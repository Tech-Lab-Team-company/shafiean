<?php

namespace App\Services\Global;

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
use App\Models\Live\Live;
use Monolog\DateTimeImmutable;
use App\Models\GroupStageSession;
use App\Models\Live\Live100msInfo;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\Http;
use App\Helpers\Response\DataSuccess;
use App\Http\Params\Live100MSIntegrationParam;
use App\Http\Resources\Live\JoinRoomResource;

class Live100MSIntegrationService
{
    protected $App_key;
    protected $App_secret;
    protected $live100MSIntegrationParam;
    public function __construct($App_key, $App_secret)
    {
        $this->App_key = $App_key;
        $this->App_secret = $App_secret;
    }
    public function create_room($request, $join = false): DataStatus
    {
        try {
            $room_data = $this->handle_live_room_body($request);
            $headers = [
                'Authorization' => 'Bearer ' . $room_data['data']['token'],
                'Content-Type' => 'application/json'
            ];
            // dd($room_data['data']);
            $response = Http::withHeaders($headers)->post('https://api.100ms.live/v2/rooms', $room_data['data']['body']);
            $json_data = $response->json();
            // dd($json_data['id']);
            $arrayOfCodes = $this->get_room_code($json_data['id']);
            // dd($arrayOfCodes);
            $room_info_data = $json_data + $arrayOfCodes;
            // dd($room_info_data);
            $live_info = $this->store_live_info($room_data['data']['live_id'], $room_info_data);

            if ($join) {
                return new DataSuccess(
                    status: true,
                    data: $room_data['data']['live'],
                    message: 'Room created successfully',
                );
                // return $room_data['data']['live'];
            }
            return new DataSuccess(
                status: true,
                message: 'Room created successfully',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function join_room($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->session_id);
            if ($request->live_id == null) {
                $live = $session->lives()->latest()->first();
            } else {
                $live = $session->lives()->where('id', $request->live_id)->first();
            }
            if ($live == null) {
                $check_live =  $this->create_room($request, true);
                if ($check_live instanceof DataFailed) {
                    return new DataFailed(
                        status: false,
                        message: $this->create_room($request, true)->getMessage()
                    );
                }
                if ($check_live instanceof DataSuccess) {
                    $live =   $check_live->getData();
                }
            }

            // dd($live);
            $live_info = $live->live_info;
            $live->update([
                'leave_date' => null
            ]);
            return new DataSuccess(
                status: true,
                message: 'Room joined successfully',
                data: new JoinRoomResource($live_info)
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage() . ' ' . $e->getLine(),
            );
        }
    }

    public function handle_live_room_body($request)
    {
        $session = GroupStageSession::find($request->session_id);
        $this->live100MSIntegrationParam = new Live100MSIntegrationParam($session, $request->enable_recording);
        $body = $this->live100MSIntegrationParam->prepare_body();
        $live = $this->store_live($session);
        $token = $this->generate_token();
        $response = [
            'data' => [
                'body' => $body,
                'token' => $token,
                'live_id' => $live->id,
                'live' => $live
            ]
        ];
        return $response;
    }
    public function store_live($session)
    {
        $live_data =  $this->live100MSIntegrationParam->handel_live_data($session);
        // dd($live_data);
        $hasLive = Live::where('session_id', $live_data['session_id'])
            ->where('course_id', $live_data['course_id'])
            ->where('group_id', $live_data['group_id'])
            ->where('leave_date', null)
            ->latest()->first();
        if ($hasLive) {
            throw new \Exception('هذا اللايف موجود بالفعل');
        }
        $live = Live::create($live_data);
        return $live;
    }

    public function store_live_info($live_id, $data)
    {
        $live_info_data = $this->live100MSIntegrationParam->handel_live_info_data($live_id, $data);
        $live_info = Live100msInfo::create($live_info_data);
        return $live_info;
    }
    public function generate_token()
    {
        $issuedAt   = new DateTimeImmutable('now');
        $expire     = $issuedAt->modify('+24 hours')->getTimestamp();
        $payload = [
            'access_key' => $this->App_key,
            'type' => 'management',
            'version' => 2,
            'jti' =>  Uuid::uuid4()->toString(),
            'iat'  => $issuedAt->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
        ];
        return JWT::encode($payload, $this->App_secret, 'HS256');
    }

    public function get_room_code($room_id)
    {
        $token = $this->generate_token(); //generate
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];
        $response = Http::withHeaders($headers)->post('https://api.100ms.live/v2/room-codes/room/' . $room_id);
        return $response->json();
    }

    public function getAppKey()
    {
        // Access the API key
        return $this->App_key;
    }

    public function getAppSecret()
    {
        // Access the secret
        return $this->App_secret;
    }
}
