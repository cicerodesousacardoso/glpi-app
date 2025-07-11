<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Facades\Auth;

class ChamadoController extends Controller
{
    // Mostrar o formulário de criação
    public function create()
    {
        return view('chamados.create');
    }

    // Salvar o chamado no banco
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ]);

        Chamado::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'user_id' => Auth::id(),
            'status' => 'aberto',
        ]);

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    // Listar os chamados do usuário
    public function index()
    {
        $chamados = Chamado::where('user_id', Auth::id())->latest()->get();
        return view('chamados.index', compact('chamados'));
    }
}
