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

        $userInfo = \App\Models\UserInfo::firstOrCreate(
            ['email_address' => 'admin@admin.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'password' => Hash::make('password'),
                'user_info_id' => $userInfo->id,
            ]
        );

        if (!$user->user_info_id) {
            $user->update(['user_info_id' => $userInfo->id]);
        }

        $user->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}