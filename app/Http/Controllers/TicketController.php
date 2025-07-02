<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        // Validação com imagem opcional
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,closed,pending',
            'product_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'status']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('product_image')) {
            $data['product_image_path'] = $request->file('product_image')->store('product_images', 'public');
        }

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,closed,pending',
            'product_image' => 'nullable|image|max:2048',
        ]);

        $ticket = Ticket::findOrFail($id);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('product_image')) {
            // Apaga imagem antiga, se houver
            if ($ticket->product_image_path) {
                Storage::disk('public')->delete($ticket->product_image_path);
            }
            $data['product_image_path'] = $request->file('product_image')->store('product_images', 'public');
        }

        $ticket->update($data);

        return redirect()->route('tickets.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->product_image_path) {
            Storage::disk('public')->delete($ticket->product_image_path);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Chamado deletado com sucesso!');
    }
}
