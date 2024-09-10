-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-09-2024 a las 22:43:20
-- Versión del servidor: 5.7.24
-- Versión de PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mdmq_encuesta`
--

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
(1, 'Encuesta MDMQ', '0000-00-00 00:00:00', '2024-09-03 23:23:43', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llenado_ns`
--

CREATE TABLE `llenado_ns` (
  `id_llenado` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_preg_alternativa` int(11) NOT NULL,
  `id_recomendacion` int(11) NOT NULL,
  `my_respuesta` varchar(200) NOT NULL,
  `my_id_token` varchar(200) NOT NULL,
  `fecha_llenado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `llenado_ns`
--

INSERT INTO `llenado_ns` (`id_llenado`, `id_encuesta`, `id_preg_alternativa`, `id_recomendacion`, `my_respuesta`, `my_id_token`, `fecha_llenado`, `estado`) VALUES
(1, 1, 1, 1, 'Respuesta muy satisfactoria', 'token123', '2024-08-23 18:25:31', 1),
(2, 1, 1, 2, 'Respuesta insatisfactoria, falta más claridad', 'token456', '2024-08-23 18:27:30', 1);

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
(1, 'dasdsa', 1, 0),
(2, 'dasdas', 1, 0),
(3, 'dsadasdas', 3, 0),
(4, 'sasas', 1, 0),
(5, 'dadadssss', 2, 1),
(6, 'dadasd', 2, 1);

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
(14, 5, 'alter 2 radioaaa', 2, 1);

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
(3, 3, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendaciones`
--

CREATE TABLE `recomendaciones` (
  `id_recomendacion` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recomendaciones`
--

INSERT INTO `recomendaciones` (`id_recomendacion`, `mensaje`, `fecha_creacion`) VALUES
(1, 'Mejorar la claridad en los formularios de solicitud.', '2024-09-03 23:50:47'),
(2, 'Incrementar el número de personal en horas pico.', '2024-09-03 23:50:47');

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
(1, 'Respuesta Multiple', 1),
(2, 'Respuesta Unica', 1),
(3, 'Respuesta Texto', 1);

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
(1, 'Francisco Javier', 'Quinteros Andrade', 'admin', '1234', '2024-09-04 00:15:39', 1),
(2, 'Jose David', 'Gangotena Altamirano', 'jdgangotena', '123456', '2024-09-03 23:50:47', 1);

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
  ADD PRIMARY KEY (`id_llenado`),
  ADD KEY `id_encuesta` (`id_encuesta`),
  ADD KEY `id_preg_alternativa` (`id_preg_alternativa`),
  ADD KEY `id_recomendacion` (`id_recomendacion`);

--
-- Indices de la tabla `pregunta_ns`
--
ALTER TABLE `pregunta_ns`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `fk_pregunta_tipo` (`id_tipo_preg`);

--
-- Indices de la tabla `preg_alternativa_ns`
--
ALTER TABLE `preg_alternativa_ns`
  ADD PRIMARY KEY (`id_preg_alternativa`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `preg_encuesta_ns`
--
ALTER TABLE `preg_encuesta_ns`
  ADD PRIMARY KEY (`id_preg_encuesta`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  ADD PRIMARY KEY (`id_recomendacion`);

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
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `llenado_ns`
--
ALTER TABLE `llenado_ns`
  MODIFY `id_llenado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pregunta_ns`
--
ALTER TABLE `pregunta_ns`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `preg_alternativa_ns`
--
ALTER TABLE `preg_alternativa_ns`
  MODIFY `id_preg_alternativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `preg_encuesta_ns`
--
ALTER TABLE `preg_encuesta_ns`
  MODIFY `id_preg_encuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  MODIFY `id_recomendacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_pregunta_ns`
--
ALTER TABLE `tipo_pregunta_ns`
  MODIFY `id_tipo_preg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_ns`
--
ALTER TABLE `usuario_ns`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `llenado_ns`
--
ALTER TABLE `llenado_ns`
  ADD CONSTRAINT `llenado_ns_ibfk_1` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta_ns` (`id_encuesta`),
  ADD CONSTRAINT `llenado_ns_ibfk_2` FOREIGN KEY (`id_preg_alternativa`) REFERENCES `preg_alternativa_ns` (`id_preg_alternativa`),
  ADD CONSTRAINT `llenado_ns_ibfk_3` FOREIGN KEY (`id_recomendacion`) REFERENCES `recomendaciones` (`id_recomendacion`);

--
-- Filtros para la tabla `pregunta_ns`
--
ALTER TABLE `pregunta_ns`
  ADD CONSTRAINT `fk_pregunta_tipo` FOREIGN KEY (`id_tipo_preg`) REFERENCES `tipo_pregunta_ns` (`id_tipo_preg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preg_alternativa_ns`
--
ALTER TABLE `preg_alternativa_ns`
  ADD CONSTRAINT `preg_alternativa_ns_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta_ns` (`id_pregunta`);

--
-- Filtros para la tabla `preg_encuesta_ns`
--
ALTER TABLE `preg_encuesta_ns`
  ADD CONSTRAINT `preg_encuesta_ns_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta_ns` (`id_pregunta`),
  ADD CONSTRAINT `preg_encuesta_ns_ibfk_2` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta_ns` (`id_encuesta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
