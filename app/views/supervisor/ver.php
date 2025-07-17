<?php require APPROOT . '/views/includes/header.php'; ?>
<style>
    /* Animaciones sutiles personalizadas */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
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
    
    @keyframes shimmer {
        0% {
            background-position: -200px 0;
        }
        100% {
            background-position: 200px 0;
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.5s ease-out forwards;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.5s ease-out forwards;
    }
    
    .animate-pulse-subtle {
        animation: pulse 2s infinite;
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
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
    
    .partida-card {
        transition: all 0.3s ease;
    }
    
    .partida-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .info-card {
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
</style>

<body class="min-h-screen" style="background: linear-gradient(135deg, #EEEEEE 0%, #f8f9fa 100%);">
    <!-- Top Bar con gradiente y mejor diseño -->
    <div class="shadow-2xl shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-slide-in-left">
                <div class="w-12 h-12 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #DC2032;">
                    <i class="fas fa-file-medical text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Detalle de Solicitud</h1>
                    <p class="text-gray-300 text-lg">#<?php echo $data['solicitud']->id; ?></p>
                </div>
            </div>
            <div class="flex items-center space-x-4 animate-slide-in-right">
                <a href="<?php echo URLROOT; ?>/supervisor" 
                   class="px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #C73659 0%, #DC2032 100%);">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
                </a>
                <a href="<?php echo URLROOT; ?>/auth/logout" 
                   class="px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl hover:rotate-1"
                   style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-6 py-10">
        <!-- Flash Messages -->
        <?php flash('solicitud_mensaje'); ?>

        <!-- Botón de Llegada Inspector -->
        <?php if($data['solicitud']->estado == 'Tomada' && is_null($data['solicitud']->fecha_llegada_inspector)): ?>
        <div class="mb-8 animate-fade-in-up delay-100">
            <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-bounce" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="fas fa-user-check text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Inspector en Camino</h3>
                            <p class="text-gray-600">Confirma cuando el inspector haya llegado al sitio</p>
                        </div>
                    </div>
                    
                    <form action="<?php echo URLROOT; ?>/supervisor/llegadaInspector/<?php echo $data['solicitud']->id; ?>" method="POST">
                        <button type="submit" 
                                class="px-8 py-4 rounded-xl text-white font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center"
                                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="fas fa-user-check mr-3 text-lg"></i>
                            ¡Llegó el Inspector!
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Información General -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10 border border-gray-100 animate-fade-in-up delay-200">
            <div class="flex items-center mb-8">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                    <i class="fas fa-info-circle text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Información General</h2>
                    <p class="text-gray-600">Datos principales de la solicitud</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-file-alt text-2xl mr-3" style="color: #DC2032;"></i>
                        <h3 class="font-bold text-gray-700">Orden Trabajo</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->orden_trabajo); ?></p>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-building text-2xl mr-3" style="color: #C73659;"></i>
                        <h3 class="font-bold text-gray-700">Cliente</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->cliente); ?></p>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-project-diagram text-2xl mr-3" style="color: #151515;"></i>
                        <h3 class="font-bold text-gray-700">Proyecto</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->proyecto); ?></p>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-cogs text-2xl mr-3" style="color: #DC2032;"></i>
                        <h3 class="font-bold text-gray-700">Área/Proceso</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->area_proceso); ?></p>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-plus text-2xl mr-3" style="color: #C73659;"></i>
                        <h3 class="font-bold text-gray-700">Fecha Solicitud</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo date('d/m/Y', strtotime($data['solicitud']->fecha_solicitud)); ?></p>
                    <p class="text-gray-500 text-sm"><?php echo date('H:i', strtotime($data['solicitud']->fecha_solicitud)); ?></p>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-hard-hat text-2xl mr-3" style="color: #151515;"></i>
                        <h3 class="font-bold text-gray-700">Inspector Asignado</h3>
                    </div>
                    <?php if($data['solicitud']->nombre_inspector): ?>
                        <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->nombre_inspector); ?></p>
                    <?php else: ?>
                        <p class="text-gray-400 italic text-lg">Sin asignar</p>
                    <?php endif; ?>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-check text-2xl mr-3" style="color: #DC2032;"></i>
                        <h3 class="font-bold text-gray-700">Llegada Inspector</h3>
                    </div>
                    <?php if($data['solicitud']->fecha_llegada_inspector): ?>
                        <p class="text-gray-800 font-semibold text-lg"><?php echo date('d/m/Y', strtotime($data['solicitud']->fecha_llegada_inspector)); ?></p>
                        <p class="text-gray-500 text-sm"><?php echo date('H:i', strtotime($data['solicitud']->fecha_llegada_inspector)); ?></p>
                    <?php else: ?>
                        <p class="text-gray-400 italic text-lg">Pendiente</p>
                    <?php endif; ?>
                </div>
                
                <div class="info-card bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-flag-checkered text-2xl mr-3" style="color: #C73659;"></i>
                        <h3 class="font-bold text-gray-700">Término Inspección</h3>
                    </div>
                    <?php if($data['solicitud']->fecha_terminacion): ?>
                        <p class="text-gray-800 font-semibold text-lg"><?php echo date('d/m/Y', strtotime($data['solicitud']->fecha_terminacion)); ?></p>
                        <p class="text-gray-500 text-sm"><?php echo date('H:i', strtotime($data['solicitud']->fecha_terminacion)); ?></p>
                    <?php else: ?>
                        <p class="text-gray-400 italic text-lg">En proceso</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Partidas -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 animate-fade-in-up delay-300">
            <div class="flex items-center mb-8">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                    <i class="fas fa-list-ul text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Partidas de la Solicitud</h2>
                    <p class="text-gray-600">Detalle de cada partida y su estado</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <?php foreach($data['partidas'] as $index => $partida): ?>
                    <div class="partida-card bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-3xl border border-gray-200 animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.4); ?>s;">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 text-white font-bold text-lg" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                                    <?php echo $index + 1; ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Marca: <?php echo htmlspecialchars($partida->marca); ?></h3>
                                    <p class="text-gray-600 text-sm">Partida de inspección</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105
                                <?php if ($partida->estado == 'Pendiente'): ?>
                                    bg-yellow-100 text-yellow-800 border border-yellow-200
                                <?php elseif ($partida->estado == 'Completada'): ?>
                                    bg-green-100 text-green-800 border border-green-200
                                <?php elseif ($partida->estado == 'Rechazada'): ?>
                                    bg-red-100 text-red-800 border border-red-200
                                <?php endif; ?>
                            ">
                                <?php if ($partida->estado == 'Pendiente'): ?>
                                    <i class="fas fa-hourglass-half mr-2"></i>
                                <?php elseif ($partida->estado == 'Completada'): ?>
                                    <i class="fas fa-check-circle mr-2"></i>
                                <?php elseif ($partida->estado == 'Rechazada'): ?>
                                    <i class="fas fa-times-circle mr-2"></i>
                                <?php endif; ?>
                                <?php echo htmlspecialchars($partida->estado); ?>
                            </span>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-align-left mr-2" style="color: #DC2032;"></i>
                                Descripción
                            </h4>
                            <p class="text-gray-800 leading-relaxed"><?php echo htmlspecialchars($partida->descripcion); ?></p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-drafting-compass text-lg mr-2" style="color: #DC2032;"></i>
                                    <span class="font-bold text-gray-700">No. Dibujo</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->numero_dibujo); ?></p>
                            </div>
                            
                            <div class="bg-white p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-code-branch text-lg mr-2" style="color: #C73659;"></i>
                                    <span class="font-bold text-gray-700">Revisión</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->revision); ?></p>
                            </div>
                            
                            <div class="bg-white p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-calculator text-lg mr-2" style="color: #151515;"></i>
                                    <span class="font-bold text-gray-700">Cantidad</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->cantidad); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>