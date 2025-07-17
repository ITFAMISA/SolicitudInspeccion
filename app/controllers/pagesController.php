<?php
// app/controllers/PagesController.php
class PagesController extends Controller {
    public function __construct(){
        // Este controlador es público
    }

    public function index(){
        // Si el usuario está logueado, lo redirige a su dashboard
        if(isLoggedIn()){
            redirect($_SESSION['rol'] . '/index');
        }
        // Si no, lo manda al login
        redirect('auth/login');
    }
}
