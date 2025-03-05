<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar libro</title>
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
        <h1><?= APP_NAME ?></h1>
        <h2>Edición del libro <?= $libro->titulo ?></h2>

        <form method="POST" action="/Libro/update">
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
            <div class="centrado mt2">
                <input type="submit" class="button" name="actualizar" value="Actualizar">
                <input type="reset" class="button" value="Reset">
            </div>
        </form>
        <div class="centrado m1">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/Libro/list">Lista de libros</a>
            <a class="button" href="/Libro/show<?=$libro->id ?>">Detalles</a>
            <a class="button" href="/Libro/delete<?=$libro->id?>">Borrado</a>
        </div>
    </main>

    <!--pulidodesuelos.net@gmail.com -->