@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Gerenciamento de Usuários</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($users->count() > 0)
    <table class="min-w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nome</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Papel</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        @if($user->role !== 'tecnico')
                            <form action="{{ route('admin.users.promote-technician', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Técnico</button>
                            </form>
                        @endif

                        @if($user->role !== 'admin')
                            <form action="{{ route('admin.users.promote-admin', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Admin</button>
                            </form>
                        @endif

                        @if($user->role !== 'user')
                            <form action="{{ route('admin.users.demote', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remover</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-center py-4 text-gray-500">Nenhum usuário cadastrado no momento.</p>
    @endif
</div>
@endsection
