<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de socios</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Libros de la biblioteca</h1>
    <menu class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?controlador=libro/list">Lista de libros</a></li>
            <li><a href="index.php?controlador=libro/create">Nuevo libro</a></li>
            <li><a href="index.php?controlador=socio/list">Lista de socios</a></li>
            <li><a href="index.php?controlador=socio/create">Nuevo socio</a></li>
        </menu>
    <div>
        <h2>Lista de socios</h2>
        <form method="POST" class="search" action="index.php?controlador=socio/search">
            <label>Campo:</label>
            <select name="campo">
            <!-- Añadir campos aquí si es necesario -->
            </select>
            <label>Valor:</label>
            <!-- Añadir campos aquí si es necesario -->
            <label>Orden:</label>
            <select name="orden">
            <!-- Añadir campos aquí si es necesario -->
            </select> 
            <input type="radio" name="sentido" value="ASC"
                <?= empty($sentido) || $sentido=='ASC'? ' checked': ''?>>
            <label>ASC</label>

            <input type="radio" name="sentido" value="DESC"
                    <?= !empty($sentido) && $sentido=='DESC'? ' checked':''?>>
            <label>DESC</label>

            <input type="submit" class="button" name="filtro" value="Filtrar">

            <a class="button" href="index.php?controlador=socio/list">Quitar filtros</a>
        </form>
        <table class="bloqueCentrado w100">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Alta</th>
                <th>Operaciones</th>
            </tr>
            <?php foreach ($socios as $socio) { ?>
                <tr>
                    <td><?= $socio->nombre?></td>
                    <td><?= $socio->apellidos?></td>
                    <td><?= $socio->email?></td>
                    <td><?= $socio->alta?></td>
                    <td>
                        <a href="index.php?controlador=socio/show&id=<?= $socio->id?>">Ver datos </a>
                        <a href="index.php?controlador=socio/edit&id=<?= $socio->id?>">Editar datos </a>
                        <a href="index.php?controlador=socio/delete&id=<?= $socio->id?>">Borrar socio </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="centrado">
        <a class="button" href="index.php?controlador=libro/list">Lista de libros</a>
    </div>
</body>

</html>