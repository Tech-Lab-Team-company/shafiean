<?php

namespace App\Modules\Notification\Application\UseCases\Topic;

use App\Modules\Auth\Infrastructure\Persistence\Models\Customer\User;
use App\Modules\Base\Application\Response\DataFailed;
use Illuminate\Support\Facades\DB;
use App\Modules\Base\Domain\Holders\AuthHolder;
use App\Modules\Base\Domain\Enums\AuthGurdTypeEnum;
use App\Modules\Base\Application\Response\DataStatus;
use App\Modules\Notification\Application\DTOS\Topic\TopicDTO;
use App\Modules\Notification\Http\Resources\Topic\TopicResource;
use App\Modules\Notification\Application\DTOS\Topic\TopicFilterDTO;
use App\Modules\Notification\Application\DTOS\TopicUser\TopicUserDTO;
use App\Modules\Notification\Application\Enums\Topic\MaxCountOfTopicEnum;
use App\Modules\Notification\Infrastructure\Persistence\Models\Topic\Topic;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\Topic\TopicRepository;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\TopicUser\TopicUserRepository;
use Exception;
use Illuminate\Http\Response;

class TopicUseCase
{

    protected $topicRepository;
    protected $TopicUserRepository;
    protected $cartRepository;
    protected $user;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
        $this->TopicUserRepository = new TopicUserRepository();
        $this->user = AuthHolder::getInstance()->getAuth(AuthGurdTypeEnum::USER->value);
    }


    public function fetchTopics(TopicFilterDTO $topicFilterDTO): DataStatus
    {
        try {
            // dd($topicFilterDTO);
            $topics = $this->topicRepository->filter(
                $topicFilterDTO,
                operator: 'like',
                translatableFields: ['title'],
                paginate: $topicFilterDTO->paginate,
                limit: $topicFilterDTO->limit
            );
            $resource = $topicFilterDTO->paginate ? TopicResource::collection($topics)->response()->getData(true) : TopicResource::collection($topics);
            return DataSuccess(
                status: true,
                message: 'Topic fetched successfully',
                data: $resource,
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }








    public function createTopic(TopicDTO $topicDTO): DataStatus
    {
        try {

            // dd($topicDTO);
            DB::beginTransaction();

            $topic = $this->topicRepository->create($topicDTO);
            try {
                $response = $this->topicRepository->subscripeToTopic($topicDTO, $topic);

                if ($response->getStatus() == false) {
                    throw new \Exception($response->getMessage());
                }
            } catch (\Exception $e) {
                return DataFailed(
                    status: false,
                    message: $e->getMessage()
                );
            }
            // dd($topic->userIds);
            if (isset($topicDTO->userIds) && count($topicDTO->userIds) > 0) {

                foreach ($topicDTO->userIds as $userId) {
                    $TopicUserDTO = TopicUserDTO::fromArray([
                        'topic_id' => $topic->id,
                        'user_id' => $userId,
                        'type' => $topic->type
                    ]);

                    $this->TopicUserRepository->create($TopicUserDTO);
                }
            }

            DB::commit();

            return DataSuccess(
                status: true,
                message: 'Topic created successfully.',
                data: new TopicResource($topic)
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return DataFailed(
                status: false,
                message: 'Topic creation failed: ' . $e->getMessage()
            );
        }
    }





/* public function handleNotficationTopicSubscription(User $user)
    {
        try {
            $topicDTO = TopicDTO::fromArray([
                'name' => 'register',
                'userIdToSubscribe' => $user->id,
            ]);
            $topic = $this->topicRepository->getWhere(key: 'name', value: 'register', type: 'first');
            if (!$topic || $topic->count >= $topic->max) {
                $topic = $this->topicRepository->create($topicDTO);
            }
            if (!$topic || !$topic->id || $topic instanceof Exception) {
                return new DataFailed(
                    statusCode: Response::HTTP_BAD_REQUEST,
                    message: ' failed to create topic'
                );
            }
            // this step maybe Low priority required cause count and max of topic always update it with tokens count while subscribe
            $TopicUserDTO = TopicUserDTO::fromArray([
                'topic_id' => $topic->id,
                'user_id' => $user->id,
                'type' => $topic->type
            ]);
            $this->TopicUserRepository->create($TopicUserDTO);

            $subscribeTopicResponse = $this->topicRepository->subscripeToTopic($topicDTO, $topic);
        } catch (\Throwable $th) {
            return new DataFailed(
                message: $th->getMessage()
            );
        }
    } */



    public function updateTopic(TopicDTO $topicDTO): DataStatus
    {
        try {
            $topic = $this->topicRepository->update($topicDTO->topic_id, $topicDTO);

            return DataSuccess(
                status: true,
                message: ' Topic updated successfully',
                data: new TopicResource($topic)
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function deleteTopic(TopicFilterDTO $topicFilterDTO): DataStatus
    {
        try {
            $topic = $this->topicRepository->delete($topicFilterDTO->topic_id);
            return DataSuccess(
                status: true,
                message: ' Topic deleted successfully',
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
