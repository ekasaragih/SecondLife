<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Goods;
use App\Models\GoodsImage;

class GoodsController extends Controller
{
    public function add_my_goods(Request $request)
    {
        try {
            $authenticatedUser = session('authenticatedUser');

            $request->validate([
                'name' => 'required',
                'category' => 'required',
                'type' => 'required',
                'originalPrice' => 'required',
                'ageOfGoods' => 'required',
                'description' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Create a new Goods instance
            $goods = new Goods();
            
            // Assign values from the request to the goods object
            $goods->us_ID = $authenticatedUser->us_ID;
            $goods->g_name = $request->input('name');
            $goods->g_category = $request->input('category');
            $goods->g_type = $request->input('type');
            $goods->g_original_price = $request->input('originalPrice');
            $goods->g_age = $request->input('ageOfGoods');
            $goods->g_desc = $request->input('description');
            
            // Save the goods to the database
            $goods->save();
            $goodsID =$goods->g_ID;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = 'goodsImage' . $goodsID . '_' . date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->storeAs('goodsImage', $path, 'public');
                   
                    $goodsImage = new GoodsImage();
                    $goodsImage->img_url = $path;
                    $goodsImage->g_ID = $goodsID;
                    $goodsImage->us_ID = $authenticatedUser->us_ID;
                    $goodsImage->save();
                }
            }
            
            // Optionally, you can return a response indicating success
            return response()->json(['message' => 'Goods added successfully'], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding goods: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An unexpected error occurred while adding goods'], 500);
        }
    }
}
