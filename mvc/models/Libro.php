<?php
#[\AllowDynamicProperties]
class Libro extends Model
{

    /**
     * Añade un tema a un libro
     * 
     * @param int $idtema identificador del tema a añadir 
     * @return int
     */
    public function addTema(int $idtema): int
    {
        //preapra la consulta
        $consulta = "INSERT INTO temas_libros(idlibro, idtema)
                VALUES($this->id, $idtema)";

        // ejecuta la consulta
        return (DB_CLASS)::insert($consulta);
    }

    public function removeTema(int $idtema): int
    {
        //preapra la consulta
        $consulta = "DELETE FROM temas_libros
                WHERE idlibro = $this->id AND idtema = $idtema";

        // ejecuta la consulta
        return (DB_CLASS)::delete($consulta);
    }

    public function validate(bool $checkId = false):array{
        $errores = [];

        //  el campo id solamente se comprueba en el update()
        if($checkId && empty(intval($this->id))) {
            $errores['id'] = "No se indicó el identificador";
        }

    // ISBN: de 10 a 17 digitos o guiones medios
    if(empty($this->isbn) || !preg_match("/^\d[\d\-]{9,16}\d$/", $this->isbn)) {
        $errores['isbn'] = "Error en el formato del ISBN";
    }

    //título: de 1 a 64 caracteres
    if(empty($this->titulo) || strlen($this->titulo)<1 || strlen($this->titulo)>64) {
        $errores['titulo'] = "Error en la longitud del título";
    }

    // edición: número positivo
    if(empty($this->edicion) ||$this->edicion<0){
        $errores['edicion'] = "Error en el número de edición";
    }

    if(empty($this->edadrecomendada)||$this->edadrecomendada<0||$this->edadrecomendada>120)
        $errores['edadrecomendada'] = "Error en la edad recomendada";

    return $errores; // retorna la lista de errores
    }
}
