<?php
$libro = Libro::findOrFail(intval($_GET['id']), 'No se encontró el libro');

require '../views/libro/actualizar.php'
?>