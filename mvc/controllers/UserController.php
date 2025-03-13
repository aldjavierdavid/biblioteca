<?php
class UserController extends Controller{

    public function index(){
        return $this->list();
    }
    
    /**
     * Carga la vista "home" para el usuario identificado
     * 
     * @return ViewResponse
     */
    public function home(){

        Auth::check(); // autorizacion (solo usuarios identificados)
        
        // carga la vista la home y le pasa el usuario identificado
        // el usuario se puede recuperar mediante el método Login::user()
        return view('user/home', [
            'user' => Login::user()
        ]);
    }

    /**
     * Muestra el formulario de "nuevo usuario"
     * 
     * @return ViewResponse
     */
    public function create(){

        // operación solamente para el administrador
        // equivale a Auth::role('ROLE_ADMIN') pero es más corto.
        Auth::admin();

        return view('user/create');
    }

    public function store(){

        // Esta operación solamente la puede hacer el administrador
        Auth::admin();

        // comprueba que llega el formulario
        if(!request()->has('guardar'))
            throw new FormException('No se recibió el formulario');

        $user = new User(); // crea el nuevo usuario

        // recupera el password y lo encripta
        // en este caso no lo cogemos de la Request, porque el saneamiento
        // podría provocar que el password cambiara (y el usuario no podría hacer login)
        // no es peligroso porque al encriptarlo no afectarán los caracteres especiales
        $user->password = md5($_POST['password']);
        $repeat         = md5($_POST['repeatpassword']);

        // comprueba que los dos passwords coinciden
        if($user->password != $repeat)
            throw new ValidationException("Las claves no coinciden");

        // toma el resto de los valores del formulario
        $user->displayname = request()->post('displayname');
        $user->email       = request()->post('email');
        $user->phone       = request()->post('phone');

        // añade ROLE_USER y el rol que venga del formulario, no pasa nada si
        // se repite "ROLE_USER", el método addRole() elimina las repeticiones.
        $user->addRole('ROLE_USER', $this->request->post('roles'));

        try{
            $user->save();              // guarda el usuario

            $file = request()->file(    // recupera la foto
                'picture',              // nombre del input
                8000000,                // tamaño maximo del fichero
                ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'] // tipos aceptados
            );
            
            // si hay fichero, lo guardamos y actualizamos el campo "picture"
            if($file){
                $user->picture = $file->store('../public/'.USER_IMAGE_FOLDER, 'user_');
                $user->update();
            }

            Session::success("Nuevo usuario $user->displayname creado con exito");
            return redirect("/Panel/admin");
        
        // si se produce un error de validación
        }catch(ValidationException $e){

            Session::error($e->getMessage());
            return redirect("/User/create");

        // si se produce un error al guardar en la BDD    
        }catch(SQLException $e){

            Session::error("Se produjo un error al guardar el usuario $user->displayname.");

            if(DEBUG)
                throw new Exception($e->getMessage());

            return redirect("/User/create");

        // si se produce un error en la subida del fichero   
        }catch(UploadException $e){
            Session::warning("El usuario se guardó correctamente, pero no se pudo subir el fichero de imagen.");

            if(DEBUG)
                throw new Exception($e->getMessage());

            // redirecciona a la edición de usuario (ver ejercicios)
            return redirect("/User/edit/$user->id");
        }
    }

    public function list(int $page = 1){

        Auth::role(ADMIN_ROLE); // autorizacion (solo usuarios identificados)

        $limit = RESULTS_PER_PAGE;
        $total = User::total();
        $paginator = new Paginator('/User/list', $page, $limit, $total);

        $users = User::orderBy('displayname', 'ASC', $limit, $paginator->getOffset());

        return view('user/list', [
            'users' => $users,
            'paginator' => $paginator,
        ]);

    }

    public function show(int $id = 0){

        // comprueba que llega el id
        if(!$id)
            throw new NothingToFindException('No se indicó el libro a buscar');

        $user = User::findOrFail($id, 'No se encontró el usuario indicado');

        // carga la vista y le pasa el libro recuperado
        return view('user/show', [
            'user' => $user
        ]);
    }

    public function update(){
        
        // comprueba que la petición venga del formulario
        if(!request()->has('actualizar'))
            throw new FormException('No se recibió el formulario');

        $id = intval(request()->post('id')); // recuperar el id vía POST

        $user = User::findOrFail($id, "No se ha encontrado el usuario");

        // recuperar el resto de campos
        $user->displayname = request()->post('displayname'); 
        $user->phone       = request()->post('phone');
        $user->email       = request()->post('email');
        $user->picture     = request()->post('picture');
        $user->roles       = $user->addRole('ROLE_USER', $this->request->post('roles'));

        // intenta recuperar el usuario
        try{
            //actualiza el usuario en la base de datos
            $user->update();

            // flashea un mensaje éxito en sesión
            Session::success("Guardado del usuario $user->displayname correcto.");

            // redirecciona a los detalles del usuario actualizado 
            return redirect("/User/show/$user->id");

            // si falla el guardado del usuario...
        }catch (SQLException $e){
            // prepara el mensaje de error
            Session::error("Hubo errores en la actualización del usuario $user->displayname");

            // si está en modo DEBUG vuelve a lanzar la excepción
            if(DEBUG)
                throw new SQLException($e->getMessage());

            // regresa al formulario de creación de libro
            return redirect("/User/edit/$id");
        }
    }
    /**
     * Muestra el formulario de edición del usuario
     * 
     * @param int $id el ID único del usuario a editar
     * 
     * @return ViewResponse
     */

     public function edit(int $id = 0)
     {
 
         // busca el libro con ese ID
         $user = User::findOrFail($id, "No se encontró el libro");
 
         // retorna una ViewResponse con la vista con el formulario de edición
         return view('user/edit', [
             'user' => $user
         ]);
     }

      /**
     * Muestra el formulario de confirmación de eliminación 
     * 
     * @param int $id identificador único del usuario a eliminar
     * 
     * @return ViewResponse
     */

    public function delete(int $id = 0)
    {

        $user = User::findOrFail($id, "No existe el socio.");

        return view('user/delete', [
            'user' => $user
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
        $user = User::findOrFail($id); // recupera el libro

        // si el libro tiene ejemplares, no permitiremos su borrado
        // más adelante ocultaremos el botón de "borrar" en estos casos
        // para que no el usuario no llegue el formulario de confirmación
        try {
            $user->deleteObject();
            Session::success("Se ha borrado el usuario $user->displayname.");
            return redirect("/User/list");
        } catch (SQLException $e) {

            Session::error("No se pudo borrar el socio $user->displayname.");

            if (DEBUG)
                throw new SQLException($e->getMessage());

            return redirect("/User/delete/$id");
        }
    }
}