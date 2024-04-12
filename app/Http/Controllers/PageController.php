<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Error pages
    public function not_found()
    {
        return view("utils.error.404");
    }

    public function internal_server_error()
    {
        return view("utils.error.500");
    }

    // Menu
    public function contact_us()
    {
        return view("utils.menu.contactUs");
    }

    public function privacy_policy()
    {
        return view("utils.menu.privacyPolicy");
    }

    // Main pages
    public function explore()
    {
        return view("pages.explore");
    }

    // Categories Section
    public function categories()
    {
        return view("pages.categories");
    }

    public function electronic()
    {
        return view("utils.categories.electronic");
    }

    // End of Categories Section

    public function communities()
    {
        return view("pages.communities");
    }

    public function user_profile()
    {
        return view("pages.userProfile");
    }
}
