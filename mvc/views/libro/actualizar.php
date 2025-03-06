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
        <h2>Edición del socio <?= $libro->titulo ?></h2>

        <form method="POST" enctype="multipart/form-data" action="/Socio/update">
            <!--input oculto que contiende el ID del libro a actualizar -->
            <input type="hidden" name='id' value="<?= $libro->id ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= old('nombre') ?>">
            <br>
            <label>Apellidos</label>
            <input type="text" name="apellidos" value="<?= old('apellidos') ?>">
            <br>
            <label>DNI</label>
            <input type="text" name="dni" value="<?= old('dni') ?>">
            <br>
            <label>Nacimiento</label>
            <input type="date" name="nacimiento" value="<?= old('nacimiento') ?>" >
            <br>
            <label>Poblacion</label>
            <input type="text" name="poblacion" value="<?= old('poblacion') ?>">
            <br>
            <label>Direccion</label>
            <input type="text" name="direccion" value="<?= old('direccion') ?>">
            <br>
            <label>Email</label>
            <input type="text" name="email" value="<?= old('email') ?>">
            <br>
            <label>Provincia</label>
            <input type="text" name="provincia" value="<?= old('provincia') ?>">
            <br>
            <label>Codigo postal</label>
            <input type="text" name="cp" value="<?= old('cp') ?>">
            <br>
            <label>Telefono</label>
            <input type="number" minLength="9" maxLength="9" name="telefono" value="<?= old('telefono') ?>">
            <br>
            <div class="centrado mt2">
                <input type="submit" class="button" name="actualizar" value="Actualizar">
                <input type="reset" class="button" value="Reset">
            </div>
        </form>
        <div class="centrado m1">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/Socio/list">Lista de socios</a>
            <a class="button" href="/Socio/show<?=$libro->id ?>">Detalles</a>
            <a class="button" href="/Socio/delete<?=$libro->id?>">Borrado</a>
        </div>
    </main>

    <!--pulidodesuelos.net@gmail.com -->