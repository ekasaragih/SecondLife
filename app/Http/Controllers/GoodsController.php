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
        // Retrieve the authenticated user from the session
        $authenticatedUser = session('authenticatedUser');
        
        // Validate the request data
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate each file in the 'files' array
            'g_ID' => 'required|exists:goods,g_ID', // Ensure the 'g_ID' exists in the 'goods' table
        ]);

        // Find existing images associated with the same 'g_ID'
        $existingImages = GoodsImage::where('g_ID', $request->input('g_ID'))->get();

        // Delete existing images if any
        foreach ($existingImages as $existingImage) {
            // Delete the image file from storage
            Storage::delete($existingImage->img_url);
            
            // Delete the image record from the database
            $existingImage->delete();
        }

        // Loop through each file in the 'files' array to store new images
        foreach ($request->file('files') as $file) {
            // Generate a unique image name based on goods details, user details, and timestamp
            $goods = Goods::find($request->input('g_ID'));
            $goodsName = str_replace(' ', '_', $goods->g_name);
            $username = $authenticatedUser->us_username;
            $goodsID = $goods->g_ID;
            $timestamp = now()->timestamp;
            $imageCount = GoodsImage::where('g_ID', $request->input('g_ID'))->count(); // Count existing images for this goods
            $extension = $file->getClientOriginalExtension(); // Get the file extension

            // Construct the image name
            $imageName = $goodsName . '_' . $username . '_' . $goodsID . '_' . ($imageCount + 1) . '_' . $timestamp . '_' . $extension;

            // Store the image in the 'public/goods_img' directory with the constructed image name
            $path = $file->storeAs('goods_img', $imageName, 'public');

            // Create a new 'GoodsImage' record and save it to the database
            $goodsImage = new GoodsImage();
            $goodsImage->img_url = $path;
            $goodsImage->g_ID = $request->input('g_ID');
            $goodsImage->us_ID = $authenticatedUser->us_ID;
            $goodsImage->save();
        }

        // Return a JSON response indicating success
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
