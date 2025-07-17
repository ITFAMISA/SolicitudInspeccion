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
    
    @keyframes slideInFromBottom {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
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
    
    .animate-slide-in-bottom {
        animation: slideInFromBottom 0.5s ease-out forwards;
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
    
    .partida-item {
        transition: all 0.3s ease;
    }
    
    .partida-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .form-input {
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 32, 50, 0.15);
    }
    
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(220, 32, 50, 0.3);
    }
    
    .btn-secondary {
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(21, 21, 21, 0.2);
    }
</style>

<body class="min-h-screen" style="background: linear-gradient(135deg, #EEEEEE 0%, #f8f9fa 100%);">
    <!-- Top Bar con gradiente y mejor diseño -->
    <div class="shadow-2xl shimmer-effect" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-slide-in-left">
                <div class="w-12 h-12 rounded-full flex items-center justify-center animate-pulse-subtle" style="background-color: #DC2032;">
                    <i class="fas fa-plus-circle text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Nueva Solicitud de Inspección</h1>
                    <p class="text-gray-300 text-lg">Crea una nueva solicitud paso a paso</p>
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
        <form action="<?php echo URLROOT; ?>/supervisor/crear" method="POST" class="max-w-7xl mx-auto">
            
            <!-- Sección de Datos Generales -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10 border border-gray-100 animate-fade-in-up delay-100">
                <div class="flex items-center mb-8">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                        <i class="fas fa-info-circle text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Datos Generales</h2>
                        <p class="text-gray-600">Información básica de la solicitud</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="form-group">
                        <label for="orden_trabajo" class="block text-gray-700 font-semibold mb-3 flex items-center">
                            <i class="fas fa-file-alt mr-2" style="color: #DC2032;"></i>
                            Orden de Trabajo
                        </label>
                        <input type="text" name="orden_trabajo" id="orden_trabajo" 
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-4 form-input" 
                               placeholder="Ingrese la orden de trabajo"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cliente" class="block text-gray-700 font-semibold mb-3 flex items-center">
                            <i class="fas fa-building mr-2" style="color: #C73659;"></i>
                            Cliente
                        </label>
                        <input type="text" name="cliente" id="cliente" 
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-4 form-input" 
                               placeholder="Nombre del cliente"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="proyecto" class="block text-gray-700 font-semibold mb-3 flex items-center">
                            <i class="fas fa-project-diagram mr-2" style="color: #151515;"></i>
                            Proyecto
                        </label>
                        <input type="text" name="proyecto" id="proyecto" 
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-4 form-input" 
                               placeholder="Nombre del proyecto"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="area_proceso" class="block text-gray-700 font-semibold mb-3 flex items-center">
                            <i class="fas fa-cogs mr-2" style="color: #DC2032;"></i>
                            Área o Proceso
                        </label>
                        <input type="text" name="area_proceso" id="area_proceso" 
                               class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-4 form-input" 
                               placeholder="Área o proceso específico"
                               required>
                    </div>
                </div>
            </div>

            <!-- Sección de Partidas -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10 border border-gray-100 animate-fade-in-up delay-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mr-4 animate-float" style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                            <i class="fas fa-list-ul text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">Partidas a Inspeccionar</h2>
                            <p class="text-gray-600">Agrega las partidas que necesitan inspección</p>
                        </div>
                    </div>
                    <button type="button" id="add-partida" 
                            class="px-8 py-4 rounded-xl text-white font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center btn-secondary"
                            style="background: linear-gradient(135deg, #151515 0%, #2d1b1b 100%);">
                        <i class="fas fa-plus mr-3 text-lg transition-transform duration-300 hover:rotate-90"></i>
                        Agregar Partida
                    </button>
                </div>
                
                <div id="partidas-container" class="space-y-6">
                    <!-- Las partidas se agregarán aquí con JS -->
                </div>
            </div>

            <!-- Botón de Guardar -->
            <div class="animate-fade-in-up delay-400">
                <div class="bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 animate-pulse-subtle" style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                                <i class="fas fa-save text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">¿Guardar Solicitud?</h3>
                                <p class="text-sm text-gray-600">La solicitud estará disponible para los inspectores</p>
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="px-8 py-3 rounded-xl text-white font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center btn-primary"
                                style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                            <i class="fas fa-check-circle mr-2"></i>
                            Guardar Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('partidas-container');
            const addButton = document.getElementById('add-partida');
            let partidaIndex = 0;

            function addPartida() {
                partidaIndex = Date.now();
                const partidaHTML = `
                    <div class="partida-item bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-3xl border border-gray-200 relative animate-slide-in-bottom">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 text-white font-bold text-lg" style="background: linear-gradient(135deg, #C73659 0%, #DC2032 100%);">
                                    ${container.children.length + 1}
                                </div>
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Nueva Partida</h3>
                                    <p class="text-gray-600">Completa la información de la partida</p>
                                </div>
                            </div>
                            <button type="button" class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold remove-partida transition-all duration-300 hover:scale-110 hover:rotate-90" 
                                    style="background: linear-gradient(135deg, #DC2032 0%, #C73659 100%);">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-drafting-compass mr-2" style="color: #DC2032;"></i>
                                    No. Dibujo
                                </label>
                                <input type="text" name="partidas[${partidaIndex}][numero_dibujo]" 
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 form-input" 
                                       placeholder="Número de dibujo"
                                       required>
                            </div>
                            
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-code-branch mr-2" style="color: #C73659;"></i>
                                    Revisión
                                </label>
                                <input type="text" name="partidas[${partidaIndex}][revision]" 
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 form-input" 
                                       placeholder="Revisión"
                                       required>
                            </div>
                            
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-tag mr-2" style="color: #151515;"></i>
                                    Marca
                                </label>
                                <input type="text" name="partidas[${partidaIndex}][marca]" 
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 form-input" 
                                       placeholder="Marca"
                                       required>
                            </div>
                            
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-calculator mr-2" style="color: #DC2032;"></i>
                                    Cantidad
                                </label>
                                <input type="number" name="partidas[${partidaIndex}][cantidad]" 
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 form-input" 
                                       placeholder="Cantidad"
                                       min="1"
                                       required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-align-left mr-2" style="color: #C73659;"></i>
                                Descripción
                            </label>
                            <textarea name="partidas[${partidaIndex}][descripcion]" rows="3" 
                                      class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 form-input" 
                                      placeholder="Descripción detallada de la partida..."
                                      required></textarea>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', partidaHTML);
                
                // Animar la entrada del nuevo elemento
                const newPartida = container.lastElementChild;
                newPartida.style.opacity = '0';
                newPartida.style.transform = 'translateY(20px)';
                
                requestAnimationFrame(() => {
                    newPartida.style.transition = 'all 0.5s ease-out';
                    newPartida.style.opacity = '1';
                    newPartida.style.transform = 'translateY(0)';
                });
            }

            // Agregar la primera partida al cargar la página
            addPartida();

            addButton.addEventListener('click', function() {
                addPartida();
                // Scroll suave hacia la nueva partida
                setTimeout(() => {
                    const newPartida = container.lastElementChild;
                    newPartida.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            });

            // Delegación de eventos para el botón de eliminar
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-partida') || e.target.closest('.remove-partida')) {
                    const partidaItem = e.target.closest('.partida-item');
                    
                    // Animación de salida
                    partidaItem.style.transition = 'all 0.3s ease-out';
                    partidaItem.style.opacity = '0';
                    partidaItem.style.transform = 'translateY(-20px)';
                    
                    setTimeout(() => {
                        partidaItem.remove();
                        updatePartidaNumbers();
                    }, 300);
                }
            });
            
            // Función para actualizar los números de las partidas
            function updatePartidaNumbers() {
                const partidas = container.querySelectorAll('.partida-item');
                partidas.forEach((partida, index) => {
                    const numberCircle = partida.querySelector('.w-12.h-12');
                    if (numberCircle) {
                        numberCircle.textContent = index + 1;
                    }
                });
            }
        });
    </script>

<?php require APPROOT . '/views/includes/footer.php'; ?>