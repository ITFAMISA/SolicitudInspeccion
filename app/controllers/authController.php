<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    private $userModel;

    public function __construct(){
        $this->userModel = $this->model('Usuario');
    }

    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function login(){
        // Si ya está logueado, redirigir al dashboard correspondiente.
        if(isLoggedIn()){
            redirect($_SESSION['rol'] . '/index');
        }

        // MEJORA: Unificar la inicialización de $data para evitar duplicación.
        // Ahora el array de 'errors' es consistente con el de register.
        $data = [
            'nombre_usuario' => '',
            'password' => '',
            'errors' => [
                'nombre_usuario_err' => '',
                'password_err' => '',
                'general_err' => '' // Para errores de credenciales
            ]
        ];

        // Procesar el formulario solo si es una petición POST.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitizar los datos del formulario.
            // NOTA: FILTER_SANITIZE_STRING está obsoleto en PHP 8.
            // Es mejor usar htmlspecialchars al mostrar datos en la vista.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $data['nombre_usuario'] = trim($_POST['nombre_usuario']);
            $data['password'] = trim($_POST['password']);

            // --- MEJORA: Validación específica por campo ---

            // Validar nombre de usuario
            if(empty($data['nombre_usuario'])){
                $data['errors']['nombre_usuario_err'] = 'Por favor, ingresa tu nombre de usuario.';
            }

            // Validar contraseña
            if(empty($data['password'])){
                $data['errors']['password_err'] = 'Por favor, ingresa tu contraseña.';
            }
            
            // Si no hay errores de validación inicial, intentar el login.
            if(empty($data['errors']['nombre_usuario_err']) && empty($data['errors']['password_err'])){
                $loggedInUser = $this->userModel->login($data['nombre_usuario'], $data['password']);

                if($loggedInUser){
                    // Si el login es exitoso, crear la sesión.
                    $this->createUserSession($loggedInUser);
                } else {
                    // MEJORA: Error general para credenciales incorrectas.
                    $data['errors']['general_err'] = 'Usuario o contraseña incorrectos.';
                    $this->view('auth/login', $data);
                }
            } else {
                // Si hay errores de validación, mostrar la vista con los errores.
                $this->view('auth/login', $data);
            }

        } else {
            // Si no es POST, simplemente mostrar el formulario de login con datos vacíos.
            $this->view('auth/login', $data);
        }
    }
    
    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function register(){
        // Si ya está logueado, redirigir.
        if(isLoggedIn()){
            redirect($_SESSION['rol'] . '/index');
        }

        // MEJORA: Estructura de datos consistente.
        $data = [
            'nombre_usuario' => '',
            'nombre_completo' => '',
            'password' => '',
            'confirm_password' => '',
            'rol' => '',
            'errors' => [
                'nombre_usuario_err' => '',
                'nombre_completo_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'rol_err' => ''
            ]
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitizar POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $data['nombre_usuario'] = trim($_POST['nombre_usuario']);
            $data['nombre_completo'] = trim($_POST['nombre_completo']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);
            $data['rol'] = trim($_POST['rol']);

            // --- Validaciones (tu lógica aquí es muy buena, la mantenemos) ---

            // Validar nombre de usuario
            if(empty($data['nombre_usuario'])){
                $data['errors']['nombre_usuario_err'] = 'Por favor ingrese un nombre de usuario.';
            } elseif(strlen($data['nombre_usuario']) < 3){
                $data['errors']['nombre_usuario_err'] = 'El nombre de usuario debe tener al menos 3 caracteres.';
            } elseif(!$this->userModel->isUsernameAvailable($data['nombre_usuario'])){
                $data['errors']['nombre_usuario_err'] = 'Este nombre de usuario ya está en uso.';
            }

            // Validar nombre completo
            if(empty($data['nombre_completo'])){
                $data['errors']['nombre_completo_err'] = 'Por favor ingrese su nombre completo.';
            }

            // Validar password
            if(empty($data['password'])){
                $data['errors']['password_err'] = 'Por favor ingrese una contraseña.';
            } elseif(strlen($data['password']) < 6){
                $data['errors']['password_err'] = 'La contraseña debe tener al menos 6 caracteres.';
            }

            // Validar confirmación de password
            if(empty($data['confirm_password'])){
                $data['errors']['confirm_password_err'] = 'Por favor confirme la contraseña.';
            } elseif($data['password'] != $data['confirm_password']){
                $data['errors']['confirm_password_err'] = 'Las contraseñas no coinciden.';
            }

            // Validar rol
            $roles_permitidos = ['supervisor', 'inspector'];
            if(empty($data['rol']) || !in_array($data['rol'], $roles_permitidos)){
                $data['errors']['rol_err'] = 'Por favor seleccione un rol válido.';
            }

            // MEJORA: Una forma más limpia de comprobar si hay errores.
            $hasErrors = false;
            foreach($data['errors'] as $error){
                if(!empty($error)){
                    $hasErrors = true;
                    break;
                }
            }

            if(!$hasErrors){
                // Hash de la contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                // Registrar usuario
                if($this->userModel->register($data)){
                    flash('register_success', 'Registro exitoso. Ya puedes iniciar sesión.');
                    redirect('auth/login');
                } else {
                    // MEJORA: Manejo de error de base de datos más elegante.
                    // En lugar de 'die()', podrías añadir un error general y recargar.
                    flash('register_fail', 'Algo salió mal durante el registro. Por favor, inténtalo de nuevo.', 'bg-red-500/20 text-red-300');
                    $this->view('auth/register', $data);
                }
            } else {
                // Cargar vista con errores
                $this->view('auth/register', $data);
            }
        } else {
            // Cargar vista con el formulario vacío
            $this->view('auth/register', $data);
        }
    }

    /**
     * Crea la sesión del usuario y redirige.
     */
    public function createUserSession($user){
        $_SESSION['usuario_id'] = $user->id;
        $_SESSION['nombre_usuario'] = $user->nombre_usuario;
        $_SESSION['nombre_completo'] = $user->nombre_completo;
        $_SESSION['rol'] = $user->rol;
        redirect($user->rol . '/index');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['nombre_usuario']);
        unset($_SESSION['nombre_completo']);
        unset($_SESSION['rol']);
        session_destroy();
        redirect('auth/login');
    }
}
