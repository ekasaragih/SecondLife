<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    
    public function index(Request $request)
    {
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');
        $goodsId = $request->query('goods');
        
        $ownerName = User::where('us_ID', $ownerUserId)->value('us_name');
        
        $chatMessages = Message::where(function ($query) use ($loggedInUserId, $ownerUserId, $goodsId) {
            $query->where('sender_id', $loggedInUserId)
                ->where('receiver_id', $ownerUserId)
                ->where('g_ID', $goodsId);
        })->orWhere(function ($query) use ($loggedInUserId, $ownerUserId, $goodsId) {
            $query->where('sender_id', $ownerUserId)
                ->where('receiver_id', $loggedInUserId)
                ->where('g_ID', $goodsId);
        })->orderBy('created_at')
        ->get();

        $product = Goods::where('us_ID', $ownerUserId)->first();

        $contacts = Message::where('receiver_id', $loggedInUserId)
        ->distinct('sender_id')
        ->pluck('sender_id');

        $contacts = User::whereIn('us_ID', $contacts)->get();

                foreach ($contacts as $contact) {
            $lastMessage = Message::where(function ($query) use ($loggedInUserId, $contact) {
                $query->where('sender_id', $loggedInUserId)
                    ->where('receiver_id', $contact->us_ID);
            })->orWhere(function ($query) use ($loggedInUserId, $contact) {
                $query->where('sender_id', $contact->us_ID)
                    ->where('receiver_id', $loggedInUserId);
            })->orderBy('created_at', 'desc')->first();

            $contact->last_message_time = $lastMessage ? $lastMessage->created_at->format('H:i') : null;
            $contact->last_message = $lastMessage ? $lastMessage->message : null;
        }

        return view('pages.chat.chatSection', compact('loggedInUserId', 'ownerUserId', 'chatMessages', 'product', 'ownerName', 'contacts'));
    }




}
