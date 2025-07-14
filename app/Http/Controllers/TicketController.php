<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user()->loadMissing('role');
        $roleName = $user->role->name ?? null;

        if (in_array($roleName, ['tecnico', 'admin'])) {
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
        } else {
            $tickets = Ticket::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user()->loadMissing('role');
        $roleName = $user->role->name ?? null;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image|max:2048',
            'status' => 'nullable|string|in:open,in_progress,closed',
        ]);

        $data = $request->only(['title', 'description']);
        $data['user_id'] = $user->id;

        // Apenas admin pode definir status, os outros sempre começam como "open"
        if ($roleName === 'admin' && $request->filled('status')) {
            $data['status'] = $request->input('status');
        } else {
            $data['status'] = 'open';
        }

        if ($request->hasFile('product_image')) {
            $data['product_image_path'] = $request->file('product_image')->store('product_images', 'public');
        }

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorizeTicketAccess($ticket);

        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorizeTicketAccess($ticket);

        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $user = auth()->user()->loadMissing('role');
        $roleName = $user->role->name ?? null;

        $this->authorizeTicketAccess($ticket);

        // Validações
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:open,in_progress,closed',
            'product_image' => 'nullable|image|max:2048',
        ]);

        $data = [];

        if (in_array($roleName, ['admin', 'tecnico'])) {
            if ($request->filled('status')) {
                $data['status'] = $request->input('status');
            }
        }

        if ($roleName === 'admin' || $ticket->user_id === $user->id) {
            if ($request->filled('title')) {
                $data['title'] = $request->input('title');
            }

            if ($request->filled('description')) {
                $data['description'] = $request->input('description');
            }
        }

        if ($request->hasFile('product_image')) {
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
        $this->authorizeTicketAccess($ticket);

        if ($ticket->product_image_path) {
            Storage::disk('public')->delete($ticket->product_image_path);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Chamado deletado com sucesso!');
    }

    private function authorizeTicketAccess(Ticket $ticket)
    {
        $user = auth()->user()->loadMissing('role');
        $roleName = $user->role->name ?? null;

        if (!in_array($roleName, ['admin', 'tecnico']) && $ticket->user_id !== $user->id) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
