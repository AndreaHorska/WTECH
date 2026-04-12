<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryType;

class RandomProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::all()->each(function ($product) {

            if ($product->categories()->exists()) {
                return;
            }

            $categoryIds = [];

            $types = CategoryType::with('categories')->get();

            foreach ($types as $type) {
                if ($type->categories->isEmpty()) {
                    continue;
                }

                if ($type->slug === 'main') {
                    $randomCategory = $type->categories->random();
                    $categoryIds[] = $randomCategory->id;
                }

                $randomCategory = $type->categories->random();
                $categoryIds[] = $randomCategory->id;
            }

            $extra = Category::inRandomOrder()
                ->limit(rand(0, 2))
                ->pluck('id')
                ->toArray();

            $categoryIds = array_merge($categoryIds, $extra);
            $categoryIds = array_unique($categoryIds);

            $product->categories()->sync($categoryIds);
        });
    }
}
