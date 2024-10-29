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
    public function create_room($request): DataStatus
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
        // dd($live_info);
    }

    public function join_room($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->session_id);
            $live = $session->lives()->where('id', $request->live_id)->first();
            if (is_null($live)) {
                $live =  $this->create_room($request);
            }

            // dd($live->live_info);
            $live_info = $live->live_info;

            return new DataSuccess(
                status: true,
                message: 'Room joined successfully',
                data: new JoinRoomResource($live_info)
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function handle_live_room_body($request)
    {
        $session = GroupStageSession::find($request->session_id);
        // dd($session);
        $this->live100MSIntegrationParam = new Live100MSIntegrationParam($session, $request->enable_recording);
        $body = $this->live100MSIntegrationParam->prepare_body();
        // dd($body);
        $live = $this->store_live($session);
        // dd($live);
        $token = $this->generate_token();
        // dd($token);
        $response = [
            'data' => [
                'body' => $body,
                'token' => $token,
                'live_id' => $live->id
            ]
        ];
        return $response;
    }
    public function store_live($session)
    {

        $live_data =  $this->live100MSIntegrationParam->handel_live_data($session);
        // dd($live_data);
        $live = Live::create($live_data);

        return $live;
    }

    public function store_live_info($live_id, $data)
    {
        // dd($data , $live_id);
        $live_info_data = $this->live100MSIntegrationParam->handel_live_info_data($live_id, $data);
        // dd($live_info_data);
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
        $room_id = $room_id;
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        $response = Http::withHeaders($headers)->post('https://api.100ms.live/v2/room-codes/room/' . $room_id);
        //        dd($response->json());
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
