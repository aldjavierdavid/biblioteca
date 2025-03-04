<?php
if(empty($_POST['confirmarborrado']))
    throw new FormException("No se recibió la confirmación");

$socio = Socio::findOrFail(intval($_POST['id']), 'No se encontró el socio');

if($socio->hasAny('Prestamo'))
    throw new Exception('No se puede borrar un socio si tiene prestamos.');

$socio->deleteObject();

$mensaje = "Borrado del socio $socio->nombre correcto.";
require '../views/exito.php';
    
