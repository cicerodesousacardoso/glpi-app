@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Chamado</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $ticket->title) }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Descrição</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $ticket->description) }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Aberto</option>
                <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Fechado</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="product_image">Imagem (opcional)</label>
            <input type="file" name="product_image" class="form-control" accept="image/*">

            @if($ticket->product_image_path)
                <p class="mt-2">Imagem atual:</p>
                <img src="{{ asset('storage/' . $ticket->product_image_path) }}" alt="Imagem atual" style="max-width: 200px; height: auto;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar Chamado</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
