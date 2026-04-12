<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryType;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'main' => [
                [
                    'name' => 'Funny',
                    'slug' => 'funny',
                ],
                [
                    'name' => 'Luxurious',
                    'slug' => 'luxurious',
                ],
                [
                    'name' => 'Seasonal',
                    'slug' => 'seasonal',
                ],
            ],
            'gear' => [
                [
                    'name' => 'Glasses',
                    'slug' => 'glasses',
                ],
                [
                    'name' => 'Hat',
                    'slug' => 'hat',
                ],
                [
                    'name' => 'Weapon',
                    'slug' => 'weapon',
                ],
                [
                    'name' => 'Other',
                    'slug' => 'other',
                ],
            ],
            'view' => [
                [
                    'name' => 'Full',
                    'slug' => 'full',
                ],
                [
                    'name' => 'Head',
                    'slug' => 'head',
                ],
                [
                    'name' => 'Abstract',
                    'slug' => 'abstract',
                ],
            ],
            'lifestyle' => [
                [
                    'name' => 'Chilled',
                    'slug' => 'chilled',
                ],
                [
                    'name' => 'Swimming',
                    'slug' => 'swimming',
                ],
                [
                    'name' => 'Quirky',
                    'slug' => 'quirky',
                ],
            ],
        ];

        foreach ($categories as $typeSlug => $items) {
            $categoryType = CategoryType::where('slug', $typeSlug)->first();

            if (!$categoryType) {
                continue;
            }

            foreach ($items as $item) {
                Category::updateOrCreate(
                    [
                        'category_type_id' => $categoryType->id,
                        'slug' => $item['slug'],
                    ],
                    [
                        'name' => $item['name'],
                        'description' => null,
                    ]
                );
            }
        }
    }
}
