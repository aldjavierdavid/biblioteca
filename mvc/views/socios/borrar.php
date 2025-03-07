<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar socio</title>
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
        <h2><?= $socio->nombre . " " . $socio->apellidos ?></h2>
            <form method="POST" class="p2 m2" action="/Socio/destroy">
                <p>Confirmar el borrado del socio <b><?= $socio->nombre . " " . $socio->apellidos ?></b>.</p>

                <input type="hidden" name="id" value="<?= $socio->id ?>">
                <input class="button-danger" type="submit" name="borrar" value="Borrar">
            </form>

            <div class="centered">
            <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Socio/list">Lista de socios</a>
                <a class="button" href="/Socio/edit/<?= $socio->id ?>">Editar</a>
                <a class="button" href="/Socio/show/<?= $socio->id ?>">Detalles</a>
            </div>
        </main>