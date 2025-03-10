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
    public function list(int $page = 1)
    {
        $filtro = Filter::apply('prestamos');
        $limit = RESULTS_PER_PAGE;
        
        if($filtro){

        $total = V_prestamo::filteredResults($filtro);
        
        $paginator = new Paginator('/Prestamo/list', $page, $limit, $total);

        $prestamos = V_prestamo::filter($filtro, $limit, $paginator->getOffset());
        
    }else{
        $total = Prestamo::total();

        $paginator = new Paginator('/Prestamo/list', $page, $limit, $total);

        $prestamos = V_prestamo::orderBy('id', 'ASC', $limit, $paginator->getOffset());
    }
        // carga la vista que los muestra
        return view('prestamo/lista', [
            'prestamos' => $prestamos,
            'paginator' => $paginator,
            'filtro' => $filtro
        ]);
    }

   
}
?>