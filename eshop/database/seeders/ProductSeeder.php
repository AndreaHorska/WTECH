<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   // falosne produkty
        \App\Models\Product::factory(100)->create();

        $products = [
        [
            'active' => true,
            'name' => 'Duck with Sunglasses',
            'description' => 'Duck with sunglasses',
            'quantity' => 50,
            'price' => 147.30,
            'rating' => 4.7,
            'review_count' => 1756,
            'material' => 'Vinyl',
            'size' => '10 cm',
            'weight' => '100 g',
            'age' => '3+',
            'country_of_origin' => 'Slovakia',
        ],
        [
            'active' => true,
            'name' => 'Super-duper Duck',
            'description' => 'Classic duck',
            'quantity' => 100,
            'price' => 0.30,
            'rating' => 5.0,
            'review_count' => 256,
            'material' => 'Rubber',
            'size' => '8 cm',
            'weight' => '80 g',
            'age' => '3+',
            'country_of_origin' => 'Slovakia',
        ],
        [
            'active' => true,
            'name' => 'Standing Duck',
            'description' => 'Standing duck figure',
            'quantity' => 40,
            'price' => 7.20,
            'rating' => 5.0,
            'review_count' => 6,
            'material' => 'Plastic',
            'size' => '12 cm',
            'weight' => '150 g',
            'age' => '3+',
            'country_of_origin' => 'Czech Republic',
        ],
        [
            'active' => true,
            'name' => 'Bubble Duck',
            'description' => 'Rubber bubble duck',
            'quantity' => 25,
            'price' => 58.62,
            'rating' => 5.0,
            'review_count' => 37,
            'material' => 'Plastic',
            'size' => '12 cm',
            'weight' => '150 g',
            'age' => '3+',
            'country_of_origin' => 'Czech Republic',
        ],
        [
            'active' => true,
            'name' => 'Quacky Ducky',
            'description' => 'Funny duck',
            'quantity' => 30,
            'price' => 58.60,
            'rating' => 4.5,
            'review_count' => 25,
            'material' => 'Vinyl',
            'size' => '10 cm',
            'weight' => '90 g',
            'age' => '6+',
            'country_of_origin' => 'Slovakia',
        ],
        [
            'active' => true,
            'name' => 'Quacky Quack',
            'description' => 'Premium duck',
            'quantity' => 20,
            'price' => 147.30,
            'rating' => 5.0,
            'review_count' => 256,
            'material' => 'Silicone',
            'size' => '20 cm',
            'weight' => '300 g',
            'age' => '3+',
            'country_of_origin' => 'Germany',
        ],
        [
            'active' => true,
            'name' => 'Ducklings',
            'description' => 'Cute ducklings',
            'quantity' => 80,
            'price' => 4.85,
            'rating' => 5.0,
            'review_count' => 1056,
            'material' => 'Rubber',
            'size' => '5 cm',
            'weight' => '50 g',
            'age' => '1+',
            'country_of_origin' => 'Slovakia',
        ],
        [
            'active' => true,
            'name' => 'Travel Duck',
            'description' => 'Duck for travel',
            'quantity' => 60,
            'price' => 4.85,
            'rating' => 5.0,
            'review_count' => 4,
            'material' => 'Plastic',
            'size' => '8 cm',
            'weight' => '70 g',
            'age' => '3+',
            'country_of_origin' => 'Austria',
        ],
    ];

        foreach ($products as $product) {
            Product::create($product);
        }


    }
}
