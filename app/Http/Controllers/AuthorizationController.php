<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
