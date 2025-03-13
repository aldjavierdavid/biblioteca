<?php 
#[\AllowDynamicProperties]
class Socio extends Model {
    
    public function validate(bool $checkId = false):array{
        $errores = [];

        //  el campo id solamente se comprueba en el update()
        if($checkId && empty(intval($this->id))) {
            $errores['id'] = "No se indicó el identificador";
        }

    // dni 
    if(empty($this->dni) || !preg_match("/^[a-zA-Z0-9]{5,10}$/", $this->dni)) {
        $errores['dni'] = "DNI incorrecto";
    }

    //teléfono
    if(empty($this->telefono) || strlen($this->telefono) < 9 || strlen($this->telefono) > 9) {
        $errores['telefono'] = "Error en el numero de telefono";
    }

    // codigo postal
    if(empty($this->cp) ||strlen($this->cp) > 5 ||strlen($this->cp) < 5){
        $errores['cp'] = "Error en el codigo postal";
    }

    // email
    if(empty($this->email) || !preg_match("/[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/", $this->email)) {
        $errores['email'] = "Inserta un email valido";
    }

        
    return $errores; // retorna la lista de errores
    }
}