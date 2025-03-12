<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del socio</title>
    <?= $template->css() ?>
    <script src="/js/BigPicture.js"></script>
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
        <h1><?= APP_NAME ?> </h1>
        <section>
            <h2><?= $tema->tema ?></h2>

            <p><b>Nombre del tema:</b> <?= $tema->tema ?></p>
            <p><b>Descripcion:</b> <?= $tema->descripcion ?></p>
            <div class="centrado">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Tema/list/">Lista de temas</a>
                <a class="button" href="/Tema/edit/<?= $tema->id ?>">Editar</a>
                <a class="button" href="/Tema/delete/<?= $tema->id ?>">Borrar</a>
            </div>
        </section>
        <section>
        <h2>Libros que tratan este tema</h2>
        <?php
        if(!$libros){
            echo "<div class='warning p2'><p>No se han encontrado libros con este tema.</p></div>";
        }else{ ?>
            <table class="table w100">
                <tr>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                </tr>
                <?php foreach($libros as $libro){ ?>
                    <tr>
                        <td><a href="/Libro/show/<?= $libro->id?>"><?= $libro->titulo ?></a></td>
                        <td><?=$libro->autor?></td>
                        <td><?=$libro->editorial ?></td>
                    </tr>
               <?php } ?>
            </table>
        <?php } ?>
        </section>
      