<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function promoteToTechnician($id)
    {
        $user = User::findOrFail($id);
        $tecnicoRoleId = Role::where('name', 'tecnico')->value('id');
        $user->role_id = $tecnicoRoleId;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a técnico.");
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);
        $adminRoleId = Role::where('name', 'admin')->value('id');
        $user->role_id = $adminRoleId;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Usuário {$user->name} promovido a admin.");
    }

    public function demote($id)
    {
        $user = User::findOrFail($id);
        $userRoleId = Role::where('name', 'user')->value('id');
        $user->role_id = $userRoleId;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "Permissões removidas do usuário {$user->name}.");
    }
}
