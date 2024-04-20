<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\GoodsImage;
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


}

