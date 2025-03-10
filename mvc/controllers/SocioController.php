<?php
class SocioController extends Controller
{
    public function index()
    {
        return $this->list();
    }

    public function list(int $page = 1){

        $filtro = Filter::apply('socios');

        $limit = RESULTS_PER_PAGE;

        if($filtro){
        
        $total = Socio::filteredResults($filtro);

        $paginator = new Paginator('/Socio/list', $page, $limit, $total);

        $socios = Socio::filter($filtro, $limit, $paginator->getOffset());
        }else{
            $total = Socio::total();

            $paginator = new Paginator('Socio/list', $page, $limit, $total);

            $socios = Socio::orderBy('nombre', 'ASC', $limit, $paginator->getOffset());
        }

        return view('socios/lista', [
            'socios' => $socios,
            'paginator' => $paginator,
            'filtro' => $filtro
        ]);
    }

    public function show(int $id = 0)
    {

        // comprueba que llega el ID
        if (!$id)
            throw new NothingToFindException('No se indicó el libro a buscar');

        $socio = Socio::find($id); // busca el libro con ese ID

        // comprueba que existe ese libro 
        $socio = Socio::findOrFail($id, "No se encontró el libro indicado.");
        $prestamos = $socio->hasMany('v_Prestamo');

        // carga la vista y le pasa el libro recuperado
        return view('socios/detalles', [
            'socio' => $socio,
            'prestamos' => $prestamos
        ]);
    }

    /**
     * Muestra el formulario de nuevo libro
     */

    public function create()
    {
        return view('socios/nuevo');
    }

    public function store()
    {
        // comprueba que la petición venga del formulario
        if (!request()->has('guardar'))
            throw new FormException('No se recibió el formulario');

        $socio = new Socio(); // crea el nuevo Libro

        // toma los datos que llegan por POST
        $socio->nombre          = request()->post('nombre');
        $socio->apellidos       = request()->post('apellidos');
        $socio->dni             = request()->post('dni');
        $socio->nacimiento      = request()->post('nacimiento');
        $socio->poblacion       = request()->post('poblacion');
        $socio->direccion       = request()->post('direccion');
        $socio->email           = request()->post('email');
        $socio->provincia       = request()->post('provincia');
        $socio->cp              = request()->post('cp');
        $socio->telefono        = request()->post('telefono');

        // Como en la configuración hemos indicado EMPTY_STRINGS_TO_NULL a true
        // los datos en blancos serán tomados como NULL.
        // En la BDD deberíamos permitir valores nulos en esos campos.

        // Si queremos poner valores por defecto podemos hacer:
        // $socio->paginas = request()->post('paginas') ?? -1;

        // intenta guardar el libro, en caso que la inserción falle vamos a 
        // evitar ir a la página de error y volver al formulario "nuevo libro"
        try {
            // guarda el libro en la base de datos
            $socio->save();

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del socio $socio->nombre $socio->apellidos correcto.");

            // redirecciona a los detalles del nuevo libro
            return redirect("/Socio/show/$socio->id");
            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            $mensaje = "No se pudo guardar el socio $socio->nombre $socio->apellidos.";

            if (str_contains($e->errorMessage(), 'Duplicate entry'))
                $mensaje .= "<br>Ya existe un socio igual.";

            Session::error($mensaje);

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Socio/create");
        }
    }

    /**
     * Muestra el formulario de edición del libro
     * 
     * @param int $id el ID único del libro a editar
     * 
     * @return ViewResponse
     */

    public function edit(int $id = 0)
    {

        // busca el libro con ese ID
        $socio = Socio::findOrFail($id, "No se encontró el libro");

        // retorna una ViewResponse con la vista con el formulario de edición
        return view('socios/actualizar', [
            'socio' => $socio
        ]);
    }

    public function update()
    {
        // comprueba que la petición venga del formulario
        if (!request()->has('actualizar'))
            throw new FormException('No se recibió el formulario');

        $id = intval(request()->post('id')); // recuperar el id vía POST

        $socio = Socio::findOrFail($id, "No se ha encontrado el libro,");

        // recuperar el resto de campos
        $socio->nombre          = request()->post('nombre');
        $socio->apellidos       = request()->post('apellidos');
        $socio->dni             = request()->post('dni');
        $socio->nacimiento      = request()->post('nacimiento');
        $socio->poblacion       = request()->post('poblacion');
        $socio->direccion       = request()->post('direccion');
        $socio->email           = request()->post('email');
        $socio->provincia       = request()->post('provincia');
        $socio->cp              = request()->post('cp');
        $socio->telefono        = request()->post('telefono');

        // intenta recuperar el libro
        try {
            // actualiza el libro en la base de datos
            $socio->update();

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del socio $socio->nombre $socio->apellidos correcto.");

            // redirecciona a los detalles del libro actualizado
            return redirect("/Socio/show/$socio->id");

            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            Session::error("Hubo errores en la actualización del socio $socio->nombre.");

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Socio/actualizar/$id");
        }
    }
    /**
     * Muestra el formulario de confirmación de eliminación 
     * 
     * @param int $id identificador único del libro a eliminar
     * 
     * @return ViewResponse
     */

    public function delete(int $id = 0)
    {

        $socio = Socio::findOrFail($id, "No existe el socio.");

        return view('socios/borrar', [
            'socio' => $socio
        ]);
    }

    /**
     * Elimina el libro de la base de datos
     * @return RedirectResponse
     */
    public function destroy()
    {

        //comprueba que llega el formulario de confirmación
        if (!request()->has('borrar'))
            throw new FormException('No se recibió la confirmación');

        $id = intval(request()->post('id')); // recupera el identificador
        $socio = Socio::findOrFail($id); // recupera el libro

        // si el libro tiene ejemplares, no permitiremos su borrado
        // más adelante ocultaremos el botón de "borrar" en estos casos
        // para que no el usuario no llegue el formulario de confirmación
        if ($socio->hasAny('Prestamo'))
            throw new Exception("No se puede borrar el socio mientras tenga prestamos");

        try {
            $socio->deleteObject();
            Session::success("Se ha borrado el socio $socio->nombre.");
            return redirect("/Socio/list");
        } catch (SQLException $e) {

            Session::error("No se pudo borrar el socio $socio->nombre.");

            if (DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/Socio/delete/$id");
        }
    }

    public function prestamos()
    {

    }
}
