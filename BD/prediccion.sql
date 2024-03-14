-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2023 a las 08:02:41
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prediccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `legajo` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `id_cuatri` int(10) NOT NULL,
  `turno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuatri`
--

CREATE TABLE `cuatri` (
  `id_cuatri` int(10) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuatri`
--

INSERT INTO `cuatri` (`id_cuatri`, `nombre`) VALUES
(1, 'Primer Cuatrimestre'),
(2, 'Segundo Cuatrimestre'),
(3, 'Tercer Cuatrimestre'),
(4, 'Cuarto Cuatrimestre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(10) NOT NULL,
  `materia` varchar(50) NOT NULL,
  `id_cuatri` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`, `id_cuatri`) VALUES
(1, 'Prog. I', 1),
(2, 'SPD', 1),
(3, 'Matemática', 1),
(4, 'Ingles I', 1),
(5, 'Lab. de Computación I', 1),
(6, 'Prog. II', 2),
(7, 'Arq. y Sist. Operativos', 2),
(8, 'Estadística', 2),
(9, 'Met de la Investigación', 2),
(10, 'Inglés II', 2),
(11, 'Lab. de Computación II', 2),
(12, 'Prog. III', 3),
(13, 'Org. Cont. de la Empresa', 3),
(14, 'Org. Empresarial', 3),
(15, 'Ele. de Inv. Operativa', 3),
(16, 'Lab. de Computación III', 3),
(17, 'Diseño y Admi. de BBDD', 4),
(18, 'Met. de Sistemas I', 4),
(19, 'Legislación', 4),
(20, 'Lab. de Computación IV', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_notas` int(10) NOT NULL,
  `faltas` int(10) NOT NULL,
  `parcial1` int(2) NOT NULL,
  `parcial2` int(2) NOT NULL,
  `recu1` int(2) DEFAULT NULL,
  `recu2` int(2) DEFAULT NULL,
  `tp` int(2) NOT NULL,
  `final` int(2) NOT NULL,
  `sitAcademica` varchar(50) DEFAULT 'Sin Datos',
  `legajo` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`legajo`),
  ADD KEY `FK_alumnos_idcuatri_idx` (`id_cuatri`);

--
-- Indices de la tabla `cuatri`
--
ALTER TABLE `cuatri`
  ADD PRIMARY KEY (`id_cuatri`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `FK_id_cuatri_materias_id` (`id_cuatri`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_notas`),
  ADD KEY `FK_notas_legajo` (`legajo`),
  ADD KEY `FK_notas_id_materia_idx` (`id_materia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_notas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `FK_alumnos_idcuatri` FOREIGN KEY (`id_cuatri`) REFERENCES `cuatri` (`id_cuatri`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `FK_id_cuatri_materias_id` FOREIGN KEY (`id_cuatri`) REFERENCES `cuatri` (`id_cuatri`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `FK_notas_id_alumno` FOREIGN KEY (`legajo`) REFERENCES `alumnos` (`legajo`),
  ADD CONSTRAINT `FK_notas_id_materia` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
