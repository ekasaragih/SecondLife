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
        $ownerUsername = User::where('us_ID', $ownerUserId)->value('us_username');
        
        $chatMessages = Message::where(function ($query) use ($loggedInUserId, $ownerUserId, $goodsId) {
            $query->where('sender_id', $loggedInUserId)
                ->where('receiver_id', $ownerUserId);
        })->orWhere(function ($query) use ($loggedInUserId, $ownerUserId, $goodsId) {
            $query->where('sender_id', $ownerUserId)
                ->where('receiver_id', $loggedInUserId);
        })->orderBy('created_at')
        ->get();

        foreach ($chatMessages as $message) {
            $message->message = $this->makeClickableLinks($message->message);
        }

        $product = Goods::where('us_ID', $ownerUserId)->first();

        $senderIds = Message::where('receiver_ID', $loggedInUserId)->distinct()->pluck('sender_ID');

        $receiverIds = Message::where('sender_ID', $loggedInUserId)->distinct()->pluck('receiver_ID');

        $contactIds = $senderIds->merge($receiverIds)->unique();

        $contacts = User::whereIn('us_ID', $contactIds)->get();

        foreach ($contacts as $contact) {
            $lastMessage = Message::where(function ($query) use ($loggedInUserId, $contact) {
                $query->where('sender_ID', $loggedInUserId)
                    ->where('receiver_ID', $contact->us_ID);
            })->orWhere(function ($query) use ($loggedInUserId, $contact) {
                $query->where('sender_ID', $contact->us_ID)
                    ->where('receiver_ID', $loggedInUserId);
            })->orderBy('created_at', 'desc')->first();

            $contact->last_message_time = $lastMessage ? $lastMessage->created_at->format('H:i') : null;
            $contact->last_message = $lastMessage ? $lastMessage->message : null;
        }

        return view('pages.chat.chatSection', compact('loggedInUserId', 'ownerUserId', 'chatMessages', 'product', 'ownerName', 'contacts', 'ownerUsername'));
    }

     private function makeClickableLinks($text)
    {
        // Find URLs and convert them into anchor tags
        $text = preg_replace('/(http?:\/\/\S+)/', '<a href="$1" target="_blank">$1</a>', $text);
        // Find email addresses and convert them into mailto links
        $text = preg_replace('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/', '<a href="mailto:$1">$1</a>', $text);
        return $text;
    }


}
