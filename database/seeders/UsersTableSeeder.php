<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@glpi.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico João',
                'email' => 'tecnico@glpi.test',
                'password' => Hash::make('tecnico123'),
                'role' => 'tecnico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usuário Maria',
                'email' => 'usuario@glpi.test',
                'password' => Hash::make('usuario123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
