<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Credit Card',
                'fee' => 0,
                'icon_key' => 'card',
            ],
            [
                'name' => 'Bank Transfer',
                'fee' => 0,
                'icon_key' => 'bank',
            ],
            [
                'name' => 'Pay on Delivery',
                'fee' => 2.99,
                'icon_key' => 'cash',
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(
                ['name' => $method['name']],
                [
                    'fee' => $method['fee'],
                    'icon_key' => $method['icon_key'],
                ]
            );
        }
    }
}
