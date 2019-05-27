-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2019 a las 04:37:41
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aprendiz021`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencia`
--

CREATE TABLE `evidencia` (
  `idEvidencia` int(11) NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `cedula` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evidencia`
--

INSERT INTO `evidencia` (`idEvidencia`, `ruta`, `cedula`) VALUES
(1, './evidencia/878798/5698387.jpg', 878798);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `isbn` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `publicacion` year(4) NOT NULL,
  `genero` enum('ficcion','terror','drama','infantil','comedia','aventura','suspenso','historia','biografia') COLLATE latin1_spanish_ci NOT NULL,
  `cedula` bigint(20) NOT NULL,
  `autor` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`isbn`, `nombre`, `descripcion`, `publicacion`, `genero`, `cedula`, `autor`) VALUES
(55555, 'Un mundo Feliz', 'Un mundo utópico futurista', 1980, 'ficcion', 878798, 'Adous Huxley'),
(99999, 'Sátanas', 'Cuanta la historia de Pozeto', 1990, 'historia', 878798, 'Mario Mendoza'),
(777777, 'El coronel no tiene quien le escriba', 'Memorias de un coronel', 1980, 'drama', 89089, 'Gabriel Garcia Márquez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula` bigint(20) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `rol` enum('admin','user','supervisor') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `contrasena`, `nombre`, `correo`, `telefono`, `rol`) VALUES
(89089, 'e10adc3949ba59abbe56e057f20f883e', 'Edwin Calderon', 'ec@ec.co', 6575765, 'admin'),
(123456, 'e10adc3949ba59abbe56e057f20f883e', 'Ivan Gutierrez', 'ig@ig.co', 76576576, 'user'),
(878798, 'e10adc3949ba59abbe56e057f20f883e', 'Johan', 'jqj.co', 65576, 'user'),
(890890, 'e10adc3949ba59abbe56e057f20f883e', 'user', 'us@us.co', 565765, 'supervisor'),
(7698679, 'e10adc3949ba59abbe56e057f20f883e', 'sandra', 's@s.co', 798987, 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD PRIMARY KEY (`idEvidencia`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `libro_ibfk_1` (`cedula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  MODIFY `idEvidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD CONSTRAINT `evidencia_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
