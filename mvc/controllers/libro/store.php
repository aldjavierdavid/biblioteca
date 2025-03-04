<?php
if(empty($_POST['guardar']))
    throw new Exception("No se recibió el formulario");

$libro = new Libro();

$libro->isbn            = $_POST['isbn'];
$libro->titulo          = $_POST['titulo'];
$libro->editorial       = $_POST['editorial'];
$libro->autor           = $_POST['autor'];
$libro->idioma          = $_POST['idioma'];
$libro->edicion         = intval($_POST['edicion']);
$libro->edadrecomendada = intval($_POST['edadrecomendada']);

$libro->save();

$mensaje = "Guardado del libro $libro->titulo correcto";
require '../views/exito.php';