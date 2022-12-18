CREATE DATABASE IF NOT EXISTS `voila` 
USE `voila`;


CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `assunto` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagem` varchar(1000) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_forum_usuarios` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `resposta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_respostas_usuarios` (`id_usuario`),
  KEY `FK_respostas_forum` (`id_forum`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `turma` varchar(200) DEFAULT '2° INFO',
  `password` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `pontos` int(200) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
