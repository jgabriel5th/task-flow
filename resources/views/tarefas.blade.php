<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Minhas Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .card { background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }

        /* Estilos estendidos para o Status */
        .status { font-weight: bold; }
        .status.pendente { color: #e74c3c; }  /* Vermelho moderno */

        .btn-concluir { background-color: #27ae60; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-concluir:hover { background-color: #219150; }
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

                {{-- STATUS SÓ APARECE SE A TAREFA FOR PENDENTE --}}
                @if($tarefa->status == 'pendente')
                    <p class="status pendente">
                        Status: {{ $tarefa->status }}
                    </p>
                @endif

                <div style="margin-top: 10px; display: flex; gap: 10px; align-items: center;">
                    {{-- LÓGICA DO BOTÃO CONCLUIR OU MENSAGEM DE SUCESSO --}}
                    @if($tarefa->status == 'pendente')
                        <form action="{{ route('tarefas.concluir', $tarefa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-concluir">
                                ✓ Concluir
                            </button>
                        </form>
                    @else
                        <span style="color: #27ae60; font-weight: bold;">✔ Concluída com sucesso!</span>
                    @endif

                    {{-- BOTÃO EXCLUIR (Sempre visível) --}}
                    <form action="/tarefas/deletar/{{ $tarefa->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; text-decoration: underline; font-size: 0.9em;">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @endforeach {{-- Fechamos o loop aqui, uma única vez --}}
    @else
        <p>Nenhuma tarefa encontrada. Que tal criar a primeira?</p>
    @endif

</body>
</html>
