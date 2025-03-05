<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar libro</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Borrado de libro') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Borrado del libro <?= $libro->titulo ?></h2>
    
        <form method="POST" class="p2 m2" action="/Libro/destroy">
            <p>Confirmar el borrado del libro <b><?=$libro->titulo?></b>.</p>

            <input type="hidden" name="id" value="<?= $libro->id?>">
            <input class="button-danger" type="submit" name="borrar" value="Borrar">
        </form>

        <div class="centered">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/Libro/list">Lista de libros</a>
            <a class="button" href="/Libro/show/<?= $libro->id ?>">Detalles</a>
            <a class="button" href="/Libro/edit/<?= $libro->id ?>">Edición</a>
        </div>
    </main>