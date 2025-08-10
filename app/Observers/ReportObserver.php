<?php

namespace App\Observers;

use App\Enum\ReportTypeEnum;
use App\Models\Report\Report;
use App\Modules\Notification\Application\DTOS\Notification\NotificationDTO;
use App\Modules\Notification\Application\DTOS\NotificationUser\NotificationUserDTO;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\Notification\NotificationRepository;
use App\Modules\Notification\Infrastructure\Persistence\Repositories\NotificationUser\NotificationUserRepository;
use Illuminate\Support\Facades\Log;

class ReportObserver
{
    /**
     * Handle the Report "created" event.
     */
    public function created(Report $report): void
    {
        if(isset($report->user_id) &&  $report->type !== ReportTypeEnum::ATTENDENCE->value){
            // send notification to user
            $title = 'New Report';
            $subtitle = 'New Report';
            $NotificationDTO = NotificationDTO::fromArray([
                'title' => $title,
                'subtitle' => $subtitle,
                'userIds' => [$report->user_id],
                'notifiable_id' => $report->id,
                'notifiable_type' => Report::class,
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
                'user_id' => $report->user_id,
            ]);
            $NotificationUserRepository = new NotificationUserRepository();
            $NotificationUserRepository->create($NotificationUserDTO);
        }
    }

    /**
     * Handle the Report "updated" event.
     */
    public function updated(Report $report): void
    {
        //
    }

    /**
     * Handle the Report "deleted" event.
     */
    public function deleted(Report $report): void
    {
        //
    }

    /**
     * Handle the Report "restored" event.
     */
    public function restored(Report $report): void
    {
        //
    }

    /**
     * Handle the Report "force deleted" event.
     */
    public function forceDeleted(Report $report): void
    {
        //
    }
}
