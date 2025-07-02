<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'aberto',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show($id)
    {
        $ticket = Ticket::where('user_id', auth()->id())->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    // Implementar editar, update e destroy conforme sua necessidade
}
