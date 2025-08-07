<?php

namespace App\Modules\Notification\Infrastructure\Persistence\Repositories\Topic;

use App\Modules\Base\Application\Response\DataStatus;
use App\Modules\Notification\Application\DTOS\Topic\TopicDTO;
use App\Modules\Base\Domain\Repositories\BaseRepositoryAbstract;
use App\Modules\Notification\Infrastructure\Persistence\Models\Topic\Topic;
use App\Modules\Auth\Infrastructure\Persistence\Models\Customer\UserDevice\UserDevice;
use App\Modules\Base\Domain\DTO\BaseDTOInterface;
use App\Modules\Notification\Infrastructure\Persistence\ApiService\NotificationApiService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopicRepository extends BaseRepositoryAbstract
{
    protected $notificationApiService;
    public function __construct()
    {
        $this->setModel(new Topic());
        $this->notificationApiService = new NotificationApiService();
    }


    /**
     * Create a new record
     */
    public function create(BaseDTOInterface $dto): Model
    {
        try {
            DB::beginTransaction();
            // 1. Check for available topic with same base name and available capacity
            $baseName = explode('-', $dto->name)[0];
            $availableTopic = $this->getAvailableTopicByBaseName($baseName);
            if ($availableTopic) {
                DB::rollBack();
                // Return the existing available topic instead of creating a new one
                return $availableTopic;
            }

            // 2. Generate unique topic name with incremented order
            $order = $this->getNextOrderForBaseName($baseName);
            $uniqueName = $baseName . '-' . $order;
            $dto->name = $uniqueName;
            $dto->order = $order;

            // 3. Create the topic
            $model = $this->getModel()->create($dto->toArray());
            DB::commit();
            $model->refresh();
            return $model;
        } catch (Exception $e) {
            DB::rollBack();
            deleteFilesFromDto($dto);
            report($e);
            return new $this->getModel(); // Return a new instance of the model in case of failure
        }
    }

    public function getAvailableTopicByBaseName($baseName)
    {
        return $this->getModel()
            ->where('name', 'like', $baseName . '%')
            ->whereColumn('count', '<', 'max')
            ->orderBy('order', 'asc')
            ->first();
    }

    public function getNextOrderForBaseName($baseName)
    {
        $lastTopic = $this->getModel()
            ->where('name', 'like', $baseName . '%')
            ->orderBy('order', 'desc')
            ->first();
        return $lastTopic ? ($lastTopic->order + 1) : 1;
    }

    public function subscripeToTopic(TopicDTO $topicDTO, Topic $topic): DataStatus
    {
        try {
            if ($topicDTO->userIdToSubscribe) {
                $tokens = UserDevice::where('user_id', $topicDTO->userIdToSubscribe)->pluck('device_token')->toArray();
            } else {
                $tokens = UserDevice::whereIn('user_id', $topicDTO->userIds)->pluck('device_token')->toArray();
            }
            $tokens_list = collect($tokens)->flatten(1)->filter()->unique()->values();
            // dd(count($tokens_list));
            if (count($tokens_list) > $topic->max) {
                return DataFailed(
                    status: false,
                    message: 'You have reached the maximum number of subscribers for this topic'
                );
            }
            $response = $this->notificationApiService->subscribeTopic($topicDTO, $tokens_list);
            $topic->count = $topic->count + count($tokens_list);
            $topic->save();
            return DataSuccess(
                status: true,
                message: 'Topic created successfully.',
                data: ' $response'
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
