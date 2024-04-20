<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goods;
use Illuminate\Support\Facades\Date;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Clothing and Accessories',
            'Home Decor',
            'Books and Media',
            'Collectibles',
            'Tools and Equipment',
            'Musical Instruments',
            'Sports and Fitness Equipment',
            'Kitchenware',
        ];

        $goods = [];

        for ($i = 1; $i <= 30; $i++) {
            $type = rand(0, 1) ? 'Used' : 'New';
            $originalPrice = rand(10000, 1000000);
            $age = rand(1, 10);
            $category = $categories[rand(0, count($categories) - 1)];

            $goods[] = [
                'us_ID' => rand(1, 10),
                'g_name' => 'Product ' . $i,
                'g_desc' => 'Description of Product ' . $i,
                'g_type' => $type,
                'g_original_price' => $originalPrice,
                'g_age' => $age,
                'g_category' => $category,
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ];
        }

        // Insert data into the goods table
        Goods::insert($goods);
    }
}
