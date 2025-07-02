@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Meus Chamados</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($tickets->isEmpty())
        <p class="text-gray-600">Você não possui chamados abertos.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-6 py-3 border-b">Título</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b">Criado em</th>
                    <th class="px-6 py-3 border-b text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($tickets as $ticket)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-6 py-4 border-b">{{ $ticket->title }}</td>
                    <td class="px-6 py-4 border-b capitalize">{{ $ticket->status }}</td>
                    <td class="px-6 py-4 border-b">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 border-b text-center">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:underline">Visualizar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
