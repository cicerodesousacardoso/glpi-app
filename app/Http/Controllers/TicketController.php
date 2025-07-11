<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    // Listar chamados do usuário logado
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('tickets.index', compact('tickets'));
    }

    // Mostrar formulário para criar chamado
    public function create()
    {
        return view('tickets.create');
    }

    // Salvar novo chamado
    public function store(Request $request)
    {
        // Validação dos dados recebidos (removido o status do formulário)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description']);
        $data['user_id'] = auth()->id();

        // Define status fixo como 'open' para novo chamado
        $data['status'] = 'open';

        // Se enviou imagem, salvar no storage público
        if ($request->hasFile('product_image')) {
            $data['product_image_path'] = $request->file('product_image')->store('product_images', 'public');
        }

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso!');
    }

    // Mostrar detalhes de um chamado
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        abort_if($ticket->user_id !== auth()->id(), 403);

        return view('tickets.show', compact('ticket'));
    }

    // Mostrar formulário de edição
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        abort_if($ticket->user_id !== auth()->id(), 403);

        return view('tickets.edit', compact('ticket'));
    }

    // Atualizar chamado
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,in_progress,closed',
            'product_image' => 'nullable|image|max:2048',
        ]);

        $ticket = Ticket::findOrFail($id);
        abort_if($ticket->user_id !== auth()->id(), 403);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('product_image')) {
            // Apagar imagem antiga, se existir
            if ($ticket->product_image_path) {
                Storage::disk('public')->delete($ticket->product_image_path);
            }
            $data['product_image_path'] = $request->file('product_image')->store('product_images', 'public');
        }

        $ticket->update($data);

        return redirect()->route('tickets.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    // Deletar chamado
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        abort_if($ticket->user_id !== auth()->id(), 403);

        if ($ticket->product_image_path) {
            Storage::disk('public')->delete($ticket->product_image_path);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Chamado deletado com sucesso!');
    }
}
