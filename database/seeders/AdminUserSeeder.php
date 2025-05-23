<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@glpi-app.com',
            'password' => Hash::make('senha123'),
            'is_admin' => true, // se você tiver esse campo
        ]);
    }
}
