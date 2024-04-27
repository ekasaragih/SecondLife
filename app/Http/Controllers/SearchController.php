<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $searchTerm = $request->input('query');

    // Perform search query
    $goods = Goods::where('g_name', 'like', "%{$searchTerm}%")->get();

    return view('utils.explore.search-results', compact('goods'));
}
}



