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
                'view' => ['full'],
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
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Silhouette Duck' => [
                'main' => ['luxurious'],
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
            'Sir Quackalot' => [
                'main' => ['luxurious'],
                'view' => ['head'],
                'lifestyle' => ['chilled'],
            ],
            'Old Classic' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Eaten' => [
                'main' => ['funny'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Sea Bundle' => [
                'main' => ['funny','seasonal'],
                'gear' => ['other','bubbles'],
                'view' => ['full'],
                'lifestyle' => ['chilled','quirky','swimming'],
            ],
            'Rainy Saddie' => [
                'main' => ['seasonal'],
                'gear' => ['other'],
                'view' => ['full'],
            ],
            'Rainy Saddie' => [
                'main' => ['funny'],
                'gear' => ['hat'],
                'view' => ['full'],
                'lifestyle' => ['quirky']
            ],
            'Chill Guy' => [
                'main' => ['funny','luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled']
            ],
            'Feather' => [
                'main' => ['luxurious'],
                'view' => ['other'],
            ],
            'Chef Berry' => [
                'main' => ['luxurious', 'funny'],
                'gear' => ['hat'],
                'view' => ['full'],
            ],
            'Ducks on the Shelf' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled']
            ],
            'Pondie' => [
                'main' => ['luxurious'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky']
            ],
            'Dark Knight' => [
                'main' => ['luxurious'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky']
            ],
            'Mama & Mini' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled']
            ],
            'Santa Quack' => [
                'main' => ['seasonal'],
                'gear' => ['hat'],
                'view' => ['head'],
                'lifestyle' => ['chilled']
            ],
            'Mr. Pipi' => [
                'main' => ['seasonal'],
                'view' => ['head'],
                'lifestyle' => ['chilled']
            ],
            'Single Track' => [
                'main' => ['luxurious'],
                'view' => ['other'],
            ],
            'Cloudy Floater' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled','swimming']
            ],
            'The Quacktastic Trio' => [
                'main' => ['seasonal'],
                'view' => ['full'],
                'lifestyle' => ['chilled']
            ],
            'Eggs' => [
                'main' => ['seasonal'],
                'view' => ['other'],
            ],
            'Businessman' => [
                'main' => ['luxurious'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky']
            ],
            'Crazy Rider' => [
                'main' => ['funny'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky', 'chilled']
            ],
            'Detective' => [
                'main' => ['luxurious', 'funny'],
                'gear' => ['other'],
                'view' => ['full'],
                'lifestyle' => ['quirky']
            ],
            'Mr. Quacker' => [
                'main' => ['luxurious'],
                'view' => ['full'],
            ],
            'Super-duper Duck' => [
                'main' => ['luxurious', 'funny'],
                'gear' => ['glasses'],
                'view' => ['full'],
                'lifestyle' => ['chilled', 'quirky', 'swimming'],
            ],
            'Smarty' => [
                'main' => ['luxurious', 'funny'],
                'gear' => ['hat', 'other'],
                'view' => ['full'],
            ],
            'Tuby' => [
                'main' => ['funny'],
                'gear' => ['other'],
                'view' => ['full'],
            ],
            'Duck Chilling' => [
                'main' => ['funny','seasonal'],
                'view' => ['other'],
            ],
            'Floater' => [
                'main' => ['seasonal', 'funny'],
                'view' => ['other'],
                'lifestyle' => ['chilled', 'swimming'],
            ],
            'Springer' => [
                'main' => ['seasonal'],
                'view' => ['full'],
                'lifestyle' => ['chilled', 'swimming'],
            ],
            'Normal Duck' => [
                'main' => ['luxurious'],
                'view' => ['full'],
                'lifestyle' => ['chilled'],
            ],
            'Bobik' => [
                'main' => ['seasonal','funny'],
                'gear' => ['hat'],
                'view' => ['full'],
                'lifestyle' => ['chilled','quirky'],
            ],
            'Magician' => [
                'main' => ['funny'],
                'gear' => ['hat','bubbles'],
                'view' => ['full'],
                'lifestyle' => ['chilled','quirky','swimming'],
            ],
            'Bubble Queen' => [
                'main' => ['funny'],
                'gear' => ['bubbles'],
                'view' => ['full'],
                'lifestyle' => ['chilled','swimming'],
            ],
            'Frayer' => [
                'main' => ['funny','luxurious','seasonal'],
                'gear' => ['bubbles','hat','glasses'],
                'view' => ['full'],
                'lifestyle' => ['quirky','swimming'],
            ],
            'Double Track' => [
                'main' => ['luxurious'],
                'view' => ['other'],
            ],
            'The Golden Paw' => [
                'main' => ['luxurious'],
                'view' => ['other'],
            ],
            'Love Birds' => [
                'main' => ['seasonal'],
                'gear' => ['other'],
                'view' => ['full'],
            ],
            'Party Ducker' => [
                'main' => ['funny','seasonal'],
                'gear' => ['hat','other'],
                'view' => ['full'],
                'lifestyle' => ['quirky'],
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
