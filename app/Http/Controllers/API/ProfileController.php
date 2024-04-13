<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends ApiController
{

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

 /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'us_name' => 'required|string|max:250',
            'us_username' => 'required|string|max:12',
            'us_email' => 'required|email|max:250|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
            'us_DOB' => 'nullable|date',
            'us_gender' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = User::find(auth()->id());

        $user->fill($request->only(['us_name', 'us_email']));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->password_updated_at = now();
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            $avatarName = 'avatar_' . $user->id . '_' . date('YmdHis') . '.' . $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->storeAs('avatars', $avatarName, 'public');
            $user->avatar = $avatarName;
        }

        $user->save();
        $user->grp_name = $user->userRole()->value('role');

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }


}
