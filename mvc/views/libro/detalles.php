<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del libro</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <section>
            <h2><?= $libro->titulo ?></h2>

            <p><b>ISBN:</b> <?= $libro->isbn ?></p>
            <p><b>Título:</b> <?= $libro->titulo ?></p>
            <p><b>Editorial:</b> <?= $libro->editorial ?></p>
            <p><b>Autor:</b> <?= $libro->autor ?></p>
            <p><b>Idioma:</b> <?= $libro->idioma ?></p>
            <p><b>Edición:</b> <?= $libro->edicion ?></p>

            <p><b>Edad Recomendada:</b>
                <?= $libro->edadrecomendada ?? 'Pendiente de calificación'; ?></p>

            <p><b>Año:</b><?= $libro->anyo ?? '--' ?></p>
            <p><b>Páginas:</b><?= $libro->paginas ?? '--' ?></p>
            <p><b>Características:</b><?= $libro->caracteristicas ?? '--' ?></p>
        </section>
        <section>
            <h2>Sinopsis</h2>
            <p><?= $libro->sinopsis ? paragraph($libro->sinopsis) : 'SIN DETALLES' ?></p>
        </section>
        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/Libro/list">Lista de libros</a>
            <a class="button" href="/Libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="button" href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
        </div>
    </main>
    <h2>Detalles del libro</h2>
    <h3><?= $libro->titulo ?></h3>


    <p><b>Edad Recomendada:</b>
        <?= $libro->edadrecomendada ? $libro->edadrecomendada : 'TP' ?></p>

    <?php foreach ($temas as $tema) { ?>
        <p><b>Tema:</b><a href="index.php?controlador=tema/show&id=<?= $tema->id ?>"><?= $tema->tema ?></a></p>
    <?php } ?>

    <table class="bloquecentradow100">
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>

        <?php foreach ($ejemplares as $ejemplar) { ?>
            <tr>
                <td><?= $ejemplar->id ?></td>
                <td><?= $ejemplar->estado ?></td>
                <td><?= $ejemplar->precio ?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="centrado">
        <a class="button" href="index.php?controlador=libro/list">Lista de libros</a>
    </div>