<?php
// app/config/config.php

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'fami123.');
define('DB_NAME', 'sistema_inspeccion');

// Raíz de la App
define('APPROOT', dirname(__DIR__));

// URL Root - Detectar automáticamente y corregir duplicación
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$directory = dirname($scriptName);

// Construir URL automáticamente
$urlRoot = $protocol . '://' . $host . $directory;

// Definir URLROOT
define('URLROOT', $urlRoot);

// Nombre del sitio
define('SITENAME', 'Sistema de Inspección');

// Zona horaria
date_default_timezone_set('America/Mexico_City');