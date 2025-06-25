<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $roles = DB::table('roles')->pluck('id', 'name');
        dd($roles);
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@glpi.test',
                'password' => Hash::make('admin123'),
                'role_id' => $roles['admin'] ?? null,
            ],
            [
                'name' => 'Técnico João',
                'email' => 'tecnico@glpi.test',
                'password' => Hash::make('tecnico123'),
                'role_id' => $roles['tecnico'] ?? null,
            ],
            [
                'name' => 'Usuário Maria',
                'email' => 'usuario@glpi.test',
                'password' => Hash::make('usuario123'),
                'role_id' => $roles['user'] ?? null,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
