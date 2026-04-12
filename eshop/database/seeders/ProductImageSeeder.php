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
            'Anas Platyrhynchos' => [
                'image/anas_platyrhynchos.png',
                'image/anas_platyrhynchos2.png',
            ],
            'Bubble Duck' => [
                'image/bubble_duck.png',
                'image/bubble_duck2.png',
            ],
            'Chilled Duck' => [
                'image/chilled_duck.png',
                'image/chilled_duck2.png',
                'image/chilled_duck3.png',
                'image/chilled_duck4.png',
            ],
            'Coldy' => [
                'image/coldy.png',
                'image/coldy2.png',
            ],
            'Drowning Gluggy' => [
                'image/drowning_gluggy.png',
                'image/drowning_gluggy2.png',
            ],
            'Lovey' => [
                'image/lovey.png',
                'image/lovey2.png',
            ],
            'Mallard' => [
                'image/mallard.png',
                'image/mallard2.png',
                'image/mallard3.png',
            ],
            'Siluette Duck' => [
                'image/siluete_duck.png',
                'image/siluete_duck2.png',
            ],
            'Splashy' => [
                'image/splashy.png',
                'image/splashy2.png',
            ],
            'Traveller' => [
                'image/traveller.png',
                'image/traveller2.png',
            ],
            'Wave Rider' => [
                'image/wave_rider.png',
                'image/wave_rider.png',
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
