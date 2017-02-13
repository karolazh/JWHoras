-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2016 a las 19:44:52
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calidadgestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_region` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL,
  `fecha_creacion_actividad` datetime NOT NULL,
  `id_tipo_actividad` int(11) NOT NULL,
  `actividad` text NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `hora_desde` time NOT NULL,
  `hora_hasta` time NOT NULL,
  `invitados` text NOT NULL,
  `allDay` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_actividad`
--

INSERT INTO `tbl_actividad` (`id_actividad`, `id_usuario`, `id_region`, `id_provincia`, `id_oficina`, `fecha_creacion_actividad`, `id_tipo_actividad`, `actividad`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `invitados`, `allDay`) VALUES
(1, 1, 1, 9, 75, '2016-12-21 12:57:47', 1, 'actividad 1', '2016-12-22', '2016-12-22', '00:00:00', '01:00:00', 'carlos.escalona@cosof.cl,', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_detalle`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad_detalle` (
  `id_actividad_detalle` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_tipo_respuesta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fecha_respuesta` datetime NOT NULL,
  `fecha_respuesta_actualizada` datetime DEFAULT NULL,
  `respondio` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad_usuario` (
  `id_actividad_usuario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_actividad_usuario`
--

INSERT INTO `tbl_actividad_usuario` (`id_actividad_usuario`, `id_usuario`, `id_actividad`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivos`
--

CREATE TABLE IF NOT EXISTS `tbl_archivos` (
  `id_archivo` int(11) unsigned NOT NULL,
  `cd_solicitud_fk_archivo` int(11) NOT NULL,
  `gl_nombre_archivo` varchar(100) DEFAULT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `gl_ruta_archivo` varchar(500) DEFAULT NULL,
  `gl_sha_archivo` varchar(100) DEFAULT NULL,
  `gl_mime_archivo` varchar(50) DEFAULT NULL,
  `cd_usuario_fk_archivo` int(11) DEFAULT '0',
  `fc_fecha_archivo` datetime DEFAULT NULL,
  `id_estado_archivo` int(11) NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `versionado` enum('si','no') NOT NULL DEFAULT 'no',
  `id_archivo_relacionado` int(11) DEFAULT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_archivos`
--

INSERT INTO `tbl_archivos` (`id_archivo`, `cd_solicitud_fk_archivo`, `gl_nombre_archivo`, `nombre_archivo`, `gl_ruta_archivo`, `gl_sha_archivo`, `gl_mime_archivo`, `cd_usuario_fk_archivo`, `fc_fecha_archivo`, `id_estado_archivo`, `id_usuario_modifica`, `fecha_update`, `versionado`, `id_archivo_relacionado`, `version`) VALUES
(1, 1, 'Doc1.docx', 'archivo 1', 'solicitudes/1', '1e94b18df70e1dabc5000bcd1e56c50b51c4105b', 'application/vnd.openxmlformats-officedocument.word', 1, '2016-12-20 16:29:52', 1, 0, '0000-00-00 00:00:00', 'no', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivos_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_archivos_actividad` (
  `id_archivo_actividad` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `gl_nombre_archivo` varchar(100) DEFAULT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `gl_ruta_archivo` varchar(500) DEFAULT NULL,
  `gl_sha_archivo` varchar(100) DEFAULT NULL,
  `gl_mime_archivo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivos_versiones`
--

CREATE TABLE IF NOT EXISTS `tbl_archivos_versiones` (
  `id_archivo_versiones` bigint(20) unsigned NOT NULL,
  `cd_solicitud_fk_archivo` int(11) NOT NULL,
  `gl_nombre_archivo` varchar(100) DEFAULT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `gl_ruta_archivo` varchar(500) DEFAULT NULL,
  `gl_sha_archivo` varchar(100) DEFAULT NULL,
  `gl_mime_archivo` varchar(50) DEFAULT NULL,
  `cd_usuario_fk_archivo` int(11) DEFAULT '0',
  `fc_fecha_archivo` datetime DEFAULT NULL,
  `id_estado_archivo` int(11) NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `versionado` enum('si','no') NOT NULL DEFAULT 'no',
  `id_archivo_relacionado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivo_estado`
--

CREATE TABLE IF NOT EXISTS `tbl_archivo_estado` (
  `id_estado_archivo` int(11) NOT NULL,
  `nombre_archivo_estado` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_archivo_estado`
--

INSERT INTO `tbl_archivo_estado` (`id_estado_archivo`, `nombre_archivo_estado`) VALUES
(1, 'E revision'),
(2, 'Obsoleto'),
(3, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

CREATE TABLE IF NOT EXISTS `tbl_bitacora` (
  `id_bitacora` bigint(20) unsigned NOT NULL,
  `fecha_bitacora` datetime NOT NULL,
  `id_usuario_bitacora` int(11) NOT NULL,
  `nombre_evento_bitacora` varchar(500) NOT NULL,
  `id_carpeta_archivo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_bitacora`
--

INSERT INTO `tbl_bitacora` (`id_bitacora`, `fecha_bitacora`, `id_usuario_bitacora`, `nombre_evento_bitacora`, `id_carpeta_archivo`) VALUES
(1, '2016-12-20 16:29:25', 1, 'Se crea Carpeta Carpeta 1', 1),
(2, '2016-12-20 16:29:52', 1, 'Se Adjunta archivo  archivo 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carpeta_archivo`
--

CREATE TABLE IF NOT EXISTS `tbl_carpeta_archivo` (
  `id_carpeta_archivo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `gl_comentario` text NOT NULL,
  `fc_fecha_creacion` datetime NOT NULL,
  `id_estado_carpeta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_responsable` int(11) DEFAULT NULL,
  `fc_fecha_update` datetime DEFAULT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `padre` enum('si','no') DEFAULT NULL,
  `id_carpeta_relacionada` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_carpeta_archivo`
--

INSERT INTO `tbl_carpeta_archivo` (`id_carpeta_archivo`, `nombre`, `gl_comentario`, `fc_fecha_creacion`, `id_estado_carpeta`, `id_usuario`, `id_usuario_responsable`, `fc_fecha_update`, `id_usuario_modifica`, `padre`, `id_carpeta_relacionada`) VALUES
(1, 'Carpeta 1', 'esta es una carpeta', '2016-12-20 16:29:25', 0, 1, NULL, '2016-12-20 16:29:52', 1, 'si', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carpeta_estado`
--

CREATE TABLE IF NOT EXISTS `tbl_carpeta_estado` (
  `id_estado_carpeta` int(11) NOT NULL,
  `nombre_estado_carpeta` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_carpeta_estado`
--

INSERT INTO `tbl_carpeta_estado` (`id_estado_carpeta`, `nombre_estado_carpeta`) VALUES
(0, '-'),
(1, 'En revision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comunas`
--

CREATE TABLE IF NOT EXISTS `tbl_comunas` (
  `id_comunas` int(11) NOT NULL COMMENT 'Primary key',
  `nombre_comuna` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_provincias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_comunas`
--

INSERT INTO `tbl_comunas` (`id_comunas`, `nombre_comuna`, `id_provincias`) VALUES
(1, 'Algarrobo', 5),
(2, 'Cabildo', 3),
(3, 'Calera', 4),
(4, 'Calle Larga', 2),
(5, 'Cartagena', 5),
(6, 'Casablanca', 7),
(7, 'Catemu', 6),
(8, 'Concon', 7),
(9, 'El Quisco', 5),
(10, 'El Tabo', 5),
(11, 'Hijuelas', 4),
(12, 'Isla De Pascua', 1),
(13, 'Juan Fernandez', 7),
(14, 'La Cruz', 4),
(15, 'La Ligua', 3),
(16, 'Limache', 8),
(17, 'Llaillay', 6),
(18, 'Los Andes', 2),
(19, 'Nogales', 4),
(20, 'Olmue', 8),
(21, 'Panquehue', 6),
(22, 'Papudo', 3),
(23, 'Petorca', 3),
(24, 'Puchuncavi', 7),
(25, 'Putaendo', 6),
(26, 'Quillota', 4),
(27, 'Quilpue', 8),
(28, 'Quintero', 7),
(29, 'Rinconada', 2),
(30, 'San Antonio', 5),
(31, 'San Esteban', 2),
(32, 'San Felipe', 6),
(33, 'Santa Maria', 6),
(34, 'Santo Domingo', 5),
(35, 'Valparaiso', 7),
(36, 'Villa Alemana', 8),
(37, 'Viña Del Mar', 7),
(38, 'Zapallar', 3),
(349, 'Iquique', 9),
(350, 'Alto Hospicio', 9),
(351, 'Pozo Almonte', 10),
(352, 'Camiña', 10),
(353, 'Colchane', 10),
(354, 'Huara', 10),
(355, 'Pica', 10),
(356, 'Antofagasta', 11),
(357, 'Mejillones', 11),
(358, 'Sierra Gorda', 11),
(359, 'Taltal', 11),
(360, 'Calama', 12),
(361, 'Ollagüe', 12),
(362, 'San Pedro de Atacama', 12),
(363, 'Tocopilla', 13),
(364, 'María Elena', 13),
(365, 'Copiapó', 14),
(366, 'Caldera', 14),
(367, 'Tierra Amarilla', 14),
(368, 'Chañaral', 15),
(369, 'Diego de Almagro', 15),
(370, 'Vallenar', 16),
(371, 'Alto del Carmen', 16),
(372, 'Freirina', 16),
(373, 'Huasco', 16),
(374, 'La Serena', 17),
(375, 'Coquimbo', 17),
(376, 'Andacollo', 17),
(377, 'La Higuera', 17),
(378, 'Paiguano', 17),
(379, 'Vicuña', 17),
(380, 'Illapel', 18),
(381, 'Canela', 18),
(382, 'Los Vilos', 18),
(383, 'Salamanca', 18),
(384, 'Ovalle', 19),
(385, 'Combarbalá', 19),
(386, 'Monte Patria', 19),
(387, 'Punitaqui', 19),
(388, 'Río Hurtado', 19),
(389, 'Rancagua', 20),
(390, 'Codegua', 20),
(391, 'Coinco', 20),
(392, 'Coltauco', 20),
(393, 'Doñihue', 20),
(394, 'Graneros', 20),
(395, 'Las Cabras', 20),
(396, 'Machalí', 20),
(397, 'Malloa', 20),
(398, 'Mostazal', 20),
(399, 'Olivar', 20),
(400, 'Peumo', 20),
(401, 'Pichidegua', 20),
(402, 'Quinta de Tilcoco', 20),
(403, 'Rengo', 20),
(404, 'Requínoa', 20),
(405, 'San Vicente', 20),
(406, 'Pichilemu', 21),
(407, 'La Estrella', 21),
(408, 'Litueche', 21),
(409, 'Marchihue', 21),
(410, 'Navidad', 21),
(411, 'Paredones', 21),
(412, 'San Fernando', 22),
(413, 'Chépica', 22),
(414, 'Chimbarongo', 22),
(415, 'Lolol', 22),
(416, 'Nancagua', 22),
(417, 'Palmilla', 22),
(418, 'Peralillo', 22),
(419, 'Placilla', 22),
(420, 'Pumanque', 22),
(421, 'Santa Cruz', 22),
(422, 'Talca', 23),
(423, 'Constitución', 23),
(424, 'Curepto', 23),
(425, 'Empedrado', 23),
(426, 'Maule', 23),
(427, 'Pelarco', 23),
(428, 'Pencahue', 23),
(429, 'Río Claro', 23),
(430, 'San Clemente', 23),
(431, 'San Rafael', 23),
(432, 'Cauquenes', 24),
(433, 'Chanco', 24),
(434, 'Pelluhue', 24),
(435, 'Curicó', 25),
(436, 'Hualañé', 25),
(437, 'Licantén', 25),
(438, 'Molina', 25),
(439, 'Rauco', 25),
(440, 'Romeral', 25),
(441, 'Sagrada Familia', 25),
(442, 'Teno', 25),
(443, 'Vichuquén', 25),
(444, 'Linares', 26),
(445, 'Colbún', 26),
(446, 'Longaví', 26),
(447, 'Parral', 26),
(448, 'Retiro', 26),
(449, 'San Javier', 26),
(450, 'Villa Alegre', 26),
(451, 'Yerbas Buenas', 26),
(452, 'Concepción', 27),
(453, 'Coronel', 27),
(454, 'Chiguayante', 27),
(455, 'Florida', 27),
(456, 'Hualqui', 27),
(457, 'Lota', 27),
(458, 'Penco', 27),
(459, 'San Pedro de la Paz', 27),
(460, 'Santa Juana', 27),
(461, 'Talcahuano', 27),
(462, 'Tomé', 27),
(463, 'Hualpén', 27),
(464, 'Lebu', 28),
(465, 'Arauco', 28),
(466, 'Cañete', 28),
(467, 'Contulmo', 28),
(468, 'Curanilahue', 28),
(469, 'Los Álamos', 28),
(470, 'Tirúa', 28),
(471, 'Los Ángeles', 29),
(472, 'Antuco', 29),
(473, 'Cabrero', 29),
(474, 'Laja', 29),
(475, 'Mulchén', 29),
(476, 'Nacimiento', 29),
(477, 'Negrete', 29),
(478, 'Quilaco', 29),
(479, 'Quilleco', 29),
(480, 'San Rosendo', 29),
(481, 'Santa Bárbara', 29),
(482, 'Tucapel', 29),
(483, 'Yumbel', 29),
(484, 'Alto Biobio', 29),
(485, 'Chillán', 30),
(486, 'Bulnes', 30),
(487, 'Cobquecura', 30),
(488, 'Coelemu', 30),
(489, 'Coihueco', 30),
(490, 'Chillán Viejo', 30),
(491, 'El Carmen', 30),
(492, 'Ninhue', 30),
(493, 'Ñiquén', 30),
(494, 'Pemuco', 30),
(495, 'Pinto', 30),
(496, 'Portezuelo', 30),
(497, 'Quillón', 30),
(498, 'Quirihue', 30),
(499, 'Ránquil', 30),
(500, 'San Carlos', 30),
(501, 'San Fabián', 30),
(502, 'San Ignacio', 30),
(503, 'San Nicolás', 30),
(504, 'Treguaco', 30),
(505, 'Yungay', 30),
(506, 'Temuco', 31),
(507, 'Carahue', 31),
(508, 'Cunco', 31),
(509, 'Curarrehue', 31),
(510, 'Freire', 31),
(511, 'Galvarino', 31),
(512, 'Gorbea', 31),
(513, 'Lautaro', 31),
(514, 'Loncoche', 31),
(515, 'Melipeuco', 31),
(516, 'Nueva Imperial', 31),
(517, 'Padre las Casas', 31),
(518, 'Perquenco', 31),
(519, 'Pitrufquén', 31),
(520, 'Pucón', 31),
(521, 'Saavedra', 31),
(522, 'Teodoro Schmidt', 31),
(523, 'Toltén', 31),
(524, 'Vilcún', 31),
(525, 'Villarrica', 31),
(526, 'Cholchol', 31),
(527, 'Angol', 32),
(528, 'Collipulli', 32),
(529, 'Curacautín', 32),
(530, 'Ercilla', 32),
(531, 'Lonquimay', 32),
(532, 'Los Sauces', 32),
(533, 'Lumaco', 32),
(534, 'Purén', 32),
(535, 'Renaico', 32),
(536, 'Traiguén', 32),
(537, 'Victoria', 32),
(538, 'Puerto Montt', 33),
(539, 'Calbuco', 33),
(540, 'Cochamó', 33),
(541, 'Fresia', 33),
(542, 'Frutillar', 33),
(543, 'Los Muermos', 33),
(544, 'Llanquihue', 33),
(545, 'Maullín', 33),
(546, 'Puerto Varas', 33),
(547, 'Castro', 34),
(548, 'Ancud', 34),
(549, 'Chonchi', 34),
(550, 'Curaco de Vélez', 34),
(551, 'Dalcahue', 34),
(552, 'Puqueldón', 34),
(553, 'Queilén', 34),
(554, 'Quellón', 34),
(555, 'Quemchi', 34),
(556, 'Quinchao', 34),
(557, 'Osorno', 35),
(558, 'Puerto Octay', 35),
(559, 'Purranque', 35),
(560, 'Puyehue', 35),
(561, 'Río Negro', 35),
(562, 'San Juan de La Costa', 35),
(563, 'San Pablo', 35),
(564, 'Chaitén', 36),
(565, 'Futaleufú', 36),
(566, 'Hualaihué', 36),
(567, 'Palena', 36),
(568, 'Coihaique', 37),
(569, 'Lago Verde', 37),
(570, 'Aisen', 38),
(571, 'Cisnes', 38),
(572, 'Guaitecas', 38),
(573, 'Cochrane', 39),
(574, 'O''Higgins', 39),
(575, 'Tortel', 39),
(576, 'Chile Chico', 40),
(577, 'Río Ibáñez', 40),
(578, 'Punta Arenas', 41),
(579, 'Laguna Blanca', 41),
(580, 'Río Verde', 41),
(581, 'San Gregorio', 41),
(582, 'Cabo de Hornos', 42),
(583, 'Antártica', 42),
(584, 'Porvenir', 43),
(585, 'Primavera', 43),
(586, 'Timaukel', 43),
(587, 'Natales', 44),
(588, 'Torres del Paine', 44),
(589, 'Santiago', 45),
(590, 'Cerrillos', 45),
(591, 'Cerro Navia', 45),
(592, 'Conchalí', 45),
(593, 'El Bosque', 45),
(594, 'Estación Central ', 45),
(595, 'Huechuraba', 45),
(596, 'Independencia', 45),
(597, 'La Cisterna', 45),
(598, 'La Florida', 45),
(599, 'La Pintana', 45),
(600, 'La Granja', 45),
(601, 'La Reina', 45),
(602, 'Las Condes', 45),
(603, 'Lo Barnechea', 45),
(604, 'Lo Espejo', 45),
(605, 'Lo Prado', 45),
(606, 'Macul', 45),
(607, 'Maipú', 45),
(608, 'Ñuñoa', 45),
(609, 'Pedro Aguirre Cerda', 45),
(610, 'Peñalolén', 45),
(611, 'Providencia', 45),
(612, 'Pudahuel', 45),
(613, 'Quilicura', 45),
(614, 'Quinta Normal', 45),
(615, 'Recoleta', 45),
(616, 'Renca', 45),
(617, 'San Joaquín', 45),
(618, 'San Miguel', 45),
(619, 'San Ramón', 45),
(620, 'Vitacura', 45),
(621, 'Puente Alto', 46),
(622, 'Pirque', 46),
(623, 'San José de Maipo', 46),
(624, 'Colina', 47),
(625, 'Lampa', 47),
(626, 'Tiltil', 47),
(627, 'San Bernardo', 48),
(628, 'Buin', 48),
(629, 'Calera de Tango', 48),
(630, 'Paine', 48),
(631, 'Melipilla', 49),
(632, 'Alhué', 49),
(633, 'Curacaví', 49),
(634, 'María Pinto', 49),
(635, 'San Pedro', 49),
(636, 'Talagante', 50),
(637, 'El Monte', 50),
(638, 'Isla de Maipo', 50),
(639, 'Padre Hurtado', 50),
(640, 'Peñaflor', 50),
(641, 'Valdivia', 51),
(642, 'Corral', 51),
(643, 'Lanco', 51),
(644, 'Los Lagos', 51),
(645, 'Máfil', 51),
(646, 'Mariquina', 51),
(647, 'Paillaco', 51),
(648, 'Panguipulli', 51),
(649, 'La Unión', 52),
(650, 'Futrono', 52),
(651, 'Lago Ranco', 52),
(652, 'Río Bueno', 52),
(653, 'Arica', 53),
(654, 'Camarones', 53),
(655, 'Putre', 54),
(656, 'General Lagos', 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_feriados`
--

CREATE TABLE IF NOT EXISTS `tbl_feriados` (
  `id_dia_feriado` int(11) NOT NULL,
  `fecha_feriado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_feriados`
--

INSERT INTO `tbl_feriados` (`id_dia_feriado`, `fecha_feriado`) VALUES
(1, '2016-12-29'),
(2, '2016-12-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_oficinas`
--

CREATE TABLE IF NOT EXISTS `tbl_oficinas` (
  `id_oficina` int(11) NOT NULL COMMENT 'Primary key',
  `nombre_oficina` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_oficinas`
--

INSERT INTO `tbl_oficinas` (`id_oficina`, `nombre_oficina`) VALUES
(1, 'TERRITORIAL VALPARAÍSO'),
(4, 'PROVINCIAL MARGA-MARGA'),
(10, 'PROVINCIAL QUILLOTA'),
(11, 'PROVINCIA SAN ANTONIO'),
(12, 'PROVINCIAL ISLA DE PASCUA'),
(13, 'TERRITORIAL VIÑA DEL MAR'),
(14, 'TEMUCO'),
(15, 'OAS VICTORIA'),
(16, 'ANGOL'),
(17, 'OAS VILLARRICA'),
(18, 'OAS PITRUFQUEN'),
(19, 'OAS TRAIGUEN'),
(20, 'OAS LAUTARO'),
(21, 'OAS IMPERIAL'),
(22, 'CENTRAL, CONCEPCION'),
(23, 'OF. TALCAHUANO'),
(24, 'OAS COLLIPULLI'),
(25, 'OAS CURACAUTIN'),
(26, 'OAS LONCOCHE'),
(27, 'OAS LONQUIMAY'),
(28, 'OF.CORONEL'),
(29, 'OF. SATELITAL DE TOME'),
(30, 'DELEGACION PROVINCIAL ÑUBLE'),
(31, 'DELEGACION PROVINCIAL BIOBIO'),
(32, 'OF. SATELITE LEBU'),
(33, 'OF. SATELITAL CURANILAHUE'),
(34, 'OF. SATELITAL ARAUCO'),
(35, 'OF. SATELITAL CAÑETE'),
(36, 'OFICINA COMUNAL OVALLE'),
(37, 'OAS DE PUERTO MONTT'),
(38, 'OAS DE CHILOE'),
(39, 'OFICINA COMUNAL LA SERENA'),
(40, 'PROVINCIAL VALDIVIA'),
(41, 'OFICINA RM'),
(42, 'OFICINA DE ACCIÓN SANITARIA PICHILEMU'),
(43, 'OFICINA DE ACCIÓN SANITARIA SANTA CRUZ'),
(44, 'OFICINA DE ACCIÓN SAN FERNANDO'),
(45, 'OFICINA DE ACCIÓN SAN VICENTE'),
(46, 'OFICINA DE ACCIÓN RENGO'),
(47, 'OFICINA DE ACCIÓN SANITARIA RANCAGUA'),
(48, 'OFICINA COMUNAL COQUIMBO'),
(49, 'OFICINA COMUNAL VICUÑA'),
(50, 'OFICINA COMUNAL COMBARBALA'),
(51, 'OFICINA COMUNAL ILLAPEL'),
(52, 'OFICINA COMUNAL LOS VILOS'),
(53, 'OFICINA COMUNAL SALAMANCA'),
(54, 'CURICÓ'),
(55, 'LINARES'),
(56, 'TALCA'),
(57, 'CAUQUENES'),
(59, 'EL LOA, CALAMA'),
(60, 'TALTAL'),
(61, 'TOCOPILLA'),
(62, 'MEJILLONES'),
(63, 'ANTOFAGASTA'),
(64, 'PUNTA ARENAS'),
(65, 'OAS DE OSORNO'),
(66, 'COYHAIQUE'),
(67, 'AYSEN'),
(68, 'PROVINCIAL CHAÑARAL'),
(69, 'PROVINCIAL HUASCO'),
(70, 'PROVINCIAL COPIAPÓ'),
(71, 'OFICINA ARICA'),
(74, 'CONSTITUCION'),
(75, 'REGIONAL TARAPACA'),
(76, 'PUERTO NATALES'),
(77, 'PORVENIR'),
(78, 'OF. TERRITORIAL DE PETORCA'),
(79, 'OF. TERRITORIAL LOS ANDES'),
(80, 'OF. TERRITORIAL SAN FELIPE'),
(81, 'CHILE CHICO'),
(82, 'TERRITORIAL CISNES'),
(84, 'COCHRANE'),
(85, 'CUREPTO'),
(86, 'PARRAL'),
(87, 'SAN JAVIER'),
(88, 'PROVINCIAL RANCO'),
(89, 'CHANCO'),
(90, 'MOLINA'),
(91, 'HUALAÑE'),
(92, 'LICANTEN'),
(93, 'PELLUHUE'),
(95, 'OAS PALENA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_oficinas_vs_comunas`
--

CREATE TABLE IF NOT EXISTS `tbl_oficinas_vs_comunas` (
  `id_oficinas_vs_comunas` int(11) NOT NULL COMMENT 'Primary key',
  `id_oficina` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1862 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_oficinas_vs_comunas`
--

INSERT INTO `tbl_oficinas_vs_comunas` (`id_oficinas_vs_comunas`, `id_oficina`, `id_comuna`) VALUES
(588, 5, 1),
(589, 5, 2),
(590, 5, 3),
(591, 5, 4),
(592, 5, 5),
(593, 5, 6),
(594, 5, 7),
(595, 5, 8),
(596, 5, 9),
(597, 5, 10),
(598, 5, 11),
(599, 5, 12),
(600, 5, 13),
(601, 5, 14),
(602, 5, 15),
(603, 5, 16),
(604, 5, 17),
(605, 5, 18),
(606, 5, 19),
(607, 5, 20),
(608, 5, 21),
(609, 5, 22),
(610, 5, 23),
(611, 5, 24),
(612, 5, 25),
(613, 5, 26),
(614, 5, 27),
(615, 5, 28),
(616, 5, 29),
(617, 5, 30),
(618, 5, 31),
(619, 5, 32),
(620, 5, 33),
(621, 5, 34),
(622, 5, 35),
(623, 5, 36),
(624, 5, 37),
(625, 5, 38),
(758, 4, 16),
(759, 4, 20),
(760, 4, 27),
(761, 4, 36),
(766, 8, 23),
(767, 8, 15),
(768, 8, 2),
(769, 8, 22),
(770, 8, 38),
(771, 9, 18),
(772, 9, 31),
(773, 9, 29),
(774, 9, 4),
(775, 10, 3),
(776, 10, 11),
(777, 10, 14),
(778, 10, 19),
(779, 10, 26),
(780, 11, 1),
(781, 11, 5),
(782, 11, 9),
(783, 11, 10),
(784, 11, 30),
(785, 11, 34),
(787, 13, 8),
(788, 13, 24),
(789, 13, 28),
(790, 13, 37),
(791, 1, 6),
(792, 1, 35),
(793, 7, 32),
(794, 7, 33),
(795, 7, 21),
(796, 7, 25),
(797, 7, 2),
(798, 7, 4),
(799, 7, 7),
(800, 7, 15),
(801, 7, 17),
(802, 7, 18),
(803, 7, 23),
(804, 7, 29),
(805, 7, 31),
(806, 7, 38),
(807, 7, 22),
(1148, 16, 535),
(1149, 16, 527),
(1150, 16, 534),
(1151, 16, 532),
(1155, 18, 512),
(1156, 18, 522),
(1157, 18, 510),
(1158, 18, 519),
(1159, 18, 523),
(1160, 19, 533),
(1161, 19, 536),
(1162, 20, 511),
(1163, 20, 518),
(1164, 20, 513),
(1168, 24, 528),
(1169, 25, 529),
(1170, 26, 514),
(1171, 27, 531),
(1178, 23, 458),
(1179, 23, 461),
(1180, 23, 463),
(1181, 28, 453),
(1182, 28, 457),
(1183, 29, 462),
(1184, 30, 492),
(1185, 30, 485),
(1186, 30, 501),
(1187, 30, 494),
(1188, 30, 487),
(1189, 30, 503),
(1190, 30, 496),
(1191, 30, 489),
(1192, 30, 505),
(1193, 30, 498),
(1194, 30, 491),
(1195, 30, 500),
(1196, 30, 493),
(1198, 30, 502),
(1199, 30, 495),
(1200, 30, 488),
(1201, 30, 504),
(1202, 30, 497),
(1203, 30, 490),
(1204, 30, 499),
(1205, 31, 473),
(1206, 31, 482),
(1207, 31, 475),
(1208, 31, 484),
(1209, 31, 477),
(1210, 31, 479),
(1211, 31, 472),
(1212, 31, 481),
(1213, 31, 474),
(1214, 31, 483),
(1215, 31, 476),
(1216, 31, 478),
(1217, 31, 471),
(1218, 31, 480),
(1220, 33, 468),
(1223, 35, 466),
(1224, 35, 470),
(1225, 35, 467),
(1226, 36, 386),
(1227, 36, 388),
(1228, 36, 384),
(1229, 36, 387),
(1230, 37, 564),
(1231, 37, 540),
(1232, 37, 566),
(1233, 37, 542),
(1234, 37, 544),
(1235, 37, 546),
(1236, 37, 539),
(1237, 37, 565),
(1238, 37, 541),
(1239, 37, 567),
(1240, 37, 543),
(1241, 37, 545),
(1242, 37, 538),
(1243, 38, 552),
(1244, 38, 554),
(1245, 38, 547),
(1246, 38, 556),
(1247, 38, 549),
(1248, 38, 551),
(1249, 38, 553),
(1250, 38, 555),
(1251, 38, 548),
(1252, 38, 550),
(1319, 42, 406),
(1320, 42, 408),
(1321, 42, 410),
(1322, 42, 407),
(1323, 42, 409),
(1324, 42, 411),
(1325, 43, 418),
(1326, 43, 421),
(1327, 43, 413),
(1328, 43, 417),
(1329, 43, 420),
(1330, 43, 415),
(1354, 49, 379),
(1355, 49, 378),
(1356, 50, 385),
(1359, 52, 382),
(1360, 53, 383),
(1391, 58, 349),
(1412, 65, 560),
(1413, 65, 562),
(1414, 65, 557),
(1415, 65, 559),
(1416, 65, 561),
(1417, 65, 563),
(1418, 65, 558),
(1442, 72, 352),
(1443, 72, 354),
(1444, 72, 351),
(1445, 72, 353),
(1446, 72, 355),
(1447, 73, 350),
(1462, 30, 486),
(1471, 41, 593),
(1472, 41, 609),
(1473, 41, 625),
(1474, 41, 602),
(1475, 41, 618),
(1476, 41, 634),
(1477, 41, 595),
(1478, 41, 611),
(1479, 41, 627),
(1480, 41, 604),
(1481, 41, 620),
(1482, 41, 636),
(1483, 41, 597),
(1484, 41, 613),
(1485, 41, 629),
(1486, 41, 590),
(1487, 41, 606),
(1488, 41, 622),
(1489, 41, 638),
(1490, 41, 600),
(1491, 41, 615),
(1492, 41, 631),
(1493, 41, 592),
(1494, 41, 608),
(1495, 41, 624),
(1496, 41, 640),
(1497, 41, 601),
(1498, 41, 617),
(1499, 41, 633),
(1500, 41, 594),
(1501, 41, 610),
(1502, 41, 626),
(1503, 41, 603),
(1504, 41, 619),
(1505, 41, 635),
(1506, 41, 596),
(1507, 41, 612),
(1508, 41, 628),
(1509, 41, 589),
(1510, 41, 605),
(1511, 41, 621),
(1512, 41, 637),
(1513, 41, 598),
(1514, 41, 614),
(1515, 41, 630),
(1516, 41, 591),
(1517, 41, 607),
(1518, 41, 623),
(1519, 41, 639),
(1520, 41, 599),
(1521, 41, 616),
(1522, 41, 632),
(1543, 17, 525),
(1544, 17, 520),
(1545, 17, 509),
(1548, 77, 584),
(1549, 77, 585),
(1550, 77, 586),
(1567, 76, 587),
(1568, 76, 588),
(1569, 15, 530),
(1570, 15, 537),
(1573, 34, 465),
(1580, 64, 578),
(1581, 64, 580),
(1582, 64, 582),
(1583, 64, 579),
(1584, 64, 581),
(1585, 64, 583),
(1596, 47, 404),
(1597, 47, 391),
(1598, 47, 393),
(1599, 47, 396),
(1600, 47, 399),
(1601, 47, 390),
(1602, 47, 392),
(1603, 47, 394),
(1604, 47, 398),
(1605, 47, 389),
(1606, 45, 395),
(1607, 45, 401),
(1608, 45, 400),
(1609, 45, 405),
(1610, 46, 397),
(1611, 46, 403),
(1612, 46, 402),
(1613, 44, 414),
(1614, 44, 419),
(1615, 44, 412),
(1616, 44, 416),
(1629, 32, 464),
(1630, 32, 469),
(1631, 78, 23),
(1632, 78, 2),
(1633, 78, 15),
(1634, 78, 22),
(1635, 78, 38),
(1636, 79, 18),
(1637, 79, 31),
(1638, 79, 4),
(1639, 79, 29),
(1646, 80, 32),
(1647, 80, 33),
(1648, 80, 25),
(1649, 80, 21),
(1650, 80, 17),
(1651, 80, 7),
(1661, 81, 576),
(1667, 66, 568),
(1668, 66, 577),
(1669, 67, 570),
(1670, 67, 572),
(1671, 84, 574),
(1672, 84, 575),
(1673, 84, 573),
(1686, 39, 377),
(1687, 39, 374),
(1700, 51, 380),
(1701, 51, 381),
(1708, 71, 655),
(1709, 71, 654),
(1710, 71, 656),
(1711, 71, 653),
(1724, 82, 571),
(1725, 82, 569),
(1734, 40, 641),
(1735, 40, 647),
(1736, 40, 644),
(1737, 40, 646),
(1738, 40, 642),
(1739, 40, 648),
(1740, 40, 643),
(1741, 40, 645),
(1742, 88, 650),
(1743, 88, 649),
(1744, 88, 651),
(1745, 88, 652),
(1746, 12, 12),
(1747, 22, 460),
(1748, 22, 452),
(1749, 22, 455),
(1750, 22, 459),
(1751, 22, 454),
(1752, 22, 456),
(1753, 68, 369),
(1754, 68, 368),
(1755, 69, 370),
(1756, 69, 372),
(1757, 69, 371),
(1758, 69, 373),
(1759, 70, 365),
(1760, 70, 367),
(1761, 70, 366),
(1762, 75, 350),
(1763, 75, 352),
(1764, 75, 353),
(1765, 75, 354),
(1766, 75, 349),
(1767, 75, 355),
(1768, 75, 351),
(1781, 59, 360),
(1782, 59, 362),
(1783, 59, 361),
(1784, 60, 359),
(1785, 61, 363),
(1786, 61, 364),
(1787, 62, 357),
(1788, 63, 358),
(1789, 63, 356),
(1790, 14, 506),
(1791, 14, 515),
(1792, 14, 524),
(1793, 14, 508),
(1794, 14, 517),
(1795, 21, 521),
(1796, 21, 516),
(1797, 21, 507),
(1798, 21, 526),
(1803, 90, 438),
(1804, 90, 441),
(1805, 91, 436),
(1812, 54, 440),
(1813, 54, 442),
(1814, 54, 435),
(1815, 54, 439),
(1824, 85, 424),
(1825, 86, 447),
(1826, 86, 448),
(1827, 87, 449),
(1828, 87, 450),
(1829, 55, 445),
(1830, 55, 444),
(1831, 55, 446),
(1832, 55, 451),
(1833, 56, 422),
(1834, 56, 430),
(1835, 56, 426),
(1836, 56, 427),
(1837, 56, 428),
(1838, 56, 429),
(1839, 56, 431),
(1841, 74, 423),
(1842, 74, 425),
(1845, 92, 437),
(1846, 92, 443),
(1851, 89, 433),
(1853, -1, 434),
(1854, 93, 434),
(1855, 57, 432),
(1856, 48, 376),
(1857, 48, 375),
(1859, 95, 564),
(1860, 95, 565),
(1861, 95, 567);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfil`
--

CREATE TABLE IF NOT EXISTS `tbl_perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `gl_descripcion` varchar(100) NOT NULL,
  `fc_fecha_creacion` datetime NOT NULL,
  `nr_estado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_perfil`
--

INSERT INTO `tbl_perfil` (`id`, `nombre`, `gl_descripcion`, `fc_fecha_creacion`, `nr_estado`) VALUES
(1, 'Administrador', 'Administra el sistema', '2016-07-07 13:41:23', 1),
(2, 'Genérico', 'solo ver', '2016-08-23 17:31:41', 1),
(3, 'Referente Técnico de Inocuidad de Alimentos (DNA)', 'Referente Técnico de Inocuidad de Alimentos (DNA)', '2016-08-23 17:34:07', 1),
(4, 'Jefe Departamento Nutrición y Alimentos (DNA)', 'Jefe Departamento Nutrición y Alimentos (DNA)', '2016-08-23 17:34:56', 1),
(5, 'Jefe de División de Políticas Públicas Saludables y Promoción (DIPOL)', 'Jefe de División de Políticas Públicas Saludables y Promoción (DIPOL)', '2016-08-23 17:35:10', 1),
(6, 'Coordinador/a Nacional de Calidad', 'Coordinador/a Nacional de Calidad', '2016-08-23 17:49:15', 1),
(7, 'Control de Gestión Regional', 'Control de Gestión Regional', '2016-08-23 17:49:30', 1),
(8, 'Encargado/a Documental', 'Encargado/a Documental', '2016-08-23 17:49:44', 1),
(9, 'Coordinador/a de Auditores', 'Coordinador/a de Auditores', '2016-08-23 17:49:56', 1),
(10, 'Auditor/a Líder', 'Auditor/a Líder', '2016-08-23 17:50:13', 1),
(11, 'Auditor/a Interno de Calidad', 'Auditor/a Interno de Calidad', '2016-08-23 17:50:24', 1),
(12, 'Encargado/a Nacional de Proceso', 'Encargado/a Nacional de Proceso', '2016-08-23 17:50:39', 1),
(13, 'Encargado Regional de Proceso', 'Encargado Regional de Proceso', '2016-08-23 17:50:49', 1),
(15, 'prueba de sistemas', 'esta es una prueba', '2016-08-28 15:38:52', 1),
(16, '777', '777', '2016-11-10 12:44:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

CREATE TABLE IF NOT EXISTS `tbl_provincias` (
  `id_provincia` int(11) NOT NULL COMMENT 'Primary key',
  `nombre_provincias` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_provincias`
--

INSERT INTO `tbl_provincias` (`id_provincia`, `nombre_provincias`, `id_region`) VALUES
(1, 'Isla De Pascua', 5),
(2, 'Los Andes', 5),
(3, 'Petorca', 5),
(4, 'Quillota', 5),
(5, 'San Antonio', 5),
(6, 'San Felipe', 5),
(7, 'Valparaiso', 5),
(8, 'Marga Marga', 5),
(9, 'Iquique', 1),
(10, 'Tamarugal', 1),
(11, 'Antofagasta', 2),
(12, 'El Loa', 2),
(13, 'Tocopilla', 2),
(14, 'Copiapó', 3),
(15, 'Chañaral', 3),
(16, 'Huasco', 3),
(17, 'Elqui', 4),
(18, 'Choapa', 4),
(19, 'Limarí', 4),
(20, 'Cachapoal', 6),
(21, 'Cardenal Caro', 6),
(22, 'Colchagua', 6),
(23, 'Talca', 7),
(24, 'Cauquenes', 7),
(25, 'Curicó', 7),
(26, 'Provincia  Linares', 7),
(27, 'Provincia de Concepción', 8),
(28, 'Arauco', 8),
(29, 'Bío-Bío', 8),
(30, 'Ñuble', 8),
(31, 'Cautín', 9),
(32, 'Malleco', 9),
(33, 'Llanquihue', 10),
(34, 'Chiloé', 10),
(35, 'Osorno', 10),
(36, 'Palena', 10),
(37, 'Coihaique', 11),
(38, 'Aysen', 11),
(39, 'Capitán Prat', 11),
(40, 'General Carrera', 11),
(41, 'Magallanes', 12),
(42, 'Antártica Chilena', 12),
(43, 'Tierra del Fuego', 12),
(44, 'Última Esperanza', 12),
(45, 'Santiago', 13),
(46, 'Cordillera', 13),
(47, 'Chacabuco', 13),
(48, 'Maipo', 13),
(49, 'Melipilla', 13),
(50, 'Talagante', 13),
(51, 'Valdivia', 14),
(52, 'Ranco', 14),
(53, 'Arica', 15),
(54, 'Parinacota', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_regiones`
--

CREATE TABLE IF NOT EXISTS `tbl_regiones` (
  `id_region` int(11) NOT NULL COMMENT 'Primary key',
  `nombre_region` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_regiones`
--

INSERT INTO `tbl_regiones` (`id_region`, `nombre_region`) VALUES
(1, 'Región de Tarapacá'),
(2, 'Región de Antofagasta'),
(3, 'Región de Atacama'),
(4, 'Región de Coquimbo'),
(5, 'Región de Valparaíso'),
(6, 'Región de O''Higgins'),
(7, 'Región del Maule'),
(8, 'Región del Biobío'),
(9, 'Región de la Araucanía'),
(10, 'Región de los Lagos'),
(11, 'Región de Aysén'),
(12, 'Región de Magallanes'),
(13, 'Región Metropolitana'),
(14, 'Región de los Ríos'),
(15, 'Región de Arica y Parinacota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud`
--

CREATE TABLE IF NOT EXISTS `tbl_solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `fc_fecha_creacion` datetime NOT NULL,
  `fc_fecha_update` datetime NOT NULL,
  `id_estado_solicitud` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_modifica` int(11) NOT NULL,
  `gl_comentario` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_solicitud`
--

INSERT INTO `tbl_solicitud` (`id_solicitud`, `fc_fecha_creacion`, `fc_fecha_update`, `id_estado_solicitud`, `id_usuario`, `id_usuario_modifica`, `gl_comentario`) VALUES
(1, '2016-12-21 10:43:29', '2016-12-21 11:35:59', 1, 1, 1, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_detalle`
--

CREATE TABLE IF NOT EXISTS `tbl_solicitud_detalle` (
  `id_solicitud_detalle` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_archivo` int(11) NOT NULL,
  `fc_fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_solicitud_detalle`
--

INSERT INTO `tbl_solicitud_detalle` (`id_solicitud_detalle`, `id_solicitud`, `id_archivo`, `fc_fecha_creacion`, `id_usuario`) VALUES
(1, 1, 1, '2016-12-21 10:43:29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_estado`
--

CREATE TABLE IF NOT EXISTS `tbl_solicitud_estado` (
  `id_estado_solicitud` int(11) NOT NULL,
  `nombre_estado_solicitud` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_solicitud_estado`
--

INSERT INTO `tbl_solicitud_estado` (`id_estado_solicitud`, `nombre_estado_solicitud`) VALUES
(1, 'Creación'),
(2, 'Modificación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_actividad` (
  `id_tipo_actividad` int(11) NOT NULL,
  `nombre_tipo_actividad` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_actividad`
--

INSERT INTO `tbl_tipo_actividad` (`id_tipo_actividad`, `nombre_tipo_actividad`) VALUES
(1, 'Reunion'),
(2, 'Auditoria'),
(3, 'Capacitacion'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_respuesta`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_respuesta` (
  `id_tipo_respuesta` int(11) NOT NULL,
  `nombre_tipo_respuesta` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_respuesta`
--

INSERT INTO `tbl_tipo_respuesta` (`id_tipo_respuesta`, `nombre_tipo_respuesta`) VALUES
(1, 'Aceptar Invitacion'),
(2, 'Rechazar Invitacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id` int(11) NOT NULL,
  `rut` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nombres` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bo_password` tinyint(4) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id`, `rut`, `nombres`, `apellidos`, `email`, `password`, `bo_password`, `id_perfil`) VALUES
(1, '11111111-1', 'ADMINISTRADOR', 'calidad', 'pablo@cosof.cl', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1),
(2, '13366564-1', 'Claudia', 'Chacon', 'claudia.chacon@cosof.cl', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, 1),
(3, '15068353-k', 'carlos', 'escalona', 'carlos.escalona@cosof.cl', 'qmy1emz7nlw6hmqxzgo8kw8840rpdmlr', 1, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `tbl_actividad_detalle`
--
ALTER TABLE `tbl_actividad_detalle`
  ADD PRIMARY KEY (`id_actividad_detalle`);

--
-- Indices de la tabla `tbl_actividad_usuario`
--
ALTER TABLE `tbl_actividad_usuario`
  ADD PRIMARY KEY (`id_actividad_usuario`);

--
-- Indices de la tabla `tbl_archivos`
--
ALTER TABLE `tbl_archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `tbl_archivos_actividad`
--
ALTER TABLE `tbl_archivos_actividad`
  ADD PRIMARY KEY (`id_archivo_actividad`);

--
-- Indices de la tabla `tbl_archivos_versiones`
--
ALTER TABLE `tbl_archivos_versiones`
  ADD PRIMARY KEY (`id_archivo_versiones`);

--
-- Indices de la tabla `tbl_archivo_estado`
--
ALTER TABLE `tbl_archivo_estado`
  ADD PRIMARY KEY (`id_estado_archivo`);

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `tbl_carpeta_archivo`
--
ALTER TABLE `tbl_carpeta_archivo`
  ADD PRIMARY KEY (`id_carpeta_archivo`);

--
-- Indices de la tabla `tbl_carpeta_estado`
--
ALTER TABLE `tbl_carpeta_estado`
  ADD PRIMARY KEY (`id_estado_carpeta`);

--
-- Indices de la tabla `tbl_comunas`
--
ALTER TABLE `tbl_comunas`
  ADD PRIMARY KEY (`id_comunas`),
  ADD KEY `prov_ia_id` (`id_provincias`);

--
-- Indices de la tabla `tbl_feriados`
--
ALTER TABLE `tbl_feriados`
  ADD PRIMARY KEY (`id_dia_feriado`);

--
-- Indices de la tabla `tbl_oficinas`
--
ALTER TABLE `tbl_oficinas`
  ADD PRIMARY KEY (`id_oficina`);

--
-- Indices de la tabla `tbl_oficinas_vs_comunas`
--
ALTER TABLE `tbl_oficinas_vs_comunas`
  ADD PRIMARY KEY (`id_oficinas_vs_comunas`),
  ADD KEY `ofi_ia_id` (`id_oficina`),
  ADD KEY `com_ia_id` (`id_comuna`);

--
-- Indices de la tabla `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_region` (`id_region`);

--
-- Indices de la tabla `tbl_regiones`
--
ALTER TABLE `tbl_regiones`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `tbl_solicitud_detalle`
--
ALTER TABLE `tbl_solicitud_detalle`
  ADD PRIMARY KEY (`id_solicitud_detalle`);

--
-- Indices de la tabla `tbl_solicitud_estado`
--
ALTER TABLE `tbl_solicitud_estado`
  ADD PRIMARY KEY (`id_estado_solicitud`);

--
-- Indices de la tabla `tbl_tipo_actividad`
--
ALTER TABLE `tbl_tipo_actividad`
  ADD PRIMARY KEY (`id_tipo_actividad`);

--
-- Indices de la tabla `tbl_tipo_respuesta`
--
ALTER TABLE `tbl_tipo_respuesta`
  ADD PRIMARY KEY (`id_tipo_respuesta`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_actividad_detalle`
--
ALTER TABLE `tbl_actividad_detalle`
  MODIFY `id_actividad_detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_actividad_usuario`
--
ALTER TABLE `tbl_actividad_usuario`
  MODIFY `id_actividad_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_archivos`
--
ALTER TABLE `tbl_archivos`
  MODIFY `id_archivo` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_archivos_actividad`
--
ALTER TABLE `tbl_archivos_actividad`
  MODIFY `id_archivo_actividad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_archivo_estado`
--
ALTER TABLE `tbl_archivo_estado`
  MODIFY `id_estado_archivo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `id_bitacora` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_carpeta_archivo`
--
ALTER TABLE `tbl_carpeta_archivo`
  MODIFY `id_carpeta_archivo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_feriados`
--
ALTER TABLE `tbl_feriados`
  MODIFY `id_dia_feriado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_oficinas`
--
ALTER TABLE `tbl_oficinas`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT de la tabla `tbl_oficinas_vs_comunas`
--
ALTER TABLE `tbl_oficinas_vs_comunas`
  MODIFY `id_oficinas_vs_comunas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',AUTO_INCREMENT=1862;
--
-- AUTO_INCREMENT de la tabla `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `tbl_regiones`
--
ALTER TABLE `tbl_regiones`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitud_detalle`
--
ALTER TABLE `tbl_solicitud_detalle`
  MODIFY `id_solicitud_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
