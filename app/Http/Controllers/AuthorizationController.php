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


}
