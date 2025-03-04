<?php
$socio = Socio::findOrFail(intval($_GET['id']), 'No se encontró el socio');

require '../views/socios/actualizar.php'
?>