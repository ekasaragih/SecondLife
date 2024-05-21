<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids; // Tambahkan baris ini


class UserController extends Controller
{
    public function showUserProfile($username)
    {
        // Ambil data pengguna berdasarkan username
        $user = User::where('us_username', $username)->firstOrFail();

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

    public function store_profilePicture(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'avatar.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $us_ID = $authenticatedUser->us_ID;
        $user = User::find($us_ID);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->avatar){
            $imagePath = public_path('users_img/' . $user->avatar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $avatar = $request->file('avatar');
        $userName = str_replace(' ', '_', $user->us_username);
        $timestamp = now()->timestamp;
        $extension = $avatar->getClientOriginalExtension();

        $imageName = $userName . '_'  . $timestamp . '.' . $extension;
        $avatar->move(public_path('users_img'), $imageName);

        $user->avatar = $imageName;
        $user->save();

        return response()->json(['message' => 'Images stored successfully'], 200);
    }


    public function edit_profile(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'us_name' => 'required|string|max:250',
            'us_username' => 'required|string|max:12',
            'us_email' => 'required|email|max:250',
            'us_DOB' => 'nullable|date',
            'us_gender' => 'nullable|string',
        ]);

        $us_ID = $authenticatedUser->us_ID;
        $profile = User::find($us_ID);

        if ($profile) {
            if($profile->us_email !== $request->input('us_email')){
                $request->validate([
                    'us_email' => 'required|email|max:250|unique:users,us_email,' . $us_ID . ',us_id',
                ]);
                $profile->us_email = $request->input('us_email');
            }
            if($profile->us_username !== $request->input('us_username')){
                $request->validate([
                    'us_username' => 'required|string|max:12|unique:users,us_username,' . $us_ID . ',us_id',
                ]);
                $profile->us_username = $request->input('us_username');
            }
            $profile->us_name = $request->input('us_name');
            $profile->us_DOB = $request->input('us_DOB');
            $profile->us_gender = $request->input('us_gender');
            $profile->save();

            return response()->json(['message' => 'Data changes stored successfully', 'us_ID' => $profile->g_ID], 200);
            
        }else{
            return response()->json(['message' => 'Record not found'], 404);
        }
        
    }

    public function edit_address(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'us_city' => 'required|string',
            'us_province' => 'required|string',
        ]);

        $us_ID = $authenticatedUser->us_ID;
        $profile = User::find($us_ID);

        if ($profile) {
            $profile->us_city = $request->input('us_city');
            $profile->us_province = $request->input('us_province');
            $profile->save();

            return response()->json(['message' => 'Data changes stored successfully', 'us_ID' => $profile->g_ID], 200);
            
        }else{
            return response()->json(['message' => 'Record not found'], 404);
        }
        
    }
}

