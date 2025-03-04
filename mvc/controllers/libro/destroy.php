<?php
if(empty($_POST['confirmarborrado']))
    throw new FormException("No se recibió la confirmación");

$libro = Libro::findOrFail(intval($_POST['id']), 'No se encontró el libro');

if($libro->hasAny('Ejemplar'))
    throw new Exception('No se puede borrar un libro si tiene ejemplares.');

$libro->deleteObject();

$mensaje = "Borrado del libro $libro->titulo, de $libro->autor correcto.";
require '../views/exito.php';
    
