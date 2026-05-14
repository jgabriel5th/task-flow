<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tarefas = Task::orderBy('status', 'desc')->get();
        return view('tarefas', ['tarefas' => $tarefas]);
    }


    public function store(Request $request)
    {
        $novaTarefa = new Task();

        $novaTarefa->titulo = $request->titulo;
        $novaTarefa->descricao = $request->descricao;
        $novaTarefa->responsavel = $request->responsavel;
        $novaTarefa->prazo = $request->prazo;

        $novaTarefa->save();

        return redirect('/');
    }

    public function concluir($id)
    {
        // 1. Procura a tarefa no banco pelo ID dela
        $tarefa = Task::findOrFail($id);

        // 2. Muda o status para concluída
        $tarefa->status = 'concluida';

        // 3. Salva a alteração no banco
        $tarefa->save();

        // 4. Volta para a página de tarefas
        return redirect('');
    }
}
