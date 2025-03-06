<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo tema - <?= APP_NAME ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME?>">
    <meta name="author" content="Robert Sallent">

    <link rel="shortcut icon" href="/favicon.icon" type="image/png">

    <?= $template->css() ?>
</head>

<body>
    <?= $template -> login() ?>
    <?= $template->header('Crear un nuevo tena')?>
    <?= $template->menu()?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages()?>
    
    <main>
    <h1>Nuevo socio</h1>
        <form method="POST" enctype="multipart/form-data" action="/Tema/store">
            <label>Tema</label>
            <input type="text" name="tema" value="<?= old('tema') ?>">
            <br>
            <label>Descripción</label>
            <input type="text" name="descripcion" value="<?= old('descripcion') ?>">
            <br>
            <input type="submit" class="button" name="guardar" value="Guardar">
        </form>