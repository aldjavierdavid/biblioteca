<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Portada</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <h1>Portada de la biblioteca</h1>
        <?= $template->menu() ?>
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
    </body>
</html>