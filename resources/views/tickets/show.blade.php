@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do Chamado</h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $ticket->title }}</h4>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</p>
            <p><strong>Criado em:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Descrição:</strong><br>{{ $ticket->description }}</p>

            @if($ticket->product_image_path)
                <div class="mt-3">
                    <strong>Imagem anexada:</strong><br>
                    <img src="{{ asset('storage/' . $ticket->product_image_path) }}" alt="Imagem do chamado" style="max-width: 100%; height: auto;">
                </div>
            @endif

            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary mt-3">Editar Chamado</a>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Voltar à lista</a>
        </div>
    </div>
</div>
@endsection
