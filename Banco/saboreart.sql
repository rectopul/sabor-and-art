-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/02/2015 às 11:39
-- Versão do servidor: 5.6.17
-- Versão do PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `saboreart`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `itensvenda`
--

CREATE TABLE IF NOT EXISTS `itensvenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` varchar(10) DEFAULT NULL,
  `idProduto` varchar(10) DEFAULT NULL,
  `quantidadeProduto` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(6) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `produto` text NOT NULL,
  `valor_custo` varchar(8) NOT NULL,
  `valor_venda` varchar(8) NOT NULL,
  `data_cad` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `products`
--

INSERT INTO `products` (`id`, `categoria`, `produto`, `valor_custo`, `valor_venda`, `data_cad`) VALUES
('1', 'Bebida', 'Suco de morango com leite', '2', '4', '2015-02-02 02:45:09'),
('10', 'lanche', 'X - tudo', '9', '12', '2015-02-02 02:46:07'),
('12a', 'Aleatoria', 'Primeiro produto de testes', '12', '15', '2015-01-30 16:30:48'),
('2', 'Lanche', 'X-Salada Bacon', '4', '8.50', '2015-01-31 14:24:02'),
('3', 'Lanche', 'Mixto Quente', '2', '5', '2015-01-31 14:24:29'),
('4', 'Bebida', 'Suco de Cajú', '1,50', '2', '2015-01-30 16:59:53'),
('4a', 'Lanche', 'X-Egg', '6', '10', '2015-01-31 14:25:00'),
('5', 'Bebida', 'Coca Cola 600ml', '2.5', '6', '2015-02-02 02:43:35'),
('6', 'Bebida', 'Pepsi 250 ml', '1.5', '2.5', '2015-02-02 02:48:36'),
('7', 'Bebida', 'Agua', '1', '2', '2015-02-02 02:48:06'),
('8', 'Bebida', 'Sprite 600 ml', '3', '6', '2015-02-02 02:47:36'),
('9', 'Bebida', 'Fanta 250 ml', '2.5', '3', '2015-02-02 02:47:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
