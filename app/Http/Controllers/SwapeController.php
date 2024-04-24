<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\SwapeWishlist;

class SwapeController extends Controller
{
    public function swapeGoods()
    {
        // Get all goods with images
        $goods = Goods::getAllGoodsWithImages();

        // Return formatted goods data
        // return response()->json($goods);
        return view('pages.utils.explore.swape', compact('goods'));

    }

    public function addToWishlist(Request $request)
    {
        // Validasi request untuk memastikan g_ID disertakan
        $request->validate([
            'g_ID' => 'required|exists:goods,g_ID',
        ]);

        $productId = $request->input('g_ID');

        $wishlist = new SwapeWishlist();
        $wishlist->g_ID = $productId;
        $wishlist->us_ID = auth()->user()->id; // Menggunakan ID pengguna yang sedang login
        
        // Simpan data ke dalam tabel wishlist
        $wishlist->save();

        // Berikan respons JSON untuk memberi tahu bahwa produk telah ditambahkan ke wishlist
        return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
    }
}
