<?php require APPROOT . '/views/includes/header.php'; ?>
<style>
    /* Animaciones sutiles personalizadas */
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
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    @keyframes float {
        0%, 100% {
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
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        background-size: 200px 100%;
        animation: shimmer 2s infinite;
    }
    
    /* Animaciones de delay para elementos */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    
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
    
    .error-shake {
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
</style>

<body class="min-h-screen flex items-center justify-center relative overflow-hidden" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 30%, #1a1a1a 70%, #151515 100%);">
    
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 rounded-full animate-float" style="background: radial-gradient(circle, rgba(220, 32, 50, 0.1) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full animate-float delay-200" style="background: radial-gradient(circle, rgba(199, 54, 89, 0.1) 0%, transparent 70%);"></div>
        <div class="absolute top-20 left-20 w-64 h-64 rounded-full animate-pulse-subtle" style="background: radial-gradient(circle, rgba(238, 238, 238, 0.05) 0%, transparent 70%);"></div>
    </div>
    
    <!-- Partículas flotantes -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 rounded-full animate-float delay-100" style="background-color: #DC2032; opacity: 0.3;"></div>
        <div class="absolute top-3/4 right-1/4 w-1 h-1 rounded-full animate-float delay-300" style="background-color: #C73659; opacity: 0.4;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-1.5 h-1.5 rounded-full animate-float delay-500" style="background-color: #EEEEEE; opacity: 0.2;"></div>
    </div>

    <!-- Contenedor principal del login -->
    <div class="relative z-10 w-full max-w-md mx-4">
        
        <!-- Logo y título -->
        <div class="text-center mb-8 animate-fade-in-up">
            <div class="w-24 h-24 rounded-full mx-auto mb-6 flex items-center justify-center animate-pulse-subtle shimmer-effect" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                <i class="fas fa-shield-alt text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 animate-gradient" style="background: linear-gradient(45deg, #DC2032, #C73659, #EEEEEE, #DC2032); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                <?php echo SITENAME; ?>
            </h1>
            <p class="text-gray-300 text-lg">Sistema de Inspección de Calidad</p>
        </div>

        <!-- Formulario de login -->
        <div class="glass-effect p-8 rounded-3xl shadow-2xl animate-fade-in-up delay-200">
            
            <!-- Mensaje de error -->
            <?php if(!empty($data['error'])): ?>
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-6 py-4 rounded-2xl mb-6 error-shake animate-fade-in-up delay-300" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3 text-red-400"></i>
                        <p class="font-semibold"><?php echo $data['error']; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/auth/login" method="POST" class="space-y-6">
                
                <!-- Campo de usuario -->
                <div class="animate-slide-in-left delay-300">
                    <label for="nombre_usuario" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-user mr-2" style="color: #DC2032;"></i>
                        Nombre de Usuario
                    </label>
                    <input type="text" 
                           id="nombre_usuario" 
                           name="nombre_usuario" 
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input"
                           placeholder="Ingresa tu nombre de usuario"
                           value="<?php echo $data['nombre_usuario']; ?>" 
                           required>
                </div>
                
                <!-- Campo de contraseña -->
                <div class="animate-slide-in-left delay-400">
                    <label for="password" class="block text-gray-300 font-semibold mb-3 flex items-center">
                        <i class="fas fa-lock mr-2" style="color: #C73659;"></i>
                        Contraseña
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent form-input"
                           placeholder="Ingresa tu contraseña"
                           required>
                </div>
                
                <!-- Botón de login -->
                <div class="animate-fade-in-up delay-500">
                    <button type="submit" 
                            class="w-full py-4 px-6 rounded-xl text-white font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl login-button flex items-center justify-center"
                            style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                        <i class="fas fa-sign-in-alt mr-3 text-xl"></i>
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php require APPROOT . '/views/includes/footer.php'; ?>