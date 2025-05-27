<?php

// database/seeders/TicketSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Ticket::create([
                'user_id' => $user->id,
                'title' => 'Chamado de teste do usuário ' . $user->name,
                'description' => 'Este é um chamado fictício para testes.',
                'status' => 'aberto',
            ]);
        }
    }
}
