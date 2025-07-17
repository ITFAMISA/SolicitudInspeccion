<?php
// web/index.php - Front Controller de Producción

// Cargar el inicializador de la aplicación
require_once '../app/bootstrap.php';

// Iniciar el Core de la aplicación (Router)
$app = new App();