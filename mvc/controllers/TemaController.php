<?php
class TemaController extends Controller
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
        $temas = Tema::all();
        $temas = Tema::orderBy('id');

        return view('tema/lista', [
            'temas' => $temas
        ]);
    }

    public function create()
    {
        return view('tema/nuevo');
    }

    public function store()
    {
        if (!request()->has('guardar'))
            throw new FormException('No se recibió el formulario');

        $tema = new Tema(); // crea el nuevo Libro

        // toma los datos que llegan por POST
        $tema->tema          = request()->post('tema');
        $tema->descripcion      = request()->post('descripcion');
        try {
            // guarda el libro en la base de datos
            $tema->save();

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del tema $tema->tema correcto.");

            // redirecciona a los detalles del nuevo libro
            return redirect("/Tema/show/$tema->id");
            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            $mensaje = "No se pudo guardar el tema $tema->tema.";

            if (str_contains($e->errorMessage(), 'Duplicate entry'))
                $mensaje .= "<br>Ya existe un tema igual.";

            Session::error($mensaje);

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Tema/create");
        }
    }

    public function show(int $id = 0)
    {

        // comprueba que llega el ID
        if (!$id)
            throw new NothingToFindException('No se indicó el libro a buscar');

        $tema = Tema::find($id); // busca el libro con ese ID

        // comprueba que existe ese libro 
        $tema = Tema::findOrFail($id, "No se encontró el libro indicado.");

        // carga la vista y le pasa el libro recuperado
        return view('tema/detalles', [
            'tema' => $tema
        ]);
    }

    public function edit(int $id = 0)
    {

        // busca el libro con ese ID
        $tema = Tema::findOrFail($id, "No se encontró el libro");

        // retorna una ViewResponse con la vista con el formulario de edición
        return view('tema/actualizar', [
            'tema' => $tema
        ]);
    }

    public function update()
    {
        // comprueba que la petición venga del formulario
        if (!request()->has('actualizar'))
            throw new FormException('No se recibió el formulario');

        $id = intval(request()->post('id')); // recuperar el id vía POST

        $tema = Tema::findOrFail($id, "No se ha encontrado el libro,");

        // recuperar el resto de campos
        $tema->tema              = request()->post('tema');
        $tema->descripcion       = request()->post('descripcion');

        try {
            // actualiza el libro en la base de datos
            $tema->update();

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del socio $tema->tema correcto.");

            // redirecciona a los detalles del libro actualizado
            return redirect("/Tema/show/$tema->id");

            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            Session::error("Hubo errores en la actualización del tema $tema->tema.");

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Tema/actualizar/$id");
        }
    }

}
