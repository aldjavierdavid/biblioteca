<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar socio</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Socios' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Nuevo ejemplar</h2>

        <p>Vas a crear un nuevo ejemplar para el libro
            <b><?= $libro->titulo ?></b>
        </p>

        <form method="POST" action="/Ejemplar/store">
            <input type="hidden" name="idlibro" value="<?= $libro->id ?>">

            <label>Año</label>
            <input type="text" name="anyo" value="<?= old('anyo')?>">
            <br>
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="<?= old('precio')?>">
            <br>
            <label>Estado</label>
            <input type="text" name="estado" value="<?= old('estado') ?>">
            <br>
            <input type="submit" class="button" name="guardar" value="Guardar">
        </form>

        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a>
        </div>
    </main>
            
     