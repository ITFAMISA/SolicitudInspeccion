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
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.5s ease-out forwards;
    }
    
    .animate-pulse-subtle {
        animation: pulse 2s infinite;
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
</style>

<body class="min-h-screen" style="background: linear-gradient(135deg, #EEEEEE 0%, #f8f9fa 100%);">
    <!-- Top Bar con gradiente y mejor diseño -->
    <div class="shadow-2xl shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-slide-in-left">
                <div class="w-10 h-10 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #DC2032;">
                    <i class="fas fa-clipboard-check text-white text-lg"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">Mis Inspecciones Asignadas</h1>
            </div>
            <div class="flex items-center space-x-4 animate-slide-in-left delay-200">
                <div class="text-right">
                    <span class="block text-sm text-gray-300">Bienvenido,</span>
                    <span class="block text-lg font-semibold text-white"><?php echo $_SESSION['nombre_completo']; ?></span>
                </div>
                <a href="<?php echo URLROOT; ?>/auth/logout" 
                   class="px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl hover:rotate-1"
                   style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%); hover:background: linear-gradient(135deg, #C73659 0%, #DC2032 100%);">
                    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-6 py-10">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8 animate-fade-in-up delay-100">
            <div>
                <h2 class="text-4xl font-light text-gray-700 mb-2">Dashboard Inspector</h2>
                <p class="text-gray-500">Gestiona tus inspecciones asignadas</p>
            </div>
            <a href="<?php echo URLROOT; ?>/inspector/disponibles" 
               class="px-8 py-4 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center hover:-translate-y-1"
               style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                <i class="fas fa-search mr-3 text-lg transition-transform duration-300 hover:rotate-12"></i>
                <span>Ver Solicitudes Disponibles</span>
            </a>
        </div>
        
        <!-- Flash Messages -->
        <?php flash('solicitud_mensaje'); ?>
        <?php flash('solicitud_error'); ?>

        <!-- Tabla mejorada -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 animate-fade-in-up delay-200">
            <!-- Header de la tabla -->
            <div class="px-8 py-6 shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-list-alt mr-3 transition-transform duration-300 hover:scale-110"></i>
                    Inspecciones Asignadas
                </h3>
            </div>

            <!-- Contenido de la tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead style="background-color: #EEEEEE;">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    ID
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Orden Trabajo
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-user-tie mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Supervisor
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Fecha Aceptada
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Estado
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-cogs mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Acciones
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php if (empty($data['solicitudes'])): ?>
                            <tr class="animate-fade-in-up delay-300">
                                <td colspan="6" class="text-center py-16">
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="w-20 h-20 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #EEEEEE;">
                                            <i class="fas fa-clipboard-list text-4xl text-gray-400"></i>
                                        </div>
                                        <div class="text-center">
                                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Sin inspecciones asignadas</h3>
                                            <p class="text-gray-500">No tienes inspecciones asignadas actualmente.</p>
                                            <p class="text-sm text-gray-400">Revisa las solicitudes disponibles para tomar una nueva inspección.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['solicitudes'] as $index => $solicitud): ?>
                            <tr class="hover:bg-gray-50 transition-all duration-300 hover:shadow-md animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white transition-all duration-300 hover:scale-110 animate-pulse-subtle" style="background-color: #DC2032;">
                                            <?php echo $solicitud->id; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-semibold text-gray-800 transition-colors duration-300 hover:text-gray-600"><?php echo htmlspecialchars($solicitud->orden_trabajo); ?></div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white mr-3 transition-all duration-300 hover:scale-110" style="background-color: #C73659;">
                                            <?php echo strtoupper(substr($solicitud->nombre_supervisor, 0, 1)); ?>
                                        </div>
                                        <span class="font-medium text-gray-800 transition-colors duration-300 hover:text-gray-600"><?php echo htmlspecialchars($solicitud->nombre_supervisor); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm font-medium text-gray-800 transition-colors duration-300 hover:text-gray-600">
                                        <?php echo date('d/m/Y', strtotime($solicitud->fecha_aceptada)); ?>
                                    </div>
                                    <div class="text-xs text-gray-500 transition-colors duration-300 hover:text-gray-400">
                                        <?php echo date('H:i', strtotime($solicitud->fecha_aceptada)); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105
                                        <?php if ($solicitud->estado == 'Tomada'): ?>
                                            bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200
                                        <?php elseif ($solicitud->estado == 'Completada'): ?>
                                            bg-green-100 text-green-800 border border-green-200 hover:bg-green-200
                                        <?php endif; ?>
                                    ">
                                        <?php if ($solicitud->estado == 'Tomada'): ?>
                                            <i class="fas fa-clock mr-2 transition-transform duration-300 hover:rotate-12"></i>
                                        <?php elseif ($solicitud->estado == 'Completada'): ?>
                                            <i class="fas fa-check-circle mr-2 transition-transform duration-300 hover:rotate-12"></i>
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($solicitud->estado); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <a href="<?php echo URLROOT; ?>/inspector/inspeccionar/<?php echo $solicitud->id; ?>" 
                                       class="inline-flex items-center px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl hover:-translate-y-1"
                                       style="background: linear-gradient(135deg, <?php echo ($solicitud->estado == 'Completada') ? '#C73659' : '#DC2032'; ?> 0%, <?php echo ($solicitud->estado == 'Completada') ? '#DC2032' : '#C73659'; ?> 100%);">
                                        <?php if ($solicitud->estado == 'Completada'): ?>
                                            <i class="fas fa-eye mr-2 transition-transform duration-300 hover:scale-110"></i>
                                            Ver Reporte
                                        <?php else: ?>
                                            <i class="fas fa-search mr-2 transition-transform duration-300 hover:scale-110"></i>
                                            Inspeccionar
                                        <?php endif; ?>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>