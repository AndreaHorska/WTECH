<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'active' => fake()->boolean(100),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(15),
            'quantity' => fake()->numberBetween(0, 100),
            'price' => fake()->randomFloat(2, 5, 200),
            'rating' => fake()->randomFloat(1, 1, 5),
            'review_count' => fake()->numberBetween(0, 500),
        ];
    }
}
