<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exchange;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'my_ID' => 'required|integer',
            'goods_owner_ID' => 'required|integer',
            'my_goods' => 'required|integer',
            'barter_with' => 'required|integer',
        ]);

        // Create a new exchange record
        $exchange = Exchange::create($validatedData);

        if ($exchange) {
            return response()->json(['message' => 'Exchange created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create exchange'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
