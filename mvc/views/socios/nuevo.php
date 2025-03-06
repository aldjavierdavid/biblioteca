<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de libros - <?= APP_NAME ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME?>">
    <meta name="author" content="Robert Sallent">

    <link rel="shortcut icon" href="/favicon.icon" type="image/png">

    <?= $template->css() ?>
</head>

<body>
    <?= $template -> login() ?>
    <?= $template->header('Crear un nuevo socio')?>
    <?= $template->menu()?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages()?>
    
    <main>
    <h1>Nuevo socio</h1>
        <form method="POST" enctype="multipart/form-data" action="/Socio/store">
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
            <input type="submit" class="button" name="guardar" value="Guardar">
        </form>

        <div class="centrado">
            <a class="button" href="/Libro/lista">Lista de libros</a>
        </div>