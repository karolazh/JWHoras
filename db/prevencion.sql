-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Servidor: 192.168.0.200
-- Tiempo de generación: 03-03-2017 a las 21:09:48
-- Versión del servidor: 5.6.10
-- Versión de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `pre_adjuntos`
--

CREATE TABLE IF NOT EXISTS `pre_adjuntos` (
  `id_adjunto` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `id_tipo_adjunto` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT '0',
  `gl_nombre` varchar(255) NOT NULL,
  `gl_path` varchar(255) DEFAULT NULL,
  `gl_glosa` varchar(255) DEFAULT NULL,
  `sha256` varchar(255) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  PRIMARY KEY (`id_adjunto`),
  UNIQUE KEY `UNIQ_gl_path` (`gl_path`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_adjuntos_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_adjuntos_tipo` (
  `id_tipo_adjunto` int(11) NOT NULL,
  `gl_nombre_tipo_adjunto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_adjunto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_agresor`
--

CREATE TABLE IF NOT EXISTS `pre_agresor` (
  `id_agresor` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) DEFAULT NULL,
  `id_comuna_vive` int(11) DEFAULT NULL,
  `id_comuna_trabaja` int(11) DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `id_tipo_ocupacion` int(11) DEFAULT NULL,
  `id_actividad_economica` int(11) DEFAULT NULL,
  `id_tipo_sexo` int(11) DEFAULT NULL,
  `id_tipo_genero` int(11) DEFAULT NULL,
  `id_orientacion_sexual` int(11) DEFAULT NULL,
  `id_ingreso_mensual` int(11) DEFAULT NULL,
  `gl_rut_agresor` varchar(11) NOT NULL,
  `gl_nombres_agresor` varchar(100) DEFAULT NULL,
  `gl_apellidos_agresor` varchar(100) DEFAULT NULL,
  `fc_nacimiento_agresor` date DEFAULT NULL,
  `nr_hijos` int(11) DEFAULT NULL,
  `nr_hijos_en_comun` int(11) DEFAULT NULL,
  `nr_denuncias_por_violencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_agresor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_casos_egreso`
--

CREATE TABLE IF NOT EXISTS `pre_casos_egreso` (
  `id_caso_egreso` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_caso_egreso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_caso_egreso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_clasificacion_imc`
--

CREATE TABLE IF NOT EXISTS `pre_clasificacion_imc` (
  `id_clasificacion_imc` int(11) NOT NULL,
  `gl_clasificacion_imc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_clasificacion_imc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_comunas`
--

CREATE TABLE IF NOT EXISTS `pre_comunas` (
  `id_comuna` int(11) NOT NULL COMMENT 'Primary key',
  `id_provincia` int(11) DEFAULT NULL,
  `id_region` int(11) DEFAULT '0',
  `gl_nombre_comuna` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_comuna`),
  KEY `IDX_id_provincia` (`id_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_cuestionario_alcoholismo`
--

CREATE TABLE IF NOT EXISTS `pre_cuestionario_alcoholismo` (
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
  PRIMARY KEY (`id_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_derivaciones`
--

CREATE TABLE IF NOT EXISTS `pre_derivaciones` (
  `id_deriva` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `id_empa` int(11) NOT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  PRIMARY KEY (`id_deriva`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_empa` (`id_empa`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_diagnostico`
--

CREATE TABLE IF NOT EXISTS `pre_diagnostico` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `gl_diagnostico` longtext,
  `fc_crea` datetime DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  `id_usuario_act` int(11) NOT NULL,
  PRIMARY KEY (`id_diagnostico`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_empa`
--

CREATE TABLE IF NOT EXISTS `pre_empa` (
  `id_empa` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `nr_orden` int(11) DEFAULT '0',
  `id_comuna` int(11) DEFAULT '0',
  `id_sector` int(11) DEFAULT '0',
  `id_institucion` int(11) DEFAULT '0',
  `nr_ficha` int(11) DEFAULT '0',
  `fc_empa` datetime DEFAULT NULL,
  `bo_consume_alcohol` int(1) DEFAULT '0',
  `gl_puntos_audit` int(11) DEFAULT '0',
  `bo_fuma` int(1) DEFAULT '0',
  `gl_peso` varchar(10) DEFAULT NULL,
  `gl_estatura` varchar(10) DEFAULT NULL,
  `gl_imc` varchar(10) DEFAULT NULL,
  `gl_circunferencia_abdominal` varchar(10) DEFAULT NULL,
  `id_clasificacion_imc` int(11) DEFAULT '0',
  `gl_pas` varchar(100) DEFAULT NULL,
  `gl_pad` varchar(100) DEFAULT NULL,
  `gl_glicemia` varchar(100) DEFAULT NULL,
  `bo_glicemia_toma` int(1) DEFAULT '0',
  `id_examen_glicemia` int(11) DEFAULT '0',
  `bo_trabajadora_reclusa` int(1) DEFAULT '0',
  `bo_vdrl` int(1) DEFAULT '0',
  `id_examen_vdrl` int(11) DEFAULT '0',
  `bo_rpr` int(1) DEFAULT '0',
  `id_examen_rpr` int(11) DEFAULT '0',
  `bo_tos_productiva` int(1) DEFAULT '0',
  `bo_baciloscopia_toma` int(1) DEFAULT '0',
  `id_examen_baciloscopia` int(11) DEFAULT '0',
  `bo_pap_realizado` int(1) DEFAULT '0',
  `fc_ultimo_pap` date DEFAULT NULL,
  `fc_tomar_pap` date DEFAULT NULL,
  `bo_pap_vigente` int(1) DEFAULT '0',
  `bo_pap_toma` int(1) DEFAULT '0',
  `id_examen_pap` int(11) DEFAULT '0',
  `gl_colesterol` varchar(100) DEFAULT NULL,
  `bo_colesterol_toma` int(1) DEFAULT '0',
  `id_examen_colesterol` int(11) DEFAULT '0',
  `bo_mamografia_realizada` int(1) DEFAULT '0',
  `bo_mamografia_vigente` int(1) DEFAULT '0',
  `bo_mamografia_toma` int(1) DEFAULT '0',
  `id_examen_mamografia` int(11) DEFAULT '0',
  `fc_mamografia` date DEFAULT NULL,
  `gl_observaciones_empa` varchar(2000) DEFAULT NULL,
  `bo_finalizado` tinyint(1) NOT NULL DEFAULT '0',
  `fc_crea` datetime DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT '0',
  `id_usuario_act` int(11) DEFAULT '0',
  PRIMARY KEY (`id_empa`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_sector` (`id_sector`),
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
  KEY `IDX_nr_orden` (`nr_orden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_empa_audit`
--

CREATE TABLE IF NOT EXISTS `pre_empa_audit` (
  `id_audit` int(11) NOT NULL AUTO_INCREMENT,
  `id_empa` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `nr_valor` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_audit`),
  KEY `IDX_id_registro` (`id_empa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_especialidades`
--

CREATE TABLE IF NOT EXISTS `pre_especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `gl_nombre_especialidad` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_establecimientos_salud`
--

CREATE TABLE IF NOT EXISTS `pre_establecimientos_salud` (
  `id_establecimiento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cd_establecimiento` varchar(10) DEFAULT NULL,
  `id_region_establecimiento` int(11) NOT NULL,
  `id_comuna_establecimiento` int(11) NOT NULL,
  `servicio_salud_establecimiento` int(11) DEFAULT NULL,
  `nombre_establecimiento` varchar(100) NOT NULL,
  `direccion_establecimiento` varchar(500) DEFAULT NULL,
  `tipo_establecimiento` varchar(50) DEFAULT NULL,
  `clasificacion_establecimiento` varchar(50) DEFAULT NULL,
  `categoria_establecimiento` varchar(10) NOT NULL,
  `lat_establecimiento` float DEFAULT '0',
  `lng_establecimiento` float DEFAULT '0',
  `bo_estado` int(1) NOT NULL DEFAULT '1',
  `fc_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_establecimiento`),
  UNIQUE KEY `id_establecimiento` (`id_establecimiento`),
  UNIQUE KEY `cd_establecimiento` (`cd_establecimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2514 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_estados_caso`
--

CREATE TABLE IF NOT EXISTS `pre_estados_caso` (
  `id_estado_caso` int(11) NOT NULL,
  `gl_nombre_estado_caso` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_estado_caso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_eventos`
--

CREATE TABLE IF NOT EXISTS `pre_eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento_tipo` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `id_empa` int(11) DEFAULT NULL,
  `gl_descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `bo_estado` int(1) DEFAULT '1',
  `fc_crea` datetime NOT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `IDX_id_evento_tipo` (`id_evento_tipo`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_eventos_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_eventos_tipo` (
  `id_evento_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_evento_tipo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_evento_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_examenes`
--

CREATE TABLE IF NOT EXISTS `pre_examenes` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_examen` varchar(255) DEFAULT NULL,
  `gl_descripción_examen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_examen`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_examen_registro`
--

CREATE TABLE IF NOT EXISTS `pre_examen_registro` (
  `id_examen_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_empa` int(11) DEFAULT NULL,
  `id_laboratorio` int(11) DEFAULT NULL,
  `gl_folio` varchar(50) DEFAULT NULL,
  `fc_toma` date DEFAULT NULL,
  `fc_resultado` date DEFAULT NULL,
  `gl_rut_persona_toma` varchar(11) DEFAULT NULL,
  `gl_nombre_persona_toma` varchar(255) DEFAULT NULL,
  `json_resultados` longtext NOT NULL,
  `gl_resultado` char(1) DEFAULT NULL,
  `gl_resultado_descripcion` longtext,
  `gl_indicacion` longtext,
  `fc_crea` datetime NOT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  `id_usuario_act` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_examen_registro`),
  KEY `IDX_id_examen` (`id_examen`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_laboratorio` (`id_laboratorio`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_ficha_vigilancia`
--

CREATE TABLE IF NOT EXISTS `pre_ficha_vigilancia` (
  `id_ficha_vigilancia` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) DEFAULT NULL,
  `id_tipo_ocupacion` int(11) DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `id_tipo_escolaridad` int(11) DEFAULT NULL,
  `id_tipo_violencia` int(11) DEFAULT NULL,
  `id_tipo_riesgo` int(11) DEFAULT NULL,
  `id_tipo_vinculo` int(11) DEFAULT NULL,
  `id_agresor` int(11) DEFAULT NULL,
  `gl_nacionalidad` varchar(50) DEFAULT NULL,
  `gl_direccion_actual` varchar(100) DEFAULT NULL,
  `gl_direccion_alternativa` varchar(100) DEFAULT NULL,
  `nr_hijos` int(11) DEFAULT NULL,
  `gl_situacion_laboral` varchar(100) DEFAULT NULL,
  `fc_ingreso` date DEFAULT NULL,
  `gl_hora_ingreso` time DEFAULT NULL,
  `gl_acompanante` varchar(100) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ficha_vigilancia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_grupo_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_grupo_tipo` (
  `id_grupo_tipo` int(11) NOT NULL,
  `gl_nombre_grupo_tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_grupo_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `pre_institucion_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_institucion_tipo` (
  `id_institucion_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_institucion_tipo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_institucion_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_laboratorios`
--

CREATE TABLE IF NOT EXISTS `pre_laboratorios` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_laboratorio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_log`
--

CREATE TABLE IF NOT EXISTS `pre_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaccion_tipo` int(11) NOT NULL,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `IDX_id_transaccion_tipo` (`id_transaccion_tipo`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_motivo_consulta`
--

CREATE TABLE IF NOT EXISTS `pre_motivo_consulta` (
  `id_motivo_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `fc_ingreso` date DEFAULT NULL,
  `gl_hora_ingreso` time DEFAULT NULL,
  `gl_motivo_consulta` longtext,
  `fc_crea` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  PRIMARY KEY (`id_motivo_consulta`),
  KEY `IDX_id_registro` (`id_registro`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_noticias`
--

CREATE TABLE IF NOT EXISTS `pre_noticias` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `id_adjunto` int(11) DEFAULT NULL,
  `gl_titulo` varchar(255) DEFAULT NULL,
  `gl_resumen` varchar(255) DEFAULT NULL,
  `gl_cuerpo` longtext,
  `gl_estado` char(1) DEFAULT NULL,
  `fc_crea` datetime NOT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  `id_usuario_act` int(11) NOT NULL,
  PRIMARY KEY (`id_noticia`),
  KEY `IDX_id_adjunto` (`id_adjunto`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_opciones`
--

CREATE TABLE IF NOT EXISTS `pre_opciones` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_opcion_padre` int(11) NOT NULL DEFAULT '0',
  `gl_nombre_opcion` varchar(255) DEFAULT NULL,
  `gl_icono` varchar(50) DEFAULT NULL,
  `gl_url` varchar(255) DEFAULT NULL,
  `gl_activo` char(1) NOT NULL DEFAULT '1',
  `bl_tiene_hijos` tinyint(1) NOT NULL DEFAULT '0',
  `fc_crea` datetime NOT NULL,
  `id_usuario_actualiza` int(11) DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  PRIMARY KEY (`id_opcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_paciente_agresor`
--

CREATE TABLE IF NOT EXISTS `pre_paciente_agresor` (
  `id_paciente` int(11) NOT NULL,
  `id_agresor` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_paciente`,`id_agresor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_perfiles`
--

CREATE TABLE IF NOT EXISTS `pre_perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_perfil` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_perfil_opcion`
--

CREATE TABLE IF NOT EXISTS `pre_perfil_opcion` (
  `id_perfil` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil`,`id_opcion`),
  KEY `id_perfil` (`id_perfil`),
  KEY `id_opcion` (`id_opcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_prevision`
--

CREATE TABLE IF NOT EXISTS `pre_prevision` (
  `id_prevision` int(11) NOT NULL,
  `gl_nombre_prevision` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_prevision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_provincias`
--

CREATE TABLE IF NOT EXISTS `pre_provincias` (
  `id_provincia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `id_region` int(11) DEFAULT NULL,
  `gl_nombre_provincia` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_provincia`),
  KEY `IDX_id_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_regiones`
--

CREATE TABLE IF NOT EXISTS `pre_regiones` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `gl_codigo_region` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gl_nombre_region` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_geozone` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gl_latitud` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gl_longitud` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gl_path_logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_registro`
--

CREATE TABLE IF NOT EXISTS `pre_registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_institucion` int(11) DEFAULT NULL COMMENT 'Donde es registrado el caso',
  `id_region` int(11) DEFAULT '0',
  `id_comuna` int(11) DEFAULT NULL,
  `id_prevision` int(11) DEFAULT NULL,
  `id_adjunto` int(11) DEFAULT NULL,
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
  `id_centro_salud` int(11) DEFAULT '0' COMMENT 'Consultorio/otro donde se atiende regularmente',
  `gl_latitud` varchar(30) DEFAULT NULL,
  `gl_longitud` varchar(30) DEFAULT NULL,
  `bo_reconoce` int(1) DEFAULT '0',
  `bo_acepta_programa` int(1) DEFAULT '0',
  `fc_crea` datetime DEFAULT NULL,
  `fc_actualiza` datetime DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT '0',
  `id_usuario_actualiza` int(11) DEFAULT '0',
  PRIMARY KEY (`id_registro`),
  KEY `IDX_id_institucion` (`id_institucion`),
  KEY `IDX_id_comuna` (`id_comuna`),
  KEY `IDX_id_prevision` (`id_prevision`),
  KEY `IDX_id_adjunto` (`id_adjunto`),
  KEY `IDX_id_estado_caso` (`id_estado_caso`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`),
  KEY `IDX_id_usuario_act` (`id_usuario_actualiza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_sectores`
--

CREATE TABLE IF NOT EXISTS `pre_sectores` (
  `id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `id_comuna` int(11) NOT NULL,
  `gl_nombre_sector` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_sector`),
  KEY `IDX_id_comuna` (`id_comuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_servicios_salud`
--

CREATE TABLE IF NOT EXISTS `pre_servicios_salud` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) NOT NULL,
  `gl_nombre_servicio` varchar(255) NOT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_actividad_economica`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_actividad_economica` (
  `id_actividad_economica` int(11) NOT NULL,
  `cd_actividad_economica` int(11) DEFAULT NULL,
  `gl_actividad_economica` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_actividad_economica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_agresor`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_agresor` (
  `id_tipo_agresor` int(11) NOT NULL,
  `gl_tipo_agresor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_agresor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_audit`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_audit` (
  `id_tipo_audit` int(11) NOT NULL,
  `gl_descripcion` varchar(250) DEFAULT NULL,
  `nr_min` int(11) NOT NULL,
  `nr_max` int(11) NOT NULL,
  `gl_color` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_audit`),
  KEY `IDX_nr_min` (`nr_min`),
  KEY `IDX_nr_max` (`nr_max`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_escolaridad`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_escolaridad` (
  `id_tipo_escolaridad` int(11) NOT NULL,
  `gl_tipo_escolaridad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_escolaridad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_estado_civil`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_estado_civil` (
  `id_estado_civil` int(11) NOT NULL,
  `gl_estado_civil` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado_civil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_genero`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_genero` (
  `id_tipo_genero` int(11) NOT NULL,
  `gl_tipo_genero` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_imc`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_imc` (
  `id_tipo_imc` int(11) NOT NULL,
  `gl_descripcion` varchar(250) DEFAULT NULL,
  `nr_min` decimal(10,2) NOT NULL,
  `nr_max` decimal(10,2) NOT NULL,
  `gl_color` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_imc`),
  KEY `IDX_nr_min` (`nr_min`),
  KEY `IDX_nr_max` (`nr_max`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_ingreso_mensual`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_ingreso_mensual` (
  `id_ingreso_mensual` int(11) NOT NULL,
  `gl_ingreso_descripcion` varchar(150) DEFAULT NULL,
  `nr_ingreso_minimo` int(11) DEFAULT NULL,
  `nr_ingreso_maximo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ingreso_mensual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_ocupacion`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_ocupacion` (
  `id_tipo_ocupacion` int(11) NOT NULL,
  `gl_tipo_ocupacion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_ocupacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_orientacion_sexual`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_orientacion_sexual` (
  `id_orientacion_sexual` int(11) NOT NULL,
  `gl_orientacion_sexual` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_orientacion_sexual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_riesgo`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_riesgo` (
  `id_tipo_riesgo` int(11) NOT NULL,
  `gl_tipo_riesgo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_riesgo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_sexo`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_sexo` (
  `id_tipo_sexo` int(11) NOT NULL,
  `gl_tipo_sexo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_vinculo`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_vinculo` (
  `id_tipo_vinculo` int(11) NOT NULL,
  `gl_tipo_vinculo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_vinculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_tipo_violencia`
--

CREATE TABLE IF NOT EXISTS `pre_tipo_violencia` (
  `id_tipo_violencia` int(11) NOT NULL,
  `gl_tipo_violencia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_violencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_transaccion_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_transaccion_tipo` (
  `id_transaccion_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_transaccion_tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaccion_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_usuarios`
--

CREATE TABLE IF NOT EXISTS `pre_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_institucion` int(11) DEFAULT NULL,
  `id_region` int(11) DEFAULT '0',
  `id_comuna` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT '0',
  `id_especialidad` int(11) DEFAULT NULL,
  `gl_grupo_tipo` varchar(100) DEFAULT 'Control',
  `gl_rol_medico` varchar(15) DEFAULT NULL,
  `gl_rut` varchar(11) NOT NULL,
  `gl_password` varchar(255) NOT NULL,
  `gl_nombres` varchar(100) DEFAULT NULL,
  `gl_apellidos` varchar(100) DEFAULT NULL,
  `gl_usuario_alias` varchar(10) DEFAULT NULL,
  `gl_email` varchar(150) DEFAULT NULL,
  `gl_direccion` varchar(255) DEFAULT NULL,
  `gl_fono` varchar(20) DEFAULT NULL,
  `gl_celular` varchar(20) DEFAULT NULL,
  `bo_activo` int(1) DEFAULT '1',
  `gl_salt` varchar(255) DEFAULT NULL,
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
  KEY `IDX_id_especialidad` (`id_especialidad`),
  KEY `FK_id_usuario_crea` (`id_usuario_crea`),
  KEY `FK_id_usuario_act` (`id_usuario_actualiza`),
  KEY `IDX_id_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
