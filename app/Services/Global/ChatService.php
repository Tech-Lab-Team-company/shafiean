<?php

namespace App\Services\Global;

use App\Models\User;
use App\Models\Chat\Chat;
use App\Enum\ChatTypeEnum;
use App\Events\PrivateChatEvent;
use Illuminate\Support\Facades\DB;

class ChatService
{
    public function SendMessage($request)
    {
        try {
            // dd($request->message);
            broadcast(new PrivateChatEvent($request->message))->toOthers();
            // if (!isset($request->chat_id) && isset($request->user_id)) {

            //     $chat = Chat::whereHas('users', function ($query) use ($request) {
            //         $query->whereIn('user_id', [$request->user_id, auth()->guard('user')->user()->id]);
            //     });
            //     $user = User::find($request->user_id);
            //     if (!$chat->exists()) {
            //         DB::beginTransaction();
            //         $chat =  Chat::create([
            //             'name' => auth()->guard('user')->user()->name . $user->name,
            //             'type' => ChatTypeEnum::PRIVATE->value,
            //         ]);
            //         $chat->users()->attach($request->user_id);
            //         $chat->users()->attach(auth()->guard('user')->user()->id);
            //     }
            //     $message = $chat->messages()->create([
            //         'user_id' => $request->user_id,
            //         'message' => $request->message,
            //     ]);
            //     DB::commit();
            // } else {
            //     DB::beginTransaction();
            //     $message = Chat::find($request->chat_id)->messages()->create([
            //         'user_id' => $request->user_id,
            //         'message' => $request->message,
            //     ]);
            //     DB::commit();
            // }
            // return $message;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function createChat()
    {
        try {
            DB::beginTransaction();

            $chat = Chat::create([
                'name' => auth()->guard('user')->user()->name,
                'type' => ChatTypeEnum::GROUP->value,
            ]);

            $chat->users()->attach([
                'user_id' => auth()->guard('user')->user()->id,
                'is_admin' => 1
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function assignUsersToChat($request)
    {
        try {
            DB::beginTransaction();
            $chat = Chat::find($request->chat_id);
            $chat->users()->attach($request->user_ids);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function removeUsersFromChat($request)
    {
        try {
            DB::beginTransaction();
            $chat = Chat::find($request->chat_id);
            $chat->users()->detach($request->user_ids);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function leaveChat($request)
    {
        try {
            DB::beginTransaction();
            $chat = Chat::find($request->chat_id);
            $chat->users()->detach(auth()->guard('user')->user()->id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function fetchUserChats()
    {
        return Chat::whereHas('users', function ($query) {
            $query->where('user_id', auth()->guard('user')->user()->id);
        })->get();
    }

    public function fetchChatMessages($request)
    {
        return Chat::find($request->chat_id)->messages()->get();
    }

    public function fetchChatUsers($request)
    {
        return Chat::find($request->chat_id)->users()->get();
    }

    public function fetchChatDetails($request)
    {
        return Chat::find($request->chat_id);
    }
}
