<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendationLocationController extends Controller
{
    public function index()
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => '$19.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Jakarta',
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => '$29.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Bekasi',
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'price' => '$39.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Jakarta',
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description for Product 4',
                'price' => '$49.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Jakarta',
            ],
            [
                'name' => 'Product 5',
                'description' => 'Description for Product 5',
                'price' => '$59.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Jakarta',
            ],
            [
                'name' => 'Product 6',
                'description' => 'Description for Product 6',
                'price' => '$69.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Jakarta',
            ],
            [
                'name' => 'Product 7',
                'description' => 'Description for Product 7',
                'price' => '$79.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Bekasi',
            ],
            [
                'name' => 'Product 8',
                'description' => 'Description for Product 8',
                'price' => '$89.99',
                'image' => 'https://via.placeholder.com/400',
                'location' => 'Bekasi',
            ],
        ];

        return view('recommendationLocation', compact('products'));
    }
}
