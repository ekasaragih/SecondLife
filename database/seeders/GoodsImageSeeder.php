<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\GoodsImage;
use App\Models\Goods;
use Illuminate\Support\Str;

class GoodsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve IDs of goods created in the goods seeder
        $goodsIds = Goods::pluck('g_ID')->toArray();

        // Path to the directory where images will be stored
        $storagePath = 'public/goods_img/';

        foreach ($goodsIds as $gId) {
            // Generate a random number of images for each good (between 1 and 3)
            $numImages = rand(1, 3);

            for ($i = 0; $i < $numImages; $i++) {
                // Generate a random image URL
                $imageUrl = $this->generateRandomImageUrl();

                // Save the image file to the storage directory
                $imageName = $this->saveImageToStorage($imageUrl, $storagePath);

                // Create a record in the goods_image table
                $this->createGoodsImageRecord($gId, $imageName);
            }
        }
    }

    /**
     * Generate a random image URL.
     */
    private function generateRandomImageUrl(): string
    {
        // You can replace this with your logic to generate random image URLs
        return 'https://via.placeholder.com/500';
    }

    /**
     * Save the image file to the storage directory.
     */
    private function saveImageToStorage(string $imageUrl, string $storagePath): string
    {
        // Extract the filename from the image URL
        $filename = Str::random(10) . '.jpg';

        // Download the image and save it to the storage directory
        $imageContent = file_get_contents($imageUrl);
        Storage::put($storagePath . $filename, $imageContent);

        return $filename;
    }

    /**
     * Create a record in the goods_image table.
     */
    private function createGoodsImageRecord(int $gId, string $imageName): void
    {
        // Create a record in the goods_image table
        GoodsImage::create([
            'img_url' => 'goods_img/' . $imageName,
            'g_ID' => $gId,
            'us_ID' => rand(1, 10), // Assuming you have users in the system
        ]);
    }
}
