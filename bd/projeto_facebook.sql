-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Nov-2018 às 11:07
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_facebook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos_membros`
--

DROP TABLE IF EXISTS `grupos_membros`;
CREATE TABLE IF NOT EXISTS `grupos_membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `texto` text,
  `id_grupo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_comentarios`
--

DROP TABLE IF EXISTS `posts_comentarios`;
CREATE TABLE IF NOT EXISTS `posts_comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `texto` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_likes`
--

DROP TABLE IF EXISTS `posts_likes`;
CREATE TABLE IF NOT EXISTS `posts_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacionamentos`
--

DROP TABLE IF EXISTS `relacionamentos`;
CREATE TABLE IF NOT EXISTS `relacionamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_de` int(11) DEFAULT NULL,
  `usuario_para` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sexo` tinyint(1) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nome`, `sexo`, `senha`, `bio`) VALUES
(1, 'teste@teste.com', 'Douglas Poma', 0, '81dc9bdb52d04dc20036dbd8313ed055', 'Sou assim alterei  '),
(2, 'douglaspoma@yahoo.com', 'Teste 2', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(3, 'douglas.poma@registrallogistica.com.br', 'Teste 3', 1, '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(4, 'elaine@teste.com', 'Elaine ', 1, '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(5, 'teste@teste.com.br', 'DougTeste', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
