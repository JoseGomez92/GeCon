-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-02-2019 a las 19:12:28
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gecon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlaces`
--

CREATE TABLE IF NOT EXISTS `enlaces` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `enlaces`
--

INSERT INTO `enlaces` (`id`, `url`, `nombre`, `id_tipo`) VALUES
(3, 'https://www.deezer.com', 'Deezer', 1),
(10, 'https://www.xatakaciencia.com/', 'Xataka Ciencia', 2),
(13, 'http://php.net/manual/es/index.php', 'Documentacion PHP', 3),
(19, 'https://www.francisol.com/index.html', 'Francisol', 7),
(21, 'https://actualidad.rt.com/tag/Ciencia', 'Actualidad RT - Ciencias', 2),
(22, 'https://elpais.com/elpais/ciencia.html', 'El Pais - Ciencia', 2),
(23, 'https://www.marca.com/', 'Marca', 14),
(24, 'https://as.com/', 'AS', 14),
(25, 'https://elpais.com/deportes/', 'El Pais - Deportes', 14),
(26, 'http://espndeportes.espn.com/', 'ESPN', 14),
(28, 'https://www.elmundo.es/', 'El mundo', 16),
(29, 'https://www.investigacionyciencia.es/', 'InvestigaciÃ³n y ciencia', 2),
(30, 'https://www.filmaffinity.com/es/main.html', 'Filmaffinity', 17),
(31, 'https://www.netflix.com/es/', 'Netflix', 17),
(33, 'https://www.imdb.com/', 'IMDb', 17),
(35, 'https://www.youtube.com/?gl=ES&hl=es', 'Youtube', 17),
(36, 'https://soundcloud.com/stream', 'Soundcloud', 1),
(37, 'http://www.rtve.es/noticias/', 'Rtve', 11),
(38, 'https://www.elmundo.es/ultimas-noticias.html', 'El Mundo', 11),
(39, 'https://www.20minutos.es/', '20 Minutos', 11),
(40, 'https://andujar.ideal.es/', 'IDEAL - Andujar', 11),
(41, 'https://elpais.com/tag/fecha/ultimahora', 'El Pais - Ultima Hora', 11),
(42, 'https://music.youtube.com/', 'Youtube Music', 1),
(43, 'https://www.spotify.com/es/', 'Spotify', 1),
(44, 'https://es.stackoverflow.com/', 'Stack Overflow', 3),
(45, 'https://www.w3schools.com/', 'W3School', 3),
(46, 'https://www.genbeta.com/', 'Genbeta', 3),
(51, 'https://music.youtube.com/watch?v=bC0HlNMJqWI&list=PLSr_oFUba1jtSaKlNy2j14TJGORbHQwoB', 'Enlace 1.1', 28),
(52, 'https://music.youtube.com/watch?v=bC0HlNMJqWI&list=PLSr_oFUba1jtSaKlNy2j14TJGORbHQwoB', 'Enlace 2', 28),
(53, 'https://www.genbeta.com/a-fondo/tres-aplicaciones-para-ahorrar-mucha-bateria-todos-macbook-apple', 'Enlace 3', 27),
(55, 'https://www.primevideo.com/', 'Amazon Videos', 42),
(57, 'https://www.netflix.com/es/', 'Netflix', 42),
(58, 'https://series.hboespana.com/?b=1&utm_expid=.0Z_wenQTQFSq9CLHreHguQ.1&utm_referrer=', 'HBO', 42),
(59, 'https://www.muyinteresante.es/ciencia', 'Muy Interesante', 45),
(61, 'https://es.dplay.com/', 'DPlay', 42),
(62, 'https://www.xatakafoto.com/', 'Xataka Foto', 12),
(63, 'https://www.dzoom.org.es/', 'DZoom', 12),
(64, 'https://www.dxomark.com/', 'DXoMark', 12),
(65, 'https://www.dpreview.com/', 'DPReview', 12),
(66, 'https://www.photolari.com/', 'Photolari', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_enlace`
--

CREATE TABLE IF NOT EXISTS `tipos_enlace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `tipos_enlace`
--

INSERT INTO `tipos_enlace` (`id`, `id_usuario`, `nombre`, `imagen`) VALUES
(1, 10, 'Musica', '10_Musica.png'),
(2, 10, 'Ciencia', '10_Ciencia.png'),
(3, 10, 'DeV', '10_DeV.png'),
(11, 10, 'Noticias', '10_Noticias.png'),
(12, 10, 'Fotografia', '10_Fotografias.png'),
(14, 10, 'Deportes', '10_Deportes.png'),
(16, 11, 'Noticias', '11_Noticias.png'),
(17, 10, 'Cine', '10_Cine.png'),
(27, 13, 'Categoria 1', '13_Categoria 1.png'),
(28, 13, 'Categoria 2', '13_Categoria 2.png'),
(42, 14, 'Streaming de cine', '14_Cine.png'),
(45, 14, 'Ciencia', '14_Ciencia.png'),
(46, 14, 'Redes Sociales', '14_RedesSociales.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasenia` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `correo`, `contrasenia`, `fecha_alta`) VALUES
(1, 'user', 'usuario@correo.es', 'pass', '2019-02-08 15:58:18'),
(10, 'jose', 'jose@jose.es', 'pass', '2019-02-08 21:41:12'),
(14, 'a', 'a@a.es', 'a', '2019-02-23 00:34:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
