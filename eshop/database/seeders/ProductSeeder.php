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
            'name' => 'Anas Platyrhynchos',
            'description' => 'Extremely realistic duck',
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
            'name' => 'Bubble Duck',
            'description' => 'Classic duck which enjoys bubbles',
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
            'name' => 'Mallard',
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
            'name' => 'Chilled Duck',
            'description' => 'Duck enjoying life',
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
            'name' => 'Coldy',
            'description' => 'Duck which does not like cold',
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
            'name' => 'Drowning Gluggy',
            'description' => 'Sometimes ducks forget to walk or swim',
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
            'name' => 'Lovey',
            'description' => 'Cute duck bringing love',
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
            'name' => 'Siluette Duck',
            'description' => 'Duck',
            'quantity' => 60,
            'price' => 4.85,
            'rating' => 4.2,
            'review_count' => 4,
            'material' => 'Plastic',
            'size' => '8 cm',
            'weight' => '70 g',
            'age' => '3+',
            'country_of_origin' => 'Austria',
        ],
            [
                'active' => true,
                'name' => 'Splashy',
                'description' => 'Classic swimming duck which enjoys water',
                'quantity' => 3,
                'price' => 14.85,
                'rating' => 4.2,
                'review_count' => 9,
                'material' => 'Plastic',
                'size' => '8 cm',
                'weight' => '32 g',
                'age' => '4+',
                'country_of_origin' => 'Austria',
            ],
            [
                'active' => true,
                'name' => 'Traveller',
                'description' => 'Duck which will swim around the Earth',
                'quantity' => 60,
                'price' => 0.63,
                'rating' => 5,
                'review_count' => 14,
                'material' => 'Plastic',
                'size' => '10 cm',
                'weight' => '70 g',
                'age' => '3+',
                'country_of_origin' => 'Germany',
            ],
            [
                'active' => true,
                'name' => 'Wave Rider',
                'description' => 'Swim and swim',
                'quantity' => 2,
                'price' => 4.85,
                'rating' => 4.2,
                'review_count' => 4,
                'material' => 'Plastic',
                'size' => '8 cm',
                'weight' => '40 g',
                'age' => '3+',
                'country_of_origin' => 'Austria',
            ],
    ];

        foreach ($products as $product) {
            Product::create($product);
        }


    }
}
