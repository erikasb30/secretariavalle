-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2024 a las 16:24:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cndj`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `radicado_escribiente`
--

CREATE TABLE `radicado_escribiente` (
  `id` int(11) NOT NULL,
  `numerorad` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `despacho` int(3) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `radicado_escribiente`
--

INSERT INTO `radicado_escribiente` (`id`, `numerorad`, `categoria`, `despacho`, `tipo`, `usuario`, `timestamp`) VALUES
(2, '76001250200020220022200', 'DESPACHO', 2, '01prueba', 'lsarmieb', '2024-04-05 15:50:30'),
(3, '76001250200020240022200', 'DESPACHO', 2, '01prueba', 'lsarmieb', '2024-04-05 16:38:23'),
(4, '76001250230020220022200', 'DESPACHO', 2, '01prueba', 'lsarmieb', '2024-04-05 18:58:15'),
(5, '76001250200020240022200', 'SECRETARIA', 0, 'reparto', 'lsarmieb', '2024-04-05 20:27:31'),
(6, '76001250200020240022200', 'SECRETARIA', 1, '', 'lsarmieb', '2024-04-05 21:30:58'),
(7, '76001250200020240022200', 'SECRETARIA', 1, 'reparto', 'lsarmieb', '2024-04-05 21:33:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `radicado_escribiente`
--
ALTER TABLE `radicado_escribiente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `radicado_escribiente`
--
ALTER TABLE `radicado_escribiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
