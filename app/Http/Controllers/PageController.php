<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Goods;
use Illuminate\Support\Facades\DB;

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
    public function about_us()
    {
        return view("utils.menu.aboutUs");
    }

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
        $recentProductsByCategory = Goods::select('g_category', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get()
            ->groupBy('g_category');

        $categoryCounts = $recentProductsByCategory->map->count();
        $topCategories = $categoryCounts->sortDesc()->keys()->take(3);
        $products = Goods::whereIn('g_category', $topCategories)->get();
        // dd($products);
        $authenticatedUser = session('authenticatedUser');

        return view('pages.explore', [
            'user' => $authenticatedUser,
            'products' => $products,
        ]);
    }

    public function categories()
    {
        return view("pages.categories");
    }

    public function wishlist()
    {
        return view("pages.wishlist");
    }

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
        $authenticatedUser = session('authenticatedUser');
        $userId = $authenticatedUser->us_ID;
        $goods = Goods::where('us_ID', $userId)->get();
        return view("pages.myGoods", compact('goods'));
    }
}
