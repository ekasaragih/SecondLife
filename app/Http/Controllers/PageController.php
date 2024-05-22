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
use Vinkla\Hashids\Facades\Hashids; // Tambahkan baris ini


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

    public function faq()
    {
        return view('utils.explore.faq');
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

    // Ambil semua produk, tanpa filter wishlist untuk konten explore lainnya
    $products = Goods::whereNotIn('g_ID', $exchangeGoodsIds)->get();
    
    // Ambil produk yang tidak ada di wishlist khusus untuk swape
    $swapeProducts = collect();
    if ($authenticatedUser && $authenticatedUser->us_ID) {
        $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)
            ->pluck('g_ID')
            ->toArray();
        $swapeProducts = Goods::whereNotIn('g_ID', $exchangeGoodsIds)
            ->whereNotIn('g_ID', $wishlistItems)
            ->get();
    } else {
        $swapeProducts = Goods::whereNotIn('g_ID', $exchangeGoodsIds)->get();
    }

    $trendProducts = $this->filterTrendProducts($topCategories, $authenticatedUser, $exchangeGoodsIds);

    if ($authenticatedUser && $authenticatedUser->us_ID) {
        $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
    }

    $cities = User::distinct('us_city')->pluck('us_city');

    $userAvatar = $authenticatedUser ? $authenticatedUser->avatar : null;

    return view('pages.explore', [
        'user' => $authenticatedUser,
        'products' => $products,
        'swapeProducts' => $swapeProducts,  // Pass variabel khusus untuk swape
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

        if (!empty($wishlistItems)) {
            $wishlistCategories = Goods::whereIn('g_ID', $wishlistItems)
                ->pluck('g_category')
                ->toArray();

            $nonWishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
                ->whereNotIn('g_ID', $wishlistItems)
                ->whereIn('g_category', $wishlistCategories)
                ->inRandomOrder()
                ->limit(8)
                ->get();
        } else {
            $nonWishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
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
            'WishlistProducts' => $WishlistProducts,
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

        $wishlistCategories = Goods::whereIn('g_ID', $wishlistItemIds)
            ->pluck('g_category')
            ->toArray();

        $exchangeGoodsIds = Exchange::pluck('my_goods')->merge(Exchange::pluck('barter_with'));

        $nonExchangeProducts = $products->whereNotIn('g_ID', $exchangeGoodsIds);

        $WishlistProducts = Goods::whereIn('g_ID', $nonExchangeProducts->pluck('g_ID')->toArray())
            ->whereNotIn('g_ID', $wishlistItemIds)
            ->whereIn('g_category', $wishlistCategories)
            ->with('images')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('pages.wishlist', [
            'user' => $authenticatedUser,
            'categories' => $categories,
            'products' => $products,
            'WishlistProducts' => $WishlistProducts,
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
            if ($authenticatedUser !== null) {
                $isLiked = Likes::where('user_ID', $authenticatedUser->us_ID)
                    ->where('community_ID', $community->community_ID)
                    ->exists();
                $community->isLikedByCurrentUser = $isLiked;
            } else {
                $community->isLikedByCurrentUser = false;
            }
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

        $availableGoodsCount = Goods::where('us_ID', $authenticatedUser->us_ID)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('exchange')
                    ->whereRaw('exchange.my_goods = goods.g_ID')
                    ->orWhereRaw('exchange.barter_with = goods.g_ID');
            })
            ->count();

        $exchangedGoods = Exchange::where('my_ID', $authenticatedUser->us_ID)
            ->orWhere('goods_owner_ID', $authenticatedUser->us_ID)
            ->with(['userGoods', 'otherUserGoods'])
            ->distinct()
            ->get();

        $totalBarteredGoods = Exchange::where('my_ID', $authenticatedUser->us_ID)
            ->orWhere('goods_owner_ID', $authenticatedUser->us_ID)
            ->count();

        return view('pages.myProfile', [
            'authenticatedUser' => $authenticatedUser,
            'user' => $user,
            'goods' => $goods,
            'exchangedGoods' => $exchangedGoods,
            'wishlistCount' => $wishlistCount,
            'totalBarteredGoods' => $totalBarteredGoods,
            'availableGoodsCount' => $availableGoodsCount,
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

    public function goods_detail($hashed_id)
    {
        // Decode hashed ID
        $g_ID = Hashids::decode($hashed_id)[0];

        $authenticatedUser = session('authenticatedUser');
        $user = session('authenticatedUser');
        $myGoods = Goods::where('us_ID', $authenticatedUser->us_ID)->get();
        $wishlist = Wishlist::get();
        $wishlistItems = Wishlist::where('us_ID', $authenticatedUser->us_ID)->get();
        $wishlistCount = $wishlistItems->count();
        $goods = Goods::where('us_ID', $authenticatedUser->us_ID)->get();
        $product = Goods::findOrFail($g_ID);
        $userDetails = User::findOrFail($product->us_ID);

        return view('pages.goodsDetail', compact('user', 'authenticatedUser','myGoods','wishlist', 'wishlistItems', 'wishlistCount', 'goods', 'product', 'userDetails'));
    }
    
    public function getUsersWishlistedItem($hashed_id)
{
    // Decode hashed ID
    $g_ID = Hashids::decode($hashed_id)[0];

    // Retrieve all user IDs who have wishlisted the given g_ID
    $userIDs = Wishlist::where('g_ID', $g_ID)->pluck('us_ID')->toArray();

    // Retrieve user details based on the user IDs
    $users = User::whereIn('us_ID', $userIDs)->get();

    // Retrieve product details
    $product = Goods::findOrFail($g_ID);

    // Pass the users and product to the view
    return view('pages.goodsDetailUsersWishlisted', compact('users', 'product'));
}


}
