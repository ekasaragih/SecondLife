<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ChatController extends Controller
{
    
    public function index()
    {
        return view("pages.chat.chatSection");
    }

    public function chat_page(Request $request)
    {
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');

        return view('pages.chat.chat', compact('loggedInUserId', 'ownerUserId'));
    }


}
