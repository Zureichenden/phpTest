-- Crear la base de datos "prueba" si no existe
CREATE DATABASE IF NOT EXISTS prueba;

-- Usar la base de datos "prueba"
USE prueba;

-- Establecer el motor de almacenamiento InnoDB y conjunto de caracteres por defecto
SET SQL_MODE = "";
SET time_zone = "+00:00";

-- Crear la tabla de Clientes
CREATE TABLE `cliente` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla de Catálogo de Montos y Plazos
CREATE TABLE `catalogoMontos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `monto` DECIMAL(10, 2) NOT NULL,
  `cantidad_plazos` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla de Préstamos
CREATE TABLE `prestamos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `cliente_id` INT,
  `monto_id` INT,
  `fecha_inicio` DATE,
  `interes` DECIMAL(10, 2),
  FOREIGN KEY (`cliente_id`) REFERENCES `cliente`(`id`),
  FOREIGN KEY (`monto_id`) REFERENCES `catalogoMontos`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla de Amortizaciones
CREATE TABLE `amortizaciones` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `prestamo_id` INT,
  `quincena` INT,
  `fecha_pago` DATE,
  `monto_pago` DECIMAL(10, 2),
  `interes_pago` DECIMAL(10, 2),
  `abono` DECIMAL(10, 2),
  `capital_pendiente` DECIMAL(10, 2),
  FOREIGN KEY (`prestamo_id`) REFERENCES `prestamos`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de prueba en la tabla de Clientes
INSERT INTO `cliente` (`nombre`) VALUES
('sam'),
('cliente 2'),
('cliente 3');

-- Insertar datos de prueba en la tabla de Catálogo de Montos y Plazos
INSERT INTO `catalogoMontos` (`monto`, `cantidad_plazos`) VALUES
(500.00, 10),
(200.00, 5),
(100.00, 2);

-- Insertar datos de prueba en la tabla de Préstamos
INSERT INTO `prestamos` (`cliente_id`, `monto_id`, `fecha_inicio`, `interes`) 
VALUES (1, 1, '2023-11-15', 5.00);
