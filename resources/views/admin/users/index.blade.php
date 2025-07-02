@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-white mb-6"> Lista de Usuários</h1>


    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="px-6 py-3 border-b">Nome</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b">Função</th>
                    <th class="px-6 py-3 border-b text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b capitalize">{{ optional($user->role)->name ?? 'Usuário comum' }}</td>
                        <td class="px-6 py-4 border-b text-center space-x-2">

                            @if(optional($user->role)->name !== 'tecnico')
                                <form action="{{ route('admin.users.promote-technician', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1 rounded shadow transition">
                                        Promover a Técnico
                                    </button>
                                </form>
                            @endif

                            @if(optional($user->role)->name !== 'admin')
                                <form action="{{ route('admin.users.promote-admin', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1 rounded shadow transition">
                                        Promover a Admin
                                    </button>
                                </form>
                            @endif

                            @if(optional($user->role)->name !== 'user')
                                <form action="{{ route('admin.users.demote', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-3 py-1 rounded shadow transition">
                                        Remover Permissões
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
