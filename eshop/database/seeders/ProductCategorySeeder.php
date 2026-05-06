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
            'Anas Platyrhynchos' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled', 'swimming'],
            ],
            'Bubble Duck' => [
                'main' => ['funny', 'seasonal'],
                'gear' => ['bubbles'],
                'view' => ['full'],
                'lifestyle' => ['quirky'],
            ],
            'Chilled Duck' => [
                'main' => ['funny'],
                'gear' => ['glasses', 'bubbles'],
                'view' => ['other'],
                'lifestyle' => ['chilled'],
            ],
            'Drowning Gluggy' => [
                'main' => ['funny'],
                'view' => ['full'],
                'lifestyle' => ['swimming'],
            ],
            'Lovey' => [
                'main' => ['seasonal'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky'],
            ],
            'Mallard' => [
                'main' => ['Luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Silhouette Duck' => [
                'main' => ['Seasonal'],
                'view' => ['full'],
            ],
            'Splashy' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['swimming'],
            ],
            'Traveller' => [
                'main' => ['funny'],
                'view' => ['full'],
                'lifestyle' => ['swimming', 'chilled'],
            ],
            'Wave Rider' => [
                'main' => ['funny'],
                'view' => ['full'],
                'lifestyle' => ['swimming', 'chilled'],
            ],
            'Coldy' => [
                'main' => ['funny', 'seasonal'],
                'gear' => ['other', 'hat'],
                'view' => ['full'],
                'lifestyle' => ['quirky', 'chilled'],
            ],
            'Summer Chiller' => [
                'main' => ['funny', 'seasonal'],
                'gear' => ['other', 'hat', 'glasses'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
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
