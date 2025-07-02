@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-6">Abrir Novo Chamado</h1>

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Título</label>
            <input type="text" id="title" name="title" 
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Descrição</label>
            <textarea id="description" name="description" rows="5" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow transition">
            Abrir Chamado
        </button>
    </form>
</div>
@endsection
