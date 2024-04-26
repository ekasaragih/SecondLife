<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SwapeWishlist;
use App\Models\Goods;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        // Validasi request untuk memastikan g_ID disertakan
        $request->validate([
            'g_ID' => 'required|exists:goods,g_ID',
        ]);

        $productId = $request->input('g_ID');
        $userId = auth()->user()->id;

        // Periksa apakah produk sudah ada dalam daftar keinginan pengguna
        if ($this->isProductInWishlist($productId, $userId)) {
            return response()->json(['success' => false, 'message' => 'Product already added to wishlist']);
        }

        // Tambahkan produk ke dalam daftar keinginan pengguna
        $wishlist = new SwapeWishlist();
        $wishlist->g_ID = $productId;
        $wishlist->us_ID = $userId;
        $wishlist->save();

        // Berikan respons JSON untuk memberi tahu bahwa produk telah ditambahkan ke wishlist
        return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
    }

    public function ignore(Request $request)
    {
        // Validasi request untuk memastikan g_ID dan us_ID disertakan
        $request->validate([
            'g_ID' => 'required|exists:goods,g_ID',
            'us_ID' => 'required',
        ]);

        $productId = $request->input('g_ID');
        $userId = $request->input('us_ID');

        // Periksa apakah produk sudah ada dalam daftar keinginan pengguna
        if ($this->isProductInWishlist($productId, $userId)) {
            // Hapus produk dari daftar keinginan pengguna
            SwapeWishlist::where('g_ID', $productId)
                ->where('us_ID', $userId)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Product ignored in wishlist']);
        }

        // Berikan respons jika produk tidak ditemukan dalam wishlist
        return response()->json(['success' => false, 'message' => 'Product not found in wishlist']);
    }

    // Fungsi untuk memeriksa apakah produk sudah ada dalam daftar keinginan pengguna
    private function isProductInWishlist($productId, $userId)
    {
        return SwapeWishlist::where('g_ID', $productId)
            ->where('us_ID', $userId)
            ->exists();
    }
}
