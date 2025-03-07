<?php 

class EjemplarController extends Controller{
    /**
     * Método que muestra el formulario de "nuevo ejemplar"
     * 
     * @return ViewResponse
     */
    public function create(int $idlibro = 0){

        $libro = Libro::findOrFail($idlibro);

        return view('ejemplar/create', [
            'libro' => $libro
        ]);
    }

    /**
     * Guarda un nuevo ejemplar
     * 
     * @return RedirectResponse
     */
    public function store(){

        // comprueba que llega el formulario con los datos
        if(!request()->has('guardar'))
            throw new FormException('No se recibieron los datos del ejemplar');

        $ejemplar = new Ejemplar(); // crea un nuevo ejemplar

        // recupera los datos del formulario que llegan por POST
        $ejemplar->idlibro = intval(request()->post('idlibro'));
        $ejemplar->anyo    = intval(request()->post('anyo'));
        $ejemplar->precio  = floatval(request()->post('precio'));
        $ejemplar->estado  = request()->post('estado');

        try{
            $ejemplar->save();

            // si todo va bien...
            Session::success('Ejemplar añadido correctamente.');
            return redirect("/Libro/edit/$ejemplar->idlibro");
        
        // si algo falla...
        }catch(SQLException $e){
            Session::error('No se pudo añadir el ejemplar.');

            if(DEBUG)
                throw new Exception($e->getMessage());

            return redirect("/Ejemplar/create/$ejemplar->idlibro");
        }
    }
    /**
     * Elimina un ejemplar de la BDD 
     * 
     * @param int $id identificador del ejemplar
     * @return RedirectResponse
     */
    public function destroy(int $id = 0){
        
        //recupera el ejemplar de la BDD
        $ejemplar = Ejemplar::findOrFail($id, "No se encontró el ejemplar.");

        // si hay préstamos no permitimos el borrado
        if($ejemplar->hasAny('Prestamo','idejemplar'))
            throw new Exception('Este ejemplar no se puede borrar, tiene préstamos.');

        try{
            $ejemplar->deleteObject();
            Session::success('Ejemplar eliminado correctamente.');
            return redirect("/Libro/edit/$ejemplar->idlibro");
        }catch(SQLException $e){

            Session::error('No se pudo eliminar el ejemplar.');

            if(DEBUG)
                throw new Exception($e->getMessage());

            return redirect("/Libro/edit/$ejemplar->idlibro");
        }
    }
    
}
