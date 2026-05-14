<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tarefas = Task::all();
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

    public function destroy($id)
    {
        $tarefa = Task::findOrFail($id);

        $tarefa->delete();

        return redirect('/');
    }
}
