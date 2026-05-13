<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Minhas Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .card { background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; shadow: 2px 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .status { font-weight: bold; color: #e67e22; }
    </style>
</head>
<body>
    <h1>📋 Minhas Tarefas (TaskFlow)</h1>

    <div class="card" style="background-color: #e8f4fd;">
        <h3>🆕 Nova Negociação de Tarefa</h3>
        <form action="/tarefas/salvar" method="POST">
            @csrf

            <input type="text" name="titulo" placeholder="Título da Tarefa" required><br><br>
            <textarea name="descricao" placeholder="Descrição"></textarea><br><br>
            <input type="text" name="responsavel" placeholder="Quem vai fazer?" required><br><br>
            <input type="date" name="prazo" required><br><br>

            <button type="submit" style="background-color: #27ae60; color: white; border: none; padding: 10px; cursor: pointer;">
                Salvar Tarefa
            </button>
        </form>
    </div>
    <hr>

    @if(count($tarefas) > 0)
        @foreach($tarefas as $tarefa)
            <div class="card">
                <h3>{{ $tarefa->titulo }}</h3>
                <p>{{ $tarefa->descricao }}</p>
                <p><strong>Responsável:</strong> {{ $tarefa->responsavel }}</p>
                <p class="status">Status: {{ $tarefa->status }}</p>
            </div>
        @endforeach
    @else
        <p>Nenhuma tarefa encontrada. Que tal criar a primeira?</p>
    @endif

</body>
</html>
