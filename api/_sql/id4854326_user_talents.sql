-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Fev-2018 às 05:52
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4854326_user_talents`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `cd_empresa` int(11) NOT NULL,
  `nr_cnpj` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `ds_razao_social` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ds_nome_fantasia` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nr_porte` int(11) NOT NULL,
  `ds_responsavel_cadastro` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ds_area_atuacacao` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ds_site` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_telefone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ds_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ds_senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`cd_empresa`, `nr_cnpj`, `ds_razao_social`, `ds_nome_fantasia`, `nr_porte`, `ds_responsavel_cadastro`, `ds_area_atuacacao`, `ds_site`, `ds_telefone`, `ds_email`, `ds_senha`) VALUES
(1, '92834389000199', 'Talents LTDA.', 'Talents', 2, 'Bruno Felix', 'Desenvolvimento de sistemas', 'https://jpo1994.000webhostapp.com/', '81995782171', 'brunofelixbarbosa123@hotmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE `profissional` (
  `cd_profissional` int(11) NOT NULL,
  `b_foto` varchar(60) NOT NULL,
  `ds_senha` varchar(32) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `ds_email` varchar(60) NOT NULL,
  `nr_latitude` int(11) NOT NULL,
  `nr_longitude` int(11) NOT NULL,
  `tp_conta` varchar(1) NOT NULL,
  `tp_sexo` enum('M','F') NOT NULL,
  `ds_nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`cd_profissional`, `b_foto`, `ds_senha`, `dt_nascimento`, `ds_email`, `nr_latitude`, `nr_longitude`, `tp_conta`, `tp_sexo`, `ds_nome`) VALUES
(1, 'teste', '123', '1994-10-25', 'maikon.silva@hotmail.com.br', 100, 100, 'S', 'M', 'Maikon Silva de Oliveira');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cd_empresa`);

--
-- Indexes for table `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`cd_profissional`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profissional`
--
ALTER TABLE `profissional`
  MODIFY `cd_profissional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
