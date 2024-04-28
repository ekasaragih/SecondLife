<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;

class ChatController extends ApiController
{

/**
     * Display the specified resource.
     */
    
    /**
     * Send message to user
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function send(Request $request)
    {
        $message = $request->input('message');
        $senderId = $request->input('sender_id');
        $receiverId = $request->input('receiver_id');
        $isReply = $request->input('is_reply', false);

        $newMessage = new Message();
        $newMessage->sender_id = $senderId;
        $newMessage->receiver_id = $receiverId;
        $newMessage->message = $message;
        $newMessage->is_read = !$isReply; 
        $newMessage->save();

        return response()->json(['success' => true]);
    } 

    public function fetch(Request $request)
    {
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');
        $goodsId = $request->query('goods');

        $chatMessages = Message::where(function ($query) use ($loggedInUserId, $ownerUserId) {
            $query->where('sender_id', $loggedInUserId)
                  ->where('receiver_id', $ownerUserId);
        })->orWhere(function ($query) use ($loggedInUserId, $ownerUserId) {
            $query->where('sender_id', $ownerUserId)
                  ->where('receiver_id', $loggedInUserId);
        })->orderBy('created_at')->get();

        return response()->json(['chatMessages' => $chatMessages]);
    }

}
