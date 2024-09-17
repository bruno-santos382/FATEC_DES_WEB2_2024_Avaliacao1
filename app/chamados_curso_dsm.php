<?php
require __DIR__.'/load.php';

$session = new Session();

if (!in_array('verificar_solicitacao_por_curso', $session->getPermissions())) {
    header('Location: login.php');
    exit;
}

render('header', [
    'title' => 'Chamados Curso DSM',
    'active_link' => 'chamados_curso_dsm',
    'session' => $session
]);

$chamado = new Chamado();
$tickets = $chamado->buscaPorCurso('DSM');

?>

<h2 class="my-5">Lista de Chamados</h2>

<div class="card">
    <div class="card-body" style="overflow-y: auto; max-height: 70vh">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Laboratório</th>
                    <th scope="col">Data</th>
                    <th scope="col">Solicitação</th>
                    <th scope="col">Curso</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tickets)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum chamado registrado</td> <!-- Colspan for empty message -->
                    </tr>
                <?php else: ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?= htmlspecialchars($ticket['laboratorio']) ?></td>
                            <td><?= date("d/m/Y", strtotime($ticket['prazo_limite'])) ?></td> <!-- Format date -->
                            <td><?= htmlspecialchars($ticket['solicitacao']) ?></td>
                            <td><?= htmlspecialchars($ticket['curso_atendendo']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
    render('footer', [
        'script' => ['static/js/cadastro.js']
    ]); 
?>