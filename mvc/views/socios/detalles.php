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
        'Libros' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <section>
            <h2><?= $socio->nombre." ".$socio->apellidos ?></h2>
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