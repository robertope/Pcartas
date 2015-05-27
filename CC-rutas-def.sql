-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2015 a las 16:23:56
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `crystalchronicles`
--
CREATE DATABASE IF NOT EXISTS `crystalchronicles` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `crystalchronicles`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `name` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`name`, `pass`) VALUES
('roberto', 'roberto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--

DROP TABLE IF EXISTS `cartas`;
CREATE TABLE IF NOT EXISTS `cartas` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `rareza` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'a',
  `imagen` varchar(3000) COLLATE utf8_spanish2_ci NOT NULL,
  `textura` varchar(3000) COLLATE utf8_spanish2_ci NOT NULL,
  `extension` char(3) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`id`, `nombre`, `rareza`, `tipo`, `imagen`, `textura`, `extension`) VALUES
(1, 'carta1', 'c', 'p', 'c1.jpg', 'c1.jpg', '.jp'),
(2, 'carta2', 'c', 'l', 'c2.jpg', 'c2.jpg', '.jp'),
(3, 'carta3', 'c', 'j', 'c3.jpg', 'c3.jpg', '.jp'),
(4, 'carta4', 'i', 'p', 'c4.jpg', 'c4.jpg', '.jp'),
(5, 'carta5', 'i', 'l', 'c5.jpg', 'c5.jpg', '.jp'),
(6, 'carta6', 'i', 'j', 'c6.jpg', 'c6.jpg', '.jp'),
(7, 'carta7', 'r', 'p', 'c7.jpg', 'c7.jpg', '.jp'),
(8, 'carta8', 'r', 'l', 'c8.jpg', 'c8.jpg', '.jp'),
(9, 'carta9', 'r', 'j', 'c9.jpg', 'c9.jpg', '.jp'),
(15, 'Catedral', 'c', 'b', 'c10.jpg', 'c10.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_jugador`
--

DROP TABLE IF EXISTS `cartas_jugador`;
CREATE TABLE IF NOT EXISTS `cartas_jugador` (
  `id_jugador` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `id_carta` int(11) NOT NULL DEFAULT '0',
  `n_copias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cartas_jugador`
--

INSERT INTO `cartas_jugador` (`id_jugador`, `id_carta`, `n_copias`) VALUES
('roberto', 1, 55),
('roberto', 2, 178),
('roberto', 3, 176),
('roberto', 4, 60),
('roberto', 5, 78),
('roberto', 6, 196),
('roberto', 7, 48),
('roberto', 8, 52),
('roberto', 9, 56),
('roberto', 15, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_mazo`
--

DROP TABLE IF EXISTS `cartas_mazo`;
CREATE TABLE IF NOT EXISTS `cartas_mazo` (
  `copias` int(11) NOT NULL,
  `nombre_jugador` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_mazo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `id_carta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cartas_mazo`
--

INSERT INTO `cartas_mazo` (`copias`, `nombre_jugador`, `nombre_mazo`, `id_carta`) VALUES
(10, 'roberto', 'Mazo1', 1),
(30, 'roberto', 'Mazo1', 2),
(40, 'roberto', 'Mazo1', 3),
(1, 'roberto', 'Mazo1', 15),
(10, 'roberto', 'Mazo2', 1),
(30, 'roberto', 'Mazo2', 2),
(50, 'roberto', 'Mazo2', 3),
(1, 'roberto', 'Mazo2', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_paquete`
--

DROP TABLE IF EXISTS `cartas_paquete`;
CREATE TABLE IF NOT EXISTS `cartas_paquete` (
  `id_carta` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `n_copias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cartas_paquete`
--

INSERT INTO `cartas_paquete` (`id_carta`, `id_paquete`, `n_copias`) VALUES
(1, 1, 5),
(2, 1, 10),
(3, 1, 10),
(6, 1, 25),
(15, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

DROP TABLE IF EXISTS `clases`;
CREATE TABLE IF NOT EXISTS `clases` (
`id` int(11) NOT NULL,
  `clase` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`) VALUES
(1, 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

DROP TABLE IF EXISTS `destinos`;
CREATE TABLE IF NOT EXISTS `destinos` (
  `id` int(11) NOT NULL DEFAULT '0',
  `destino` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

DROP TABLE IF EXISTS `juego`;
CREATE TABLE IF NOT EXISTS `juego` (
  `id` int(11) NOT NULL,
  `coste` int(11) NOT NULL,
  `gasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
CREATE TABLE IF NOT EXISTS `jugadores` (
  `id` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `avatar` varchar(3000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `recuerdo` varchar(555) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activado` tinyint(1) NOT NULL DEFAULT '0',
  `monedas` int(11) NOT NULL DEFAULT '1000',
  `dinero` decimal(6,2) NOT NULL DEFAULT '0.00',
  `activacion` varchar(555) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `pass`, `avatar`, `mail`, `pais`, `recuerdo`, `activado`, `monedas`, `dinero`, `activacion`, `nombre`) VALUES
('jugador', 'jugador', NULL, 'jugador@jugador.com', 'España', NULL, 1, 1000, '0.00', '', 'Jugador'),
('roberto', 'roberto', NULL, 'aaaaaa', NULL, NULL, 1, 991100, '67.00', '', 'roberto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_partida`
--

DROP TABLE IF EXISTS `jugadores_partida`;
CREATE TABLE IF NOT EXISTS `jugadores_partida` (
  `id_partida` int(11) NOT NULL,
  `id_jugador` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `jugadores_partida`
--

INSERT INTO `jugadores_partida` (`id_partida`, `id_jugador`) VALUES
(1, 'jugador'),
(1, 'roberto'),
(2, 'jugador'),
(2, 'roberto'),
(3, 'jugador'),
(3, 'roberto'),
(4, 'jugador'),
(4, 'roberto'),
(5, 'jugador'),
(5, 'roberto'),
(6, 'jugador'),
(6, 'roberto'),
(7, 'jugador'),
(7, 'roberto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizaciones`
--

DROP TABLE IF EXISTS `localizaciones`;
CREATE TABLE IF NOT EXISTS `localizaciones` (
  `id` int(11) NOT NULL,
  `localizacion` int(11) NOT NULL,
  `fbusqueda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazos`
--

DROP TABLE IF EXISTS `mazos`;
CREATE TABLE IF NOT EXISTS `mazos` (
  `nombre_jugador` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_mazo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(450) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mazos`
--

INSERT INTO `mazos` (`nombre_jugador`, `nombre_mazo`, `descripcion`) VALUES
('roberto', 'Mazo1', 'Este es mi primer mazo'),
('roberto', 'Mazo2', 'Este es mi segundo mazo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

DROP TABLE IF EXISTS `noticia`;
CREATE TABLE IF NOT EXISTS `noticia` (
`id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `contenido` varchar(9999) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `fecha`, `contenido`) VALUES
(1, 'aaaa', '2015-05-20 12:16:25', 'aaaaaa'),
(2, 'bbb', '2015-05-20 12:18:10', 'bbbbb'),
(3, 'bbb', '2015-05-20 12:57:11', 'bbbbb'),
(4, 'Noticia', '2015-05-23 12:31:29', 'uewuyioqw iuqw oñoqywe ñoiqwuye ñoiuyqwe  oiuyqwe  qweoiuñyq we\r\n qwe uoyiqwe\r\n qweuiyq weoiqwe \r\n wqeio yuhqiweom qwioe mqw\r\nwq eoíqwkeoiqwjuhe oimqhephqwe, qwe\r\nqw emqwehkqw,eqwoiedjyuqwoi,jqwiosdhqnwlidqw\r\nqw dlqiwhdjmqwpiod,wqodijqwkdo,jugfuytqwiumdkqwdplopwq\r\nwq dioqwyhmd qiwluhd,p iwqodfklweñdqw\r\nwqdpihu kc,wcuiywpnqd9wmi .qw\r\n wqeoiuyjwqld,hwqñolij0`wduq,wj.eqw\r\nqwe dilqhwjudghqwmidub,ño qjwop´dqw\r\nqwdoiqwiuhdñqwd m,p qwiwqd\r\nqwd iqwlujdhqkwpd,h.qw`qw\r\nqw d.ioqwudh qwpdmh qwp9d j,qw\r\nswedfer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE IF NOT EXISTS `paquetes` (
`id_paquete` int(11) NOT NULL,
  `precio_monedas` int(11) DEFAULT NULL,
  `precio_dinero` decimal(6,2) DEFAULT NULL,
  `nombre_paquete` varchar(30) NOT NULL,
  `tipo` enum('m','s') NOT NULL,
  `imagen` varchar(999) NOT NULL,
  `descripcion` varchar(999) NOT NULL DEFAULT 'aaaaaaaa'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `precio_monedas`, `precio_dinero`, `nombre_paquete`, `tipo`, `imagen`, `descripcion`) VALUES
(1, 100, '1.50', 'Paquete1', 'm', 'prueba.jpg', 'Mazo con cartas prestablecidas'),
(2, 100, '1.50', 'Paquete2', 's', 'prueba2.jpg', 'Sobre con 20 cartas aleatorias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

DROP TABLE IF EXISTS `partida`;
CREATE TABLE IF NOT EXISTS `partida` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `ganador` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `abandono` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `fecha`, `ganador`, `abandono`) VALUES
(1, '2015-05-23', 'jugador', NULL),
(2, '2015-05-23', 'jugador', NULL),
(3, '0000-00-00', 'jugador', NULL),
(4, '2015-05-07', 'jugador', NULL),
(5, '2015-05-08', 'roberto', NULL),
(6, '2015-05-20', 'roberto', NULL),
(7, '2015-05-12', 'roberto', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

DROP TABLE IF EXISTS `personajes`;
CREATE TABLE IF NOT EXISTS `personajes` (
  `id` int(11) NOT NULL,
  `fuerza` int(11) NOT NULL,
  `defensa` int(11) NOT NULL,
  `coste` int(11) NOT NULL,
  `gasta` int(11) NOT NULL,
  `raza` int(11) NOT NULL,
  `clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

DROP TABLE IF EXISTS `razas`;
CREATE TABLE IF NOT EXISTS `razas` (
`id` int(11) NOT NULL,
  `raza` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id`, `raza`) VALUES
(1, 'Prueba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `cartas_jugador`
--
ALTER TABLE `cartas_jugador`
 ADD PRIMARY KEY (`id_jugador`,`id_carta`), ADD KEY `fk_id_carta` (`id_carta`) USING BTREE;

--
-- Indices de la tabla `cartas_mazo`
--
ALTER TABLE `cartas_mazo`
 ADD PRIMARY KEY (`nombre_jugador`,`nombre_mazo`,`id_carta`), ADD UNIQUE KEY `nombre_jugador` (`nombre_jugador`,`nombre_mazo`,`id_carta`), ADD KEY `nombre_jugador_2` (`nombre_jugador`,`id_carta`);

--
-- Indices de la tabla `cartas_paquete`
--
ALTER TABLE `cartas_paquete`
 ADD UNIQUE KEY `id_carta` (`id_carta`,`id_paquete`), ADD KEY `id_paquete` (`id_paquete`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `clase` (`clase`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
 ADD PRIMARY KEY (`id`,`destino`), ADD UNIQUE KEY `id` (`id`,`destino`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `jugadores_partida`
--
ALTER TABLE `jugadores_partida`
 ADD KEY `jugadores_p` (`id_jugador`), ADD KEY `p_jugadores` (`id_partida`);

--
-- Indices de la tabla `localizaciones`
--
ALTER TABLE `localizaciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mazos`
--
ALTER TABLE `mazos`
 ADD PRIMARY KEY (`nombre_jugador`,`nombre_mazo`), ADD KEY `fk_nombre` (`nombre_mazo`) USING BTREE;

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
 ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
 ADD PRIMARY KEY (`id`), ADD KEY `ganador` (`ganador`);

--
-- Indices de la tabla `personajes`
--
ALTER TABLE `personajes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_clase_personaje` (`clase`) USING BTREE, ADD KEY `fk_raza_personaje` (`raza`) USING BTREE;

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `raza` (`raza`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartas`
--
ALTER TABLE `cartas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admins`
--
ALTER TABLE `admins`
ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`name`) REFERENCES `jugadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cartas_jugador`
--
ALTER TABLE `cartas_jugador`
ADD CONSTRAINT `cartas_jugador_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cartas_jugador_ibfk_2` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_mazo`
--
ALTER TABLE `cartas_mazo`
ADD CONSTRAINT `cartas_mazo_ibfk_1` FOREIGN KEY (`nombre_jugador`, `id_carta`) REFERENCES `cartas_jugador` (`id_jugador`, `id_carta`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cartas_mazo_ibfk_2` FOREIGN KEY (`nombre_jugador`, `nombre_mazo`) REFERENCES `mazos` (`nombre_jugador`, `nombre_mazo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_paquete`
--
ALTER TABLE `cartas_paquete`
ADD CONSTRAINT `cartas_paquete_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cartas_paquete_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `destinos`
--
ALTER TABLE `destinos`
ADD CONSTRAINT `destinos_ibfk_1` FOREIGN KEY (`id`) REFERENCES `localizaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
ADD CONSTRAINT `juego_ibfk_1` FOREIGN KEY (`id`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores_partida`
--
ALTER TABLE `jugadores_partida`
ADD CONSTRAINT `jugadores_p` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `p_jugadores` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `localizaciones`
--
ALTER TABLE `localizaciones`
ADD CONSTRAINT `localizaciones_ibfk_1` FOREIGN KEY (`id`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mazos`
--
ALTER TABLE `mazos`
ADD CONSTRAINT `mazos_ibfk_1` FOREIGN KEY (`nombre_jugador`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`ganador`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personajes`
--
ALTER TABLE `personajes`
ADD CONSTRAINT `personajes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `personajes_ibfk_2` FOREIGN KEY (`clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `personajes_ibfk_3` FOREIGN KEY (`raza`) REFERENCES `razas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
