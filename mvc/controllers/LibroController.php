<?php
class LibroController extends Controller {
    public function index(){
        return $this->list();
    }

    public function list(){

        $libros = Libro::all();
        $libros = Libro::orderBy('titulo');

        return view('libro/lista', [
            'libros' => $libros
        ]);
    }
    
    public function show(int $id = 0){

        // comprueba que llega el ID
        if(!$id)
            throw new NothingToFindException('No se indicó el libro a buscar');

        $libro = Libro::find($id); // busca el libro con ese ID

        // comprueba que existe ese libro 
        if(!$libro)
            throw new NotFoundException('No se encontró el libro indicado');

        // carga la vista y le pasa el libro recuperado
        return view('libro/show', [
            'libro' => $libro
        ]);




    }
}


?>