<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Message;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Exchange;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ChatController extends Controller
{
    
    public function index(Request $request)
    {
        // Retrieve query parameters
        // $hashedLoggedInUserId = $request->query('logged_in_user');
        // $hashedOwnerUserId = $request->query('owner_user');

        // // dd($hashedLoggedInUserId, $hashedOwnerUserId);

        // // Decode hashed IDs to get the real user IDs
        // $loggedInUserId = $this->decodeHashId($hashedLoggedInUserId);
        // $ownerUserId = $this->decodeHashId($hashedOwnerUserId);

        // dd($loggedInUserId, $ownerUserId);

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
        
        // Fetch recent exchange
        $recentExchange = Exchange::latest()->first();

        $exchangedGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'))->unique();

        // $loggedInUserGoods = Goods::where('us_ID', $loggedInUserId)
        //     ->whereNotIn('g_ID', $exchangedGoodsIds)
        //     ->get();

        // Fetch user's wishlist
        $wishlist = Wishlist::where('us_ID', auth()->id())->get();
        $wishlistGoodsIds = $wishlist->pluck('g_ID')->toArray();

        // Fetch goods from the user's wishlist
        $wishlistGoods = Goods::whereIn('g_ID', $wishlistGoodsIds)->get();

        // Fetch goods uploaded by the user, excluding those from the wishlist
        $loggedInUserGoods = Goods::where('us_ID', $loggedInUserId)
            ->whereNotIn('g_ID', $exchangedGoodsIds)
            ->get();

        // Merge wishlist goods with user's goods
        $goods = $wishlistGoods->merge($loggedInUserGoods);


        $chattingUserGoods = Goods::where('us_ID', $ownerUserId)
            ->whereNotIn('g_ID', $exchangedGoodsIds)
            ->whereNotIn('g_ID', $wishlistGoodsIds)
            ->get();

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
            'wishlistGoods' => $wishlistGoods,
        ]);
    }

private function decodeHashId($hashedId) 
{
    try {
        // Convert the hexadecimal representation to decimal
        $userId = hexdec($hashedId);
        
        // Return the decrypted user ID
        return $userId;
    } catch (\Exception $e) {
        // Handle decryption failure, maybe log an error
        return null;
    }
}









}
