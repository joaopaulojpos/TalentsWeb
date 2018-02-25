-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Fev-2018 às 00:53
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cd_empresa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
