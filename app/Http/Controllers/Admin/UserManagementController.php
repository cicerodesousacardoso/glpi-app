<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function promoteToTechnician($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'tecnico';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a técnico.");
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a admin.");
    }

    public function demote($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Permissões removidas do usuário {$user->name}.");
    }
}
