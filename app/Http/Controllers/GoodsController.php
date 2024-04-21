<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Goods;
use App\Models\GoodsImage;

class GoodsController extends Controller
{
    public function store(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'g_name' => 'required|string',
            'g_desc' => 'required|string',
            'g_type' => 'required|string',
            'g_original_price' => 'required|numeric',
            'g_price_prediction' => 'required|numeric',
            'g_age' => 'required|integer',
            'g_category' => 'required|string',
        
        ]);

        $goods = new Goods();
        $goods->us_ID = $authenticatedUser->us_ID;
        $goods->g_name = $request->input('g_name');
        $goods->g_desc = $request->input('g_desc');
        $goods->g_type = $request->input('g_type');
        $goods->g_original_price = $request->input('g_original_price');
        $goods->g_price_prediction = $request->input('g_price_prediction');
        $goods->g_age = $request->input('g_age');
        $goods->g_category = $request->input('g_category');
      
        $goods->save();

        return response()->json(['message' => 'Data stored successfully', 'g_ID' => $goods->g_ID], 200);

    }

    public function storeImg(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'g_ID' => 'required|exists:goods,g_ID',
        ]);

        foreach ($request->file('files') as $file) {
            $goods = Goods::find($request->input('g_ID'));
            $goodsName = str_replace(' ', '_', $goods->g_name);
            $username = $authenticatedUser->us_username;
            $goodsID = $goods->g_ID;
            $timestamp = now()->timestamp;
            $imageCount = GoodsImage::where('g_ID', $request->input('g_ID'))->count();
            $extension = $file->getClientOriginalExtension();

            $imageName = $goodsName . '_' . $username . '_' . $goodsID . '_' . ($imageCount + 1) . '_' . $timestamp . '_' . $extension;

            $path = $file->storeAs('goods_img', $imageName, 'public');

            $goodsImage = new GoodsImage();
            $goodsImage->img_url = $path;
            $goodsImage->g_ID = $request->input('g_ID');
            $goodsImage->us_ID = $authenticatedUser->us_ID;
            $goodsImage->save();
        }

        return response()->json(['message' => 'Images stored successfully'], 200);
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        foreach ($goods->images as $image) {
            $imagePath = 'public/' . $image->img_url;
            Storage::delete($imagePath);
        }
        $goods->delete();

        return response()->json(['message' => 'Goods deleted successfully'], 200);
    }

    public function show($id)
    {
        $goods = Goods::with('images')->findOrFail($id);
        return response()->json($goods);
    }
}
