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
}