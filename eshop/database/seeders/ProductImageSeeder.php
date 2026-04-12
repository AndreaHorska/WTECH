<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'Duck with Sunglasses' => [
                'image/duck_with_sunglasses.png',
                'image/duck1.png',
            ],
            'Super-duper Duck' => [
                'image/duck1.png',
                'image/duck2.png',
            ],
            'Standing Duck' => [
                'image/duck2.png',
                'image/duck3.png',
            ],
            'Bubble Duck' => [
                'image/duck3.png',
                'image/rubber-duck.png',
            ],
            'Quacky Ducky' => [
                'image/rubber-duck.png',
                'image/duck_with_sunglasses.png',
            ],
        ];

        foreach ($images as $productName => $paths) {
            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            foreach ($paths as $path) {
                ProductImage::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]
                );
            }
        }
    }
}
