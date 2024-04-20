<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\User;

class RecommendationLocationController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data produk
        $products = Goods::getAllGoodsWithImages();

        // Mendapatkan semua data kategori
        $cities = User::distinct('us_city')->pluck('us_city');
        

        // Mengirim data produk dan kategori ke view 'product'
        return view('product', compact('products', 'cities'));
    }

}

