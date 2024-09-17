<?php
require __DIR__.'/load.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

render('header', [
    'title' => 'Cadastrar Chamado',
    'active_link' => 'cadastro',
    'session' => $session
]);

?>

<div class="card" style="width: 30rem;">
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Cadastrar Chamado</h2>
        
        <form id="cadastro" action="#" method="post">
            <!-- Mensagem de Erro -->
            <div class="alert alert-danger d-none" id="error-message">
                Erro ao efetuar o cadastro. Tente novamente.
            </div>

            <!-- Campo de Seleção de Laboratório -->
            <div class="mb-4">
                <label for="laboratorio" class="form-label">Laboratório:</label>
                <select class="form-select" name="laboratorio" id="laboratorio" required>
                    <option value="" disabled selected>Selecione um laboratório</option>
                    <option value="laboratorio1">Laboratório 1</option>
                    <option value="laboratorio2">Laboratório 2</option>
                    <option value="laboratorio3">Laboratório 3</option>
                </select>
            </div>

            <!-- Campo de Prazo Limite -->
            <div class="mb-4">
                <label for="prazo_limite" class="form-label">Prazo Limite:</label>
                <input type="date" class="form-control" name="prazo_limite" id="prazo_limite" required>
            </div>

            <!-- Campo de Solicitação -->
            <div class="mb-4">
                <label for="solicitacao" class="form-label">Solicitação:</label>
                <input type="text" class="form-control" name="solicitacao" id="solicitacao" required placeholder="Digite sua solicitação">
            </div>

            <!-- Campo de Curso Atendendo -->
            <div class="mb-4">
                <label for="curso_atendendo" class="form-label">Curso Atendendo:</label>
                <select class="form-select" name="curso_atendendo" id="curso_atendendo" required>
                    <option value="" disabled selected>Selecione um curso</option>
                    <option value="DSM">DSM</option>
                    <option value="GE">GE</option>
                </select>
            </div>

            <!-- Botão de Envio -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>


<?php 
    render('footer', [
        'script' => ['static/js/cadastro.js']
    ]); 
?>