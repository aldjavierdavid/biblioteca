<?php

$id = intval($_GET['id']);

$socio = Socio::findOrFail($id, 'No se encontró el libro');

require '../views/socios/borrar.php';

?>