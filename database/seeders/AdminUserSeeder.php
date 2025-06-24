<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pega o ID do papel 'admin' na tabela roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');

        User::updateOrCreate(
            ['email' => 'admin@glpi.com'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRoleId,
            ]
        );
    }
}
