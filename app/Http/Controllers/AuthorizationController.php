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
use App\Mail\ForgotPasswordMail;

class AuthorizationController extends Controller
{
    public function login()
    {
        return view("authorization.login");
    }
    public function forgotPassword()
    {
        return view("authorization.forgotPassword");
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

    public function authenticate(Request $request)
    {
        $credentials = $request->only('us_username', 'password');
    
        $validator = Validator::make($credentials, [
            'us_username' => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::where('us_username', $credentials['us_username'])->first();
    
        if ($user && password_verify($credentials['password'], $user->password)) {
            if (Auth::loginUsingId($user->us_ID)) {

                session([
                    'authenticatedUser' => $user,
                ]);

                return redirect()->route('explore');
            }
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
    } 

    public function getAuthenticatedUserName()
    {
        // Pastikan pengguna sudah terotentikasi sebelum mengambil nama pengguna
        if (Auth::check()) {
            // Ambil nama pengguna yang sedang login
            $loggedInUserName = Auth::user()->us_name;

            // Kirimkan nama pengguna ke tampilan atau lakukan tindakan yang sesuai
            return response()->json(['name' => $loggedInUserName], 200);
        } else {
            // Jika pengguna belum terotentikasi, Anda dapat mengembalikan pesan kesalahan atau melakukan tindakan lain yang sesuai dengan kebutuhan aplikasi Anda
            return response()->json(['error' => 'User is not authenticated'], 401);
        }
    }
}
