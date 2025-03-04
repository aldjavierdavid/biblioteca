<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Portada</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <h1>Portada de la biblioteca</h1>
        <menu class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?controlador=libro/list">Lista de libros</a></li>
            <li><a href="index.php?controlador=libro/create">Nuevo libro</a></li>
            <li><a href="index.php?controlador=socio/list">Lista de socios</a></li>
            <li><a href="index.php?controlador=socio/create">Nuevo socio</a></li>
        </menu>
        <form method="POST" action="index.php?controlador=socio/store">
            <label>Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label>Apellidos</label>
            <input type="text" name="apellidos">
            <br>
            <label>DNI</label>
            <input type="text" name="dni">
            <br>
            <label>Nacimiento</label>
            <input type="date" name="nacimiento">
            <br>
            <label>Poblacion</label>
            <input type="text" name="poblacion">
            <br>
            <label>Direccion</label>
            <input type="text" name="direccion">
            <br>
            <label>Email</label>
            <input type="text" name="email">
            <br>
            <label>Provincia</label>
            <input type="text" name="provincia">
            <br>
            <label>Codigo postal</label>
            <input type="text" name="cp">
            <br>
            <label>Telefono</label>
            <input type="number" minLength="9" maxLength="9" name="telefono">
            <br>
            <input type="submit" class="button" name="guardar" value="Guardar">
        </form>

        <div class="centrado">
            <a class="button" href="index.php?controlador=libro/list">Lista de libros</a>
        </div>