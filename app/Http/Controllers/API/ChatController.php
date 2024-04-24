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
        $goodsId = $request->input('g_ID');

        $newMessage = new Message();
        $newMessage->sender_id = $senderId;
        $newMessage->receiver_id = $receiverId;
        $newMessage->message = $message;
        $newMessage->g_ID = $goodsId;
        $newMessage->save();

        return response()->json(['success' => true]);
    } 


}
