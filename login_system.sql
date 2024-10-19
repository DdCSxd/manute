-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19-Out-2024 às 19:05
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login_system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `inspecao_inicial`
--

DROP TABLE IF EXISTS `inspecao_inicial`;
CREATE TABLE IF NOT EXISTS `inspecao_inicial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_pqd` varchar(255) NOT NULL,
  `numero_velame` int NOT NULL,
  `numero_involucro` int NOT NULL,
  `data_inspecao` date NOT NULL,
  `data_saida` date DEFAULT NULL,
  `inspecionado_por` varchar(255) NOT NULL,
  `observacoes` text,
  `data_fabricacao` int NOT NULL,
  `remendo` enum('sim','nao') DEFAULT NULL,
  `remendo_painel` int DEFAULT NULL,
  `remendo_secao` int DEFAULT NULL,
  `substituicao` enum('sim','nao') DEFAULT NULL,
  `substituicao_painel` int DEFAULT NULL,
  `substituicao_secao` int DEFAULT NULL,
  `recostura` enum('sim','nao') DEFAULT NULL,
  `recostura_painel` int DEFAULT NULL,
  `recostura_secao` int DEFAULT NULL,
  `troca_linha` enum('sim','nao') DEFAULT NULL,
  `troca_linha_numero` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `inspecao_inicial`
--

INSERT INTO `inspecao_inicial` (`id`, `tipo_pqd`, `numero_velame`, `numero_involucro`, `data_inspecao`, `data_saida`, `inspecionado_por`, `observacoes`, `data_fabricacao`, `remendo`, `remendo_painel`, `remendo_secao`, `substituicao`, `substituicao_painel`, `substituicao_secao`, `recostura`, `recostura_painel`, `recostura_secao`, `troca_linha`, `troca_linha_numero`) VALUES
(1, 't10-B', 12345, 67890, '2024-10-14', '2027-02-20', 'João Silva', 'Nenhuma observação relevante', 2023, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'mc1-1c', 3232, 3333, '2004-10-10', '2024-10-14', '1', 'asdas', 20014, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 't10-R', 1254, 1875, '2024-06-03', '2024-10-14', '1033', 's/a', 112022, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 't10-B', 2254, 3520, '2024-02-10', '2024-10-15', '1033', 's/a', 22023, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 't10-B', 2224, 6453, '2024-06-08', NULL, '1028', NULL, 122024, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 't10-B', 30123, 3035, '2024-09-08', NULL, '1028', 'sa', 22024, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 't10-B', 3035, 4567, '2024-02-08', NULL, '1028', 'sa', 22024, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 't10-R', 32132, 4045, '2024-06-08', NULL, '1027', 'sa', 22024, 'sim', 3, 3, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(9, 't10-B', 8774, 4589, '2019-03-12', NULL, '1033', 's/a', 222004, 'sim', 15, 3, NULL, 0, 0, NULL, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inspecao_paraquedas`
--

DROP TABLE IF EXISTS `inspecao_paraquedas`;
CREATE TABLE IF NOT EXISTS `inspecao_paraquedas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_pqd` varchar(100) NOT NULL,
  `data_fabricacao` date NOT NULL,
  `numero_velame` int NOT NULL,
  `numero_involucro` int NOT NULL,
  `inspecionado_por` int NOT NULL,
  `data_inspecao` date NOT NULL,
  `entrada` date NOT NULL,
  `saida` date NOT NULL,
  `observacoes` text,
  `remendo` tinyint(1) DEFAULT '0',
  `substituicao` tinyint(1) DEFAULT '0',
  `recostura` tinyint(1) DEFAULT '0',
  `troca_linha` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_pqd` (`tipo_pqd`),
  KEY `inspecionado_por` (`inspecionado_por`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `login`, `senha`) VALUES
(1, 'admin', '123456'),
(2, '1033', '92536'),
(3, '1028', '92525');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
