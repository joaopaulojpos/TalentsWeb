-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 06-Mar-2018 às 23:31
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4854326_db_talents`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `cd_cargo` int(11) NOT NULL,
  `ds_cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `ds_curso` varchar(50) DEFAULT NULL,
  `cd_curso` int(11) NOT NULL,
  `ds_instituicao` varchar(50) DEFAULT NULL,
  `cd_formacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `ds_razao_social` varchar(100) DEFAULT NULL,
  `ds_nome_fantasia` varchar(100) DEFAULT NULL,
  `nr_porte` varchar(50) DEFAULT NULL,
  `ds_nome_responsavel` varchar(100) DEFAULT NULL,
  `ds_area_atuacao` varchar(100) DEFAULT NULL,
  `ds_site` varchar(50) DEFAULT NULL,
  `ds_telefone` varchar(15) DEFAULT NULL,
  `nr_cnpj` int(11) DEFAULT NULL,
  `cd_empresa` int(11) NOT NULL,
  `ds_email` varchar(50) DEFAULT NULL,
  `ds_senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`ds_razao_social`, `ds_nome_fantasia`, `nr_porte`, `ds_nome_responsavel`, `ds_area_atuacao`, `ds_site`, `ds_telefone`, `nr_cnpj`, `cd_empresa`, `ds_email`, `ds_senha`) VALUES
