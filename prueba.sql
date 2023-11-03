SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `cliente` (`id`, `nombre`) VALUES
(1, 'sam'),
(2, 'cliente 2'),
(3, 'cliente 3');


ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

CREATE TABLE `catalogoMontos` (
  `id` int(11) NOT NULL,
  `monto` decimal(10, 2) NOT NULL,
  `cantidad_plazos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `catalogoMontos` (`id`, `monto`, `cantidad_plazos`) VALUES
(1, '500', 10),
(2, '200', 5),
(3, '100', 2);


ALTER TABLE `catalogoMontos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `catalogoMontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

