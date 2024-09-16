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

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
