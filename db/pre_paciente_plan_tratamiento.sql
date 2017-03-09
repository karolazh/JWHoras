-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-03-2017 a las 10:10:51
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prevencion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_plan_tratamiento`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_plan_tratamiento` (
  `id_plan_tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT NULL,
  `gl_observacion` longtext,
  `id_tipo_especialidad` int(11) DEFAULT NULL,
  `id_profesional` int(11) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_act` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  PRIMARY KEY (`id_plan_tratamiento`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
