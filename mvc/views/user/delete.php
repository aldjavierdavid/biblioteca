<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar usuario</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Borrado de socio') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Socios' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <h2><?= $user->displayname ?></h2>
            <form method="POST" class="p2 m2" action="/User/destroy">
                <p>Confirmar el borrado del usuario <b><?= $user->displayname ?></b>.</p>

                <input type="hidden" name="id" value="<?= $user->id ?>">
                <input class="button-danger" type="submit" name="borrar" value="Borrar">
            </form>

            <div class="centered">
            <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/User/list">Lista de socios</a>
                <a class="button" href="/User/edit/<?= $user->id ?>">Editar</a>
                <a class="button" href="/User/show/<?= $user->id ?>">Detalles</a>
            </div>
        </main>