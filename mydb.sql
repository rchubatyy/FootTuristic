-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 05-Jan-2015 às 20:46
-- Versão do servidor: 5.1.41
-- versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;
-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` double(10,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `sessao` text NOT NULL,
  `img` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `carrinho`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Morada` varchar(45) NOT NULL,
  `Localidade` varchar(45) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `NIF` int(11) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `Nome`, `Morada`, `Localidade`, `Telefone`, `NIF`, `Username`, `Password`) VALUES
(1, 'Pedro Campos', 'Caminho da Penteada, 23', 'Funchal', 961234567, 123456789, 'pcampos', '12345'),
(2, 'Wilson Jesus Carvalho Santos', 'Rua de São Martinho, nº 201', 'Funchal', 967897218, 987654321, 'willy93', '12345'),
(4, 'Joao Vitor Rodrigues', 'Caminho do Maritimo, 10', 'Funchal', 912457731, 912346782, 'joaodoria', '12345');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Quantidade` smallint(6) NOT NULL,
  `Clientes_id` int(11) NOT NULL,
  `Produtos_id` int(11) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Data` varchar(45) NOT NULL,
  `Fabricas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Clientes_id` (`Clientes_id`),
  KEY `Produtos_id` (`Produtos_id`),
  KEY `fk_fab_compras` (`Fabricas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`id`, `Quantidade`, `Clientes_id`, `Produtos_id`, `Estado`, `Data`, `Fabricas_id`) VALUES
(17, 4, 4, 2, 'Concluida', '2014-12-07', 1),
(19, 1, 2, 2, 'Entregar', '2014-12-11', 1),
(20, 1, 2, 2, 'Concluida', '2014-12-11', 2),
(21, 3, 4, 12, 'Concluida', '2014-12-21', 2),
(22, 1, 2, 12, 'Concluida', '2014-12-21', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricas`
--

DROP TABLE IF EXISTS `fabricas`;
CREATE TABLE IF NOT EXISTS `fabricas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Morada` varchar(45) NOT NULL,
  `Localidade` varchar(45) NOT NULL,
  `Gerentes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Gerentes_id` (`Gerentes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `fabricas`
--

INSERT INTO `fabricas` (`id`, `Morada`, `Localidade`, `Gerentes_id`) VALUES
(1, 'Estrada da Alfarrobeira, 26', 'Lisboa', 1),
(2, 'Avenida Pinto da Costa, 23', 'Porto', 2),
(3, 'Estrada do Cavaco', 'Faro', 3),
(4, 'Caminho da Ajuda, 20', 'Funchal', 4),
(5, 'Estrada dos Pescadores, 53', 'Ponta Delgada', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerentes`
--

DROP TABLE IF EXISTS `gerentes`;
CREATE TABLE IF NOT EXISTS `gerentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `Localidade` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `gerentes`
--

INSERT INTO `gerentes` (`id`, `Nome`, `Telefone`, `Localidade`, `Username`, `Password`) VALUES
(1, 'Manuel da Ponte', 217321449, 'Lisboa', 'mponte', 'ponte1'),
(2, 'João Miguel Rodrigues', 229909921, 'Porto', 'jmrodrigues', 'jmr007'),
(3, 'Joaquim Ferreira Almeida', 289231225, 'Faro', 'jocaalmeida', 'jfa2'),
(4, 'Isabel Gouveia Gomes', 291792288, 'Funchal', 'isagomes', 'isabelgg'),
(5, 'Maria Fernanda Pires', 295898123, 'Ponta Delgada', 'mariapires', 'mafepi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojistas`
--

DROP TABLE IF EXISTS `lojistas`;
CREATE TABLE IF NOT EXISTS `lojistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NomeLoja` varchar(45) NOT NULL,
  `Morada` varchar(45) NOT NULL,
  `Localidade` varchar(45) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `NIF` int(11) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `lojistas`
--

INSERT INTO `lojistas` (`id`, `NomeLoja`, `Morada`, `Localidade`, `Telefone`, `NIF`, `Username`, `Password`) VALUES
(1, 'ZARA', 'Avenida do Benfica, 10', 'Lisboa', 219009213, 221331, 'zaralisboa', 'zlisbon'),
(2, 'Massimo Dutti', 'Rua do Lumiar, 3', 'Lisboa', 219982321, 121131, 'mduttilisboa', 'mdutti'),
(3, 'ZARA', 'Rua do Morcão de Cima, 201', 'Porto', 229112355, 3216161, 'zaraporto', 'zporto'),
(4, 'Bershka', 'Caminho do Amparo, 104', 'Funchal', 291040298, 20531530, 'bershkafunchal', 'bfunc'),
(5, 'Massimo Dutti', 'Estrada das Docas, 1', 'Ponta Delgada', 289100219, 223431, 'mduttipdelgada', 'mdpdel'),
(6, 'Bershka', 'Estrada Dr. Alferes da Silva, 19', 'Faro', 289010241, 102934411, 'bershkafaro', 'bfaro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosencomenda`
--

DROP TABLE IF EXISTS `pedidosencomenda`;
CREATE TABLE IF NOT EXISTS `pedidosencomenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Quantidade` smallint(6) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Gerentes_id` int(11) NOT NULL,
  `Lojistas_id` int(11) NOT NULL,
  `Produtos_id` int(11) NOT NULL,
  `Data` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Lojistas_id_fk` (`Lojistas_id`),
  KEY `Gerentes_id_fk` (`Gerentes_id`),
  KEY `Produtos_id_fk1` (`Produtos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `pedidosencomenda`
--

INSERT INTO `pedidosencomenda` (`id`, `Quantidade`, `Estado`, `Gerentes_id`, `Lojistas_id`, `Produtos_id`, `Data`) VALUES
(1, 15, 'Concluida', 1, 1, 1, '2014-12-06'),
(2, 10, 'Concluida', 1, 2, 5, '2014-12-06'),
(3, 20, 'Concluida', 1, 3, 4, '2014-12-06'),
(4, 5, 'Concluida', 1, 5, 10, '2014-12-06'),
(5, 3, 'Concluida', 1, 1, 2, '2014-12-06'),
(6, 76, 'Concluida', 1, 1, 5, '2014-12-06'),
(7, 15, 'Concluida', 1, 1, 6, '2014-12-07'),
(9, 10, 'Concluida', 3, 1, 4, '2014-12-07'),
(10, 20, 'Concluida', 1, 1, 2, '2014-12-07'),
(11, 20, 'Concluida', 1, 1, 2, '2014-12-08'),
(12, 10, 'Concluida', 2, 1, 3, '2014-12-11'),
(13, 5, 'Concluida', 1, 1, 1, '2014-12-11'),
(14, 2, 'Concluida', 1, 1, 5, '2014-12-11'),
(16, 2, 'Em Espera', 2, 1, 5, '2014-12-21'),
(17, 5, 'Concluida', 5, 3, 8, '2014-12-21'),
(19, 2, 'Em Espera', 2, 1, 6, '2015-01-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `Genero` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Qtd_Vendas` int(11) NOT NULL,
  `Imagem` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `Nome`, `Preco`, `Genero`, `Tipo`, `Qtd_Vendas`, `Imagem`) VALUES
(1, 'Spider Shoe', '29.99', 'Homem', 'Casual', 0, 'sapato01.jpg'),
(2, 'Oxford Shoe', '34.99', 'Homem', 'Casual', 14, 'sapato02.jpg'),
(3, 'Jet 3100H', '39.99', 'Homem', 'Casual', 0, 'sapato03.jpg'),
(4, 'Hush Puppies', '29.99', 'Senhora', 'Casual', 0, 'sapato04.jpg'),
(5, 'Bata Black', '35.00', 'Senhora', 'Casual', 0, 'sapato05.jpg'),
(6, 'North Star', '31.49', 'Senhora', 'Casual', 0, 'sapato06.jpg'),
(7, 'Gel-Nimbus 16', '165.00', 'Homem', 'Desporto', 0, 'sapato07.jpg'),
(8, 'MT610', '75.00', 'Homem', 'Desporto', 0, 'sapato08.jpg'),
(9, 'Wave Inspire 10', '133.00', 'Homem', 'Desporto', 0, 'sapato09.jpg'),
(10, 'Gel-Sonoma', '80.00', 'Senhora', 'Desporto', 0, 'sapato10.jpg'),
(11, 'Gel-Cumulus 16', '117.00', 'Senhora', 'Desporto', 0, 'sapato11.jpg'),
(12, 'XA Pro 3D Ultra 2W', '115.00', 'Senhora', 'Desporto', 4, 'sapato12.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Qtd_Stock` smallint(6) NOT NULL,
  `Produtos_id` int(11) NOT NULL,
  `Fabricas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Produtos_id_fk` (`Produtos_id`),
  KEY `Fabricas_id_fk` (`Fabricas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id`, `Qtd_Stock`, `Produtos_id`, `Fabricas_id`) VALUES
(1, 10, 1, 1),
(2, 5, 2, 1),
(3, 25, 3, 1),
(4, 10, 4, 1),
(5, 13, 5, 1),
(6, 15, 6, 1),
(7, 21, 7, 1),
(8, 10, 8, 1),
(9, 15, 9, 1),
(10, 12, 10, 1),
(11, 24, 11, 1),
(12, 33, 12, 1),
(13, 10, 1, 2),
(14, 10, 2, 2),
(15, 1, 3, 2),
(16, 10, 4, 2),
(17, 10, 5, 2),
(18, 10, 6, 2),
(19, 10, 7, 2),
(20, 10, 8, 2),
(21, 10, 9, 2),
(22, 10, 10, 2),
(23, 10, 11, 2),
(24, 7, 12, 2),
(25, 10, 1, 3),
(26, 10, 2, 3),
(27, 10, 3, 3),
(28, 10, 4, 3),
(29, 10, 5, 3),
(30, 10, 6, 3),
(31, 10, 7, 3),
(32, 10, 8, 3),
(33, 10, 9, 3),
(34, 10, 10, 3),
(35, 10, 11, 3),
(36, 10, 12, 3),
(37, 10, 1, 4),
(38, 10, 2, 4),
(39, 10, 3, 4),
(40, 10, 4, 4),
(41, 10, 5, 4),
(42, 10, 6, 4),
(43, 10, 7, 4),
(44, 10, 8, 4),
(45, 10, 9, 4),
(46, 10, 10, 4),
(47, 10, 11, 4),
(48, 10, 12, 4),
(49, 10, 1, 5),
(50, 10, 2, 5),
(51, 10, 3, 5),
(52, 10, 4, 5),
(53, 10, 5, 5),
(54, 10, 6, 5),
(55, 10, 7, 5),
(56, 5, 8, 5),
(57, 10, 9, 5),
(58, 10, 10, 5),
(59, 10, 11, 5),
(60, 9, 12, 5);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `Clientes_id` FOREIGN KEY (`Clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`Fabricas_id`) REFERENCES `fabricas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Produtos_id` FOREIGN KEY (`Produtos_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `fabricas`
--
ALTER TABLE `fabricas`
  ADD CONSTRAINT `Gerentes_id` FOREIGN KEY (`Gerentes_id`) REFERENCES `gerentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidosencomenda`
--
ALTER TABLE `pedidosencomenda`
  ADD CONSTRAINT `Gerentes_id_fk` FOREIGN KEY (`Gerentes_id`) REFERENCES `gerentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Lojistas_id_fk` FOREIGN KEY (`Lojistas_id`) REFERENCES `lojistas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Produtos_id_fk1` FOREIGN KEY (`Produtos_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `Fabricas_id_fk` FOREIGN KEY (`Fabricas_id`) REFERENCES `fabricas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Produtos_id_fk` FOREIGN KEY (`Produtos_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
