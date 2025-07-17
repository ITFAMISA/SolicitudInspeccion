<?php
/*
 * app/core/Controller.php
 * Controlador base. Carga los modelos y las vistas.
 */
class Controller {
    // Cargar modelo
    public function model($model){
        // Requerir el archivo del modelo
        require_once '../app/models/' . $model . '.php';
        // Instanciar el modelo
        return new $model();
    }

    // Cargar vista
    public function view($view, $data = []){
        // Verificar si el archivo de la vista existe
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // La vista no existe
            die('La vista no existe: ' . $view);
        }
    }
}
