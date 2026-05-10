<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;
class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Home Delivery',
                'fee' => 2.99,
                'icon_key' => 'home',
                'eta_days' => 3,
            ],
            [
                'name' => 'Store Pickup',
                'fee' => 0,
                'icon_key' => 'store',
                'eta_days' => 0,
            ],
        ];

        foreach ($methods as $method) {
            ShippingMethod::updateOrCreate(
                ['name' => $method['name']],
                [
                    'fee' => $method['fee'],
                    'icon_key' => $method['icon_key'],
                    'eta_days' => $method['eta_days'],
                ]
            );
        }
    }
}
