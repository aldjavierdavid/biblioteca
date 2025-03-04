<?php
    $tema = Tema::findOrFail(intval($_GET['id']),"Falta el id del tema.");
           
    $libros = $tema->belongsToMany('Libro','temas_libros');
    
    require '../views/tema/detalles.php';
?>