<?php
// app/controllers/AuthController.php
class AuthController extends Controller {
    private $userModel; // Declarar la propiedad explícitamente

    public function __construct(){
        $this->userModel = $this->model('Usuario');
    }

    public function login(){
        // Si ya está logueado, redirigir
        if(isLoggedIn()){
            redirect($_SESSION['rol'] . '/index');
        }

        // Procesar el formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'nombre_usuario' => trim($_POST['nombre_usuario']),
                'password' => trim($_POST['password']),
                'error' => ''
            ];

            // Validar
            if(empty($data['nombre_usuario']) || empty($data['password'])){
                $data['error'] = 'Por favor, complete todos los campos.';
                $this->view('auth/login', $data);
                return;
            }

            // Intentar login
            $loggedInUser = $this->userModel->login($data['nombre_usuario'], $data['password']);

            if($loggedInUser){
                // Crear sesión
                $this->createUserSession($loggedInUser);
            } else {
                $data['error'] = 'Usuario o contraseña incorrectos.';
                $this->view('auth/login', $data);
            }
        } else {
            // Mostrar formulario de login
            $data = [
                'nombre_usuario' => '',
                'password' => '',
                'error' => ''
            ];
            $this->view('auth/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['usuario_id'] = $user->id;
        $_SESSION['nombre_usuario'] = $user->nombre_usuario;
        $_SESSION['nombre_completo'] = $user->nombre_completo;
        $_SESSION['rol'] = $user->rol;
        redirect($user->rol . '/index');
    }

    public function logout(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['nombre_usuario']);
        unset($_SESSION['nombre_completo']);
        unset($_SESSION['rol']);
        session_destroy();
        redirect('auth/login');
    }
}