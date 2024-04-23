<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ChatController extends Controller
{
    
    public function index(Request $request)
    {
        $loggedInUserId = $request->query('logged_in_user');
        $ownerUserId = $request->query('owner_user');

        return view('pages.chat.chatSection', compact('loggedInUserId', 'ownerUserId'));
    }


}
