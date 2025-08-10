<?php

namespace App\Observers;

use App\Models\AttendenceReport\AttendenceReport;

use App\Enum\ReportTypeEnum;
use App\Models\Report\Report;
use App\Modules\Notification\Application\DTOS\Notification\NotificationDTO;
use App\Modules\Notification\Application\DTOS\NotificationUser\NotificationUserDTO;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\Notification\NotificationRepository;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\NotificationUser\NotificationUserRepository;
use Illuminate\Support\Facades\Log;

class AttendenceReportObserver
{
    /**
     * Handle the AttendenceReport "created" event.
     */
    public function created(AttendenceReport $attendenceReport): void
    {
        if ($attendenceReport->user_id) {
            // send notification to user
            $title = 'New Report';
            $subtitle = 'New Report';
            $NotificationDTO = NotificationDTO::fromArray([
                'title' => $title,
                'subtitle' => $subtitle,
                'userIds' => [$attendenceReport->user_id],
                'notifiable_id' => $attendenceReport->id,
                'notifiable_type' => AttendenceReport::class,
            ]);

            try {
                $NotificationRepository = new NotificationRepository();
                $NotificationRepository->SendNotification($NotificationDTO);
            } catch (\Throwable $th) {
                Log::info($th->getMessage());
            }

            // create notification to user in the database
            $notification = $NotificationRepository->create($NotificationDTO);
            $NotificationUserDTO = NotificationUserDTO::fromArray([
                'notification_id' => $notification->id,
                'user_id' => $attendenceReport->user_id,
            ]);
            $NotificationUserRepository = new NotificationUserRepository();
            $NotificationUserRepository->create($NotificationUserDTO);
        }
    }

    /**
     * Handle the AttendenceReport "updated" event.
     */
    public function updated(AttendenceReport $attendenceReport): void
    {
        //
    }

    /**
     * Handle the AttendenceReport "deleted" event.
     */
    public function deleted(AttendenceReport $attendenceReport): void
    {
        //
    }

    /**
     * Handle the AttendenceReport "restored" event.
     */
    public function restored(AttendenceReport $attendenceReport): void
    {
        //
    }

    /**
     * Handle the AttendenceReport "force deleted" event.
     */
    public function forceDeleted(AttendenceReport $attendenceReport): void
    {
        //
    }
}
