<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use App\Models\Feedbacks;
use App\Models\Likes;
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

    public function like(Request $request)
    {
        // Validate the request
        $request->validate([
            'community_ID' => 'required|exists:communities,community_ID',
        ]);

        // Check if the user has already liked the post
        $user = session('authenticatedUser');
        $community_ID = $request->community_ID;
        $like = Likes::where('user_ID', $user->us_ID)
                    ->where('community_ID', $community_ID)
                    ->first();

        if ($like) {
            // User has already liked the post
            $like->delete();
            return response()->json(['success' => 'You have unliked this post' ], 200);
        }

        // Create a new like record
        $like = new Likes();
        $like->user_ID = $user->us_ID;
        $like->community_ID = $community_ID;
        $like->save();

        // Return success response with updated like count
        return response()->json(['success' => 'You have liked this post' ], 200);
    }
}
