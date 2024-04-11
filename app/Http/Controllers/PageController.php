<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function explore()
    {
        return view("pages.explore");
    }

    public function categories()
    {
        return view("pages.categories");
    }

    public function communities()
    {
        return view("pages.communities");
    }

    public function user_profile()
    {
        return view("pages.user-profile");
    }
}
