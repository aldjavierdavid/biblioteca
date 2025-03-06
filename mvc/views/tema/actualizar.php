<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar tema</title>
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

        <form method="POST" enctype="multipart/form-data" action="/Socio/update">
            <h2>Editar tema: <?= $tema->tema ?></h2>
            <label>Nombre del tema:</label>
            <input type="text" value="<?= $tema->tema ?>" name="tema">
            <br>
            <label>Descripcion:</label>
            <input type="text" value="<?= $tema->descripcion ?>" name="descripcion">
            <br>
            <div class="centrado mt2">
                <input type="submit" class="button" name="actualizar" value="Actualizar">
                <input type="reset" class="button" value="Reset">
            </div>
        </form>