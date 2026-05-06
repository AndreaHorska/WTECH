<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryType;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Main',
                'slug' => 'main',
            ],
            [
                'name' => 'Gear',
                'slug' => 'gear',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
            ],
            [
                'name' => 'View',
                'slug' => 'view',
            ],
        ];

        foreach ($types as $type) {
            CategoryType::updateOrCreate(
                ['slug' => $type['slug']],
                ['name' => $type['name']]
            );
        }
    }
}
