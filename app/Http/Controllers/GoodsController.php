<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Goods;

class GoodsController extends Controller
{
    public function add_my_goods(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'type' => 'required',
            'originalPrice' => 'required',
            'ageOfGoods' => 'required',
            'description' => 'required',
        ]);

        // Create a new Goods instance
        $goods = new Goods();
        
        // Assign values from the request to the goods object
        $goods->us_ID = "1";
        $goods->g_name = $request->input('name');
        $goods->g_category = $request->input('category');
        $goods->g_type = $request->input('type');
        $goods->g_original_price = $request->input('originalPrice');
        $goods->g_age = $request->input('ageOfGoods');
        $goods->g_desc = $request->input('description');
        
        // Save the goods to the database
        $goods->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Goods added successfully'], 200);

        // $goods = Goods::all();
        // return view("pages.myGoods", compact('goods'));
    }
}
