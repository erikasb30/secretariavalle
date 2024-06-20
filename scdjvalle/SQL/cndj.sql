-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2024 a las 23:31:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
(7, '76001250200020240022200', 'SECRETARIA', 1, 'reparto', 'lsarmieb', '2024-04-05 21:33:09'),
(8, '76001250200020240025300', 'DESPACHO', 2, 'IReparto', 'lsarmieb', '2024-05-02 14:59:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_categoria`
--

CREATE TABLE `registro_categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_categoria`
--

INSERT INTO `registro_categoria` (`id`, `categoria`, `usuario`, `timestamp`) VALUES
(1, 'DESPACHO', 'lsarmieb', '2024-04-05 18:23:09'),
(2, 'SECRETARIA', 'lsarmieb', '2024-04-05 18:24:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_tipo`
--

CREATE TABLE `registro_tipo` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_tipo`
--

INSERT INTO `registro_tipo` (`id`, `nombre_tipo`, `usuario`, `timestamp`) VALUES
(2, 'reparto', 'lsarmieb', '2024-04-05 19:54:52'),
(3, 'IReparto', 'lsarmieb', '2024-04-05 21:20:22');

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
  `rutadocumento` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reg_info_despachos`
--

INSERT INTO `reg_info_despachos` (`id`, `numerorad`, `categoria`, `despacho`, `tipo`, `estado`, `usuario`, `rutadocumento`) VALUES
(10, '76001250200020220022200', 'DESPACHO', 2, 'IReparto', 'Proceso', 'lsarmieb', 'C:/xampp/htdocs/pruebateams/CargueDocumentos/2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('normal','admin','moderator') DEFAULT 'normal',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(5, 'Listz Erika Sarmiento B', 'lsarmieb', 'Likas19924*', 'lsarmieb@cndj.gov.co', 'admin', '2024-03-18 16:23:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `radicado_escribiente`
--
ALTER TABLE `radicado_escribiente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_categoria`
--
ALTER TABLE `registro_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_tipo`
--
ALTER TABLE `registro_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reg_info_despachos`
--
ALTER TABLE `reg_info_despachos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `radicado_escribiente`
--
ALTER TABLE `radicado_escribiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `registro_categoria`
--
ALTER TABLE `registro_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro_tipo`
--
ALTER TABLE `registro_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reg_info_despachos`
--
ALTER TABLE `reg_info_despachos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
