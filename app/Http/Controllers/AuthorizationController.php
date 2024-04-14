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

    public function registerSkip()
    {
        return view("authorization.registerSkip");
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
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'role_id' => Roles::ROLE_USER,
            'us_name' => $request->us_name,
            'us_username' => $request->us_username,
            'us_email' => $request->us_email,
            'password' => Hash::make($request->password),
            'password_updated_at' => now()
        ]);    

        if($user) {
            return redirect()->route('login')->withSuccess('You have successfully registered!');
        } else {
            return back()->withError('Failed to register user. Please try again.');
        }
    }

    // Function not worked yet
    public function storeSkip(Request $request)
    {
        $request->validate([
            'us_name' => 'required|string|max:250',
            'us_username' => 'required|string|max:12',
            'us_email' => 'required|email:dns|max:250|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'role_id' => Roles::ROLE_USER,
            'us_name' => $request->us_name,
            'us_username' => $request->us_username,
            'us_email' => $request->us_email,
            'password' => Hash::make($request->password),
            'password_updated_at' => now()
        ]);    

        if($user) {
            return redirect()->route('login')->withSuccess('You have successfully registered!');
        } else {
            return back()->withError('Failed to register user. Please try again.');
        }
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
            ? 'us_email' 
            : 'us_username';

        $credentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect('/')->withSuccess('You have successfully logged in!');
        }

        return redirect()->back()->withErrors([
            'login' => 'Invalid email/username or password!',
        ]);
    }


}
