<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Message;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Exchange;

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

        $product = Goods::where('us_ID', $ownerUserId)->first();

        $contactIds = Message::where('sender_id', $loggedInUserId)
        ->orWhere('receiver_id', $loggedInUserId)
        ->distinct()
        ->pluck('sender_id')
        ->merge(Message::where('sender_id', $loggedInUserId)
            ->orWhere('receiver_id', $loggedInUserId)
            ->distinct()
            ->pluck('receiver_id'))
        ->unique();

        $contacts = User::whereIn('us_ID', $contactIds)
            ->orderByDesc(function ($query) use ($loggedInUserId) {
                $query->select('created_at')
                    ->from('messages')
                    ->whereRaw('messages.sender_ID = users.us_ID')
                    ->orWhereRaw('messages.receiver_ID = users.us_ID')
                    ->orderByDesc('created_at')
                    ->limit(1);
            })
            ->get();

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

        $authenticatedUser = session('authenticatedUser');
        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        $userId = $authenticatedUser->us_ID;
        $goods = Goods::where('us_ID', $userId)->get();

        $chattingUserGoods = Goods::where('us_ID', $ownerUserId)->get();
        $loggedInUserGoods = Goods::where('us_ID', $loggedInUserId)->get();

        $recentExchange = Exchange::latest()->first();

        return view('pages.chat.chatSection', [
            'recentExchange' => $recentExchange,
            'loggedInUserId' => $loggedInUserId,
            'chattingUserGoods' => $chattingUserGoods,
            'loggedInUserGoods' => $loggedInUserGoods,
            'ownerUserId' => $ownerUserId,
            'chatMessages' => $chatMessages,
            'ownerName' => $ownerName,
            'contacts' => $contacts,
            'ownerUsername' => $ownerUsername,
            'goods' => $goods,
            'wishlistCount' => $wishlistCount,
            'product' => $product,
            'goodsId' => $goodsId,

        ]);
    }


}
