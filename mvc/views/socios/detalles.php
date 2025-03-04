<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del socio</title>
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
    <h2>Detalles del socio</h2>
    <h3><?= $socio->nombre?></h3>

    <p><b>Nombre:</b> <?= $socio->nombre?></p>
    <p><b>Apellidos:</b> <?= $socio->apellidos?></p>
    <p><b>Nacimiento:</b> <?= $socio->nacimiento?></p>
    <p><b>Poblacion:</b> <?= $socio->poblacion?></p>
    <p><b>Direccion:</b> <?= $socio->direccion ?></p>
    <p><b>Provincia:</b> <?= $socio->provincia ?></p>
    <p><b>Codigo postal:</b> <?= $socio->cp ?></p>
    <p><b>Telefono:</b> <?= $socio->telefono ?></p>

    <table class="bloquecentradow100">
			<tr>
				<th>Título</th><th>Límite</th><th>Devolución</th></tr>
				
			<?php foreach ($prestamos as $prestamo){?>
				<tr>
					<td><a href="index.php?controlador=libro/show&id=<?= $prestamo->idlibro ?>"><?=$prestamo->titulo?></a></td>
					<td><?=$prestamo->limite?></td>
					<td><?=$prestamo->devolucion?></td>					
				</tr>
			<?php } ?>		
		</table>
    

    <div class="centrado">
        <a class="button" href="index.php?controlador=socio/list">Lista de socios</a>
    </div>