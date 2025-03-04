<?php
if(empty($_POST['guardar']))
    throw new Exception("No se recibió el formulario");

$socio = new Socio();

$socio->nombre         = $_POST['nombre'];
$socio->apellidos          = $_POST['apellidos'];
$socio->dni          = $_POST['dni'];
$socio->nacimiento       = date($_POST['nacimiento']);
$socio->poblacion          = $_POST['poblacion'];
$socio->direccion         = $_POST['direccion'];
$socio->email         = $_POST['email'];
$socio->provincia         = $_POST['provincia'];
$socio->cp        = intval($_POST['cp']);
$socio->telefono = intval($_POST['telefono']);
$socio->alta =     isset($_POST['alta']) ? $_POST['alta'] : date("Y-m-d H:i:s");

$socio->save();

$mensaje = "Guardado del socio $socio->nombre correcto";
require '../views/exito.php';