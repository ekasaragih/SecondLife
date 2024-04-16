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
        return view('pages.explore');
    }

    // Categories Section
    public function categories()
    {
        return view("pages.categories");
    }
    // End of Categories Section

    // wishlist Section
    public function wishlist()
    {
        return view("pages.wishlist");
    }
    // End of wishlist Section

    public function communities()
    {
        return view("pages.communities");
    }

    public function my_profile()
    {
        return view("pages.myProfile");
    }

    public function my_goods()
    {
        return view("pages.myGoods");
    }
}
