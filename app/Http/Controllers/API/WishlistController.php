<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Add a product to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'g_ID' => 'required|exists:goods,g_ID',
            'us_ID' => 'required|exists:users,us_ID',
        ]);

        $existingWishlistItem = Wishlist::where('g_ID', $validatedData['g_ID'])
                                        ->where('us_ID', $validatedData['us_ID'])
                                        ->first();

        if ($existingWishlistItem) {
            return response()->json(['success' => false, 'message' => 'You have already added this product to your wishlist.']);
        }

        $wishlist = Wishlist::create([
            'g_ID' => $validatedData['g_ID'],
            'us_ID' => $validatedData['us_ID'],
        ]);

        if ($wishlist) {
            return response()->json(['success' => true, 'message' => 'Product added to wishlist.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add product to wishlist.'], 500);
        }
    }

    public function remove(Request $request)
    {
        $wishlistId = $request->input('wishlist_ID');

        Wishlist::destroy($wishlistId);

        return response()->json(['success' => true, 'message' => 'Item removed from wishlist.']);
    }

}
