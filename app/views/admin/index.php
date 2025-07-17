<?php require APPROOT . '/views/includes/header.php'; ?>
<body class="bg-gray-100">
    <div class="top-bar text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-500">Panel de Administración</h1>
            <div>
                <span class="mr-4">Hola, <?php echo $_SESSION['nombre_completo']; ?> (Admin)</span>
                <a href="<?php echo URLROOT; ?>/auth/logout" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8 main-content">
        <h2 class="text-3xl font-light text-gray-700 mb-6">Todas las Solicitudes del Sistema</h2>
        
        <?php flash('solicitud_mensaje'); ?>

        <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">Orden Trabajo</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">Supervisor</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">Inspector</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">Fecha Solicitud</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-center text-xs font-semibold uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (empty($data['solicitudes'])): ?>
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-500">No hay solicitudes en el sistema.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($data['solicitudes'] as $solicitud): ?>
                        <tr class="hover:bg-gray-50 border-b border-gray-200">
                            <td class="px-5 py-4"><?php echo $solicitud->id; ?></td>
                            <td class="px-5 py-4"><?php echo htmlspecialchars($solicitud->orden_trabajo); ?></td>
                            <td class="px-5 py-4"><?php echo htmlspecialchars($solicitud->nombre_supervisor); ?></td>
                            <td class="px-5 py-4"><?php echo $solicitud->nombre_inspector ? htmlspecialchars($solicitud->nombre_inspector) : '<span class="text-gray-400 italic">No asignado</span>'; ?></td>
                            <td class="px-5 py-4"><?php echo date('d/m/Y H:i', strtotime($solicitud->fecha_solicitud)); ?></td>
                            <td class="px-5 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    <?php if ($solicitud->estado == 'Pendiente') echo 'bg-yellow-200 text-yellow-800'; ?>
                                    <?php if ($solicitud->estado == 'Tomada') echo 'bg-blue-200 text-blue-800'; ?>
                                    <?php if ($solicitud->estado == 'Completada') echo 'bg-green-200 text-green-800'; ?>
                                ">
                                    <?php echo htmlspecialchars($solicitud->estado); ?>
                                </span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <a href="<?php echo URLROOT; ?>/admin/ver/<?php echo $solicitud->id; ?>" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                    Ver / Editar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>
