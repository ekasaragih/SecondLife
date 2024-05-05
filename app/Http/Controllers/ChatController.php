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
        // Retrieve query parameters
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');

        // Fetch owner details
        $ownerName = User::where('us_ID', $ownerUserId)->value('us_name');
        $ownerUsername = User::where('us_ID', $ownerUserId)->value('us_username');
        $ownerAvatar = User::where('us_ID', $ownerUserId)->value('avatar');
        
        // Fetch chat messages
        $chatMessages = Message::where(function ($query) use ($loggedInUserId, $ownerUserId) {
            $query->where('sender_id', $loggedInUserId)
                ->where('receiver_id', $ownerUserId);
            })->orWhere(function ($query) use ($loggedInUserId, $ownerUserId) {
                $query->where('sender_id', $ownerUserId)
                    ->where('receiver_id', $loggedInUserId);
            })->orderBy('created_at')
            ->get();

        // Fetch contacts
        $contactIds = Message::where('sender_id', $loggedInUserId)
            ->orWhere('receiver_id', $loggedInUserId)
            ->distinct()
            ->pluck('sender_id')
            ->merge(Message::where('sender_id', $loggedInUserId)
                ->orWhere('receiver_id', $loggedInUserId)
                ->distinct()
                ->pluck('receiver_id'))
            ->unique()
            ->reject(function ($id) use ($loggedInUserId) {
                return $id == $loggedInUserId;
            });

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

        // Fetch recent exchange
        $recentExchange = Exchange::latest()->first();

        // Fetch goods excluding those in exchange table
        $loggedInUserGoods = Goods::where('us_ID', $loggedInUserId)
            ->whereNotIn('g_ID', function ($query) {
                $query->select('barter_with')->from('exchange');
            })->get();

        $chattingUserGoods = Goods::where('us_ID', $ownerUserId)
            ->whereNotIn('g_ID', function ($query) {
                $query->select('my_goods')->from('exchange');
            })->get();

        // Fetch wishlist count
        $wishlistCount = Wishlist::where('us_ID', $loggedInUserId)->count();

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
            'wishlistCount' => $wishlistCount,
            'ownerAvatar' => $ownerAvatar,
        ]);
    }



}
