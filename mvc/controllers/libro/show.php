<?php
if(empty($_GET['id']))
    throw new NothingToFindException("Falta el id del libro.");

$id = intval($_GET['id']);

if(empty($libro = Libro::find($id)))
    throw new NotFoundException("No existe el libro $id.");

    $temas = $libro->belongsToMany('Tema','temas_libros');
    
    $ejemplares = $libro->hasMany('Ejemplar');

require '../views/libro/detalles.php';
?>