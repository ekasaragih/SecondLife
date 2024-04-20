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

    public function addToWishlist(Request $request) {
        $productId = $request->input('product_id');
        $userId = auth()->user()->id;
    
        // Check if the product already exists in the user's wishlist
        $existingWishlist = Wishlist::where('g_ID', $productId)
                                    ->where('us_ID', $userId)
                                    ->first();
    
        // If the product does not exist in the user's wishlist, add it to the database
        if (!$existingWishlist) {
            Wishlist::create([
                'g_ID' => $productId,
                'us_ID' => $userId,
            ]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Product already exists in the wishlist.']);
        }
    }
    

}

