@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow mt-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Chamado</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="title" value="{{ old('title', $ticket->title) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
            <textarea name="description" rows="5" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $ticket->description) }}</textarea>
        </div>

        @if(in_array(auth()->user()->role->name, ['admin', 'tecnico']))
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Aberto</option>
                <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Fechado</option>
            </select>
        </div>
        @endif

        <div>
            <label for="product_image" class="block text-sm font-medium text-gray-700">Imagem (opcional)</label>
            <input type="file" name="product_image" accept="image/*"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0 file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">

            @if($ticket->product_image_path)
                <div class="mt-3">
                    <p class="text-sm text-gray-600">Imagem atual:</p>
                    <img src="{{ asset('storage/' . $ticket->product_image_path) }}" alt="Imagem atual"
                         class="mt-1 max-w-xs rounded border shadow">
                </div>
            @endif
        </div>

        <div class="flex gap-4">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Atualizar Chamado
            </button>
            <a href="{{ route('tickets.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
