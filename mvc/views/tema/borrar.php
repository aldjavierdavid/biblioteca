<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar socio</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Borrar tema') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Temas' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <h2><?= $tema->tema ?></h2>
            <form method="POST" class="p2 m2" action="/Tema/destroy">
                <p>Confirmar el borrado del tema: <b><?=$tema->tema?></b>.</p>
                <input type="hidden" name="id" value="<?= $tema->id ?>">
                <input class="button-danger" type="submit" name="borrar" value="Borrar">
            </form>

            <div class="centered">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Tema/lista">Lista de libros</a>
                <a class="button" href="/Tema/show/<?= $tema->id ?>">Detalles</a>
                <a class="button" href="/Socio/edit/<?= $tema->id ?>">Editar</a>
            </div>
        </main>