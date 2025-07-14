@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow mt-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Meus Chamados</h2>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tickets.create') }}"
       class="inline-block mb-6 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        + Novo Chamado
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Título</th>
                    <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Criado em</th>
                    <th class="px-4 py-2 border-b text-center text-sm font-semibold text-gray-700">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b text-blue-600 hover:underline">
                            <a href="{{ route('tickets.show', $ticket->id) }}">
                                {{ $ticket->title }}
                            </a>
                        </td>
                        <td class="px-4 py-3 border-b">
                            @php
                                $statusClasses = [
                                    'open' => 'bg-green-100 text-green-800',
                                    'in_progress' => 'bg-yellow-100 text-yellow-800',
                                    'closed' => 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusClasses[$ticket->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-sm {{ $statusClass }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 border-b">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 border-b text-center space-x-2">
                            @php
                                $user = auth()->user();
                                $roleName = optional($user->role)->name;
                                $canEdit = in_array($roleName, ['admin', 'tecnico']) || $ticket->user_id === $user->id;
                                $canDelete = $ticket->user_id === $user->id || $roleName === 'admin';
                            @endphp

                            @if($canEdit)
                                <a href="{{ route('tickets.edit', $ticket->id) }}"
                                   class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm transition">
                                    Editar
                                </a>
                            @endif

                            @if($canDelete)
                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Tem certeza que deseja deletar este chamado?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm transition">
                                        Excluir
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600">Nenhum chamado encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
