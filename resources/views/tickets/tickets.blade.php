@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-8">
    <h2 class="text-2xl font-semibold mb-6">Abrir Novo Chamado</h2>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block font-medium text-gray-700 mb-1">Título</label>
            <input id="title" name="title" type="text" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   value="{{ old('title') }}">
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700 mb-1">Descrição</label>
            <textarea id="description" name="description" rows="5" required
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        {{-- Apenas admin vê o campo status --}}
        @can('admin-access')
        <div>
            <label for="status" class="block font-medium text-gray-700 mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Aberto</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Fechado</option>
            </select>
        </div>
        @else
            {{-- Usuário comum só envia "open" por padrão --}}
            <input type="hidden" name="status" value="open" />
        @endcan

        <div>
            <label for="product_image" class="block font-medium text-gray-700 mb-1">Imagem (opcional)</label>
            <input id="product_image" name="product_image" type="file" accept="image/*"
                   class="w-full text-gray-700">
        </div>

        <div>
            <button type="submit"
                    class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition">
                Abrir Chamado
            </button>
        </div>
    </form>
</div>
@endsection
