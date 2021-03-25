-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02-Nov-2019 às 21:38
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acervo`
--
CREATE DATABASE IF NOT EXISTS `acervo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `acervo`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo`
--

DROP TABLE IF EXISTS `acervo`;
CREATE TABLE IF NOT EXISTS `acervo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `autor` varchar(60) CHARACTER SET latin1 NOT NULL,
  `ano` int(11) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `ideditora` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ideditora` (`ideditora`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acervo`
--

INSERT INTO `acervo` (`id`, `titulo`, `autor`, `ano`, `preco`, `quantidade`, `tipo`, `ideditora`) VALUES
(48, 'TESTE', 'Lucas', 2000, 90, 9, 3, 4),
(49, 'Lucas', 'Lucas', 2000, 90, 9, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

DROP TABLE IF EXISTS `editora`;
CREATE TABLE IF NOT EXISTS `editora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(1, 'CLARETIANO'),
(2, 'RECORD'),
(3, 'Saraiva'),
(4, 'Pearson');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acervo`
--
ALTER TABLE `acervo`
  ADD CONSTRAINT `acervo_ibfk_1` FOREIGN KEY (`ideditora`) REFERENCES `editora` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
