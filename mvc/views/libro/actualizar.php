<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar libro</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Actualizar libro</h1>
    <h2><?=$libro->titulo?></h2>
    <menu class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?controlador=libro/list">Lista de libros</a></li>
            <li><a href="index.php?controlador=libro/create">Nuevo libro</a></li>
            <li><a href="index.php?controlador=socio/list">Lista de socios</a></li>
            <li><a href="index.php?controlador=socio/create">Nuevo socio</a></li>
        </menu>
    <form method="POST" action="index.php?controlador=libro/update">
        <input type="hidden" name='id' value="<?=$libro->id?>">

        <label>ISBN</label>
        <input type="text" name="isbn" value="<?=$libro->isbn?>">
        <br>
        <label>Título</label>
        <input type="text" name="titulo" value="<?=$libro->titulo?>">
        <br>
        <label>Editorial</label>
        <input type="text" name="editorial" value="<?=$libro->editorial?>">
        <br>
        <label>Autor</label>
        <input type="text" name="autor" value="<?=$libro->autor?>">
        <br>
        <label>Idioma</label>
        <select name="idioma">
            <option value="Castellano" <?=$libro->idioma=='Castellano'? 'selected': ''?>>Castellano</option>
            <option value="Catalán" <?=$libro->idioma=='Catalán'? 'selected': ''?>>Catalán</option>
            <option value="Inglés" <?=$libro->idioma=='Inglés'? 'selected': ''?>>Inglés</option>
            <option value="Otros" <?=$libro->idioma=='Otros'? 'selected': ''?>>Otros</option>
        </select>
        <br>
        <label>Edición</label>
        <input type="number" min="0" name="edicion" value="<?=$libro->edicion?>">
        <br>
        <label>Edad</label>
        <input type="number" min="0" max="99" name="edadrecomendada"
            value="<?=$libro->edadrecomendada?>">
        <br>
        <input type="submit" class="button" name="actualizar" value="Actualizar">
        <input type="reset" class="button" value="Reset">
    </form>