<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserProfile($username)
    {
        // Ambil data pengguna berdasarkan username
        $user = User::where('us_name', $username)->firstOrFail();

        // Ambil barang-barang (goods) yang dimiliki oleh pengguna
        $goods = $user->goods;

        // Tampilkan halaman profil pengguna dengan data yang diperlukan
        return view('pages.user.userProfile', ['user' => $user, 'goods' => $goods]);
    }

   public function followUser(User $user)
    {
        // Attach the user to the following relationship of the authenticated user
        auth()->user()->following()->attach($user);

        return back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollowUser(User $user)
    {
        auth()->user()->following()->detach($user);

        return back()->with('success', 'You have unfollowed ' . $user->name);
    }

    public function followStatus(User $user)
    {
        // Check if authenticated user is following the specified user
        $isFollowing = auth()->user()->isFollowing($user);

        return response()->json(['is_following' => $isFollowing]);
    }
}

