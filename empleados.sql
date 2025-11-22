-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2025 a las 22:17:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `eliminar` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`id`, `nombre`, `apellido`, `correo`, `pass`, `rol`, `imagen`, `eliminar`) VALUES
(1, 'Edson Javier', 'Mendiola', 'edson@hotmail.com', '$2y$10$ulKe9iSDb9Zz7sDAljlgzuoSG/RJIu3rKZFSyKIgShgJL5/ubtrie', 1, '8d5a5c0ca8019d53f67d17990b38d6d4.png', 0),
(2, 'Angel ', 'Mendiola Magana', 'omar@hotmail.com', 'omar1234', 2, '04f23d26197195eca186d887debadb35.png', 0),
(3, 'Sofia Luna', 'Lopez', 'sofia@hotmail.com', '$2y$10$s1o1xNiE96Ce4A6KSM/SaOTGL38bp9gw4D8DJR5sRtePMvgahyb2y', 2, '5a699eed44c51f4e2a1e8ab5ef023c24.webp', 0),
(4, 'Karla Lucia', 'Rodriguez Macias', 'karla@hotmail.com', '$2y$10$cZFLGN/4E6OFwzWHOtuLFufK.dSk2.ERHMLb42pWjWk3NGW6bj6H2', 1, '2f745c8e223bb24f20a691d5770f75c5.avif', 0),
(5, 'Joel Luis', 'Cano Zapata', 'joel@gmail.com', '$2y$10$eU4xDE4mxc72xbXIRHjxluFY2gTrc3cnUKnxC264LZ4mjxjnXH9Hq', 1, '4bf0d8a8d1a1f46286ad123ca969de73.jpg', 1),
(6, 'Gansito', 'Marinela', 'marinela@hotmail.com', '$2y$10$.jZDluX8u3f9xvk2wDnWhuyf8X36M1aWO.majQaiRaBmFfkeEEZUu', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `costo` double NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Se guardan los productos';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
