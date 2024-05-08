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
use App\Models\Exchange;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    // Error pages
    public function not_found()
    {
        return view('utils.error.404');
    }

    public function internal_server_error()
    {
        return view('utils.error.500');
    }

    // Menu
    public function about_us()
    {
        return view('utils.menu.aboutUs');
    }

    public function contact_us()
    {
        return view('utils.menu.contactUs');
    }

    public function privacy_policy()
    {
        return view('utils.menu.privacyPolicy');
    }

    // Main pages
    public function explore()
    {
        $recentProductsByCategory = Goods::select('g_category', 'created_at')->orderBy('created_at', 'desc')->take(20)->get()->groupBy('g_category');

        $authenticatedUser = session('authenticatedUser');
        $wishlistCount = null;
        $categoryCounts = $recentProductsByCategory->map->count();
        $topCategories = $categoryCounts->sortDesc()->keys()->take(3);

        $exchangeGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'));

        $products = Goods::whereNotIn('g_ID', $exchangeGoodsIds)->get();
        $trendProducts = $this->filterTrendProducts($topCategories, $authenticatedUser, $exchangeGoodsIds);

        if ($authenticatedUser && $authenticatedUser->us_ID) {
            $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        }

        $cities = User::distinct('us_city')->pluck('us_city');

        $userAvatar = $authenticatedUser ? $authenticatedUser->avatar : null;

        return view('pages.explore', [
            'user' => $authenticatedUser,
            'products' => $products,
            'trendProducts' => $trendProducts,
            'wishlistCount' => $wishlistCount,
            'cities' => $cities,
            'userAvatar' => $userAvatar,
        ]);
    }

    private function filterTrendProducts($topCategories, $authenticatedUser)
    {
        $exchangeGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'));

        if ($authenticatedUser) {
            return Goods::whereIn('g_category', $topCategories)
                ->where('us_ID', '!=', $authenticatedUser->us_ID)
                ->whereNotIn('g_ID', $exchangeGoodsIds)
                ->get();
        } else {
            return Goods::whereIn('g_category', $topCategories)
                ->whereNotIn('g_ID', $exchangeGoodsIds)
                ->get();
        }
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
            $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)
                ->pluck('g_ID')
                ->toArray();
        }

        $exchangeGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'));

        $nonExchangeProducts = $products->whereNotIn('g_ID', $exchangeGoodsIds);

        if (empty($wishlistItems)) {
            $nonWishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
                ->inRandomOrder()
                ->limit(8)
                ->get();
        } else {
            $nonWishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
                ->whereNotIn('g_ID', $wishlistItems)
                ->inRandomOrder()
                ->limit(8)
                ->get();
        }

        return view('pages.categories', [
            'user' => $authenticatedUser,
            'categories' => $categories,
            'products' => $nonExchangeProducts,
            'wishlistCount' => $wishlistCount,
            'wishlistItems' => $wishlistItems,
            'nonWishlistProducts' => $nonWishlistProducts,
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

        $wishlistItemIds = Wishlist::where('us_ID', $authenticatedUser->us_ID)
            ->pluck('g_ID')
            ->toArray();

        $exchangeGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'));

        $nonExchangeProducts = $products->whereNotIn('g_ID', $exchangeGoodsIds);

        $nonWishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
            ->whereNotIn('g_ID', $wishlistItemIds)
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

        $communities = Communities::with('feedbacks')->withCount('likes')->orderByDesc('likes_count')->get();

        foreach ($communities as $community) {
            $isLiked = Likes::where('user_ID', $authenticatedUser->us_ID)
                ->where('community_ID', $community->community_ID)
                ->exists();
            $community->isLikedByCurrentUser = $isLiked;
        }
        $feedbacks = Feedbacks::all();
        return view('pages.communities', compact('communities', 'feedbacks', 'wishlistCount', 'authenticatedUser'));
    }

    public function my_profile()
    {
        $authenticatedUser = session('authenticatedUser');
        $user = User::where('us_ID', $authenticatedUser->us_ID)->first();
        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
        $goods = Goods::with('images')->where('us_ID', $authenticatedUser->us_ID)->get();

        return view('pages.myProfile', [
            'authenticatedUser' => $authenticatedUser,
            'user' => $user,
            'goods' => $goods,
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
        $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)->get();
        $wishlistCount = $wishlistItems->count();
        $goods = Goods::where('us_ID', $authenticatedUser->us_ID)->get();
        $product = Goods::findOrFail($id);
        $userDetails = User::findOrFail($product->us_ID);

        return view('pages.goodsDetail', compact('user', 'authenticatedUser', 'wishlistItems', 'wishlistCount', 'goods', 'product', 'userDetails'));
    }
}
