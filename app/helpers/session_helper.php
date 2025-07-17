<?php
// app/helpers/session_helper.php

// Función para mostrar mensajes flash
function flash($name = '', $message = '', $class = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash" role="alert"><p>'.$_SESSION[$name].'</p></div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

// Verificar si el usuario ha iniciado sesión
function isLoggedIn(){
    return isset($_SESSION['usuario_id']);
}

// Verificar rol de usuario
function checkRole($rol){
    return isset($_SESSION['rol']) && $_SESSION['rol'] === $rol;
}
