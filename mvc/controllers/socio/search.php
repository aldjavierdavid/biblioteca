<?php
$campo = $_POST['campo'] ?? 'nombre';
$valor = $_POST['valor'] ?? '';
$orden = $_POST['orden'] ?? 'id';
$sentido = $_POST['sentido'] ?? 'ASC';

// recupera los libros aplicando el filtro
$socios = Socio::getFiltered($campo, $valor, $orden, $sentido);

// carga la vista con el listado de libros
// (es la misma vista que para la operación listar)
require '../views/socios/lista.php';
?>