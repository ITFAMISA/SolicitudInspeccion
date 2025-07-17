<?php
// insertar_usuarios.php - Script para insertar usuarios de prueba
// Ejecutar una sola vez desde el navegador o línea de comandos

// Incluir la configuración
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

// Crear conexión a la base de datos
$db = new Database();

// Usuarios a insertar
$usuarios = [
    [
        'nombre_usuario' => 'supervisortest',
        'password' => 'password',
        'nombre_completo' => 'Supervisor de Prueba',
        'rol' => 'supervisor'
    ],
    [
        'nombre_usuario' => 'inspectortest', 
        'password' => 'password',
        'nombre_completo' => 'Inspector de Prueba',
        'rol' => 'inspector'
    ],
    [
        'nombre_usuario' => 'admintest',
        'password' => 'password', 
        'nombre_completo' => 'Administrador de Prueba',
        'rol' => 'admin'
    ]
];

echo "<h2>Insertando usuarios de prueba...</h2>";

foreach ($usuarios as $usuario) {
    try {
        // Verificar si el usuario ya existe
        $db->query('SELECT id FROM usuarios WHERE nombre_usuario = :nombre_usuario');
        $db->bind(':nombre_usuario', $usuario['nombre_usuario']);
        $usuarioExistente = $db->single();
        
        if ($usuarioExistente) {
            echo "⚠️  El usuario '{$usuario['nombre_usuario']}' ya existe. Saltando...<br>";
            continue;
        }
        
        // Hashear la contraseña
        $passwordHash = password_hash($usuario['password'], PASSWORD_DEFAULT);
        
        // Insertar el usuario
        $db->query('INSERT INTO usuarios (nombre_usuario, password, nombre_completo, rol) VALUES (:nombre_usuario, :password, :nombre_completo, :rol)');
        $db->bind(':nombre_usuario', $usuario['nombre_usuario']);
        $db->bind(':password', $passwordHash);
        $db->bind(':nombre_completo', $usuario['nombre_completo']);
        $db->bind(':rol', $usuario['rol']);
        
        if ($db->execute()) {
            echo "✅ Usuario '{$usuario['nombre_usuario']}' insertado correctamente (Rol: {$usuario['rol']})<br>";
        } else {
            echo "❌ Error al insertar usuario '{$usuario['nombre_usuario']}'<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Error con usuario '{$usuario['nombre_usuario']}': " . $e->getMessage() . "<br>";
    }
}

echo "<br><h3>Usuarios disponibles para login:</h3>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Usuario</th><th>Contraseña</th><th>Rol</th></tr>";

foreach ($usuarios as $usuario) {
    echo "<tr>";
    echo "<td><strong>{$usuario['nombre_usuario']}</strong></td>";
    echo "<td>{$usuario['password']}</td>";
    echo "<td>{$usuario['rol']}</td>";
    echo "</tr>";
}

echo "</table>";

echo "<br><p><strong>¡Usuarios creados exitosamente!</strong></p>";
echo "<p>Puedes acceder al sistema en: <a href='" . URLROOT . "/auth/login'>" . URLROOT . "/auth/login</a></p>";

echo "<br><p style='color: red;'><strong>IMPORTANTE:</strong> Elimina este archivo después de usarlo por seguridad.</p>";
?>