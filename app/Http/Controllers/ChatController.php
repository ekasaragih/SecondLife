<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Message;

class ChatController extends Controller
{
    
    public function index(Request $request)
    {
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');
        
        // Fetch the chat messages
        $chatMessages = Message::where('sender_id', $loggedInUserId)
            ->orWhere('receiver_id', $loggedInUserId)
            ->orderBy('created_at')
            ->get();

        // Fetch the product details
        $product = Goods::where('us_ID', $ownerUserId)->first();

        return view('pages.chat.chatSection', compact('loggedInUserId', 'ownerUserId', 'chatMessages', 'product'));
    }


}
