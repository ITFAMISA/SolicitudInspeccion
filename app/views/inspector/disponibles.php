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
    
    @keyframes glow {
        0%, 100% {
            box-shadow: 0 0 20px rgba(220, 32, 50, 0.3);
        }
        50% {
            box-shadow: 0 0 30px rgba(220, 32, 50, 0.6);
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
    
    .animate-glow {
        animation: glow 2s ease-in-out infinite;
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
    
    .solicitud-row {
        transition: all 0.3s ease;
    }
    
    .solicitud-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
</style>

<body class="min-h-screen" style="background: linear-gradient(135deg, #EEEEEE 0%, #f8f9fa 100%);">
    <!-- Top Bar con gradiente y mejor diseño -->
    <div class="shadow-2xl shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-slide-in-left">
                <div class="w-12 h-12 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #DC2032;">
                    <i class="fas fa-list-ul text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Solicitudes Disponibles</h1>
                    <p class="text-gray-300 text-lg">Selecciona una solicitud para inspeccionar</p>
                </div>
            </div>
            <div class="flex items-center space-x-4 animate-slide-in-right">
                <a href="<?php echo URLROOT; ?>/inspector" 
                   class="px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #C73659 0%, #DC2032 100%);">
                    <i class="fas fa-arrow-left mr-2"></i>Volver a mi Dashboard
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
        <!-- Header Section -->
        <div class="text-center mb-10 animate-fade-in-up delay-100">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                    <i class="fas fa-tasks text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-light text-gray-700">Solicitudes Pendientes</h2>
                    <p class="text-gray-500 text-lg">Elige una solicitud para comenzar la inspección</p>
                </div>
            </div>
        </div>

        <!-- Tabla mejorada -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 animate-fade-in-up delay-200">
            <!-- Header de la tabla -->
            <div class="px-8 py-6 shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-clipboard-list mr-3 transition-transform duration-300 hover:scale-110"></i>
                    Solicitudes Disponibles para Inspección
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
                                    <i class="fas fa-calendar-plus mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Fecha Solicitud
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 transition-colors duration-300 hover:bg-gray-200">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-hand-point-right mr-2 text-gray-500 transition-transform duration-300 hover:scale-110"></i>
                                    Acción
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php if (empty($data['solicitudes'])): ?>
                            <tr class="animate-fade-in-up delay-300">
                                <td colspan="5" class="text-center py-20">
                                    <div class="flex flex-col items-center space-y-6">
                                        <div class="w-24 h-24 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #EEEEEE;">
                                            <i class="fas fa-inbox text-5xl text-gray-400"></i>
                                        </div>
                                        <div class="text-center">
                                            <h3 class="text-2xl font-semibold text-gray-600 mb-3">No hay solicitudes pendientes</h3>
                                            <p class="text-gray-500 text-lg">No hay solicitudes disponibles para inspección en este momento.</p>
                                            <p class="text-sm text-gray-400 mt-2">Las nuevas solicitudes aparecerán aquí cuando estén disponibles.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['solicitudes'] as $index => $solicitud): ?>
                            <tr class="solicitud-row hover:bg-gray-50 transition-all duration-300 animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white transition-all duration-300 hover:scale-110 animate-pulse-subtle" style="background-color: #DC2032;">
                                            <?php echo $solicitud->id; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 transition-all duration-300 hover:scale-110" style="background-color: #EEEEEE;">
                                            <i class="fas fa-file-alt text-lg" style="color: #DC2032;"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800 text-lg transition-colors duration-300 hover:text-gray-600">
                                                <?php echo htmlspecialchars($solicitud->orden_trabajo); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">Orden de Trabajo</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white mr-3 transition-all duration-300 hover:scale-110" style="background-color: #C73659;">
                                            <?php echo strtoupper(substr($solicitud->nombre_supervisor, 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800 text-lg transition-colors duration-300 hover:text-gray-600">
                                                <?php echo htmlspecialchars($solicitud->nombre_supervisor); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">Supervisor Asignado</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 transition-all duration-300 hover:scale-110" style="background-color: #EEEEEE;">
                                            <i class="fas fa-calendar text-lg" style="color: #151515;"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-800 transition-colors duration-300 hover:text-gray-600">
                                                <?php echo date('d/m/Y', strtotime($solicitud->fecha_solicitud)); ?>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <?php echo date('H:i', strtotime($solicitud->fecha_solicitud)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <form action="<?php echo URLROOT; ?>/inspector/tomar/<?php echo $solicitud->id; ?>" method="POST">
                                        <button type="submit" class="inline-flex items-center px-8 py-4 rounded-2xl text-white font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl animate-glow text-lg"
                                                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); hover:background: linear-gradient(135deg, #20c997 0%, #28a745 100%);">
                                            <i class="fas fa-hand-paper mr-3 text-xl transition-transform duration-300 hover:rotate-12"></i>
                                            Tomar Solicitud
                                        </button>
                                    </form>
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