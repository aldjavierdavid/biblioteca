<?php
#[\AllowDynamicProperties]
class Libro extends Model {
    
/**
 * Añade un tema a un libro
 * 
 * @param int $idtema identificador del tema a añadir 
 * @return int
 */ 
public function addTema(int $idtema):int{
    //preapra la consulta
    $consulta = "INSERT INTO temas_libros(idlibro, idtema)
                VALUES($this->id, $idtema)";

    // ejecuta la consulta
    return (DB_CLASS)::insert($consulta);
}

public function removeTema(int $idtema):int{
    //preapra la consulta
    $consulta = "DELETE FROM temas_libros
                WHERE idlibro = $this->id AND idtema = $idtema";

    // ejecuta la consulta
    return (DB_CLASS)::delete($consulta);
}
}