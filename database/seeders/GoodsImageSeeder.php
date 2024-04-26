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
            // Define an array of image URLs corresponding to each g_ID and us_ID
            $imageUrls = [
                [
                    'g_ID' => 1,
                    'us_ID' => 1,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaqoQf3sbt6zJbePZBK875vDBGru9Bn5F8NRDf1lrfltZmxCeKw-x9ehngG8SnRlKeTcg&usqp=CAU',
                ],
                [
                    'g_ID' => 2,
                    'us_ID' => 2,
                    'img_url' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//105/MTA-44129958/aerostreet_aerostreet_x_le_minerale_limited_edition_sneakers_full01_7204e0ee.jpg',
                ],
                [
                    'g_ID' => 3,
                    'us_ID' => 3,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoQx198_ItDJlfMv7lifjvpkDzWJSK4A9kaS0ZWy6lNA&s',
                ],
                [
                    'g_ID' => 4,
                    'us_ID' => 4,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGfIXBKQ2Xac3p-NI5AEMxkJUWlKCQ2yO3FmKLfBbVJQ&s',
                ],
                [
                    'g_ID' => 5,
                    'us_ID' => 5,
                    'img_url' => 'https://images.tokopedia.net/img/cache/700/VqbcmM/2024/3/20/5ceae410-df39-4db6-9d61-6de673ec29f4.jpg',
                ],
                [
                    'g_ID' => 6,
                    'us_ID' => 6,
                    'img_url' => 'https://wwd.com/wp-content/uploads/2023/03/designer-handbag-lead-art.jpg?w=911',
                ],
                [
                    'g_ID' => 7,
                    'us_ID' => 7,
                    'img_url' => 'https://www.zdnet.com/a/img/resize/988067fafbf5768427cfb22fc12c70cd92e92a5c/2022/06/18/a0b91e0b-49d5-4972-8742-f0e1a545de48/nikon-d6-review-best-dslr-camera.jpg?auto=webp&fit=crop&height=900&width=1200',
                ],
                [
                    'g_ID' => 8,
                    'us_ID' => 8,
                    'img_url' => 'https://id-test-11.slatic.net/p/140edc52c5c50af2d011770b0ff4388d.jpg',
                ],
                [
                    'g_ID' => 9,
                    'us_ID' => 9,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFK6q05OXT-HOaGwMioaSTPAeYJ_waPV2fgjMehfj7ZQ&s',
                ],
                [
                    'g_ID' => 10,
                    'us_ID' => 10,
                    'img_url' => 'https://www.ft.com/__origami/service/image/v2/images/raw/http%3A%2F%2Fcom.ft.imagepublish.upp-prod-eu.s3.amazonaws.com%2F14fda366-1fe0-11e7-b7d3-163f5a7f229c?source=next-article&fit=scale-down&quality=highest&width=700&dpr=1',
                ],
                [
                    'g_ID' => 11,
                    'us_ID' => 11,
                    'img_url' => 'https://m.media-amazon.com/images/I/51YD0CM1PnL.jpg',
                ],
                [
                    'g_ID' => 12,
                    'us_ID' => 12,
                    'img_url' => 'https://down-id.img.susercontent.com/file/02181121a0ea3adbaaa6d8e725780752',
                ],
                [
                    'g_ID' => 13,
                    'us_ID' => 13,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKcBCCRbtI-nK-aBXJLm3xJML-nvz8cyeZdYltqWHslQ&s',
                ],
                [
                    'g_ID' => 14,
                    'us_ID' => 14,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsXyqe_1JQ-FTcyz3NaKZN7m5TVrReKyi1UpUNe5r-4g&s',
                ],
                [
                    'g_ID' => 15,
                    'us_ID' => 15,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScUVOPz-ZZQNIS78CJSqFpwsL_dTPpnEuhhdzyNEMo8A&s',
                ],
                [
                    'g_ID' => 16,
                    'us_ID' => 16,
                    'img_url' => 'https://images-cdn.ubuy.co.id/633aa3f44885c515c471ac26-ubuy-online-shopping.jpg',
                ],
                [
                    'g_ID' => 17,
                    'us_ID' => 17,
                    'img_url' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/96/MTA-114634761/no-brand_no-brand_full01.jpg',
                ],
                [
                    'g_ID' => 18,
                    'us_ID' => 18,
                    'img_url' => 'https://i.etsystatic.com/33318517/r/il/4f2d16/5333624662/il_570xN.5333624662_9b33.jpg',
                ],
                [
                    'g_ID' => 19,
                    'us_ID' => 19,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4CLZ5l1HoYoWY4g9kNuRBHHDBlCuKTEqmt_q-bVCuaA&s',
                ],
                [
                    'g_ID' => 20,
                    'us_ID' => 20,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBxvE4l94X5FlUFop-DwuS7QbGpob-MKn0T9vkb3jV7g&s',
                ],
                [
                    'g_ID' => 21,
                    'us_ID' => 21,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHqRY3pEgrl1--IjY8B0UJV_Kyt5Zl3l6PBA1LLKvciw&s',
                ],
                [
                    'g_ID' => 22,
                    'us_ID' => 22,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAQAD-H8g7LTtWTItY88jV-GBEZtJwjcd7Fs1OXCS5lg&s',
                ],
                [
                    'g_ID' => 23,
                    'us_ID' => 23,
                    'img_url' => 'https://media.wired.com/photos/6504b2a1afe02332db973557/master/w_960,c_limit/Ugreen_Power_Bank-SOURCE-Ugreen-Gear.jpg',
                ],
                [
                    'g_ID' => 24,
                    'us_ID' => 24,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhe6BME1opPxhNhiI2h3I7nfNuJRhh_lnzi4dvDsjK-A&s',
                ],
                [
                    'g_ID' => 25,
                    'us_ID' => 25,
                    'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIn-13pc8e7MGSUHMb2Edi284ipt-W6kO8xy_26LH6Vw&s',
                ],
                
            ];
    
            // Insert records into the goods_image table
            foreach ($imageUrls as $data) {
                $this->createGoodsImageRecord($data);
            }
        }
    
        /**
         * Create a record in the goods_image table.
         */
        private function createGoodsImageRecord(array $data): void
        {
            // Create a record in the goods_image table
            GoodsImage::create([
                'img_url' => $data['img_url'],
                'g_ID' => $data['g_ID'],
                'us_ID' => $data['us_ID'],
            ]);
        }
    }