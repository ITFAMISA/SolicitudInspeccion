<?php require APPROOT . '/views/includes/header.php'; ?>
<body class="bg-gray-100">
    <div class="top-bar text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-500">Detalle de Solicitud #<?php echo $data['solicitud']->id; ?> (Vista Admin)</h1>
            <div>
                <a href="<?php echo URLROOT; ?>/admin" class="text-gray-300 hover:text-white mr-4">Volver al Panel</a>
                <a href="<?php echo URLROOT; ?>/auth/logout" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8 main-content">
        <!-- Datos Generales -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Información General</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-gray-700">
                <div><strong>Orden Trabajo:</strong><br><?php echo htmlspecialchars($data['solicitud']->orden_trabajo); ?></div>
                <div><strong>Supervisor:</strong><br><?php echo htmlspecialchars($data['solicitud']->nombre_supervisor); ?></div>
                <div><strong>Inspector:</strong><br><?php echo htmlspecialchars($data['solicitud']->nombre_inspector ?? 'N/A'); ?></div>
                <div><strong>Estado Solicitud:</strong><br>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?php if ($data['solicitud']->estado == 'Tomada') echo 'bg-blue-200 text-blue-800'; if ($data['solicitud']->estado == 'Completada') echo 'bg-green-200 text-green-800'; if ($data['solicitud']->estado == 'Pendiente') echo 'bg-yellow-200 text-yellow-800'; ?>">
                        <?php echo htmlspecialchars($data['solicitud']->estado); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Partidas -->
        <h2 class="text-2xl font-light text-gray-700 mb-4">Partidas de la Solicitud</h2>
        <div class="space-y-6">
            <?php foreach($data['partidas'] as $partida): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="md:flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-xl text-gray-800">Marca: <?php echo htmlspecialchars($partida->marca); ?></h3>
                        <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($partida->descripcion); ?></p>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6 flex-shrink-0">
                        <form action="<?php echo URLROOT; ?>/admin/actualizarPartida/<?php echo $partida->id; ?>" method="POST" class="flex items-center space-x-2">
                            <input type="hidden" name="id_solicitud" value="<?php echo $data['solicitud']->id; ?>">
                            <span class="font-semibold text-gray-600">Estado:</span>
                            <select name="estado" class="border-gray-300 rounded-md shadow-sm">
                                <option value="Pendiente" <?php if($partida->estado == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                                <option value="Completada" <?php if($partida->estado == 'Completada') echo 'selected'; ?>>Completada</option>
                                <option value="Rechazada" <?php if($partida->estado == 'Rechazada') echo 'selected'; ?>>Rechazada</option>
                            </select>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-lg" title="Guardar Cambios"><i class="fas fa-save"></i></button>
                        </form>
                    </div>
                </div>
                
                <?php flash('partida_mensaje_' . $partida->id); ?>

                <!-- Observaciones -->
                <div class="mt-6 border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Observaciones Registradas</h4>
                    <div class="space-y-2">
                        <?php if(empty($partida->observaciones)): ?>
                            <p class="text-sm text-gray-500 italic">No hay observaciones para esta partida.</p>
                        <?php else: ?>
                            <?php foreach($partida->observaciones as $obs): ?>
                                <div class="bg-gray-50 p-3 rounded-md text-sm">
                                    <p><?php echo htmlspecialchars($obs->texto_observacion); ?></p>
                                    <span class="text-xs text-gray-400"><?php echo date('d/m/Y H:i', strtotime($obs->fecha_creacion)); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>
