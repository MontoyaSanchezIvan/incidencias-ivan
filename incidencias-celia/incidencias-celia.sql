-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2020 a las 11:21:43
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidencias-celia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE `incidencia` (
  `id` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `lugar` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `equipo_afectado` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_creador` int(11) NOT NULL,
  `observaciones` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `prioridad` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`id`, `fecha_alta`, `lugar`, `equipo_afectado`, `descripcion`, `usuario_creador`, `observaciones`, `estado`, `prioridad`) VALUES
(1, '0000-00-00', 'aula 20', 'impresora', 'parece que solo imprime en color negro', 1, 'parece que se le ha terminado el tóner de colores ', 'en espera', 'media'),
(25, '2020-11-01', '6', 'torrrrrrrrrrrrr', 'Descripción', 1, 'Observaciones', 'abierto', 'alta'),
(28, '2020-11-01', '21', 'pantalla', 'rota', 2, 'parece que alguien le ha dado un golpe', 'abierto', 'alta'),
(29, '2020-08-21', '1', 'proyector', 'Se ve azul', 4, 'Parece fallo del cable del ordenador', 'pendiente', 'alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `correo` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `tipo`, `correo`, `pass`) VALUES
(1, 'ivan', 'montoya sanchez', 0, 'montoyaivan97@gmail.com', '77440350'),
(2, 'pablo', 'fernandez ', 1, '', ''),
(3, 'alfredo', '', 1, '', ''),
(4, 'pepe', NULL, 1, 'pepe123@gmail.com', '12345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_creador` (`usuario_creador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`usuario_creador`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
