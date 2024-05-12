<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Goods;
use App\Models\GoodsImage;
use Vinkla\Hashids\Facades\Hashids; // Tambahkan baris ini


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

        $hashedID = Hashids::encode($goods->g_ID);
        $goods->hashed_id = $hashedID; // Assuming 'hashed_id' is the column name for the hashed ID
        $goods->save();

        return response()->json(['message' => 'Data stored successfully', 'g_ID' => $goods->g_ID], 200);
    }

    public function storeImg(Request $request)
    {
        $authenticatedUser = session('authenticatedUser');

        $request->validate([
            'existing_images' => 'required_without:files|array',
            'files' => 'required_without:existing_images|array',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'g_ID' => 'required|exists:goods,g_ID',
        ]);

        $g_ID = $request->input('g_ID');
        $goods = Goods::find($g_ID);

        if (!$goods) {
            return response()->json(['message' => 'Goods not found'], 404);
        }

        // If existing_images are provided, process them
        if ($request->has('existing_images')) {
            $goodsImages = GoodsImage::where('g_ID', $g_ID)->get();
            $existingImages = $request->input('existing_images');

            // Extract filenames from the existing_images[] parameters
            $existingFilenames = array_map(function ($imageUrl) {
                return basename($imageUrl); // Extract only the filename from the URL
            }, $existingImages);

            // Identify images to delete
            $imagesToDelete = $goodsImages->filter(function ($image) use ($existingFilenames) {
                return !in_array(basename($image->img_url), $existingFilenames);
            });

            // Delete images from storage and database
            foreach ($imagesToDelete as $image) {
                $imagePath = public_path('goods_img/' . $image->img_url);
                File::delete($imagePath);
                $image->delete();
            }
        }

        // If files are provided, process them
        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                $goods = Goods::find($request->input('g_ID'));
                $goodsName = str_replace(' ', '_', $goods->g_name);
                $username = $authenticatedUser->us_username;
                $goodsID = $goods->g_ID;
                $timestamp = now()->timestamp;
                $imageCount = GoodsImage::where('g_ID', $request->input('g_ID'))->count();
                $extension = $file->getClientOriginalExtension();

                $imageName = $goodsName . '_' . $username . '_' . $goodsID . '_' . ($imageCount + 1) . '_' . $timestamp . '.' . $extension;

                $file->move(public_path('goods_img'), $imageName);

                $goodsImage = new GoodsImage();
                $goodsImage->img_url = $imageName;
                $goodsImage->g_ID = $request->input('g_ID');
                $goodsImage->us_ID = $authenticatedUser->us_ID;
                $goodsImage->save();
            }
        }

        return response()->json(['message' => 'Images stored successfully'], 200);
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        foreach ($goods->images as $image) {
            $imagePath = public_path('goods_img/' . $image->img_url);

            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }
            $image->delete();
        }
        $goods->delete();

        return response()->json(['message' => 'Goods deleted successfully'], 200);
    }

    public function show($id)
    {
        $goods = Goods::with('images')->findOrFail($id);
        return response()->json($goods);
    }

    public function update(Request $request)
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
            'g_ID' => 'required|integer', // Add validation for the ID
        ]);

        // Retrieve the ID from the request
        $g_ID = $request->input('g_ID');

        // If ID is provided, update existing record; otherwise, create a new record
        if ($g_ID) {
            // Find the existing record
            $goods = Goods::find($g_ID);

            // Check if the record exists
            if (!$goods) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            // Update the fields with new values from the request
            $goods->us_ID = $authenticatedUser->us_ID;
            $goods->g_name = $request->input('g_name');
            $goods->g_desc = $request->input('g_desc');
            $goods->g_type = $request->input('g_type');
            $goods->g_original_price = $request->input('g_original_price');
            $goods->g_price_prediction = $request->input('g_price_prediction');
            $goods->g_age = $request->input('g_age');
            $goods->g_category = $request->input('g_category');
        }
        // Save the changes to the database
        $goods->save();

        return response()->json(['message' => 'Data changes stored successfully', 'g_ID' => $goods->g_ID], 200);
    }
}
