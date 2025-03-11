<?php
class LibroController extends Controller
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
        $filtro = Filter::apply('libros');

        $limit = RESULTS_PER_PAGE;

        if ($filtro) {

            $total = V_libro::filteredResults($filtro);

            // crea el objeto paginator
            $paginator = new Paginator('/Libro/list', $page, $limit, $total);

            $libros = V_libro::filter($filtro, $limit, $paginator->getOffset());
            // si no hay filtro
        } else {
            $total = V_libro::total();

            $paginator = new Paginator('/Libro/list', $page, $limit, $total);

            $libros = V_libro::orderBy('titulo', 'ASC', $limit, $paginator->getOffset());
        }

        // carga la vista que los muestra
        return view('libro/lista', [
            'libros' => $libros,
            'paginator' => $paginator,
            'filtro' => $filtro
        ]);
    }

    public function show(int $id = 0)
    {

        // comprueba que llega el ID
        if (!$id)
            throw new NothingToFindException('No se indicó el libro a buscar');

        $libro = Libro::find($id); // busca el libro con ese ID

        // comprueba que existe ese libro 
        $libro = Libro::findOrFail($id, "No se encontró el libro indicado.");

        $ejemplares = $libro->hasMany('Ejemplar');

        // recupera los temas del libro
        // $temas = $libro->getTemas(); // si tenemos getTemas() en el modelo

        $temas = $libro->belongsToMany('Tema', 'temas_libros');

        // carga la vista y le pasa el libro recuperado
        return view('libro/detalles', [
            'libro' => $libro,
            'ejemplares' => $ejemplares,
            'temas' => $temas
        ]);
    }

    /**
     * Muestra el formulario de nuevo libro
     */

    public function create()
    {
        //carga la vista con el forumulario y le pasa
        // la lista de temas ordenados alfabeticamente
        return view('libro/nuevo', [
            'listaTemas' => Tema::orderBy('tema')
        ]);
    }

    public function store()
    {
        // comprueba que la petición venga del formulario
        if (!request()->has('guardar'))
            throw new FormException('No se recibió el formulario');

        $libro = new Libro(); // crea el nuevo Libro

        // toma los datos que llegan por POST
        $libro->isbn            = request()->post('isbn');
        $libro->titulo          = request()->post('titulo');
        $libro->editorial       = request()->post('editorial');
        $libro->autor           = request()->post('autor');
        $libro->idioma          = request()->post('idioma');
        $libro->edicion         = request()->post('edicion');
        $libro->anyo            = request()->post('anyo');
        $libro->edadrecomendada = request()->post('edadrecomendada');
        $libro->paginas         = request()->post('paginas');
        $libro->caracteristicas = request()->post('caracteristicas');
        $libro->sinopsis        = request()->post('sinopsis');

        //recupera el idtema del desplegable
        $idtema = intval(request()->post('idtema'));

        // Como en la configuración hemos indicado EMPTY_STRINGS_TO_NULL a true
        // los datos en blancos serán tomados como NULL.
        // En la BDD deberíamos permitir valores nulos en esos campos.

        // Si queremos poner valores por defecto podemos hacer:
        // $libro->paginas = request()->post('paginas') ?? -1;

        // intenta guardar el libro, en caso que la inserción falle vamos a 
        // evitar ir a la página de error y volver al formulario "nuevo libro"
        try {
            // guarda el libro en la base de datos
            $libro->save();
            $libro->addTema($idtema); // le pone el tema principal

            //recupera la portada como objeto UploadedFile (o null si no llega)
            $file = request()->file(
                'portada', // nombre del input
                8000000,   // tamaño maximo del fichero
                ['image/png', 'image/jpeg', 'image/gif', 'image/webp'] // tipos aceptados
            );

            // si hay fichero, lo guardamos y actualizamos el campo "portada"
            if ($file) {
                $libro->portada = $file->store('../public' . BOOK_IMAGE_FOLDER, 'book_');
                $libro->update();
            }
            // flashea un mensaje éxito en sesión
            Session::success("Guardado del libro $libro->titulo correcto.");

            // redirecciona a los detalles del nuevo libro
            return redirect("/Libro/show/$libro->id");
            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            $mensaje = "No se pudo guardar el libro $libro->titulo.";

            if (str_contains($e->errorMessage(), 'Duplicate entry'))
                $mensaje .= "<br>Ya existe un libro con el ISBN $libro->isbn.";

            Session::error($mensaje);

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Libro/create");
        } catch (UploadException $e) {

            // preparamos un mensaje de advertencia 
            // no de error, puesto que el libro se guardó
            Session::warning("El libro se guardó correctamente, pero no se pudo subir el fichero de imagen");

            if (DEBUG)
                throw new UploadException($e->getMessage());

            // redirigimos a la edición del libro
            // por si se quiere volver a intentar subir la imagen
            redirect("/Libro/edit/$libro->id");
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
        $libro = Libro::findOrFail($id, "No se encontró el libro");
        $ejemplares = $libro->hasMany('Ejemplar');

        $temas = $libro->belongsToMany('Tema', 'temas_libros');

        $listaTemas = array_diff(Tema::orderBy('tema'), $temas);

        // retorna una ViewResponse con la vista con el formulario de edición
        return view('libro/actualizar', [
            'libro' => $libro,
            'ejemplares' => $ejemplares,
            'temas' => $temas,
            'listaTemas' => $listaTemas
        ]);
    }

    public function update()
    {
        // comprueba que la petición venga del formulario
        if (!request()->has('actualizar'))
            throw new FormException('No se recibió el formulario');

        $id = intval(request()->post('id')); // recuperar el id vía POST

        $libro = Libro::findOrFail($id, "No se ha encontrado el libro,");

        // recuperar el resto de campos
        $libro->isbn            = request()->post('isbn');
        $libro->titulo          = request()->post('titulo');
        $libro->editorial       = request()->post('editorial');
        $libro->autor           = request()->post('autor');
        $libro->idioma          = request()->post('idioma');
        $libro->edicion         = request()->post('edicion');
        $libro->anyo            = request()->post('anyo');
        $libro->edadrecomendada = request()->post('edadrecomendada');
        $libro->paginas         = request()->post('paginas');
        $libro->caracteristicas = request()->post('caracteristicas');
        $libro->sinopsis        = request()->post('sinopsis');

        // intenta recuperar el libro
        try {
            // actualiza el libro en la base de datos
            $libro->update();

            //recupera la portada como objeto UploadedFile (o null si no llega)
            $file = request()->file(
                'portada', // nombre del input
                8000000,   // tamaño maximo del fichero
                ['image/png', 'image/jpeg', 'image/gif', 'image/webp', 'image/jpg'] // tipos aceptados
            );

            // si hay fichero, lo guardamos y actualizamos el campo "portada"
            if ($file) {
                if ($libro->portada) // elimina el fichero anterior (si lo hay)
                    File::remove('/public'.'/'.BOOK_IMAGE_FOLDER.'/'.$libro->portada);

                // coloca el nuevo fichero y actualiza la propiedad
                $libro->portada = $file->store('../public/'.BOOK_IMAGE_FOLDER, 'book_');
                $libro->update();
            }

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del libro $libro->titulo correcto.");

            // redirecciona a los detalles del libro actualizado
            return redirect("/Libro/show/$libro->id");

            // si falla el guardado del libro...
        } catch (SQLException $e) {
            // prepara el mensaje de error
            Session::error("Hubo errores en la actualización del libro $libro->titulo.");

            // si está en modo DEBUG vuelve a lanzar la excepción
            if (DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro 
            return redirect("/Libro/actualizar/$id");
        } catch(UploadException $e){
            Session::warning("Cambios guardados, pero no se modificó la portada");

            if(DEBUG)
                throw new UploadException($e->getMessage());

            return redirect("/Libro/edit/$id");
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

        $libro = Libro::findOrFail($id, "No existe el libro.");

        return view('libro/borrar', [
            'libro' => $libro
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
        $libro = Libro::findOrFail($id); // recupera el libro

        // si el libro tiene ejemplares, no permitiremos su borrado
        // más adelante ocultaremos el botón de "borrar" en estos casos
        // para que no el usuario no llegue el formulario de confirmación
        if ($libro->hasAny('Ejemplar'))
            throw new Exception("No se puede borrar el libro mientras tenga ejemplares");

        try {
            $libro->deleteObject();

            // si hay imagen de portada, hay que borrarla
            if($libro->portada)
                File::remove('../public/'.BOOK_IMAGE_FOLDER.'/'.$libro->portada, true);

            Session::success("Se ha borrado el libro $libro->titulo.");
            return redirect("/Libro/list");
        } catch (SQLException $e) {

            Session::error("No se pudo borrar el libro $libro->titulo.");

            if (DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/Libro/delete/$id");
        }catch(FileException $e) {
            Session::warning("Se eliminó el libro pero no se pudo eliminar el fichero del disco.");

            if(DEBUG)
                throw new Exception($e->getMessage());

            // no podemos redirigir al libro si ya no existe
            // volveremos al listado de libros
            return redirect("/Libro");
        }
    }

    /**
     * Añade un tema a un libro
     * 
     * @return RedirectResponse
     */
    public function addtema()
    {
        if (empty(request()->post('add')))
            throw new FormException("No se recibio el formulario");

        // recupera los identificadores necesarios (idlibro e idtema)
        $idlibro = intval(request()->post('idlibro'));
        $idtema = intval(request()->post('idtema'));

        // recupera el libro
        $libro = Libro::findOrFail($idlibro, "No se encontro el libro");

        // recuperar el tema es opcional, si fallara la operacion porque el tema
        // ya no existe, el mensaje de error seria mas claro para el usuario
        $tema = Tema::findOrFail($idtema, "No se encontro el tema");

        try {
            $libro->addTema($idtema);

            Session::success("Se ha añadido $tema->tema a $libro->titulo.");
            return redirect("/Libro/edit/$idlibro");
        } catch (SQLException $e) {

            Session::error("No se pudo añadir $tema->tema a $libro->titulo.");

            if (DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/Libro/edit/$idlibro");
        }
    }

    /**
     * Elimina un tema de un libro
     * 
     * @return RedirectResponse
     */
    public function removetema()
    {

        // comprueba que llega el formulario
        if (empty(request()->post('remove')))
            throw new FormException("No se recibio el formulario.");

        // toma los IDs necesarios (idlibro e idtema)
        $idlibro = intval(request()->post('idlibro'));
        $idtema = intval(request()->post('idtema'));

        // recupera el libro
        $libro = Libro::findOrFail($idlibro, "No se encontro el libro");

        //recuperar el tema es opcional, si fallara la operacion porque el tema
        // ya no existe, el mensaje de error seria mas claro para el usuario
        $tema = Tema::findOrFail($idtema, "No se encontro el tema");

        //intenta quitar el tema al libro
        try {
            $libro->removeTema($idtema);
            Session::success("Se ha eliminado $tema->tema de $libro->titulo.");
            return redirect("/Libro/edit/$idlibro");

            // si se produce un error...
        } catch (SQLException $e) {
            Session::error("No se pudo eliminar $tema->tema de $libro->titulo.");

            if (DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/Libro/edit/$idlibro");
        }
    }

    /** 
     * Elimina la imagen de portada
     * 
     * @return RedirectResponse
    */
    public function dropcover(){

        // si no llega el formulario...
        if(!request()->has('borrar'))
            throw new FormException('Faltan datos para completar la operación');

        // recupera el ID y el libro
        $id = request()->post('id');
        $libro = Libro::findOrFail($id, "No se ha encontrado el libro.");

        $tmp = $libro->portada; // recordaremos el nombre para poder borrarla luego
        $libro->portada = NULL; // marca la portada a NULL

        try{
            // primero guardamos en la BDD y luego eliminamos el fichero
            $libro->update();
            File::remove('../public/'.BOOK_IMAGE_FOLDER.'/'.$tmp, true);

            Session::success("Borrado de la portada de $libro->titulo realizada.");
            return redirect("/Libro/edit/$id");
        }catch(SQLException $e){
            Session::error("No se pudo eliminar la portada");

            if(DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/Libro/edit/$id");
        }catch(FileException $e){
            Session::warning("No se pudo eliminar el fichero del disco.");
            
            if(DEBUG)
                throw new FileException($e->getMessage());

            return redirect("/Libro/edit/$libro->id");
        
        }
    }
}
