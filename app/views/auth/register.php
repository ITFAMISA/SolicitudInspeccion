<?php require APPROOT . '/views/includes/header.php'; ?>
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -200px 0;
        }

        100% {
            background-position: 200px 0;
        }
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
    }

    .animate-pulse-subtle {
        animation: pulse 3s infinite;
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        background-size: 200px 100%;
        animation: shimmer 2s infinite;
    }

    /* Animaciones de delay para elementos */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    .form-input {
        transition: all 0.3s ease;
    }

    .form-input:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(220, 32, 50, 0.2);
    }

    .login-button {
        transition: all 0.3s ease;
    }

    .login-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(220, 32, 50, 0.4);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Reutilizar estilos del login */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
    }

    .animate-pulse-subtle {
        animation: pulse 3s infinite;
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    .delay-600 {
        animation-delay: 0.6s;
    }

    .form-input {
        transition: all 0.3s ease;
    }

    .form-input:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(220, 32, 50, 0.2);
    }

    .register-button {
        transition: all 0.3s ease;
    }

    .register-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(220, 32, 50, 0.4);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

<body class="min-h-screen flex items-center justify-center relative py-12"
    style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 30%, #1a1a1a 70%, #151515 100%);">

    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 rounded-full animate-float"
            style="background: radial-gradient(circle, rgba(220, 32, 50, 0.1) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full animate-float delay-200"
            style="background: radial-gradient(circle, rgba(199, 54, 89, 0.1) 0%, transparent 70%);"></div>
    </div>

    <!-- Contenedor principal del registro -->
    <div class="relative z-10 w-full max-w-lg mx-4">

        <!-- Logo y título -->
        <div class="text-center mb-8 animate-fade-in-up">
            <div class="w-24 h-24 rounded-full mx-auto mb-6 flex items-center justify-center animate-pulse-subtle"
                style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                <i class="fas fa-user-plus text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Crea tu Cuenta</h1>
            <p class="text-gray-300 text-lg">Únete a la plataforma <?php echo SITENAME; ?></p>
        </div>

        <!-- Formulario de registro -->
        <div class="glass-effect p-8 rounded-3xl shadow-2xl animate-fade-in-up delay-200">

            <!-- MENSAJE DE ERROR (si falla el registro en la BD) -->
            <?php flash('register_fail'); ?>

            <form action="<?php echo URLROOT; ?>/auth/register" method="POST" class="space-y-6">

                <!-- Nombre Completo -->
                <div class="animate-slide-in-left delay-300">
                    <label for="nombre_completo" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-id-card mr-2" style="color: #DC2032;"></i>
                        Nombre Completo
                    </label>
                    <input type="text" id="nombre_completo" name="nombre_completo"
                        class="w-full bg-gray-800/50 border rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input <?php echo (!empty($data['errors']['nombre_completo_err'])) ? 'border-red-500' : 'border-gray-600'; ?>"
                        placeholder="Ej: Ana Sofía Paredes"
                        value="<?php echo htmlspecialchars($data['nombre_completo']); ?>" required>
                    <?php display_error($data['errors']['nombre_completo_err']); ?>
                </div>

                <!-- Nombre de Usuario -->
                <div class="animate-slide-in-left delay-400">
                    <label for="nombre_usuario" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-user mr-2" style="color: #C73659;"></i>
                        Nombre de Usuario
                    </label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario"
                        class="w-full bg-gray-800/50 border rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input <?php echo (!empty($data['errors']['nombre_usuario_err'])) ? 'border-red-500' : 'border-gray-600'; ?>"
                        placeholder="Ej: ana_sofia" value="<?php echo htmlspecialchars($data['nombre_usuario']); ?>"
                        required>
                    <?php display_error($data['errors']['nombre_usuario_err']); ?>
                </div>

                <!-- Rol -->
                <div class="animate-slide-in-left delay-500">
                    <label for="rol" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-user-tag mr-2" style="color: #EEEEEE;"></i>
                        Tipo de Usuario
                    </label>
                    <select name="rol" id="rol"
                        class="w-full bg-gray-800/50 border rounded-xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input <?php echo (!empty($data['errors']['rol_err'])) ? 'border-red-500' : 'border-gray-600'; ?>"
                        required>
                        <option value="">Selecciona tu rol...</option>
                        <option value="supervisor" <?php echo ($data['rol'] == 'supervisor') ? 'selected' : ''; ?>>👔
                            Supervisor</option>
                        <option value="inspector" <?php echo ($data['rol'] == 'inspector') ? 'selected' : ''; ?>>🔍
                            Inspector</option>
                    </select>
                    <?php display_error($data['errors']['rol_err']); ?>
                </div>

                <!-- Contraseña -->
                <div class="animate-slide-in-left delay-600">
                    <label for="password" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-lock mr-2" style="color: #DC2032;"></i>
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full bg-gray-800/50 border rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input <?php echo (!empty($data['errors']['password_err'])) ? 'border-red-500' : 'border-gray-600'; ?>"
                        placeholder="Mínimo 6 caracteres" required>
                    <?php display_error($data['errors']['password_err']); ?>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="animate-slide-in-left delay-700">
                    <label for="confirm_password" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-lock mr-2" style="color: #C73659;"></i>
                        Confirmar Contraseña
                    </label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full bg-gray-800/50 border rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input <?php echo (!empty($data['errors']['confirm_password_err'])) ? 'border-red-500' : 'border-gray-600'; ?>"
                        placeholder="Repite la contraseña" required>
                    <?php display_error($data['errors']['confirm_password_err']); ?>
                </div>

                <!-- Botón de registro -->
                <div class="animate-fade-in-up delay-800 pt-4">
                    <button type="submit"
                        class="w-full py-4 px-6 rounded-xl text-white font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl register-button flex items-center justify-center"
                        style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                        <i class="fas fa-user-plus mr-3 text-xl"></i>
                        Crear Cuenta
                    </button>
                </div>
            </form>

            <!-- Link al login -->
            <div class="text-center mt-8 animate-fade-in-up delay-900">
                <p class="text-gray-300">
                    ¿Ya tienes una cuenta?
                    <a href="<?php echo URLROOT; ?>/auth/login"
                        class="text-red-400 hover:text-red-300 font-semibold transition-colors duration-300">
                        Inicia sesión aquí
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
<?php
function display_error($error_message)
{
    if (!empty($error_message)) {
        echo '<p class="text-red-400 text-sm mt-2 animate-fade-in-up flex items-center"><i
        class="fas fa-exclamation-circle mr-2"></i>' . $error_message . '</p>';
    }
}
?>
<?php require APPROOT . '/views/includes/footer.php'; ?>