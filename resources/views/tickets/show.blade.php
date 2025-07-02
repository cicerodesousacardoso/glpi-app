@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $ticket->title }}</h1>

    <p class="mb-4">{{ $ticket->description }}</p>

    @if($ticket->product_image_path)
        <div class="mb-4">
            <h2 class="font-semibold mb-2">Imagem do Produto</h2>
            <img src="{{ asset('storage/' . $ticket->product_image_path) }}" alt="Imagem do produto" class="max-w-xs rounded shadow">
        </div>
    @endif

    <a href="{{ route('tickets.index') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        Voltar para chamados
    </a>
</div>
@endsection
