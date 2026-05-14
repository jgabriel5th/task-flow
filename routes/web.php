<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// 1. A raiz da página agora vai direto para o seu Controller listar as tarefas
Route::get('/', [TaskController::class, 'index']);

// 2. Rota para salvar a tarefa
Route::post('/tarefas/salvar', [TaskController::class, 'store']);

// 3. Rota para concluir a tarefa
Route::patch('/tarefas/{id}/concluir', [TaskController::class, 'concluir'])->name('tarefas.concluir');
