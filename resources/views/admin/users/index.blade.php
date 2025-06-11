@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Usuários - Admin</h1>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Nome</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Papel</th>
                    <th class="border px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->role }}</td>
                        <td class="border px-4 py-2">
                            @if($user->role !== 'tecnico')
                                <form action="{{ route('admin.users.promote-technician', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Promover a Técnico</button>
                                </form>
                            @endif

                            @if($user->role !== 'admin')
                                <form action="{{ route('admin.users.promote-admin', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Promover a Admin</button>
                                </form>
                            @endif

                            @if($user->role !== 'user')
                                <form action="{{ route('admin.users.demote', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Remover Permissões</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Nenhum usuário cadastrado no momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
