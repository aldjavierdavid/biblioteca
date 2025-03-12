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
}