<?php

namespace App\Http\Params;

use Carbon\Carbon;
use App\Models\GroupStageSession;

class Live100MSIntegrationParam
{

    protected $name;
    protected $description;
    protected $enable_recording;
    protected $session;

    public function __construct($session, $enable_recording)
    {
        $this->session = $session;
        $this->enable_recording = $enable_recording;
    }

    public function prepare_body()
    {
        //    dd($this->session->group);
        return [
            'name' => Carbon::now() . ' - ' . $this->session->id,
            'description' => $this->session?->group?->title,
            "recording_info" => [
                "enabled" => filter_var($this->enable_recording, FILTER_VALIDATE_BOOLEAN)
            ]
        ];
    }
    public function handel_live_data($session)
    {

        return [
            'session_id' => $session->id,
            'course_id' => $session->group->course->id,
            'group_id' => $session->group->id,
        ];
    }

    public function handel_live_info_data($live_id, $data)
    {
            // dd($data);
        return [
            "room_id" => $data['id'],
            "live_id" => $live_id,
            "name" => $data['name'],
            "description" => $data['description'],
            "enabled" => $data['enabled'],
            "recording" => $data['recording_info']['enabled'],
            "region" => $data['region'],
            "large_room" => $data['large_room'],
            // Merging host and guest codes based on condition
        ] + ($data['data'][0]['role'] == 'host'
            ? ["host_code" => $data['data'][0]['code'], "guest_code" => $data['data'][1]['code']]
            : ["host_code" => $data['data'][1]['code'], "guest_code" => $data['data'][0]['code']]
        );
    }
}
