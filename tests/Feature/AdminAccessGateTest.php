<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminAccessGateTest extends TestCase
{
    /** @test */
    public function user_with_admin_role_has_access()
    {
        // Cria o usuário admin no banco de dados temporário do teste
        $adminUser = User::factory()->create(['role' => 'admin']);

        // Verifica se o Gate permite acesso
        $this->assertTrue(Gate::forUser($adminUser)->allows('admin-access'));
    }

    /** @test */
    public function user_without_admin_role_does_not_have_access()
    {
        // Cria o usuário comum no banco de dados temporário do teste
        $normalUser = User::factory()->create(['role' => 'user']);

        // Verifica se o Gate nega acesso
        $this->assertFalse(Gate::forUser($normalUser)->allows('admin-access'));
    }
}
