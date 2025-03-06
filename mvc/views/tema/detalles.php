<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del socio</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Socios' => $socio->nombre ." ". $socio->apellidos
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <section>
            <h2><?= $tema->tema ?></h2>

    <p><b>Nombre del tema:</b> <?= $tema->tema ?></p>
    <p><b>Descripcion:</b> <?= $tema->descripcion ?></p>
    