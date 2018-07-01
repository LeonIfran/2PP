-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2018 a las 06:07:31
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `donjuan`
--
CREATE DATABASE IF NOT EXISTS `donjuan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `donjuan`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `talle` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medias`
--

INSERT INTO `medias` (`id`, `color`, `marca`, `precio`, `talle`, `foto`) VALUES
(1, 'rojo', 'puma', 12, 'M', 'clases/fotosrojo.jpg'),
(5, 'verde', 'kappa', 17, 'XL', 'clases/fotos/kappa_verde.jpg'),
(6, 'Violeta', 'kevingston', 40, 'L', 'clases/fotos/kevingston_Violeta.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `perfil`) VALUES
(1, 'andres', '1234', 'dueño'),
(2, 'empleado2', 'asdf', 'empleado'),
(3, 'empleado', 'fdsa', 'empleado'),
(4, 'encargado', 'qwerty', 'encargado'),
(5, 'encargado', 'qwerty', 'encargado'),
(6, 'empleado3', '1111', 'empleado'),
(7, 'empleado4', '2222', 'empleado'),
(8, 'empleado5', '5555', 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventamedia`
--

CREATE TABLE `ventamedia` (
  `id` int(11) NOT NULL,
  `idMedia` int(11) NOT NULL,
  `nombreCliente` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `importe` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventamedia`
--

INSERT INTO `ventamedia` (`id`, `idMedia`, `nombreCliente`, `fecha`, `importe`) VALUES
(1, 2, 'Saitama', '2018-02-02 00:00:00', 30),
(2, 2, 'Saitama', '2018-02-02 00:00:00', 30),
(3, 3, 'reaperoo', '2019-03-06 00:00:00', 45),
(4, 2, 'sylen3', '2016-08-09 00:00:00', 7.99),
(5, 1, 'Romina', '2018-06-27 00:00:00', 15),
(6, 1, 'Romina', '2018-06-27 00:00:00', 15),
(7, 3, 'reaperoo', '2019-03-06 00:00:00', 45),
(8, 4, 'aaaa', '2018-06-27 00:00:00', 55),
(9, 3, 'blaze', '2012-06-25 02:47:43', 66);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventamedia`
--
ALTER TABLE `ventamedia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `ventamedia`
--
ALTER TABLE `ventamedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
