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
        'Socios' => $socio->nombre . " " . $socio->apellidos
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <section>
            <h2><?= $socio->nombre . " " . $socio->apellidos ?></h2>
            <h3><?= $socio->nombre ?></h3>

            <p><b>Nombre:</b> <?= $socio->nombre ?></p>
            <p><b>Apellidos:</b> <?= $socio->apellidos ?></p>
            <p><b>Nacimiento:</b> <?= $socio->nacimiento ?></p>
            <p><b>Poblacion:</b> <?= $socio->poblacion ?></p>
            <p><b>Direccion:</b> <?= $socio->direccion ?></p>
            <p><b>Provincia:</b> <?= $socio->provincia ?></p>
            <p><b>Codigo postal:</b> <?= $socio->cp ?></p>
            <p><b>Telefono:</b> <?= $socio->telefono ?></p>

            <div class="centered">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Socio/list">Lista de socios</a>
                <a class="button" href="/Socio/edit/<?= $socio->id ?>">Editar</a>
                <a class="button" href="/Socio/delete/<?= $socio->id ?>">Borrar</a>
            </div>
        </section>
            <section>
            <h2>Lista de prestamos</h2>
        <table class="table w100">
            <tr>
                <th>ID</th>
                <th>Ejemplar</th>
                <th>Título</th>
                <th>Límite</th>
                <th>Devolución</th>
            </tr>
            <?php foreach ($prestamos as $prestamo) { ?>
                <tr>
                    <td><?= $prestamo->id ?></td>
                    <td><?= $prestamo->idejemplar ?></td>
                    <td><?= $prestamo->titulo ?></td>
                    <td><?= $prestamo->limite ?></td>
                    <td><?= $prestamo->devolucion ?></td>
                </tr>
            <?php } ?>
        </table>
        </section>