@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-6">Meus Chamados</h1>

    @if($tickets->count())
        <ul>
            @foreach($tickets as $ticket)
                <li class="mb-4 border-b pb-2">
                    <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:underline font-semibold">
                        {{ $ticket->title }}
                    </a>
                    <p class="text-gray-600 text-sm">{{ Str::limit($ticket->description, 100) }}</p>
                </li>
            @endforeach
        </ul>

        {{ $tickets->links() }}
    @else
        <p>Você ainda não possui chamados.</p>
    @endif
</div>
@endsection
