<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar socio</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Actualizar socio</h1>
    <h2><?=$socio->nombre . " " . $socio->apellidos?></h2>
    <menu class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?controlador=libro/list">Lista de libros</a></li>
            <li><a href="index.php?controlador=libro/create">Nuevo libro</a></li>
            <li><a href="index.php?controlador=socio/list">Lista de socios</a></li>
            <li><a href="index.php?controlador=socio/create">Nuevo socio</a></li>
        </menu>
    <form method="POST" action="index.php?controlador=socio/update">
        <input type="hidden" name='id' value="<?=$socio->id?>">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?=$socio->nombre?>">
        <br>
        <label>Apellido</label>
        <input type="text" name="apellidos" value="<?=$socio->apellidos?>">
        <br>
        <label>Nacimiento</label>
        <input type="date" name="nacimiento" value="<?=$socio->nacimiento?>">
        <br>
        <label>Email:</label>
        <input type="text" name="email" value="<?=$socio->apellidos?>">
        <br>
        <label>Poblacion</label>
        <input type="text" name="poblacion" value="<?=$socio->poblacion?>">
        <br>
        <label>Direccion</label>
        <input type="text" name="direccion" value="<?=$socio->direccion?>">
        <br>
        <label>Provincia</label>
        <input type="text" name="provincia" value="<?=$socio->provincia?>">
        <br>
        <label>Codigo postal</label>
        <input type="number" min="0" name="cp" value="<?=$socio->cp?>">
        <br>
        <label>Telefono</label>
        <input type="number" min="0" name="telefono" value="<?=$socio->telefono?>">
        <br>
        <input type="submit" class="button" name="actualizar" value="Actualizar">
        <input type="reset" class="button" value="Reset">
    </form>