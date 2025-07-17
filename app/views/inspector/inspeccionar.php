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
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
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
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.6s ease-out forwards;
    }
    
    .animate-pulse-subtle {
        animation: pulse 3s infinite;
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
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
    .delay-600 { animation-delay: 0.6s; }
    
    .partida-card {
        transition: all 0.3s ease;
    }
    
    .partida-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
</style>

<body class="min-h-screen" style="background: linear-gradient(135deg, #EEEEEE 0%, #f8f9fa 100%);">
    <!-- Top Bar con gradiente y mejor diseño -->
    <div class="shadow-2xl shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-slide-in-left">
                <div class="w-12 h-12 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #DC2032;">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Inspeccionando Solicitud</h1>
                    <p class="text-gray-300 text-lg">#<?php echo $data['solicitud']->id; ?></p>
                </div>
            </div>
            <div class="flex items-center space-x-4 animate-slide-in-right">
                <a href="<?php echo URLROOT; ?>/inspector" 
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
        
        <!-- Información General -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10 border border-gray-100 animate-fade-in-up delay-100">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                    <i class="fas fa-info-circle text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Información General</h2>
                    <p class="text-gray-600">Detalles de la solicitud de inspección</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-file-alt text-2xl mr-3" style="color: #DC2032;"></i>
                        <h3 class="font-bold text-gray-700">Orden Trabajo</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->orden_trabajo); ?></p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-tie text-2xl mr-3" style="color: #C73659;"></i>
                        <h3 class="font-bold text-gray-700">Supervisor</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($data['solicitud']->nombre_supervisor); ?></p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-check text-2xl mr-3" style="color: #151515;"></i>
                        <h3 class="font-bold text-gray-700">Llegada Inspector</h3>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg">
                        <?php echo $data['solicitud']->fecha_llegada_inspector ? date('d/m/Y H:i', strtotime($data['solicitud']->fecha_llegada_inspector)) : '<span class="italic text-gray-500">No registrada</span>'; ?>
                    </p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-info-circle text-2xl mr-3" style="color: #DC2032;"></i>
                        <h3 class="font-bold text-gray-700">Estado</h3>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105
                        <?php if ($data['solicitud']->estado == 'Tomada'): ?>
                            bg-blue-100 text-blue-800 border border-blue-200
                        <?php elseif ($data['solicitud']->estado == 'Completada'): ?>
                            bg-green-100 text-green-800 border border-green-200
                        <?php endif; ?>
                    ">
                        <?php if ($data['solicitud']->estado == 'Tomada'): ?>
                            <i class="fas fa-clock mr-2"></i>
                        <?php elseif ($data['solicitud']->estado == 'Completada'): ?>
                            <i class="fas fa-check-circle mr-2"></i>
                        <?php endif; ?>
                        <?php echo htmlspecialchars($data['solicitud']->estado); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Partidas -->
        <div class="space-y-8">
            <div class="text-center animate-fade-in-up delay-200">
                <h2 class="text-4xl font-light text-gray-700 mb-2">Partidas de Inspección</h2>
                <p class="text-gray-500">Gestiona cada partida individualmente</p>
            </div>
            
            <?php foreach($data['partidas'] as $index => $partida): ?>
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 partida-card animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                <div class="flex flex-col lg:flex-row justify-between items-start">
                    <div class="flex-1">
                        <!-- Header de la partida -->
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 text-white font-bold text-lg" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                                <?php echo $index + 1; ?>
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-gray-800">Marca: <?php echo htmlspecialchars($partida->marca); ?></h3>
                                <p class="text-gray-600 text-lg mt-1"><?php echo htmlspecialchars($partida->descripcion); ?></p>
                            </div>
                        </div>
                        
                        <!-- Detalles de la partida -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-drafting-compass text-lg mr-2" style="color: #DC2032;"></i>
                                    <span class="font-bold text-gray-700">No. Dibujo</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->numero_dibujo); ?></p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-code-branch text-lg mr-2" style="color: #C73659;"></i>
                                    <span class="font-bold text-gray-700">Revisión</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->revision); ?></p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-calculator text-lg mr-2" style="color: #151515;"></i>
                                    <span class="font-bold text-gray-700">Cantidad</span>
                                </div>
                                <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($partida->cantidad); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Control de estado -->
                    <?php if($data['solicitud']->estado != 'Completada'): ?>
                    <div class="mt-6 lg:mt-0 lg:ml-8 flex-shrink-0">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                            <h4 class="font-bold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-cog mr-2" style="color: #DC2032;"></i>
                                Control de Estado
                            </h4>
                            <form action="<?php echo URLROOT; ?>/inspector/actualizarPartida/<?php echo $partida->id; ?>" method="POST" class="space-y-4">
                                <input type="hidden" name="id_solicitud" value="<?php echo $data['solicitud']->id; ?>">
                                <select name="estado" class="w-full border-gray-300 rounded-xl shadow-sm p-3 transition-all duration-300 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="Pendiente" <?php if($partida->estado == 'Pendiente') echo 'selected'; ?>>🔄 Pendiente</option>
                                    <option value="Completada" <?php if($partida->estado == 'Completada') echo 'selected'; ?>>✅ Completada</option>
                                    <option value="Rechazada" <?php if($partida->estado == 'Rechazada') echo 'selected'; ?>>❌ Rechazada</option>
                                </select>
                                <button type="submit" class="w-full px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center"
                                        style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                                    <i class="fas fa-save mr-2"></i>Guardar Estado
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <?php flash('partida_mensaje_' . $partida->id); ?>

                <!-- Observaciones -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-clipboard-list text-2xl mr-3" style="color: #DC2032;"></i>
                        <h4 class="font-bold text-xl text-gray-700">Observaciones y Evidencias</h4>
                    </div>
                    
                    <?php if($data['solicitud']->estado != 'Completada'): ?>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 mb-6">
                        <form action="<?php echo URLROOT; ?>/inspector/agregarObservacion/<?php echo $partida->id; ?>" method="POST" class="space-y-4">
                            <input type="hidden" name="id_solicitud" value="<?php echo $data['solicitud']->id; ?>">
                            <textarea name="texto_observacion" rows="3" 
                                      class="w-full border-gray-300 rounded-xl shadow-sm p-4 transition-all duration-300 focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                      placeholder="✍️ Añadir una nueva observación..."></textarea>
                            <button type="submit" class="px-8 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center"
                                    style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                                <i class="fas fa-plus mr-2"></i>Agregar Observación
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Lista de observaciones -->
                    <div class="space-y-4">
                        <?php if(empty($partida->observaciones)): ?>
                            <div class="text-center py-12">
                                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-subtle" style="background-color: #EEEEEE;">
                                    <i class="fas fa-comment-slash text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 text-lg">No hay observaciones para esta partida</p>
                                <p class="text-sm text-gray-400">Las observaciones aparecerán aquí cuando sean agregadas</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($partida->observaciones as $obsIndex => $obs): ?>
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-2xl border border-gray-200 transition-all duration-300 hover:shadow-lg hover:scale-102 animate-fade-in-up" style="animation-delay: <?php echo ($obsIndex * 0.1 + 0.1); ?>s;">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0" style="background: linear-gradient(135deg, #C73659 0%, #DC2032 100%);">
                                            <?php echo $obsIndex + 1; ?>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-gray-800 text-lg leading-relaxed"><?php echo htmlspecialchars($obs->texto_observacion); ?></p>
                                            <div class="flex items-center mt-3 text-sm text-gray-500">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span><?php echo date('d/m/Y H:i', strtotime($obs->fecha_creacion)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Botón de Terminar Inspección -->
        <?php if($data['solicitud']->estado != 'Completada'): ?>
        <div class="mt-12 text-center animate-fade-in-up delay-600">
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 max-w-md mx-auto">
                <div class="mb-6">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-subtle" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                        <i class="fas fa-flag-checkered text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">¿Finalizar Inspección?</h3>
                    <p class="text-gray-600">Una vez terminada, no podrás realizar más cambios</p>
                </div>
                
                <form action="<?php echo URLROOT; ?>/inspector/terminar/<?php echo $data['solicitud']->id; ?>" method="POST" 
                      onsubmit="return confirm('¿Estás seguro de que deseas terminar y cerrar esta inspección? No podrás realizar más cambios.');">
                    <button type="submit" class="w-full px-12 py-6 rounded-2xl text-white font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                        <i class="fas fa-check-circle mr-3 text-2xl"></i>
                        Terminar Inspección
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>