@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
   <h1 class="text-3xl font-bold mb-6 text-white">Bem Vindo</h1>


    @if(optional(auth()->user()->role)->name === 'user' || !optional(auth()->user()->role)->name)
        <div class="space-x-4">
            <a href="{{ route('tickets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                Abrir Chamado
            </a>

            <a href="{{ route('tickets.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded shadow">
                Acompanhar Chamados
            </a>
        </div>
    @endif

    {{-- Conteúdo do dashboard para outros perfis --}}
</div>
@endsection
