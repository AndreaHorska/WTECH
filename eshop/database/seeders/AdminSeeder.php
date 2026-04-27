<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);

        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['password' => Hash::make('password')]
        );

        $user->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}