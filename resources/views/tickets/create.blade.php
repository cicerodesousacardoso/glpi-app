@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 max-w-2xl mt-10">
    <h2 class="text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100">Abrir Novo Chamado</h2>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
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
            <label for="title" class="block mb-2 text-gray-700 dark:text-gray-300 font-medium">Título</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >
        </div>

        <div>
            <label for="description" class="block mb-2 text-gray-700 dark:text-gray-300 font-medium">Descrição</label>
            <textarea
                name="description"
                id="description"
                rows="5"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 resize-y focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="product_image" class="block mb-2 text-gray-700 dark:text-gray-300 font-medium">Imagem (opcional)</label>
            <input
                type="file"
                name="product_image"
                id="product_image"
                accept="image/*"
                class="w-full text-gray-700 dark:text-gray-300"
            >
        </div>

        {{-- Status não aparece para usuário comum --}}

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded transition duration-150"
        >
            Abrir Chamado
        </button>
    </form>
</div>
@endsection
