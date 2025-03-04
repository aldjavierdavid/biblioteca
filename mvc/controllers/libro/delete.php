<?php

$id = intval($_GET['id']);

$libro = Libro::findOrFail($id, 'No se encontró el libro');

require '../views/libro/borrar.php';

?>