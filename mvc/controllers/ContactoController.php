<?php 
class ContactoController extends Controller{
    /**
     * Carga la vista con el formulario de contacto
     * 
     * @return ViewResponse
     */
    public function index(){
        return view('contacto');
    }

/**
 * Envia el email al administrador de la aplicacion
 * 
 * @return RedirectResponse
 */
public function send(){
    if(empty(request()->post('enviar')))
        throw new FormException('No se recibio el formulario de contacto.');

    // toma los datos del formulario de contacto
    $from = request()->post('email');
    $name = request()->post('nombre');
    $subject = request()->post('asunto');
    $message = request()->post('mensaje');

    // intenta preparar y enviar el email al administrador
    // cuyo email esta configurado en el fichero config/config.php
    try{
        $email = new Email(ADMIN_EMAIL, $from, $name, $subject, $message);
        $email->send();

        // flashea el mensaje de exito y redirecciona a la portada
        Session::success("Mensaje enviado, en breve recibiras una respuesta.");
        return redirect('/');

        //En caso de que no se pueda enviar el email...
    }catch(EmailException $e){
        Session::error("No se pudo enviar el email.");

        if(DEBUG)
            throw new Exception($e->getMessage());

        return redirect("/Contacto");
    }
}
}