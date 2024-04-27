<?php

// app/Http/Controllers/FollowerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;

class FollowerController extends Controller
{
    public function followUser(Request $request)
    {
        $follower = new Follower();
        $follower->current_user = auth()->user()->us_ID; // ID user yang sedang login
        $follower->user_followed = $request->user_followed_id; // ID user yang akan di-follow
        $follower->save();

        return back()->with('success', 'You are now following this user.');
    }

    public function unfollowUser(Request $request)
    {
        $follower = Follower::where('current_user', auth()->user()->us_ID)
                            ->where('user_followed', $request->user_followed_id)
                            ->first();

        if ($follower) {
            $follower->delete();
            return back()->with('success', 'You have unfollowed this user.');
        }

        return back()->with('error', 'You are not following this user.');
    }
}
