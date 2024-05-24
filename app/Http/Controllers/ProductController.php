<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\GoodsImage;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data produk
        $products = Goods::getAllGoodsWithImages();

        // Mendapatkan semua data kategori
        $categories = Goods::distinct('g_category')->pluck('g_category');
        

        // Mengirim data produk dan kategori ke view 'product'
        return view('product', compact('products', 'categories'));
    }
    
public function addToWishlist(Request $request)
{
    $authenticatedUser = session('authenticatedUser');

    $request->validate([
        'goods_ID' => 'required|integer',
    ]);

    $g_ID = $request->input('goods_ID');
    $us_ID = $authenticatedUser->us_ID;

    // Fetch the goods to check the owner
    $goods = Goods::find($g_ID);

    if ($goods && $goods->us_ID == $us_ID) {
        return response()->json(['message' => 'You cannot add your own goods to the wishlist'], 403);
    }

    $existingWishlist = Wishlist::where('g_ID', $g_ID)->where('us_ID', $us_ID)->first();

    if (!$existingWishlist){
        $wishlist = new Wishlist();
        $wishlist->us_ID = $us_ID;
        $wishlist->g_ID = $g_ID;
        $wishlist->save();
        return response()->json(['message' => 'Data stored successfully'], 200);
    } else {
        return response()->json(['message' => 'Product already in the wishlist'], 200);
    }
}

}

