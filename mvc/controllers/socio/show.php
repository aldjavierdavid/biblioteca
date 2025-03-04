<?php
if(empty($_GET['id']))
    throw new NothingToFindException("Falta el id del socio.");

$id = intval($_GET['id']);

if(empty($socio = Socio::find($id)))
    throw new NotFoundException("No existe el socio $id.");

$prestamos = $socio->hasMany('V_prestamo');

require '../views/socios/detalles.php';
?>