<?php

namespace App\Http\Controllers;

use App\Constants\Roles;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    // public function authenticate(Request $request)
    // {
    //     $request->validate([
    //         'login' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL ) 
    //         ? 'us_email' 
    //         : 'us_username';

    //     if ($loginType == 'email') {
    //         $request->validate([
    //             'login' => 'required|email|exists'
    //         ])
    //     }

    //     $credentials = [
    //         $loginType => $request->input('login'),
    //         'password' => $request->input('password'),
    //     ];

    //     if(Auth::attempt($credentials))
    //     {
    //         dd($credentials);
    //         $request->session()->regenerate();
    //         return redirect()->route('explore')->withSuccess('dasdsada');
         
    //     }

    //     return redirect()->back()->withErrors([
    //         'login' => 'Invalid email/username or password!',
    //     ]);
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('us_username', 'password');
    
        // Validate the credentials
        $validator = Validator::make($credentials, [
            'us_username' => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Retrieve the user from the database
        $user = User::where('us_username', $credentials['us_username'])->first();
    
        // Check if user exists and password matches
        if ($user && password_verify($credentials['password'], $user->password)) {
            // Attempt to authenticate the user
            if (Auth::loginUsingId($user->us_ID)) {
                // Authentication passed, fetch the authenticated user data
                $authenticatedUser = Auth::user();
                $authenticatedUserName = $authenticatedUser->us_name;
                $authenticatedUserID = $authenticatedUser->us_ID;
    
                // Store the authenticated user's name in the session
                session(['authenticatedUserName' => $authenticatedUserName]);
                session(['authenticatedUserID' => $authenticatedUserID]);

                // Redirect to dashboard
                return redirect()->route('explore');
            }
        }
    
        // Authentication failed, redirect back with error message
        return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
    } 


}
