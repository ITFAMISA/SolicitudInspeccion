-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS `sistema_inspeccion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_inspeccion`;

-- Tabla para los usuarios y sus roles
CREATE TABLE `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre_usuario` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nombre_completo` VARCHAR(100) NOT NULL,
  `rol` ENUM('supervisor', 'inspector', 'admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuarios de ejemplo
-- Contraseña para todos es 'password123' (hasheada)
INSERT INTO `usuarios` (`nombre_usuario`, `password`, `nombre_completo`, `rol`) VALUES
('supervisor1', '$2y$10$Iis.E.j1.gN9/h0aI7aH2.tP0T1xJ.g1Z.C.xKjY9.U.L3oI6m4mK', 'Supervisor Uno', 'supervisor'),
('inspector1', '$2y$10$Iis.E.j1.gN9/h0aI7aH2.tP0T1xJ.g1Z.C.xKjY9.U.L3oI6m4mK', 'Inspector Uno', 'inspector'),
('admin1', '$2y$10$Iis.E.j1.gN9/h0aI7aH2.tP0T1xJ.g1Z.C.xKjY9.U.L3oI6m4mK', 'Administrador', 'admin');

-- Tabla principal para las solicitudes de inspección
CREATE TABLE `solicitudes_inspeccion` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_supervisor` INT NOT NULL,
  `id_inspector` INT DEFAULT NULL,
  `orden_trabajo` VARCHAR(100) NOT NULL,
  `cliente` VARCHAR(100) NOT NULL,
  `proyecto` VARCHAR(100) NOT NULL,
  `area_proceso` VARCHAR(100) NOT NULL,
  `fecha_solicitud` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_llegada_inspector` DATETIME DEFAULT NULL,
  `fecha_aceptada` DATETIME DEFAULT NULL,
  `fecha_terminacion` DATETIME DEFAULT NULL,
  `estado` ENUM('Pendiente', 'Tomada', 'Completada', 'Rechazada') NOT NULL DEFAULT 'Pendiente',
  FOREIGN KEY (`id_supervisor`) REFERENCES `usuarios`(`id`),
  FOREIGN KEY (`id_inspector`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla para las partidas de cada solicitud
CREATE TABLE `partidas_inspeccion` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_solicitud` INT NOT NULL,
  `numero_dibujo` VARCHAR(100) NOT NULL,
  `revision` VARCHAR(50) NOT NULL,
  `marca` VARCHAR(100) NOT NULL,
  `cantidad` INT NOT NULL,
  `descripcion` TEXT NOT NULL,
  `estado` ENUM('Pendiente', 'Completada', 'Rechazada') NOT NULL DEFAULT 'Pendiente',
  FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes_inspeccion`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla para las observaciones y evidencias de cada partida
CREATE TABLE `observaciones_partida` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_partida` INT NOT NULL,
  `texto_observacion` TEXT NOT NULL,
  `evidencia_path` VARCHAR(255) DEFAULT NULL, -- Ruta al archivo de evidencia
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_partida`) REFERENCES `partidas_inspeccion`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
