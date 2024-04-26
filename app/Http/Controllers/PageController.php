<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use App\Models\Feedbacks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Likes;
use App\Models\Wishlist;
use App\Models\User;
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

        $authenticatedUser = session('authenticatedUser');
        $wishlistCount = null;
        $categoryCounts = $recentProductsByCategory->map->count();
        $topCategories = $categoryCounts->sortDesc()->keys()->take(3);

        $products = Goods::whereIn('g_category', $topCategories)
        ->where('us_ID', '!=', $authenticatedUser->us_ID)
        ->get();

        if ($authenticatedUser && $authenticatedUser->us_ID) {
            $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        }

        return view('pages.explore', [
            'user' => $authenticatedUser,
            'products' => $products,
            'wishlistCount' => $wishlistCount,
        ]);
    }


    public function categories()
    {
        $authenticatedUser = session('authenticatedUser');
        $categories = Goods::distinct('g_category')->pluck('g_category');
        $products = Goods::getAllGoodsWithImages();
        $wishlistCount = null;
        $wishlistItems = [];

        if ($authenticatedUser && $authenticatedUser->us_ID) {
            $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
            $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)->pluck('g_ID')->toArray();
        }

        if (empty($wishlistItems)) {
            $nonWishlistProducts = Goods::with('images')
                ->inRandomOrder()
                ->limit(8)
                ->get();
        } else {
            $nonWishlistProducts = Goods::whereNotIn('g_ID', $wishlistItems)
                ->with('images')
                ->inRandomOrder()
                ->limit(8)
                ->get();
        }

        return view('pages.categories', [
            'user' => $authenticatedUser,
            'categories' => $categories,
            'products' => $products,
            'nonWishlistProducts' => $nonWishlistProducts,
            'wishlistCount' => $wishlistCount,
        ]);
    }


    public function wishlist()
    {
        $authenticatedUser = session('authenticatedUser');
        if (!$authenticatedUser || !$authenticatedUser->us_ID) {
            return redirect()->route('explore');
        }

        $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)
            ->with('goods.images')
            ->get();

        $categories = Goods::distinct('g_category')->pluck('g_category');

        $products = Goods::getAllGoodsWithImages();

        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        
        $wishlistItemIds = Wishlist::where('us_ID', $authenticatedUser->us_ID)->pluck('g_ID')->toArray();

        $nonWishlistProducts = Goods::whereNotIn('g_ID', $wishlistItemIds)
            ->with('images')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('pages.wishlist', [
            'user' => $authenticatedUser,
            'categories' => $categories,
            'products' => $products,
            'nonWishlistProducts' => $nonWishlistProducts,
            'wishlistCount' => $wishlistCount,
            'wishlistItems' => $wishlistItems,
        ]);
    }

    public function communities()
    {
        $authenticatedUser = session('authenticatedUser');
        if ($authenticatedUser !== null) {
            $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        } else {
            $wishlistCount = 0;
        }
        $communities = Communities::with('feedbacks')->get();
        foreach ($communities as $community) {
            $isLiked = Likes::where('user_ID', $authenticatedUser->us_ID)
                            ->where('community_ID', $community->community_ID)
                            ->exists();
            $community->isLikedByCurrentUser = $isLiked;
        }
        $feedbacks = Feedbacks::all();
        return view("pages.communities", compact('communities', 'feedbacks', 'wishlistCount', 'authenticatedUser'));
    }

    public function my_profile()
    {
        $authenticatedUser = session('authenticatedUser');
        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();

        return view('pages.myProfile', [
            'user' => $authenticatedUser, 
            'wishlistCount' => $wishlistCount,
        ]);
    }

public function my_goods()
{
    $authenticatedUser = session('authenticatedUser');
    $userId = $authenticatedUser->us_ID;
    
    // Fetch goods with their associated images
    $goods = Goods::with('images')->where('us_ID', $userId)->get();
    
    $wishlistCount = Wishlist::where('us_ID', $userId)->count();

    return view("pages.myGoods", compact('goods', 'wishlistCount'));
}


    public function goods_detail($id)
    {
        $authenticatedUser = session('authenticatedUser');
        $user = session('authenticatedUser');
        
        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        $userId = $authenticatedUser->us_ID;
        $goods = Goods::where('us_ID', $userId)->get();

        $product = Goods::findOrFail($id);
        $userDetails = User::findOrFail($product->us_ID);
        
        return view("pages.goodsDetail", compact('user', 'authenticatedUser', 'userDetails', 'goods', 'wishlistCount', 'product'));
    }
}
