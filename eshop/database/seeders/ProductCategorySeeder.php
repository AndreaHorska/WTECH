<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCategories = [
            'Duck with Sunglasses' => [
                'main' => ['luxurious', 'funny'],
                'gear' => ['glasses'],
                'view' => ['full'],
                'lifestyle' => ['chilled', 'swimming'],
            ],
            'Super-duper Duck' => [
                'main' => ['funny'],
                'gear' => ['hat'],
                'view' => ['full'],
                'lifestyle' => ['quirky'],
            ],
            'Standing Duck' => [
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Bubble Duck' => [
                'main' => ['funny'],
                'view' => ['full'],
                'lifestyle' => ['quirky'],
            ],
            'Quacky Ducky' => [
                'main' => ['funny'],
                'view' => ['full'],
                'lifestyle' => ['swimming'],
            ],
        ];

        foreach ($productCategories as $productName => $groups) {
            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            $categoryIds = [];

            foreach ($groups as $typeSlug => $categorySlugs) {
                $ids = Category::query()
                    ->whereHas('categoryType', function ($query) use ($typeSlug) {
                        $query->where('slug', $typeSlug);
                    })
                    ->whereIn('slug', $categorySlugs)
                    ->pluck('id')
                    ->toArray();

                $categoryIds = array_merge($categoryIds, $ids);
            }

            $product->categories()->sync($categoryIds);
        }
    }
}
