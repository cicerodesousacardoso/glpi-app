@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow mt-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Detalhes do Chamado</h2>

    <div class="space-y-4 text-gray-700">
        <div>
            <strong class="block text-sm text-gray-600">Título:</strong>
            <p class="text-lg">{{ $ticket->title }}</p>
        </div>

        <div>
            <strong class="block text-sm text-gray-600">Descrição:</strong>
            <p>{{ $ticket->description }}</p>
        </div>

        <div>
            <strong class="block text-sm text-gray-600">Status:</strong>
            <span class="inline-block px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
            </span>
        </div>

        <div>
            <strong class="block text-sm text-gray-600">Criado em:</strong>
            <p>{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
        </div>

        @if(in_array(auth()->user()->role->name, ['admin', 'tecnico']))
        <div>
            <strong class="block text-sm text-gray-600">Criado por:</strong>
            <p>{{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
        </div>
        @endif

        @if ($ticket->product_image_path)
            <div>
                <strong class="block text-sm text-gray-600">Imagem do Produto:</strong>
                <img src="{{ asset('storage/' . $ticket->product_image_path) }}" alt="Imagem do Produto"
                     class="mt-2 max-w-full rounded border shadow">
            </div>
        @endif
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
            Voltar
        </a>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded">
            Editar
        </a>
    </div>
</div>
@endsection
