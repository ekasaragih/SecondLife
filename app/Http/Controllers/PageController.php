<?php

namespace App\Http\Controllers;
use App\Models\Goods;

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
        $authenticatedUser = session('authenticatedUser');
        $products = Goods::all();
        
        return view('pages.explore', [
            'user' => $authenticatedUser,
            'products' => $products,
        ]);
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
        $authenticatedUser = session('authenticatedUser');

        return view('pages.myProfile', ['user' => $authenticatedUser]);
    }


    public function my_goods()
    {
        return view("pages.myGoods");
    }
}
