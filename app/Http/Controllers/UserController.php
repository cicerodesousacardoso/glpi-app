<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar formulário de cadastro
    public function create()
    {
        return view('auth.register');
    }

    // Salvar usuário no banco
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Usuário criado com sucesso! Faça login.');
    }

    // Listar usuários para o admin
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Promover para admin
    public function promoteAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a admin.");
    }

    // Promover para técnico
    public function promoteTechnician(User $user)
    {
        $user->role = 'tecnico';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a técnico.");
    }

    // Remover permissões (voltar para usuário comum)
    public function demote(User $user)
    {
        $user->role = 'user';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Permissões removidas do usuário {$user->name}.");
    }
}
