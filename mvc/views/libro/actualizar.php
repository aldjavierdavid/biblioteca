<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar socio</title>
    <?= $template->css() ?>
    <script src="/js/BigPicture.js"></script>
    <script src="/js/Preview.js"></script>
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

        <section>

            <form method="POST" action="/Libro/update" enctype="multipart/form-data">
                <!--input oculto que contiende el ID del libro a actualizar -->
                <input type="hidden" name='id' value="<?= $libro->id ?>">
                <!-- resto del formulario... -->
                <label>ISBN</label>
                <input type="text" name="isbn" value="<?= old('isbn', $libro->isbn) ?>">
                <br>
                <label>Título</label>
                <input type="text" name="titulo" value="<?= old('titulo', $libro->titulo) ?>">
                <br>
                <label>Editorial</label>
                <input type="text" name="editorial" value="<?= old('editorial', $libro->editorial) ?>">
                <br>
                <label>Autor</label>
                <input type="text" name="autor" value="<?= old('autor', $libro->autor) ?>">
                <br>
                <label>Portada</label>
                <input type="file" name="portada" accept="image/*" id="file-with-preview">
                <br>
                <label>Idioma</label>
                <input type="text" name="idioma" value="<?= old('idioma', $libro->idioma) ?>">
                <br>
                <label>Edición</label>
                <input type="number" min="0" name="edicion" value="<?= old('edicion', $libro->edicion)  ?>">
                <br>
                <label>Año</label>
                <input type="number" min="0" name="anyo" value="<?= old('anyo', $libro->anyo) ?>">
                <br>
                <label>Edad rec.</label>
                <input type="number" min="0" max="99" name="edadrecomendada"
                    value="<?= old('edad', $libro->edadrecomendada)  ?>">
                <br>
                <label>Páginas</label>
                <input type="number" min="0" name="paginas" value="<?= old('paginas', $libro->paginas) ?>">
                <br>
                <label>Características</label>
                <input type="text" name="caracteristicas" value="<?= old('caracteristicas', $libro->caracteristicas) ?>">
                <br>
                <label>Sinopsis</label>
                <textarea name="sinopsis" class="w50"><?= old('caracteristicas', $libro->caracteristicas) ?></textarea>
                <br>
                </figure>
                <div class="centrado mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <figure class="flex1 centrado">
                    <img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="cover enlarge-image" alt="Portada de <?= $libro->titulo ?>" id="preview-image">
                    <figcaption>Portada de <?= "$libro->titulo, de $libro->autor" ?></figcaption>


                    <?php if ($libro->portada) { ?>
                        <form method="POST" action="/Libro/dropcover" class="no-border">
                            <input type="hidden" name="id" value="<?= $libro->id ?>">
                            <input type="submit" class="button-danger"
                                name="borrar" value="Eliminar portada">
                        </form>
                    <?php } ?>
        </section>

        <div class="centrado m1">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/Libro/list">Lista de libros</a>
            <a class="button" href="/Libro/show/<?= $libro->id ?>">Detalles</a>
            <a class="button" href="/Libro/delete/<?= $libro->id ?>">Borrado</a>

        </div>
        <section>
            <script>
                function confirmar(id) {
                    if (confirm('Seguro que lo deseas eliminar?'))
                        location.href = '/Ejemplar/destroy/' + id
                }
            </script>

            <h2>Ejemplres de <?= $libro->titulo ?></h2>

            <a class="button" href="/Ejemplar/create/<?= $libro->id ?>">Nuevo ejemplar</a>

            <?php
            if (!$ejemplares) {
                echo "<div class='warning p2'><p>No hay ejemplares de este libro.</p></div>";
            } else { ?>
                <table class="table bloquecentradow100 my1">
                    <tr>
                        <th>ID</th>
                        <th>Año</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Operaciones</th>
                    </tr>

                    <?php foreach ($ejemplares as $ejemplar) { ?>
                        <tr>
                            <td><?= $ejemplar->id ?></td>
                            <td><?= $ejemplar->anyo ?></td>
                            <td><?= $ejemplar->estado ?></td>
                            <td><?= $ejemplar->precio ?></td>
                            <td class="centered">
                                <?php if (!$ejemplar->hasAny('Prestamo')) { ?>
                                    <a onclick="confirmar(<?= $ejemplar->id ?>)">Borrar</a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                }
                ?>


                </table>
                <div class="p1 right">
                    Existen <?= sizeof($ejemplares) ?> ejemplares de este libro
                </div>
        </section>
        <section id="temas">
            <h2>Temas tratados en <?= $libro->titulo ?></h2>
            <?php
            if (!$temas) {
                echo "<div class='warning p2'><p>No se han indicado temas.</p></div>";
            } else { ?>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Tema</th>
                        <th>Operaciones</th>
                    </tr>
                    <?php foreach ($temas as $tema) { ?>
                        <tr>
                            <td><?= $tema->id ?></td>
                            <td><a href="/Tema/show/<?= $tema->id ?>"><?= $tema->tema ?></a></td>
                            <td class="centrado">
                                <form method="POST" class="no-border" action="/Libro/removetema">
                                    <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                                    <input type="hidden" name="idtema" value="<?= $tema->id ?>">
                                    <input type="submit" class="button-danger" name="remove" value="Borrar">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
            <form class="w50 m0 no-border" method="POST" action="/Libro/addTema">
                <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                <select name="idtema">
                    <?php
                    foreach ($listaTemas as $nuevoTema)
                        echo "<option value='$nuevoTema->id'>$nuevoTema->tema</option>\n";
                    ?>
                </select>
                <input class="button-success" type="submit" name="add" value="Añadir tema">
            </form>
        </section>
    </main>

    <!--pulidodesuelos.net@gmail.com -->