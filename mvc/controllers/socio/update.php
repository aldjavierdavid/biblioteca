<?php
if(empty($_POST['actualizar'])) 
    throw new FormException('No se recibió el formulario');

$socio = Socio::findOrFail(intval($_POST['id']), 'No se encontró el socio');

$socio->nombre         = $_POST['nombre'];
$socio->apellidos          = $_POST['apellidos'];
$socio->nacimiento       = date($_POST['nacimiento']);
$socio->poblacion          = $_POST['poblacion'];
$socio->direccion         = $_POST['direccion'];
$socio->email         = $_POST['email'];
$socio->provincia         = $_POST['provincia'];
$socio->cp        = intval($_POST['cp']);
$socio->telefono = intval($_POST['telefono']);

$socio->update();

$mensaje = "Actualización del socio $socio->nombre $socio->apellido correcto.";
require '../views/exito.php';
    
?>