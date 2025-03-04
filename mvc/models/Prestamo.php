<?php
    class Prestamo extends Model{  
        
        /**
         * Recupera el ejemplar al que pertenece prestamo
         *
         * @return Prestamo | NULL
         */
        
        public function getEjemplar():?Ejemplar{
            $consulta = "SELECT * FROM prestamos WHERE id=$this->idejemplar";
            return DBMysqli::select($consulta, 'Ejemplar');
        }
    }
?>