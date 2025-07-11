@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Meus Chamados</h2>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tickets.create') }}" class="btn btn-success mb-3">+ Novo Chamado</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td>{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Tem certeza que deseja deletar este chamado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum chamado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
