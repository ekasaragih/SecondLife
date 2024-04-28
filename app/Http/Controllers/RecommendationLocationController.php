<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class RecommendationLocationController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data produk
        $products = Goods::getAllGoodsWithImages();

        // Mendapatkan semua data kategori
        $cities = User::distinct('us_city')->pluck('us_city');
        
        $users = User::all(['us_ID', 'us_name'])->keyBy('us_ID');

        return view('product', compact('products', 'cities', 'users'));
    }

    public function addToWishlist(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'goods_ID' => 'required|integer',
        ]);

        $g_ID = $request->input('goods_ID');
        $us_ID = $authenticatedUser->us_ID;

        $existingWishlist = Wishlist::where('g_ID', $g_ID)->where('us_ID', $us_ID)->first();

        if (!$existingWishlist){
            $wishlist = new Wishlist();
            $wishlist->us_ID = $us_ID;
            $wishlist->g_ID = $g_ID;
            $wishlist->save();
            return response()->json(['message' => 'Data stored successfully'], 200);
        }else{
            return response()->json(['message' => 'Product already in the wishlist'], 200);
        }
    }

}

