<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Search for goods based on the provided query.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        // Retrieve the search query from the request
        $query = $request->input('query');

        // Search for goods whose name matches the query (case-insensitive)
        $products = Goods::where('g_name', 'like', "%{$query}%")->get();

        // Return the 'utils.explore.search' view with the search results
        return view('utils.explore.search', compact('products'));
    }
}



