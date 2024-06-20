-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2024 a las 16:25:38
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
-- Estructura de tabla para la tabla `reg_info_despachos`
--

CREATE TABLE `reg_info_despachos` (
  `id` int(11) NOT NULL,
  `numerorad` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `despacho` int(3) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `rutadocumento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reg_info_despachos`
--

INSERT INTO `reg_info_despachos` (`id`, `numerorad`, `categoria`, `despacho`, `tipo`, `estado`, `usuario`, `rutadocumento`) VALUES
(2, '76001250200020220022200', 'DESPACHO', 2, 'IReparto', 'Tramite', 'lsarmieb', 'C:/xampp/htdocs/pruebateams/Ca');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reg_info_despachos`
--
ALTER TABLE `reg_info_despachos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reg_info_despachos`
--
ALTER TABLE `reg_info_despachos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
