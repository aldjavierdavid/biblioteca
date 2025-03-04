<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Portada - <?= APP_NAME ?></title>
		
		<!-- META -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Portada en <?= APP_NAME ?>">
		<meta name="author" content="Robert Sallent">
		
		<!-- FAVICON -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/png">	
		
		<!-- CSS -->
		<?= $template->css() ?>
	</head>
	<body>
		<?= $template->login() ?>
		<?= $template->header('Portada') ?>
		<?= $template->menu() ?>
		<?= $template->breadCrumbs() ?>
		<?= $template->messages() ?>
		<?= $template->acceptCookies() ?>
		
		<h1>Portada de la biblioteca</h1>
        <div class="success">
            <h2>Bienvenido</h2>
            <p>Esta es la portada del primer ejemplo de gestión de libros 
                de la biblioteca.</p>
            <p>Este ejemplo es un <b>MVC sencillo</b>, todas las peticiones 
        pasarán por el <b>index.php</b>, que actuará de dispatcher y gestionará todos los errores.</p>
        </div>
        <div class="centrado">
            <a class="button" href="index.php?controlador=libro/list">Lista de libros</a>
        </div>
		
    </nav>
    
		<?= $template->footer() ?>
		<?= $template->version() ?>
		
	</body>
</html>

