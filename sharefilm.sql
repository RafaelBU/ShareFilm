-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2015 a las 10:56:13
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sharefilm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE IF NOT EXISTS `amigo` (
  `nick1` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nick2` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Nick` varchar(50) CHARACTER SET utf8 NOT NULL,
  `IdNoticia` int(3) unsigned NOT NULL,
  `Coment` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE IF NOT EXISTS `genero` (
  `Tipo` enum('Accion','Ciencia ficcion','Comedia','Documental','Drama','Historica','Infantil','Misterio','Musical','Romantica','Suspense','Terror') CHARACTER SET utf8 NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `nick` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accion` enum('comprado','comentado','valorado','recomendado','escrito','seguido') CHARACTER SET utf8 NOT NULL,
  `texto` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`ID` int(3) unsigned NOT NULL,
  `Titulo` text CHARACTER SET utf8 NOT NULL,
  `Cabecera` text CHARACTER SET utf8 NOT NULL,
  `Nick` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Contenido` text CHARACTER SET utf8 NOT NULL,
  `Foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE IF NOT EXISTS `peliculas` (
`ID` int(3) unsigned NOT NULL,
  `Titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Director` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Actores` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Sinopsis` text CHARACTER SET utf8 NOT NULL,
  `Portada` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculatienda`
--

CREATE TABLE IF NOT EXISTS `peliculatienda` (
`ID` int(3) unsigned NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Portada` varchar(50) NOT NULL,
  `Trailer` varchar(100) NOT NULL,
  `numeroVentas` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienegeneropeli`
--

CREATE TABLE IF NOT EXISTS `tienegeneropeli` (
  `IdPeli` int(3) unsigned NOT NULL,
  `Genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienegenerotienda`
--

CREATE TABLE IF NOT EXISTS `tienegenerotienda` (
  `IDTiendaPeli` int(3) unsigned NOT NULL,
  `Genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tieneoferta`
--

CREATE TABLE IF NOT EXISTS `tieneoferta` (
  `IDTiendaPeli` int(3) unsigned NOT NULL,
  `Descuento` int(2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodisco`
--

CREATE TABLE IF NOT EXISTS `tipodisco` (
  `IDTiendaPeli` int(3) unsigned NOT NULL,
  `Stock` int(3) NOT NULL,
  `Precio` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariocompra`
--

CREATE TABLE IF NOT EXISTS `usuariocompra` (
  `Nick` varchar(50) NOT NULL,
  `idPeli` int(3) unsigned NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Nick` varchar(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Pais` varchar(50) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Avatar` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vota`
--

CREATE TABLE IF NOT EXISTS `vota` (
  `Nick` varchar(50) CHARACTER SET utf8 NOT NULL,
  `IdPeli` int(3) unsigned NOT NULL,
  `Nota` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
 ADD PRIMARY KEY (`nick1`,`nick2`), ADD KEY `nick2` (`nick2`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`Fecha`,`Nick`,`IdNoticia`), ADD KEY `Nick` (`Nick`), ADD KEY `IdNoticia` (`IdNoticia`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
 ADD PRIMARY KEY (`Id`), ADD KEY `Tipo` (`Tipo`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
 ADD PRIMARY KEY (`nick`,`fecha`,`accion`,`texto`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`ID`), ADD KEY `Nick` (`Nick`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `peliculatienda`
--
ALTER TABLE `peliculatienda`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tienegeneropeli`
--
ALTER TABLE `tienegeneropeli`
 ADD PRIMARY KEY (`IdPeli`,`Genero`), ADD KEY `Genero` (`Genero`);

--
-- Indices de la tabla `tienegenerotienda`
--
ALTER TABLE `tienegenerotienda`
 ADD PRIMARY KEY (`IDTiendaPeli`,`Genero`), ADD KEY `Genero` (`Genero`);

--
-- Indices de la tabla `tieneoferta`
--
ALTER TABLE `tieneoferta`
 ADD PRIMARY KEY (`IDTiendaPeli`);

--
-- Indices de la tabla `tipodisco`
--
ALTER TABLE `tipodisco`
 ADD PRIMARY KEY (`IDTiendaPeli`);

--
-- Indices de la tabla `usuariocompra`
--
ALTER TABLE `usuariocompra`
 ADD PRIMARY KEY (`Nick`,`idPeli`), ADD KEY `idPeli` (`idPeli`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`Nick`);

--
-- Indices de la tabla `vota`
--
ALTER TABLE `vota`
 ADD PRIMARY KEY (`Nick`,`IdPeli`), ADD KEY `Nick` (`Nick`), ADD KEY `IdPeli` (`IdPeli`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
MODIFY `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `peliculatienda`
--
ALTER TABLE `peliculatienda`
MODIFY `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
ADD CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`nick1`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`nick2`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`Nick`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`IdNoticia`) REFERENCES `noticias` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`Nick`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tienegeneropeli`
--
ALTER TABLE `tienegeneropeli`
ADD CONSTRAINT `tienegeneropeli_ibfk_1` FOREIGN KEY (`IdPeli`) REFERENCES `peliculas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tienegeneropeli_ibfk_2` FOREIGN KEY (`Genero`) REFERENCES `genero` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tienegenerotienda`
--
ALTER TABLE `tienegenerotienda`
ADD CONSTRAINT `tienegenerotienda_ibfk_1` FOREIGN KEY (`IDTiendaPeli`) REFERENCES `peliculatienda` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tienegenerotienda_ibfk_2` FOREIGN KEY (`Genero`) REFERENCES `genero` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tieneoferta`
--
ALTER TABLE `tieneoferta`
ADD CONSTRAINT `tieneoferta_ibfk_1` FOREIGN KEY (`IDTiendaPeli`) REFERENCES `peliculatienda` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipodisco`
--
ALTER TABLE `tipodisco`
ADD CONSTRAINT `tipodisco_ibfk_1` FOREIGN KEY (`IDTiendaPeli`) REFERENCES `peliculatienda` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariocompra`
--
ALTER TABLE `usuariocompra`
ADD CONSTRAINT `usuariocompra_ibfk_1` FOREIGN KEY (`Nick`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuariocompra_ibfk_2` FOREIGN KEY (`idPeli`) REFERENCES `peliculatienda` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vota`
--
ALTER TABLE `vota`
ADD CONSTRAINT `vota_ibfk_1` FOREIGN KEY (`IdPeli`) REFERENCES `peliculas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `vota_ibfk_2` FOREIGN KEY (`Nick`) REFERENCES `usuarios` (`Nick`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
