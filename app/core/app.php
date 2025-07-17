<?php
/*
 * app/core/App.php - Router Principal
 * Mapea la URL a controlador, método y parámetros.
 * Formato URL - /controller/method/params
 */
class App {
    protected $currentController = 'PagesController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getUrl();

        // Buscar en controllers el primer valor de la URL
        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')){
            // Si existe, se establece como controlador actual
            $this->currentController = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        // Requerir el controlador
        require_once '../app/controllers/'. $this->currentController . '.php';
        // Instanciar el controlador
        $this->currentController = new $this->currentController;

        // Verificar el método (segunda parte de la url)
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Obtener los parámetros
        $this->params = $url ? array_values($url) : [];

        // Llamar al método con los parámetros
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
