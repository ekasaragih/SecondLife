<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use App\Models\Feedbacks;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function store(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'community_title' => 'required|string',
            'community_desc' => 'required|string',
        ]);

        $community = new Communities();
        $community->us_ID = $authenticatedUser->us_ID;
        $community->community_title = $request->input('community_title');
        $community->community_desc = $request->input('community_desc');
      
        $community->save();

        return response()->json(['message' => 'Data stored successfully', 'community_ID' => $community->community_ID], 200);

    }

    public function storeFeedback(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'community_ID' => 'required|integer',
            'feedback_desc' => 'required|string',
        ]);

        $feedback = new Feedbacks();
        $feedback->us_ID = $authenticatedUser->us_ID;
        $feedback->community_ID = $request->input('community_ID');
        $feedback->feedback_desc = $request->input('feedback_desc');
      
        $feedback->save();

        return response()->json(['message' => 'Data stored successfully', 'community_ID' => $feedback->community_ID], 200);

    }
}
