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
        'Socios' => $socio->nombre ." ". $socio->apellidos
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


    <?php if ($socio->hasAny('Prestamo')) { ?>
    <table class="bloquecentradow100">
			<tr>
				<th>Título</th><th>Límite</th><th>Devolución</th></tr>
				
			<?php foreach ($prestamos as $prestamo){?>
				<tr>
					<td><a href="Libro/show/<?= $prestamo->idlibro ?>"><?=$prestamo->titulo?></a></td>
					<td><?=$prestamo->limite?></td>
					<td><?=$prestamo->devolucion?></td>					
				</tr>
			<?php } ?>		
		</table>
    <?php } ?>

    <div class="centrado">
        <a class="button" href="/Socio/list">Lista de socios</a>
    </div>