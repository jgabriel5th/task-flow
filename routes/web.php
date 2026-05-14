<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('', [TaskController::class, 'index']);

Route::post('/tarefas/salvar', [TaskController::class, 'store']);

Route::delete('/tarefas/deletar/{id}', [TaskController::class, 'destroy']);