<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@glpi.com'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('admin123'), // senha padrão
                'is_admin' => true,
            ]
        );
    }
}
