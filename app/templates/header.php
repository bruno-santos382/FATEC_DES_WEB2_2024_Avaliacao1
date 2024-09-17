<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/'; ?>">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="static/lib/bootstrap@523/css/bootstrap.min.css">

    <?php if (!empty($style)): ?>
        <?php foreach ($style as $href): ?>
            <link rel="stylesheet" href="<?= htmlspecialchars($href, ENT_QUOTES) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Chamados</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a <?= (isset($active_link) && $active_link == 'lista_chamados') ? 'class="nav-link active" aria-current="true"' : 'class="nav-link"' ?>  href="lista_chamados.php">
                        Todos os Chamados
                    </a>
                </li>

                <?php if ($session->isLoggedIn()): ?>
                    <li class="nav-item">
                        <a <?= (isset($active_link) && $active_link == 'chamados_curso') ? 'class="nav-link active" aria-current="true"' : 'class="nav-link"' ?>  href="chamados_curso.php">
                            Chamados por Curso
                        </a>
                    </li>
                    <li class="nav-item">
                        <a <?= (isset($active_link) && $active_link == 'cadastro') ? 'class="nav-link active" aria-current="true"' : 'class="nav-link"' ?>  href="cadastro.php">
                            Novo Chamado
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <div class="d-flex align-items-center">
                <?php if ($session->isLoggedIn()): ?>
                    <span class="me-3">Olá, <?= htmlspecialchars($session->getUsername()) ?>!</span>
                    <a class="btn btn-outline-danger" href="controller.php?action=logout">Sair</a>
                <?php else: ?>
                    <a class="btn btn-outline-primary" href="login.php">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>


<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
