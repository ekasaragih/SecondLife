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

        $goods = Goods::find($g_ID);

        if ($goods && $goods->us_ID == $us_ID) {
            return response()->json(['message' => 'You cannot add your own goods to the wishlist'], 403);
        }

        $goodsDetails = Goods::where('g_ID', $g_ID)->first();
        if (!$goodsDetails) {
            return response()->json(['message' => 'Goods not found'], 404);
        }

        $existingWishlist = Wishlist::where('g_ID', $g_ID)->where('us_ID', $us_ID)->first();

        if (!$existingWishlist) {
            $wishlist = new Wishlist();
            $wishlist->us_ID = $us_ID;
            $wishlist->g_ID = $g_ID;
            $wishlist->save();

            // Check if any goods of the current user are in the wishlist of the goods' owner
            $goods = Goods::where('us_ID', $us_ID)->get();
            $userGoodsWishlist = Wishlist::where('us_ID', $goodsDetails->us_ID)->get();

            foreach ($goods as $good) {
                foreach ($userGoodsWishlist as $check) {
                    if ($good->g_ID == $check->g_ID) {
                        return response()->json(['message' => 'Matched! The person also added your goods'], 200);
                    }
                }
            }
            return response()->json(['message' => 'Added to the wishlist'], 200);
        } else {
            return response()->json(['message' => 'Product already in the wishlist'], 200);
        }
    }
}
