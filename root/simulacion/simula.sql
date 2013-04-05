-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-03-2013 a las 02:22:04
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `simula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_minuto` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion` int(11) NOT NULL,
  `correo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id`, `id_minuto`, `nombre`, `apellido`, `identificacion`, `correo`) VALUES
(1, 128168, 'DIANA MARCELA', 'ORTIZ GALINDO', 1073628153, 'dimaorga14@hotmail.com'),
(2, 1282205, 'DANNY FERNANDO', 'TORRES', 1073628742, 'comadoe6@hotmail.com'),
(3, 128290, 'ERIKA', 'LAVERDE HERNANADEZ', 1073629160, 'erika-lh@hotmail.com'),
(4, 128305, 'INGRID LORENA', 'FONSECA HUERTAS', 1073628566, 'lovely198922@hotmail.com'),
(5, 128333, 'JHON EDISON', 'CEBALLOS ESCOBAR', 1075624721, 'jece0228@hotmail.com'),
(6, 128962, 'LEONELA', 'LOZANO CUCAITA', 1073628524, 'lelocu25@hotmail.com'),
(7, 0, 'CHARLES RICHARD', 'TORRES MORENO', 79874225, 'charlesrct@hotmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
