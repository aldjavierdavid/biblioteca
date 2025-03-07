<?php

class PrestamoController extends Controller
{
    public function index()
    {
        return $this->list();
    }

    /**
     * Listado de libros
     * @return ViewResponse
     */
    public function list()
    {
        // recupera los libros junto con la información extra
        $prestamos = V_prestamo::orderBy('id');

        // carga la vista que los muestra
        return view('prestamo/lista', [
            'prestamos' => $prestamos
        ]);
    }

   
}
?>