<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Services\Global\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }
    public function SendMessage(Request $request)
    {
        $chat = $this->chatService->SendMessage($request);
    }
}
