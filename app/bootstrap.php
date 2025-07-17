<?php
// app/bootstrap.php

// Cargar configuración
require_once 'config/config.php';

// Cargar Helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Autocargar las clases del core
// Esta función carga automáticamente las clases del directorio 'core' cuando se necesitan.
spl_autoload_register(function($className) {
    // __DIR__ es la ruta del directorio actual ('app').
    // Construimos la ruta al archivo de la clase dentro de la carpeta 'core'.
    $file = __DIR__ . '/core/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Iniciar sesión de forma segura (solo si no hay una activa)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
