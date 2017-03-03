
--
-- Estructura de tabla para la tabla `pre_eventos_tipo`
--

CREATE TABLE IF NOT EXISTS `pre_eventos_tipo` (
  `id_evento_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_evento_tipo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_evento_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `pre_eventos_tipo`
--

INSERT INTO `pre_eventos_tipo` (`id_evento_tipo`, `gl_nombre_evento_tipo`) VALUES
(1, 'Registro de Paciente'),
(2, 'EMPA Finalizado'),
(3, 'Modificación de Registro de Paciente'),
(4, 'Paciente Consciente Participar'),
(5, 'Paciente Reconoce Maltrato'),
(6, 'Paciente Enviado a Consejería'),
(7, 'Paciente Finaliza Consejería'),
(8, 'Paciente Abandona Consejería'),
(9, 'Paciente Abandona Seguimiento'),
(10, 'Paciente vuelve a Seguimiento'),
(11, 'Ingreso de Nuevo Examen'),
(12, 'EMPA Modificado'),
(13, 'EMPA Creado'),
(14, 'AUDIT Creado'),
(15, 'AUDIT Modificado'),
(16, 'Consulta Agregada');
