<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de libros - <?= APP_NAME ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <link rel="shortcut icon" href="/favicon.icon" type="image/png">

    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Crear un nuevo socio') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages() ?>
    <form method="POST" enctype="multipart/form-data" action="/Socio/update">
        <h1>Actualizar datos del socio: <?= $socio->nombre . " " . $socio->apellidos ?></h1>
        <input type="hidden" name='id' value="<?= $socio->id ?>">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $socio->nombre ?>">
        <br>
        <label>Apellido</label>
        <input type="text" name="apellidos" value="<?= $socio->apellidos ?>">
        <br>
        <label>Nacimiento</label>
        <input type="date" name="nacimiento" value="<?= $socio->nacimiento ?>">
        <br>
        <label>Email:</label>
        <input type="text" name="email" value="<?= $socio->apellidos ?>">
        <br>
        <label>Poblacion</label>
        <input type="text" name="poblacion" value="<?= $socio->poblacion ?>">
        <br>
        <label>Direccion</label>
        <input type="text" name="direccion" value="<?= $socio->direccion ?>">
        <br>
        <label>Provincia</label>
        <input type="text" name="provincia" value="<?= $socio->provincia ?>">
        <br>
        <label>Codigo postal</label>
        <input type="number" min="0" name="cp" value="<?= $socio->cp ?>">
        <br>
        <label>Telefono</label>
        <input type="number" min="0" name="telefono" value="<?= $socio->telefono ?>">
        <br>
        <div class="centrado mt2">
            <input type="submit" class="button" name="actualizar" value="Actualizar">
            <input type="reset" class="button" value="Reset">
        </div>
        <div class="centered mt3">
            <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Socio/list">Lista de socios</a>
                <a class="button" href="/Socio/show/<?= $socio->id ?>">Detalles</a>
            </div>
    </form>