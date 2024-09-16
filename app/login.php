<?php
    require __DIR__.'/load.php';

    render('header', [
        'title' => 'Título da página',
        'style' => ['static/css/main.css']
    ]);
?>

<div class="card" style="width: 30rem;">
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Login</h2>
        
        <form id="login" action="#" method="post">
            <!-- Mensagem de Erro -->
            <div class="alert alert-danger d-none" id="error-message">
                Erro ao efetuar login no sistema. Tente novamente.
            </div>

            <!-- Campo de Usuário -->
            <div class="mb-4">
                <label for="user" class="form-label">Usuário:</label>
                <input type="text" class="form-control" value="coordenacao" name="user" id="user" required placeholder="Digite seu usuário">
            </div>
            
            <!-- Campo de Senha -->
            <div class="mb-4">
                <label for="pass" class="form-label">Senha:</label>
                <input type="password" class="form-control" value="coordenacao" name="pass" id="pass" required placeholder="Digite sua senha">
            </div>

            <!-- Botão de Envio -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>


<?php 
    render('footer', [
        'script' => ['static/js/login.js']
    ]); 
?>