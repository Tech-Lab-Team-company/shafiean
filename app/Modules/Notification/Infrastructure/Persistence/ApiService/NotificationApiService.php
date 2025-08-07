<?php


namespace App\Modules\Notification\Infrastructure\Persistence\ApiService;

use Illuminate\Support\Facades\Http;
use App\Modules\Notification\Application\DTOS\Notification\NotificationDTO;
use App\Modules\Notification\Application\DTOS\Topic\TopicDTO;
use Illuminate\Support\Facades\Log;

class NotificationApiService
{
    protected $baseUrl;
    protected $projectSlug;

    public function __construct()
    {
        $this->baseUrl = config('services.notification_api.base_url');
        $this->projectSlug = config('services.notification_api.project_slug');
    }
    public function subscribeTopic(TopicDTO $TopicDTO, $users_tokens)
    {
        $url =  $this->baseUrl . "createTopicAndSubscribe";
        $response = Http::withOptions(['verify' => false])->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post($url, [
            'project_slug' => $this->projectSlug,
            'topic_name' =>  $TopicDTO->name,
            'provider' => 'firebase',
            'tokens' => $users_tokens
        ]);
        // $response = Http::post($url, [
        //     'project_slug' => $this->projectSlug,
        //     'topic_name' => $TopicDTO->name,
        //     'provider' => $provider,
        //     'tokens' => $users_tokens
        // ]);
        // dd($response->json());
        return $response->json();
    }



    public function sendNotification(NotificationDTO $notificationDTO, $topic = null, $tokens = null, $type = null)
    {
        Log::info('send Notification start', ['data' => $tokens]);
        // dd($notificationDTO , $topic, $tokens, $type);
        $url =  $this->baseUrl . "sendNotificationToTopic";
        // dd($url);
        // dd($this->projectSlug,$notificationDTO->title,$notificationDTO->body,$notificationDTO->user_device_tokens);
        $response = Http::withOptions(['verify' => false]) // still good if there's self-signed SSL
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->post($url, [
                'project_slug' => $this->projectSlug,
                'topic_name' => $topic,
                'title' => $notificationDTO->title,
                'body' => $notificationDTO->subtitle,
                'tokens' => $tokens,
                'type' => $type,
                'provider' => 'firebase',
            ]);
        // dd($response->json());
        Log::info('Notification sent end', ['data' => $response->json()]);
        return $response->json();
    }
}
