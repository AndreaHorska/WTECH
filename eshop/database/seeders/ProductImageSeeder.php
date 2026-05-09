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
            'Silhouette Duck' => [
                'image/silhouette_duck.png',
                'image/silhouette_duck2.png',
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
                'image/wave_rider2.png',
            ],
            'Summer Chiller' => [
                'image/summer_chiller1.png',
                'image/summer_chiller2.png',
            ],
            'Sir Quackalot' => [
                'image/sir_quackalot1.png',
                'image/sir_quackalot2.png',
            ],
            'Old Classic' => [
                'image/old_classic1.png',
                'image/old_classic2.png',
            ],
            'Eaten' => [
                'image/eaten.png',
                'image/eaten2.png',
            ],
            'Sea Bundle' => [
                'image/sea_bundle.png',
                'image/sea_bundle2.png',
            ],
            'Rainy Saddie' => [
                'image/rainy_saddie.png',
                'image/rainy_saddie2.png',
            ],
            'Chef Berry' => [
                'image/chef_berry.png',
                'image/chef_berry2.png',
            ],
            'Chill Guy' => [
                'image/chill_guy.png',
                'image/chill_guy2.png',
            ],
            'Feather' => [
                'image/feather.png',
                'image/feather2.png',
                'image/feather3.png',
            ],
            'DJ Quack' => [
                'image/dj_quack.png',
                'image/dj_quack2.png',
            ],
            'Inspector Bob' => [
                'image/detective.png',
                'image/detective2.png',
            ],
            'Ducks on the Shelf' => [
                'image/ducks_shelf.png',
                'image/ducks_shelf2.png',
                'image/ducks_shelf3.png',
            ],
            'Pondie' => [
                'image/pondie.png',
                'image/pondie2.png',
            ],
            'Dark Knight' => [
                'image/dark_knight.png',
                'image/dark_knight2.png',
                'image/dark_knight3.png',
            ],
            'Mama & Mini' => [
                'image/mama_mini.png',
                'image/mama_mini2.png',
                'image/mama_mini3.png',
            ],
            'Santa Quack' => [
                'image/santa_quack.png',
                'image/santa_quack2.png',
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
