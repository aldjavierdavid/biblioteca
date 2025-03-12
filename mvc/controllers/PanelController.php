<?php
class PanelController extends Controller {
    
    /** Muestra el panel del bibliotecario 
     * @return ViewResponse
     */
    public function index() {
        // comprueba que el usuario sea bibliotecario
        Auth::role('ROLE_LIBRARIAN');

        // carga la vista del panel
        return view('panel/biblio');
    }

    /** Muestra el panel del administrador
     * @return ViewResponse
     */
    public function admin(){
        // comprueba que el usuario sea administrador
        Auth::role('ROLE_ADMIN');

        // carga la vista del panel
        return view('panel/admin');
    }
}