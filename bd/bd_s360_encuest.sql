-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2019 a las 07:09:01
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `s360_encuesta`
--
CREATE DATABASE IF NOT EXISTS `s360_encuesta` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `s360_encuesta`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_ns`
--

CREATE TABLE `encuesta_ns` (
  `id_encuesta` int(11) NOT NULL,
  `encuesta` varchar(200) NOT NULL,
  `fecha_llenado` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encuesta_ns`
--

INSERT INTO `encuesta_ns` (`id_encuesta`, `encuesta`, `fecha_llenado`, `fecha_creacion`, `estado`) VALUES
(1, 'Primera generación', '0000-00-00 00:00:00', '2019-10-27 23:11:30', 1),
(8, 'Segunda generación', '0000-00-00 00:00:00', '2019-10-28 01:02:09', 0),
(9, 'Tercera generación', '0000-00-00 00:00:00', '2019-10-28 01:03:39', 0),
(11, 'Cuarta generación', '0000-00-00 00:00:00', '2019-10-28 01:05:36', 0),
(14, 'Quinta generación', '0000-00-00 00:00:00', '2019-10-28 01:07:03', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llenado_ns`
--

CREATE TABLE `llenado_ns` (
  `id_llenado` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_preg_alternativa` int(11) NOT NULL,
  `my_respuesta` varchar(200) NOT NULL,
  `my_id_token` varchar(200) NOT NULL,
  `fecha_llenado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `llenado_ns`
--

INSERT INTO `llenado_ns` (`id_llenado`, `id_encuesta`, `id_preg_alternativa`, `my_respuesta`, `my_id_token`, `fecha_llenado`, `estado`) VALUES
(1, 1, 47, '47', '1571801612.4581', '2019-10-22 22:33:32', 1),
(2, 1, 41, '41', '1571801612.4581', '2019-10-22 22:33:32', 1),
(3, 1, 50, 'sasa', '1571801612.4581', '2019-10-22 22:33:32', 1),
(4, 1, 47, '47', '1571801757.4014', '2019-10-22 22:35:57', 1),
(5, 1, 41, '41', '1571801757.4014', '2019-10-22 22:35:57', 1),
(6, 1, 50, 'sasas', '1571801757.4014', '2019-10-22 22:35:57', 1),
(7, 1, 47, '47', '1571801777.7225', '2019-10-22 22:36:17', 1),
(8, 1, 41, '41', '1571801777.7225', '2019-10-22 22:36:17', 1),
(9, 1, 50, 'sasas', '1571801777.7225', '2019-10-22 22:36:17', 1),
(10, 1, 47, '47', '1571804442.0309', '2019-10-22 23:20:42', 1),
(11, 1, 41, '41', '1571804442.0309', '2019-10-22 23:20:42', 1),
(12, 1, 50, 'ss', '1571804442.0309', '2019-10-22 23:20:42', 1),
(13, 1, 47, '47', '1571804605.8033', '2019-10-22 23:23:25', 1),
(14, 1, 41, '41', '1571804605.8033', '2019-10-22 23:23:25', 1),
(15, 1, 50, 'sasa', '1571804605.8033', '2019-10-22 23:23:25', 1),
(16, 1, 47, '47', '1571804764.1014', '2019-10-22 23:26:04', 1),
(17, 1, 41, '41', '1571804764.1014', '2019-10-22 23:26:04', 1),
(18, 1, 50, 'sss', '1571804764.1014', '2019-10-22 23:26:04', 1),
(19, 1, 47, '47', '1571804788.3177', '2019-10-22 23:26:28', 1),
(20, 1, 41, '41', '1571804788.3177', '2019-10-22 23:26:28', 1),
(21, 1, 50, 'ss', '1571804788.3177', '2019-10-22 23:26:28', 1),
(22, 1, 47, '47', '1571805846.3983', '2019-10-22 23:44:06', 1),
(23, 1, 41, '41', '1571805846.3983', '2019-10-22 23:44:06', 1),
(24, 1, 50, 'ss', '1571805846.3983', '2019-10-22 23:44:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_ns`
--

CREATE TABLE `pregunta_ns` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` varchar(200) NOT NULL,
  `id_tipo_preg` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pregunta_ns`
--

INSERT INTO `pregunta_ns` (`id_pregunta`, `pregunta`, `id_tipo_preg`, `estado`) VALUES
(1, '¿Cuál es tu color favorito?', 1, 0),
(2, '¿Qué piensas al estar solo?', 1, 0),
(3, '¿Qué valoras más?', 1, 0),
(4, '¿Qué es lo que valoras más en tu vida?', 1, 0),
(5, 'Soy un radio', 2, 0),
(6, 'dasdsadasd', 3, 0),
(7, 'Sugerencia', 3, 0),
(8, 'dasdsa', 1, 0),
(9, 'dasdas', 1, 0),
(10, 'RESP 1', 2, 0),
(11, 'RESP2', 2, 0),
(12, 'RESP3', 2, 0),
(13, 'DSADASD', 2, 0),
(14, 'dasdas', 2, 0),
(15, 'dasda', 2, 0),
(16, 'buenas noches', 3, 0),
(17, 'Holitas', 3, 0),
(18, 'dada', 1, 0),
(19, 'dada', 2, 0),
(20, '¿Cómo conosiste S360?', 1, 0),
(21, '¿Hes tanido experiencia en algun volun?', 1, 0),
(22, '¿Has tenido experiencia en algun voluntariado?', 2, 1),
(23, 'Sugerencia', 3, 0),
(24, '¿Cómo conosiste a Superación 360?', 1, 0),
(25, '¿Cómo conociste a superación 360?', 1, 1),
(26, 'Sugerencia', 3, 1),
(27, 'sasas', 1, 0),
(28, 'dsadasdas', 3, 0),
(29, 'dadad', 2, 1),
(30, 'dadasd', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preg_alternativa_ns`
--

CREATE TABLE `preg_alternativa_ns` (
  `id_preg_alternativa` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `alternativa` varchar(200) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preg_alternativa_ns`
--

INSERT INTO `preg_alternativa_ns` (`id_preg_alternativa`, `id_pregunta`, `alternativa`, `orden`, `estado`) VALUES
(1, 1, 'Rojo Oscuro', 1, 1),
(2, 1, 'Azul Claro', 2, 1),
(3, 1, 'Verde', 3, 1),
(4, 1, 'Amarillo', 4, 1),
(5, 1, 'Negro', 5, 1),
(6, 2, 'Que no me meresco estar solor', 1, 1),
(7, 2, 'Que soy una persona en busqueda de alguien', 2, 1),
(8, 3, 'Buena amistad', 1, 1),
(9, 3, 'Buenos padres', 2, 1),
(10, 3, 'Buena actitud', 3, 1),
(11, 4, 'Mi familia', 1, 1),
(12, 4, 'Mis hermanos', 2, 1),
(13, 5, 'alter 1 radio aaaaa', 1, 1),
(14, 5, 'alter 2 radioaaa', 2, 1),
(15, 6, '', 0, 1),
(16, 7, '', 0, 1),
(17, 8, '1da', 1, 1),
(18, 8, '2da', 2, 1),
(19, 9, 'dsadsad', 1, 1),
(20, 9, 'ssssssssssss1', 2, 1),
(21, 10, 'adasdsad', 1, 1),
(22, 10, 'dadasdas', 2, 1),
(23, 11, 'DASDASD', 1, 1),
(24, 11, 'dasdasdas', 2, 1),
(25, 12, 'DADAD', 1, 1),
(26, 12, 'DASDASD', 2, 1),
(27, 13, 'DSADASDA', 1, 1),
(28, 14, 'dasdasd', 1, 1),
(29, 15, 'dada', 1, 1),
(30, 12, 'sasasass', 0, 1),
(31, 16, '', 0, 1),
(32, 17, '', 0, 1),
(33, 18, 'dada', 1221, 1),
(34, 19, 'dasdasdas', 1, 1),
(35, 20, 'Facebook', 1, 1),
(36, 20, 'Proa    ', 2, 1),
(37, 21, 'veme ddd', 1, 1),
(38, 21, 'dadadad', 2, 1),
(39, 21, 'dasdasdas', 3, 1),
(40, 20, 'Otros', 0, 1),
(41, 22, 'Si', 1, 1),
(42, 22, 'No', 2, 1),
(43, 23, '', 0, 1),
(44, 24, 'Facebook', 1, 1),
(45, 24, 'Proa', 2, 1),
(46, 24, 'Otros', 3, 1),
(47, 25, 'Facebook', 1, 1),
(48, 25, 'Proa', 2, 1),
(49, 25, 'Otros', 3, 1),
(50, 26, '', 0, 1),
(51, 27, 'sasas', 1, 1),
(52, 27, 'sasas', 2, 1),
(53, 28, '', 0, 1),
(54, 29, 'dadad', 1, 1),
(55, 29, 'dadasd', 2, 1),
(56, 30, 'dasdasd', 1, 1),
(57, 30, 'dasdasdasd', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preg_encuesta_ns`
--

CREATE TABLE `preg_encuesta_ns` (
  `id_preg_encuesta` bigint(20) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preg_encuesta_ns`
--

INSERT INTO `preg_encuesta_ns` (`id_preg_encuesta`, `id_pregunta`, `id_encuesta`, `orden`, `estado`) VALUES
(1, 1, 1, NULL, 1),
(2, 2, 1, NULL, 1),
(3, 3, 1, NULL, 1),
(4, 4, 1, NULL, 1),
(5, 5, 1, NULL, 1),
(6, 6, 1, NULL, 1),
(7, 7, 1, NULL, 1),
(8, 8, 1, NULL, 1),
(9, 9, 1, NULL, 1),
(10, 10, 1, NULL, 1),
(11, 11, 1, NULL, 1),
(12, 12, 1, NULL, 1),
(13, 13, 1, NULL, 1),
(14, 14, 1, NULL, 1),
(15, 15, 1, NULL, 1),
(16, 16, 1, NULL, 1),
(17, 17, 1, NULL, 1),
(18, 18, 1, NULL, 1),
(19, 19, 1, NULL, 1),
(20, 20, 1, NULL, 1),
(21, 21, 1, NULL, 1),
(22, 22, 1, NULL, 1),
(23, 23, 1, NULL, 1),
(24, 24, 1, NULL, 1),
(25, 25, 1, NULL, 1),
(26, 26, 1, NULL, 1),
(27, 27, 1, NULL, 1),
(28, 28, 1, NULL, 1),
(29, 29, 1, NULL, 1),
(30, 30, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pregunta_ns`
--

CREATE TABLE `tipo_pregunta_ns` (
  `id_tipo_preg` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_pregunta_ns`
--

INSERT INTO `tipo_pregunta_ns` (`id_tipo_preg`, `tipo`, `estado`) VALUES
(1, 'Check - Respuesta Multiple', 1),
(2, 'Radio - Respuesta Unica', 1),
(3, 'Text - Respuesta Texto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_ns`
--

CREATE TABLE `usuario_ns` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `fecha_crea` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_ns`
--

INSERT INTO `usuario_ns` (`id_usuario`, `nombres`, `apellidos`, `usuario`, `clave`, `fecha_crea`, `estado`) VALUES
(1, 'MAXIMO HUGO', 'BUENO URIBE', 'admin', '1234', '2019-10-28 00:15:39', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta_ns`
--
ALTER TABLE `encuesta_ns`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `llenado_ns`
--
ALTER TABLE `llenado_ns`
  ADD PRIMARY KEY (`id_llenado`);

--
-- Indices de la tabla `pregunta_ns`
--
ALTER TABLE `pregunta_ns`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `preg_alternativa_ns`
--
ALTER TABLE `preg_alternativa_ns`
  ADD PRIMARY KEY (`id_preg_alternativa`);

--
-- Indices de la tabla `preg_encuesta_ns`
--
ALTER TABLE `preg_encuesta_ns`
  ADD PRIMARY KEY (`id_preg_encuesta`);

--
-- Indices de la tabla `tipo_pregunta_ns`
--
ALTER TABLE `tipo_pregunta_ns`
  ADD PRIMARY KEY (`id_tipo_preg`);

--
-- Indices de la tabla `usuario_ns`
--
ALTER TABLE `usuario_ns`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta_ns`
--
ALTER TABLE `encuesta_ns`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `llenado_ns`
--
ALTER TABLE `llenado_ns`
  MODIFY `id_llenado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pregunta_ns`
--
ALTER TABLE `pregunta_ns`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `preg_alternativa_ns`
--
ALTER TABLE `preg_alternativa_ns`
  MODIFY `id_preg_alternativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `preg_encuesta_ns`
--
ALTER TABLE `preg_encuesta_ns`
  MODIFY `id_preg_encuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tipo_pregunta_ns`
--
ALTER TABLE `tipo_pregunta_ns`
  MODIFY `id_tipo_preg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_ns`
--
ALTER TABLE `usuario_ns`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