('Talents LTDA.', 'Talents', '2', 'Bruno Felix', 'Desenvolvimento de sistemas', 'www.gotalents.com.br', '81995782171', 362935730, 1, 'bruno', '123456'),
('123', '123', '123', '123', '123', '123', '123', 123, 2, '123', '123'),
('123', '123', '123', '123', '123', '123', '123', 123, 3, '123', '123'),
('aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 0, 4, 'aa', NULL),
('empresa nova', 'empresa nova', 'empresa nova', 'empresa nova', 'empresa nova', 'empresa nova', 'empresa nova', 0, 7, 'empresa nova', NULL),
('teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 0, 12, 'teste', NULL),
('teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 0, 13, 'teste bruno', 'teste bruno'),
('teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 'teste bruno', 0, 14, 'teste bruno', 'teste bruno'),
('novo', 'novo', 'novo', 'novo', 'novo', 'novo', 'novo', 0, 15, 'novo', 'novo'),
('teste', 'teste', 'teste', 'aa', 'aa', 'aa', 'aa', 123456, 16, 'bb', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao`
--

CREATE TABLE `formacao` (
  `cd_formacao` int(11) NOT NULL,
  `ds_formacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidade`
--

CREATE TABLE `habilidade` (
  `cd_habilidade` int(11) NOT NULL,
  `ds_habilidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma`
--

CREATE TABLE `idioma` (
  `cd_idioma` int(11) NOT NULL,
  `ds_idioma` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcao_perfil_comportamental`
--

CREATE TABLE `opcao_perfil_comportamental` (
  `ds_resposta` varchar(50) DEFAULT NULL,
  `ds_resultado` float DEFAULT NULL,
  `cd_opcao_perfil_comportamental` int(11) NOT NULL,
  `cd_pergunta_perfil_comportamental` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta_perfil_comportamental`
--

CREATE TABLE `pergunta_perfil_comportamental` (
  `cd_pergunta_perfil_comportamental` int(11) NOT NULL,
  `ds_pergunta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE `profissional` (
  `ds_nome` varchar(100) DEFAULT NULL,
  `ds_email` varchar(50) DEFAULT NULL,
  `b_foto` varchar(32) DEFAULT NULL,
  `ds_senha` varchar(50) DEFAULT NULL,
  `nr_longitude` float DEFAULT NULL,
  `tp_sexo` varchar(1) DEFAULT NULL,
  `tp_conta` varchar(1) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `nr_latitude` float DEFAULT NULL,
  `cd_profissional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`ds_nome`, `ds_email`, `b_foto`, `ds_senha`, `nr_longitude`, `tp_sexo`, `tp_conta`, `dt_nascimento`, `nr_latitude`, `cd_profissional`) VALUES
('TJ Batera', 'tjbatera', '/semfoto.jpg', '123456', 24.12, 'M', '1', '2017-01-11', -897.01, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_cargo`
--

CREATE TABLE `profissional_cargo` (
  `ds_empresa` varchar(50) DEFAULT NULL,
  `ds_inicio` datetime DEFAULT NULL,
  `ds_fim` date DEFAULT NULL,
  `cd_cargo` int(11) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_curso`
--

CREATE TABLE `profissional_curso` (
  `tp_certificado_validado` varchar(1) DEFAULT NULL,
  `dt_inicio` date DEFAULT NULL,
  `nr_cerificado` int(11) DEFAULT NULL,
  `dt_fim` date DEFAULT NULL,
  `nr_periodo` int(11) DEFAULT NULL,
  `ds_instituicao` varchar(50) DEFAULT NULL,
  `cd_curso` int(11) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_habilidade`
--

CREATE TABLE `profissional_habilidade` (
  `nr_nivel` int(11) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL,
  `cd_habilidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_idioma`
--

CREATE TABLE `profissional_idioma` (
  `nr_nivel` int(11) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL,
  `cd_idioma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_perfil_comportamental`
--

CREATE TABLE `profissional_perfil_comportamental` (
  `cd_opcao_perfil_comportamental` int(11) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional_vaga`
--

CREATE TABLE `profissional_vaga` (
  `tp_acao` varchar(10) DEFAULT NULL,
  `cd_profissional` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `cd_vaga` int(11) NOT NULL,
  `nr_qtd_vaga` int(11) DEFAULT NULL,
  `ds_observacao` varchar(100) DEFAULT NULL,
  `dt_validade` date DEFAULT NULL,
  `tp_contratacao` varchar(1) DEFAULT NULL,
  `nr_longitude` float DEFAULT NULL,
  `nr_latitude` float DEFAULT NULL,
  `ds_beneficios` varchar(100) DEFAULT NULL,
  `ds_horario_expediente` varchar(100) DEFAULT NULL,
  `dt_criacao` date DEFAULT NULL,
  `ds_titulo` varchar(100) DEFAULT NULL,
  `vl_salario` float DEFAULT NULL,
  `cd_cargo` int(11) DEFAULT NULL,
  `cd_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga_curso`
--

CREATE TABLE `vaga_curso` (
  `cd_formacao` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga_habilidade`
--

CREATE TABLE `vaga_habilidade` (
  `nr_nivel` int(11) DEFAULT NULL,
  `cd_habilidade` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga_idioma`
--

CREATE TABLE `vaga_idioma` (
  `nr_nivel` int(11) DEFAULT NULL,
  `cd_idioma` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cd_cargo`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cd_curso`),
  ADD KEY `cd_formacao` (`cd_formacao`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cd_empresa`);

--
-- Indexes for table `formacao`
--
ALTER TABLE `formacao`
  ADD PRIMARY KEY (`cd_formacao`);

--
-- Indexes for table `habilidade`
--
ALTER TABLE `habilidade`
  ADD PRIMARY KEY (`cd_habilidade`);

--
-- Indexes for table `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`cd_idioma`);

--
-- Indexes for table `opcao_perfil_comportamental`
--
ALTER TABLE `opcao_perfil_comportamental`
  ADD PRIMARY KEY (`cd_opcao_perfil_comportamental`),
  ADD KEY `cd_pergunta_perfil_comportamental` (`cd_pergunta_perfil_comportamental`);

--
-- Indexes for table `pergunta_perfil_comportamental`
--
ALTER TABLE `pergunta_perfil_comportamental`
  ADD PRIMARY KEY (`cd_pergunta_perfil_comportamental`);

--
-- Indexes for table `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`cd_profissional`);

--
-- Indexes for table `profissional_cargo`
--
ALTER TABLE `profissional_cargo`
  ADD KEY `cd_cargo` (`cd_cargo`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `profissional_curso`
--
ALTER TABLE `profissional_curso`
  ADD KEY `cd_curso` (`cd_curso`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `profissional_habilidade`
--
ALTER TABLE `profissional_habilidade`
  ADD KEY `cd_habilidade` (`cd_habilidade`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `profissional_idioma`
--
ALTER TABLE `profissional_idioma`
  ADD KEY `cd_idioma` (`cd_idioma`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `profissional_perfil_comportamental`
--
ALTER TABLE `profissional_perfil_comportamental`
  ADD KEY `cd_opcao_perfil_comportamental` (`cd_opcao_perfil_comportamental`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `profissional_vaga`
--
ALTER TABLE `profissional_vaga`
  ADD KEY `cd_vaga` (`cd_vaga`),
  ADD KEY `cd_profissional` (`cd_profissional`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`cd_vaga`);

--
-- Indexes for table `vaga_curso`
--
ALTER TABLE `vaga_curso`
  ADD KEY `cd_formacao` (`cd_formacao`),
  ADD KEY `cd_vaga` (`cd_vaga`);

--
-- Indexes for table `vaga_habilidade`
--
ALTER TABLE `vaga_habilidade`
  ADD KEY `cd_habilidade` (`cd_habilidade`),
  ADD KEY `cd_vaga` (`cd_vaga`);

--
-- Indexes for table `vaga_idioma`
--
ALTER TABLE `vaga_idioma`
  ADD KEY `cd_idioma` (`cd_idioma`),
  ADD KEY `cd_vaga` (`cd_vaga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cd_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cd_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `formacao`
--
ALTER TABLE `formacao`
  MODIFY `cd_formacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habilidade`
--
ALTER TABLE `habilidade`
  MODIFY `cd_habilidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `idioma`
--
ALTER TABLE `idioma`
  MODIFY `cd_idioma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opcao_perfil_comportamental`
--
ALTER TABLE `opcao_perfil_comportamental`
  MODIFY `cd_opcao_perfil_comportamental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pergunta_perfil_comportamental`
--
ALTER TABLE `pergunta_perfil_comportamental`
  MODIFY `cd_pergunta_perfil_comportamental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profissional`
--
ALTER TABLE `profissional`
  MODIFY `cd_profissional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `cd_vaga` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
