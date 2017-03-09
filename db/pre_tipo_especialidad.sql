
CREATE TABLE IF NOT EXISTS `pre_tipo_especialidad` (
  `id_tipo_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `gl_nombre_especialidad` varchar(150) DEFAULT NULL,
  `id_usuario_crea` int(11) DEFAULT NULL,
  `fc_crea` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tipo_especialidad`),
  KEY `IDX_id_usuario_crea` (`id_usuario_crea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `pre_tipo_especialidad` (`id_tipo_especialidad`, `gl_nombre_especialidad`, `id_usuario_crea`, `fc_crea`) VALUES
(1, 'Odontólogo', NULL, '0000-00-00 00:00:00'),
(2, 'Psicólogo', NULL, '0000-00-00 00:00:00'),
(3, 'Psiquiatra', NULL, '0000-00-00 00:00:00'),
(4, 'Dentista', NULL, '2017-03-09 00:00:00'),
(5, 'Nutricionista', NULL, '2017-03-09 00:00:00');