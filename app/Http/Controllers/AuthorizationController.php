<?php

namespace App\Http\Controllers;

use App\Constants\Roles;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorizationController extends Controller
{
    public function login()
    {
        return view("authorization.login");
    }

    public function register()
    {
        return view("authorization.register");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'us_name' => 'required|string|max:250',
            'us_username' => 'required|string|max:12',
            'us_email' => 'required|email:dns|max:250|unique:users',
            'us_password' => 'required|min:8',
            
        ]);

        User::create([
            'role_id' => Roles::ROLE_USER,
            'us_name' => $request->name,
            'us_email' => $request->email,
            'us_password' => Hash::make($request->password),
            'password_updated_at' => now()
        ]);    

        $credentials = $request->only('us_email', 'us_password');
        Auth::attempt($credentials);

        $request->session()->regenerate();

        return redirect()->route('dashboard')->withSuccess('You have successfully registered!');
    }

}
