<?php

namespace App\Modules\Notification\Application\UseCases\Notification;

use App\DTOS\UserFilterDTO;
use App\Models\User;
use App\Modules\Auth\Infrastructure\Persistence\Repositories\Customer\UserRepository;
use App\Modules\Base\Application\Response\DataFailed;
use Illuminate\Support\Facades\DB;
use App\Modules\Base\Domain\Holders\AuthHolder;
use App\Modules\Base\Domain\Enums\AuthGurdTypeEnum;
use App\Modules\Base\Application\Response\DataStatus;
use App\Modules\Base\Application\Response\DataSuccess;
use App\Modules\Notification\Application\DTOS\Notification\NotificationDTO;
use App\Modules\Notification\Http\Resources\Notification\NotificationResource;
use App\Modules\Notification\Application\DTOS\Notification\NotificationFilterDTO;
use App\Modules\Notification\Application\DTOS\NotificationUser\NotificationUserDTO;
use App\Modules\Notification\Application\DTOS\Topic\TopicFilterDTO;
use App\Modules\Notification\Infrastructure\Persistence\Models\Notification\Notification;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\Notification\NotificationRepository;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\NotificationUser\NotificationUserRepository;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\Topic\TopicRepository;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class NotificationUseCase
{

    protected $NotificationRepository;
    protected $NotificationUserRepository;
    protected $userRepository;
    protected $user;
    protected $employee;
    protected $topicRepository;
    public function __construct(NotificationRepository $NotificationRepository)
    {
        $this->NotificationRepository = $NotificationRepository;
        $this->NotificationUserRepository = new NotificationUserRepository();
        // $this->userRepository = new UserRepository();
        $this->user = AuthHolder::getInstance()->getAuth(AuthGurdTypeEnum::USER->value);
        $this->employee = AuthHolder::getInstance()->getAuth(AuthGurdTypeEnum::ORGANIZATION->value);
        $this->topicRepository = new TopicRepository();
    }


    public function fetchNotifications(NotificationFilterDTO $NotificationFilterDTO): DataStatus
    {
        // dd($this->user,$this->employee);
        try {
            // dd($NotificationFilterDTO);
            $relations = [];
            if ($this->user) {
                $relations = ['users' => function ($query) {
                    $query->where('users.id', $this->user->id);
                }];
            }
            $NotificationFilterDTO->direction = 'desc';
            $Notifications = $this->NotificationRepository->filter(
                $NotificationFilterDTO,
                paginate: $NotificationFilterDTO->paginate,
                limit: $NotificationFilterDTO->limit,
                whereHasRelations: $relations
            );

            // $resourceData["unread_notifications_count"] = $this->user->notifications()->count();
            $resourceData = $NotificationFilterDTO->paginate ? NotificationResource::collection($Notifications)->response()->getData(true) : NotificationResource::collection($Notifications);
            return new DataSuccess(
                status: true,
                message: 'Notification fetched successfully',
                resourceData: $resourceData,
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function fetchUnreadNotificationCount(NotificationFilterDTO $NotificationFilterDTO): DataStatus
    {
        try {
            /* if (!$NotificationFilterDTO->user_id && $this->user) {
                $NotificationFilterDTO->user_id = $this->user->id;
            } */
            //    dd($NotificationFilterDTO);
            $unreadNotificationsCount = $this->NotificationRepository->filter(
                $NotificationFilterDTO,
                paginate: $NotificationFilterDTO->paginate,
                limit: $NotificationFilterDTO->limit,
                whereHasRelations: [
                    'users' => [
                        'users.id' => $this->user->id,
                        'is_read' => false,
                    ],
                ]
            )->count();
            return DataSuccess(
                status: true,
                message: 'Notification fetched successfully',
                resourceData: $unreadNotificationsCount,
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function createNotification(NotificationDTO $NotificationDTO): DataStatus
    {
        DB::beginTransaction();

        try {
            // 1. Determine user IDs
            if (empty($NotificationDTO->userIds)) {
                $userIds = User::select('id')->where('organization_id', $this->employee->organization_id)->pluck('id')->toArray();
                // $NotificationDTO->userIds = $userIds;
            } else {
                $userIds = $NotificationDTO->userIds;
            }

            // 2. Create notification record
            $notification = $this->NotificationRepository->create($NotificationDTO);
            if (!$notification) {
                DB::rollBack();
                return DataFailed(
                    status: false,
                    message: 'Notification creation failed'
                );
            }

            // 3. Create notification-user pivot entries
            $this->createNotificationUser($userIds, $notification->id);

            DB::commit();

            // dd ($NotificationDTO->userIds,!empty($NotificationDTO->userIds) && count($NotificationDTO->userIds) > 0) ;
            if ((!empty($NotificationDTO->userIds) && count($NotificationDTO->userIds) > 0) || !empty($NotificationDTO->topic_id)) {
                FacadesLog::info('Sending specific notification', [
                    'userIds' => $NotificationDTO->userIds,
                    'topic_id' => $NotificationDTO->topic_id,
                ]);
                $response = $this->sendSpecificNotification($NotificationDTO);
            } else {
                $response = $this->sendAllNotification($NotificationDTO);
            }
            if ($response->getStatus() == false) {
                return $response;
            }

            return DataSuccess(
                status: true,
                message: 'Notification created and sent successfully.',
                data: $notification
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return DataFailed(
                status: false,
                message: 'Notification creation failed: ' . $e->getMessage()
            );
        }
    }

    private function sendSpecificNotification(NotificationDTO $NotificationDTO): DataStatus
    {
        // dd('send specific ',$NotificationDTO);
        try {
            $response = $this->NotificationRepository->SendNotification($NotificationDTO);
            if ($response->getStatus() == false) {
                return $response;
            }
            return DataSuccess(
                status: true,
                message: 'Notification sent successfully',
                data: $response->getData()
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    private function sendAllNotification(NotificationDTO $NotificationDTO): DataStatus
    {
        try {
            // dd('send all ',$NotificationDTO);
            $topics = $this->topicRepository->filter(
                dto: new TopicFilterDTO([]),
                // whereHasRelations: [
                //     'users' => function ($query) use ($NotificationDTO) {
                //         $query->whereIn('users.id', $NotificationDTO->userIds);
                //     },
                // ],
                // pluckField: 'id',
            )->pluck('id');
            // dd($topics);
            foreach ($topics as $topicId) {
                $NotificationDTO->topic_id = $topicId;
                $NotificationDTO->userIds = [];
                // dd($NotificationDTO);
                $this->NotificationRepository->SendNotification($NotificationDTO);
            }

            return DataSuccess(
                status: true,
                message: 'Notification sent successfully',
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    private function createNotificationUser($userIds, int $notificationId): void
    {
        // dd($userIds, $notificationId);
        foreach ($userIds as $userId) {
            $NotificationUserDTO = NotificationUserDTO::fromArray([
                'notification_id' => $notificationId,
                'user_id' => $userId,
                'is_read' => false,
            ]);
            $this->NotificationUserRepository->create($NotificationUserDTO);
        }
    }
    public function updateNotification(NotificationDTO $NotificationDTO): DataStatus
    {
        try {
            if (isset($NotificationDTO->notification_id)) {
                // $Notification = $this->NotificationRepository->update($NotificationDTO->notification_id, $NotificationDTO);
                $notification = $this->NotificationRepository->getById($NotificationDTO->notification_id);
                // dd($notification->users()->where('users.id', $this->user->id)->first());
                $userNotification = $notification->users()->where('users.id', $this->user->id)->first();
                
                if (!$userNotification) {
                    return new DataFailed(
                        statusCode: 404,
                        message: 'Notification not found'
                    );
                }
                $notificationResource = new NotificationResource($notification);
            } else {
                //update all notifications for this user
                $unreadNotifications = $this->NotificationRepository->filter(
                    $NotificationDTO,
                    paginate: $NotificationDTO->paginate,
                    limit: $NotificationDTO->limit,
                    whereHasRelations: [
                        'users' => [
                            'users.id' => $this->user->id,
                            'is_read' => false,
                        ],
                    ]
                );
                // dd($unreadNotifications);
                if ($unreadNotifications->count() > 0) {
                    foreach ($unreadNotifications as $notification) {
                        /** @var Notification $notification */
                        $notification->users()->where('users.id', $this->user->id)->update(['is_read' => true]);

                        /*  $this->NotificationRepository->setModel($notification)->updatePivot(
                            relationMethod: 'users',
                            relatedId: $notification->id,
                            data: [
                                'is_read' => false
                            ]
                        ); */
                        /* $this->NotificationRepository
                            ->setModel($notification)
                            ->updatePivot('users', 1, ['is_read' => false]); */
                    }
                }
                $notificationResource = (object)[];
            }

            return DataSuccess(
                status: true,
                message: ' Notification updated successfully',
                data: $notificationResource
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function deleteNotification(NotificationFilterDTO $NotificationFilterDTO): DataStatus
    {
        try {
            $Notification = $this->NotificationRepository->delete($NotificationFilterDTO->notification_id);
            return DataSuccess(
                status: true,
                message: ' Notification deleted successfully',
            );
        } catch (\Exception $e) {
            return DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
