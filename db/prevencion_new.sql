-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Servidor: 192.168.0.200
-- Tiempo de generación: 03-03-2017 a las 21:10:18
-- Versión del servidor: 5.6.10
-- Versión de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prevencion_new`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_adjunto`
--

CREATE TABLE IF NOT EXISTS `pre_adjunto` (
  `id_adjunto` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_adjunto_tipo` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT '0',
  `gl_nombre` varchar(255) DEFAULT NULL,
  `gl_path` varchar(255) DEFAULT NULL,
  `gl_glosa` varchar(255) DEFAULT NULL,
  `sha256` varchar(255) DEFAULT NULL,
  `bo_estado` int(1) DEFAULT '1' COMMENT '1=activo',
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_adjunto`),
  UNIQUE KEY `UNIQ_gl_path` (`gl_path`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_paciente` (`id_paciente`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_sha256` (`sha256`),
  KEY `IDX_id_tipo_adjunto` (`id_adjunto_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_adjunto_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_adjunto_tipo` (
  `id_adjunto_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_tipo_adjunto` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_adjunto_tipo`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_auditoria`
--

CREATE TABLE IF NOT EXISTS `pre_auditoria` (
  `id_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT '0',
  `gl_tipo` varchar(255) DEFAULT NULL,
  `gl_query` longtext,
  `ip_publica` varchar(50) DEFAULT '0.0.0.0',
  `ip_privada` varchar(50) DEFAULT '0.0.0.0',
  `fc_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gl_tiempo` varchar(100) DEFAULT NULL COMMENT 'Tiempo de Ejecucion de Script',
  PRIMARY KEY (`id_auditoria`),
  KEY `IDX_gl_tipo` (`gl_tipo`),
  KEY `IDX_id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_auditoria_login`
--

CREATE TABLE IF NOT EXISTS `pre_auditoria_login` (
  `id_auditoria_login` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT '0',
  `gl_rut` varchar(255) DEFAULT NULL,
  `gl_origen` varchar(100) DEFAULT NULL,
  `gl_token` varchar(255) DEFAULT NULL,
  `ip_privada` varchar(50) DEFAULT '0.0.0.0',
  `ip_publica` varchar(50) DEFAULT '0.0.0.0',
  `fc_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_auditoria_login`),
  KEY `IDX_id_usuario` (`id_usuario`),
  KEY `IDX_gl_rut` (`gl_rut`),
  KEY `IDX_ip_privada` (`ip_privada`),
  KEY `IDX_ip_publica` (`ip_publica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_centro_salud`
--

CREATE TABLE IF NOT EXISTS `pre_centro_salud` (
  `id_centro_salud` int(11) NOT NULL AUTO_INCREMENT,
  `cd_establecimiento` varchar(10) DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `id_servicio_salud` int(11) DEFAULT NULL,
  `gl_nombre_establecimiento` varchar(250) DEFAULT NULL,
  `gl_direccion` varchar(500) DEFAULT NULL,
  `gl_tipo` varchar(100) DEFAULT NULL,
  `gl_clasificacion` varchar(100) DEFAULT NULL,
  `gl_categoria` varchar(10) DEFAULT NULL,
  `gl_latitud` varchar(30) DEFAULT NULL,
  `gl_longitud` varchar(30) DEFAULT NULL,
  `bo_estado` int(1) DEFAULT '1',
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_centro_salud`),
  UNIQUE KEY `cd_establecimiento` (`cd_establecimiento`),
  KEY `IDX_id_region` (`id_region`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_servicio_salud` (`id_servicio_salud`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2514 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_comuna`
--

CREATE TABLE IF NOT EXISTS `pre_comuna` (
  `id_comuna` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `id_region` int(11) NOT NULL,
  `id_provincia` int(11) DEFAULT '0',
  `gl_nombre_comuna` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comuna`),
  KEY `IDX_id_provincia` (`id_provincia`),
  KEY `IDX_id_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=660 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_diagnostico`
--

CREATE TABLE IF NOT EXISTS `pre_diagnostico` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `gl_diagnostico` longtext,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_act` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_diagnostico`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_empa`
--

CREATE TABLE IF NOT EXISTS `pre_empa` (
  `id_empa` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `nr_orden` int(11) DEFAULT '0',
  `id_comuna` int(11) DEFAULT '0',
  `gl_sector` varchar(250) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `nr_ficha` int(11) DEFAULT NULL,
  `fc_empa` datetime DEFAULT NULL,
  `bo_consume_alcohol` int(1) DEFAULT NULL,
  `gl_puntos_audit` varchar(10) DEFAULT NULL,
  `bo_fuma` int(1) DEFAULT NULL,
  `gl_peso` varchar(10) DEFAULT NULL,
  `gl_estatura` varchar(10) DEFAULT NULL,
  `gl_imc` varchar(10) DEFAULT NULL,
  `gl_circunferencia_abdominal` varchar(10) DEFAULT NULL,
  `id_clasificacion_imc` int(11) DEFAULT NULL,
  `gl_pas` varchar(100) DEFAULT NULL,
  `gl_pad` varchar(100) DEFAULT NULL,
  `gl_glicemia` varchar(100) DEFAULT NULL,
  `bo_glicemia_toma` int(1) DEFAULT NULL,
  `id_examen_glicemia` int(11) DEFAULT NULL,
  `bo_trabajadora_reclusa` int(1) DEFAULT NULL,
  `bo_vdrl` int(1) DEFAULT NULL,
  `id_examen_vdrl` int(11) DEFAULT NULL,
  `bo_rpr` int(1) DEFAULT NULL,
  `id_examen_rpr` int(11) DEFAULT NULL,
  `bo_tos_productiva` int(1) DEFAULT NULL,
  `bo_baciloscopia_toma` int(1) DEFAULT NULL,
  `id_examen_baciloscopia` int(11) DEFAULT NULL,
  `bo_pap_realizado` int(1) DEFAULT NULL,
  `fc_ultimo_pap` date DEFAULT NULL,
  `fc_tomar_pap` date DEFAULT NULL,
  `bo_pap_vigente` int(1) DEFAULT NULL,
  `bo_pap_toma` int(1) DEFAULT NULL,
  `id_examen_pap` int(11) DEFAULT NULL,
  `gl_colesterol` varchar(100) DEFAULT NULL,
  `bo_colesterol_toma` int(1) DEFAULT NULL,
  `id_examen_colesterol` int(11) DEFAULT NULL,
  `bo_mamografia_realizada` int(1) DEFAULT NULL,
  `bo_mamografia_vigente` int(1) DEFAULT NULL,
  `bo_mamografia_toma` int(1) DEFAULT NULL,
  `id_examen_mamografia` int(11) DEFAULT NULL,
  `fc_mamografia` date DEFAULT NULL,
  `gl_observaciones_empa` varchar(2000) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT '0',
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_act` int(11) DEFAULT '0',
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empa`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_clasificacion_imc` (`id_clasificacion_imc`),
  KEY `IDX_id_examen_glicemia` (`id_examen_glicemia`),
  KEY `IDX_id_examen_vdrl` (`id_examen_vdrl`),
  KEY `IDX_id_examen_rpr` (`id_examen_rpr`),
  KEY `IDX_id_examen_baciloscopia` (`id_examen_baciloscopia`),
  KEY `IDX_id_examen_pap` (`id_examen_pap`),
  KEY `IDX_id_examen_colesterol` (`id_examen_colesterol`),
  KEY `IDX_id_examen_mamografia` (`id_examen_mamografia`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`),
  KEY `IDX_nr_orden` (`nr_orden`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_empa_audit`
--

CREATE TABLE IF NOT EXISTS `pre_empa_audit` (
  `id_audit` int(11) NOT NULL AUTO_INCREMENT,
  `id_empa` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `nr_valor` int(11) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_audit`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_empa_audit_pregunta`
--

CREATE TABLE IF NOT EXISTS `pre_empa_audit_pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `gl_pregunta` varchar(1000) DEFAULT NULL,
  `gl_respuesta1` varchar(50) DEFAULT NULL,
  `nr_respuesta1_puntos` int(11) DEFAULT NULL,
  `gl_respuesta2` varchar(50) DEFAULT NULL,
  `nr_respuesta2_puntos` int(11) DEFAULT NULL,
  `gl_respuesta3` varchar(50) DEFAULT NULL,
  `nr_respuesta3_puntos` int(11) DEFAULT NULL,
  `gl_respuesta4` varchar(50) DEFAULT NULL,
  `nr_respuesta4_puntos` int(11) DEFAULT NULL,
  `gl_respuesta5` varchar(50) DEFAULT NULL,
  `nr_respuesta5_puntos` int(11) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pregunta`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_evento`
--

CREATE TABLE IF NOT EXISTS `pre_evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento_tipo` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `gl_descripcion` text COLLATE utf8_spanish_ci,
  `bo_estado` int(1) DEFAULT '1',
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  KEY `IDX_id_evento_tipo` (`id_evento_tipo`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_evento_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_evento_tipo` (
  `id_evento_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_evento_tipo` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento_tipo`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_institucion`
--

CREATE TABLE IF NOT EXISTS `pre_institucion` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `id_institucion_tipo` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `gl_nombre` varchar(150) DEFAULT NULL,
  `gl_descripcion` varchar(255) DEFAULT NULL,
  `gl_direccion` varchar(255) DEFAULT NULL,
  `gl_fono` int(11) DEFAULT NULL,
  `gl_email` varchar(150) DEFAULT NULL,
  `gl_latitud` point DEFAULT NULL,
  `gl_longitud` point DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `id_usuario_act` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`),
  KEY `IDX_id_institucion_tipo` (`id_institucion_tipo`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_laboratorio`
--

CREATE TABLE IF NOT EXISTS `pre_laboratorio` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_laboratorio` varchar(255) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laboratorio`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_opcion`
--

CREATE TABLE IF NOT EXISTS `pre_opcion` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_opcion_padre` int(11) DEFAULT '0',
  `gl_nombre_opcion` varchar(255) DEFAULT NULL,
  `gl_icono` varchar(50) DEFAULT NULL,
  `gl_url` varchar(255) DEFAULT NULL,
  `bo_tiene_hijo` int(1) DEFAULT '0',
  `bo_activo` int(1) DEFAULT '1',
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_actualiza` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_opcion`),
  KEY `IDX_id_opcion_padre` (`id_opcion_padre`),
  KEY `IDX_bo_activo` (`bo_activo`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente`
--

CREATE TABLE IF NOT EXISTS `pre_paciente` (
  `id_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `id_institucion` int(11) NOT NULL COMMENT 'Donde es registrado el Paciente',
  `id_region` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `id_prevision` int(11) DEFAULT NULL,
  `bo_acepta_programa` int(1) DEFAULT NULL,
  `bo_reconoce` int(1) DEFAULT NULL,
  `id_estado_caso` int(11) DEFAULT '1',
  `gl_grupo_tipo` varchar(100) DEFAULT NULL,
  `gl_rut` varchar(11) DEFAULT NULL,
  `bo_extranjero` int(1) DEFAULT '0',
  `gl_run_pass` varchar(15) DEFAULT NULL,
  `gl_nombres` varchar(100) DEFAULT NULL,
  `gl_apellidos` varchar(100) DEFAULT NULL,
  `fc_nacimiento` date DEFAULT NULL,
  `gl_sexo` char(1) DEFAULT 'F',
  `gl_direccion` varchar(255) DEFAULT NULL,
  `gl_fono` varchar(20) DEFAULT NULL,
  `gl_celular` varchar(20) DEFAULT NULL,
  `gl_email` varchar(150) DEFAULT NULL,
  `id_centro_salud` int(11) DEFAULT NULL COMMENT 'Consultorio/otro donde se atiende regularmente',
  `gl_latitud` varchar(30) DEFAULT NULL,
  `gl_longitud` varchar(30) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_actualiza` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_paciente`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_prevision` (`id_prevision`),
  KEY `IDX_id_estado_caso` (`id_estado_caso`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_actualiza`),
  KEY `IDX_id_region` (`id_region`),
  KEY `IDX_gl_rut` (`gl_rut`),
  KEY `IDX_id_centro_salud` (`id_centro_salud`),
  KEY `IDX_gl_run_pass` (`gl_run_pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_derivar`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_derivar` (
  `id_derivar` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT NULL,
  `id_profesional` int(11) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_act` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_derivar`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_estado`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_estado` (
  `id_estado_caso` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_estado_caso` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_estado_caso`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_examen`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_examen` (
  `id_paciente_examen` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_examen` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT NULL,
  `id_laboratorio` int(11) DEFAULT NULL,
  `id_usuario_toma` int(11) DEFAULT NULL,
  `gl_rut_persona_toma` varchar(11) DEFAULT NULL,
  `gl_nombre_persona_toma` varchar(255) DEFAULT NULL,
  `json_resultado` longtext,
  `gl_folio` varchar(50) DEFAULT NULL,
  `fc_toma` date DEFAULT NULL,
  `fc_resultado` date DEFAULT NULL,
  `gl_resultado` varchar(100) DEFAULT NULL,
  `gl_resultado_descripcion` longtext,
  `gl_indicacion` longtext,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_act` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_paciente_examen`),
  KEY `IDX_id_laboratorio` (`id_laboratorio`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`),
  KEY `IDX_id_paciente` (`id_paciente`),
  KEY `IDX_id_tipo_examen` (`id_tipo_examen`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_id_usuario_toma` (`id_usuario_toma`),
  KEY `IDX_gl_rut_persona_toma` (`gl_rut_persona_toma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_registro`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `fc_ingreso` date DEFAULT NULL,
  `gl_hora_ingreso` time DEFAULT NULL,
  `gl_motivo_consulta` longtext,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_registro`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_perfil`
--

CREATE TABLE IF NOT EXISTS `pre_perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_perfil` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perfil`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_perfil_opcion`
--

CREATE TABLE IF NOT EXISTS `pre_perfil_opcion` (
  `id_perfil` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perfil`,`id_opcion`),
  KEY `id_perfil` (`id_perfil`),
  KEY `id_opcion` (`id_opcion`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_prevision`
--

CREATE TABLE IF NOT EXISTS `pre_prevision` (
  `id_prevision` int(11) NOT NULL,
  `gl_nombre_prevision` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prevision`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_provincia`
--

CREATE TABLE IF NOT EXISTS `pre_provincia` (
  `id_provincia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `id_region` int(11) NOT NULL,
  `gl_nombre_provincia` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_provincia`),
  KEY `IDX_id_region` (`id_region`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_region`
--

CREATE TABLE IF NOT EXISTS `pre_region` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `gl_codigo_region` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_nombre_region` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_geozone` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_latitud` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_longitud` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_path_logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_region`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_servicio_salud`
--

CREATE TABLE IF NOT EXISTS `pre_servicio_salud` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) NOT NULL,
  `gl_nombre_servicio` varchar(255) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_servicio`),
  KEY `IDX_id_region` (`id_region`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_egreso`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_egreso` (
  `id_tipo_egreso` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_caso_egreso` varchar(255) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipo_egreso`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_especialidad`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_especialidad` (
  `id_tipo_especialidad` int(11) NOT NULL,
  `gl_nombre_especialidad` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipo_especialidad`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_examen`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_examen` (
  `id_tipo_examen` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_examen` varchar(255) DEFAULT NULL,
  `gl_descripción_examen` varchar(255) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipo_examen`),
  KEY `id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_grupo`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_grupo` (
  `id_institucion_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_institucion_tipo` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_institucion_tipo`),
  KEY `id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_imc`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_imc` (
  `id_tipo_imc` int(11) NOT NULL,
  `gl_descripcion` varchar(250) DEFAULT NULL,
  `nr_min` decimal(10,2) DEFAULT NULL,
  `nr_max` decimal(10,2) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipo_imc`),
  KEY `IDX_nr_min` (`nr_min`),
  KEY `IDX_nr_max` (`nr_max`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_usuario`
--

CREATE TABLE IF NOT EXISTS `pre_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL DEFAULT '0',
  `gl_rut` varchar(11) NOT NULL,
  `gl_password` varchar(255) NOT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `id_tipo_grupo` varchar(100) DEFAULT NULL,
  `gl_nombres` varchar(100) DEFAULT NULL,
  `gl_apellidos` varchar(100) DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `gl_direccion` varchar(255) DEFAULT NULL,
  `gl_email` varchar(150) DEFAULT NULL,
  `gl_fono` varchar(20) DEFAULT NULL,
  `gl_celular` varchar(20) DEFAULT NULL,
  `bo_activo` int(1) DEFAULT '1',
  `fc_ultimo_login` datetime DEFAULT NULL,
  `id_usuario_actualiza` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `UNIQ_gl_rut` (`gl_rut`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_perfil` (`id_perfil`),
  KEY `IDX_id_region` (`id_region`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_actualiza`),
  KEY `IDX_bo_activo` (`bo_activo`),
  KEY `IDX_gl_password` (`gl_password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_usuario_especialidad`
--

CREATE TABLE IF NOT EXISTS `pre_usuario_especialidad` (
  `id_usuario_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_especialidad` int(11) NOT NULL,
  `gl_descripcion` varchar(250) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario_especialidad`),
  KEY `IDX_id_usuario` (`id_usuario`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_tipo_especialidad` (`id_tipo_especialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
