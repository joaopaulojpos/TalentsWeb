-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Mar-2018 às 02:17
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
-- Database: `id4854326_db_talents`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `cd_cargo` int(11) NOT NULL,
  `ds_cargo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`cd_cargo`, `ds_cargo`) VALUES
(1, 'Gerente de Administração de Banco de Dados'),
(2, 'Coordenador de Administração de Banco de Dados'),
(3, 'Consultor de Administração de Banco de Dados'),
(4, 'Supervisor de Administração de Banco de Dados'),
(5, 'Administrador de Banco de Dados Sênior'),
(6, 'Administrador de Banco de Dados Pleno'),
(7, 'Administrador de Banco de Dados Júnior'),
(8, 'Analista de Administração de Banco de Dados Sênior'),
(9, 'Analista de Administração de Banco de Dados Pleno'),
(10, 'Analista de Administração de Banco de Dados Júnior'),
(11, 'Trainee de Administração de Banco de Dados'),
(12, 'Assistente de Administração de Banco de Dados'),
(13, 'Auxiliar de Administração de Banco de Dados'),
(14, 'Estagiário de Administração de Banco de Dados'),
(15, 'Gerente de Administração de Redes'),
(16, 'Coordenador de Administração de Redes'),
(17, 'Consultor de Administração de Redes'),
(18, 'Supervisor de Administração de Redes'),
(19, 'Administrador de Redes Sênior'),
(20, 'Administrador de Redes Pleno'),
(21, 'Administrador de Redes Júnior'),
(22, 'Analista de Administração de Redes Sênior'),
(23, 'Analista de Administração de Redes Pleno'),
(24, 'Analista de Administração de Redes Júnior'),
(25, 'Trainee de Administração de Redes'),
(26, 'Assistente de Administração de Redes'),
(27, 'Auxiliar de Administração de Redes'),
(28, 'Estagiário de Administração de Redes'),
(29, 'Gerente de Arquitetura da Informação'),
(30, 'Coordenador de Arquitetura da Informação'),
(31, 'Supervisor de Arquitetura da Informação'),
(32, 'Arquiteto da Informação Sênior'),
(33, 'Arquiteto da Informação Pleno'),
(34, 'Arquiteto da Informação Júnior'),
(35, 'Assistente de Arquitetura da Informação'),
(36, 'Estagiário de Arquitetura da Informação'),
(37, 'Gerente de Conteúdo Web'),
(38, 'Coordenador de Conteúdo Web'),
(39, 'Supervisor de Conteúdo Web'),
(40, 'Analista de Conteúdo Web Sênior'),
(41, 'Analista de Conteúdo Web Pleno'),
(42, 'Analista de Conteúdo Web Júnior'),
(43, 'Trainee de Conteúdo Web'),
(44, 'Assistente de Conteúdo Web'),
(45, 'Auxiliar de Conteúdo Web'),
(46, 'Estagiário de Conteúdo Web'),
(47, 'Gerente de Web Designer'),
(48, 'Coordenador de Criação Web'),
(49, 'Supervisor de Criação Web'),
(50, 'Web Designer Sênior'),
(51, 'Web Designer Pleno'),
(52, 'Web Designer Júnior'),
(53, 'Webmaster Sênior'),
(54, 'Webmaster Pleno'),
(55, 'Webmaster Júnior'),
(56, 'Revisor de Criação Web'),
(57, 'Trainee de Criação Web'),
(58, 'Estagiário de Criação Web'),
(59, 'Diretor de E-Commerce / E-Business'),
(60, 'Gerente de E-Commerce / E-Business'),
(61, 'Coordenador de E-Commerce / E-Business'),
(62, 'Supervisor de E-Commerce / E-Business'),
(63, 'Analista de E-Commerce / E-Business Sênior'),
(64, 'Analista de E-Commerce / E-Business Pleno'),
(65, 'Analista de E-Commerce / E-Business Júnior'),
(66, 'Trainee de E-Commerce / E-Business'),
(67, 'Assistente de E-Commerce / E-Business'),
(68, 'Auxiliar de E-Commerce / E-Business'),
(69, 'Estagiário de E-Commerce / E-Business'),
(70, 'Diretor de Negócios Web'),
(71, 'Gerente de Negócios Web'),
(72, 'Coordenador de Negócios Web'),
(73, 'Supervisor de Negócios Web'),
(74, 'Executivo de Contas de Negócios Web'),
(75, 'Analista de Negócios Web Sênior'),
(76, 'Analista de Negócios Web Pleno'),
(77, 'Analista de Negócios Web Júnior'),
(78, 'Trainee de Negócios Web'),
(79, 'Assistente de Negócios Web'),
(80, 'Auxiliar de Negócios Web'),
(81, 'Estagiário de Negócios Web'),
(82, 'Diretor de Processamento de Dados'),
(83, 'Gerente de Processamento de Dados'),
(84, 'Coordenador de Processamento de Dados'),
(85, 'Supervisor de Processamento de Dados'),
(86, 'Analista de Processamento de Dados Sênior'),
(87, 'Analista de Processamento de Dados Pleno'),
(88, 'Analista de Processamento de Dados Júnior'),
(89, 'Trainee de Processamento de Dados'),
(90, 'Operador de Processamento de Dados'),
(91, 'Assistente de Processamento de Dados'),
(92, 'Auxiliar de Processamento de Dados'),
(93, 'Digitador'),
(94, 'Estagiário de Processamento de Dados'),
(95, 'Diretor de Programação'),
(96, 'Gerente de Programação'),
(97, 'Coordenador de Programação'),
(98, 'Supervisor de Programação'),
(99, 'Analista Programador Sênior'),
(100, 'Analista Programador Pleno'),
(101, 'Analista Programador Júnior'),
(102, 'Programador Sênior'),
(103, 'Programador Pleno'),
(104, 'Programador Júnior'),
(105, 'Assistente de Programação'),
(106, 'Trainee de Programação'),
(107, 'Auxiliar de Programação'),
(108, 'Estagiário de Programação'),
(109, 'Gerente de Qualidade de Software'),
(110, 'Coordenador de Qualidade de Software'),
(111, 'Supervisor de Qualidade de Software'),
(112, 'Analista de Qualidade de Software Sênior'),
(113, 'Analista de Qualidade de Software Pleno'),
(114, 'Analista de Qualidade de Software Júnior'),
(115, 'Assistente de Qualidade de Software'),
(116, 'Estagiário de Qualidade de Software'),
(117, 'Analista de Redes Sociais Sênior'),
(118, 'Analista de Redes Sociais Pleno'),
(119, 'Analista de Redes Sociais Júnior'),
(120, 'Gerente de Segurança da Informação'),
(121, 'Coordenador de Segurança da Informação'),
(122, 'Consultor de Segurança da Informação'),
(123, 'Supervisor de Segurança da Informação'),
(124, 'Analista de Segurança da Informação Sênior'),
(125, 'Analista de Segurança da Informação Pleno'),
(126, 'Analista de Segurança da Informação Júnior'),
(127, 'Assistente de Segurança da Informação'),
(128, 'Estagiário de Segurança da Informação'),
(129, 'Diretor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(130, 'Gerente de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(131, 'Coordenador de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(132, 'Supervisor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(133, 'Consultor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(134, 'Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Sênior'),
(135, 'Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Pleno'),
(136, 'Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Júnior'),
(137, 'Analista de Requisitos Sênior'),
(138, 'Analista de Requisitos Pleno'),
(139, 'Analista de Requisitos Júnior'),
(140, 'Analista de Testes Sênior'),
(141, 'Analista de Testes Pleno'),
(142, 'Analista de Testes Júnior'),
(143, 'Trainee de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(144, 'Assistente de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(145, 'Auxiliar de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(146, 'Estagiário de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
(147, 'Diretor de Suporte Técnico em Informática – Help Desk'),
(148, 'Gerente de Suporte Técnico em Informática – Help Desk'),
(149, 'Coordenador de Suporte Técnico em Informática – Help Desk'),
(150, 'Supervisor de Suporte Técnico em Informática – Help Desk'),
(151, 'Consultor de Suporte Técnico em Informática – Help Desk'),
(152, 'Analista de Suporte Técnico em Informática – Help Desk Sênior'),
(153, 'Analista de Suporte Técnico em Informática – Help Desk Pleno'),
(154, 'Analista de Suporte Técnico em Informática – Help Desk Júnior'),
(155, 'Técnico de Suporte em Informática – Help Desk'),
(156, 'Trainee de Suporte Técnico em Informática – Help Desk'),
(157, 'Assistente de Suporte Técnico em Informática – Help Desk'),
(158, 'Auxiliar de Suporte Técnico em Informática – Help Desk'),
(159, 'Estagiário de Suporte Técnico em Informática – Help Desk'),
(160, 'Diretor de Tecnologia da Informação'),
(161, 'Gerente de Tecnologia da Informação'),
(162, 'Consultor de Tecnologia da Informação'),
(163, 'Coordenador de Tecnologia da Informação'),
(164, 'Supervisor de Tecnologia da Informação'),
(165, 'Analista de Tecnologia da Informação Sênior'),
(166, 'Analista de Tecnologia da Informação Pleno'),
(167, 'Analista de Tecnologia da Informação Júnior'),
(168, 'Trainee de Tecnologia da Informação'),
(169, 'Assistente de Tecnologia da Informação'),
(170, 'Auxiliar de Tecnologia da Informação'),
(171, 'Estagiário de Tecnologia da Informação'),
(172, 'Diretor de Web Development'),
(173, 'Gerente de Web Development'),
(174, 'Coordenador de Web Development'),
(175, 'Supervisor de Web Development'),
(176, 'Analista de Web Development Sênior'),
(177, 'Analista de Web Development Pleno'),
(178, 'Analista de Web Development Júnior'),
(179, 'Trainee de Web Development'),
(180, 'Assistente de Web Development'),
(181, 'Auxiliar de Web Development'),
(182, 'Estagiário de Web Development');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `ds_curso` varchar(300) DEFAULT NULL,
  `cd_curso` int(11) NOT NULL,
  `cd_formacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`ds_curso`, `cd_curso`, `cd_formacao`) VALUES
('Análise e desenvolvimento de sistemas', 1, 1),
('Sistema da informação', 2, 1),
('Engenharia da computação', 3, 1),
('Ciências da computação', 4, 1),
('Técnico em informática', 5, 2),
('Engenharia de produção', 6, 1),
('Redes de computadores', 7, 1),
('Técnico em redes de computadores', 8, 2),
('Técnico em desenvolvimento de sistemas', 9, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `ds_razao_social` varchar(100) NOT NULL,
  `ds_nome_fantasia` varchar(100) NOT NULL,
  `nr_porte` varchar(50) NOT NULL,
  `ds_nome_responsavel` varchar(100) NOT NULL,
  `ds_area_atuacao` varchar(100) NOT NULL,
  `ds_site` varchar(50) DEFAULT NULL,
  `ds_telefone` varchar(15) NOT NULL,
  `nr_cnpj` int(11) DEFAULT NULL,
  `cd_empresa` int(11) NOT NULL,
  `ds_email` varchar(50) DEFAULT NULL,
  `ds_senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`ds_razao_social`, `ds_nome_fantasia`, `nr_porte`, `ds_nome_responsavel`, `ds_area_atuacao`, `ds_site`, `ds_telefone`, `nr_cnpj`, `cd_empresa`, `ds_email`, `ds_senha`) VALUES
('Talents LTDA.', 'Talents', '2', 'Bruno Felix', 'Desenvolvimento de sistemas', 'www.gotalents.com.br', '81995782171', 362935730, 1, 'bruno', '123456'),
('123', '123', '123', '123', '123', '123', '123', 123, 2, '123', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao`
--

CREATE TABLE `formacao` (
  `cd_formacao` int(11) NOT NULL,
  `ds_formacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formacao`
--

INSERT INTO `formacao` (`cd_formacao`, `ds_formacao`) VALUES
(1, 'Ensino Superior'),
(2, 'Ensino Técnico'),
(3, 'Ensino Médio'),
(4, 'Pós-graduação'),
(5, 'Mestrado'),
(6, 'Doutorado'),
(7, 'PHD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidade`
--

CREATE TABLE `habilidade` (
  `cd_habilidade` int(11) NOT NULL,
  `cd_tipo_habilidade` int(11) NOT NULL,
  `ds_habilidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `habilidade`
--

INSERT INTO `habilidade` (`cd_habilidade`, `cd_tipo_habilidade`, `ds_habilidade`) VALUES
(1, 1, 'Java'),
(2, 1, 'Php'),
(3, 1, 'C#'),
(4, 1, 'Delphi'),
(5, 1, 'Python'),
(6, 1, 'Assembly'),
(7, 1, 'Ruby on Rails'),
(8, 1, 'Java Web'),
(9, 1, 'C'),
(10, 1, 'C++'),
(11, 1, 'ASP.NET'),
(12, 1, 'JavaScript'),
(13, 1, 'Android'),
(14, 1, 'Ionic'),
(15, 2, 'Oracle'),
(16, 2, 'MySQL'),
(17, 2, 'Firebird'),
(18, 2, 'SQL Server'),
(19, 2, 'Acess'),
(20, 2, 'MariaDB'),
(21, 2, 'PostGreSQL'),
(22, 2, 'Firebase'),
(23, 2, 'Oracle'),
(24, 3, 'Slim FrameWork'),
(25, 3, 'Laravel'),
(26, 3, 'Zend FrameWork'),
(27, 3, 'CakePHP'),
(28, 3, 'CodeIgniter'),
(29, 3, 'Bootstrap'),
(30, 3, 'Symfony'),
(31, 4, 'Windows'),
(32, 4, 'Linux'),
(33, 4, 'ChromeOS'),
(34, 4, 'Android'),
(35, 5, 'XP'),
(36, 5, 'Scrum'),
(37, 5, 'Kanban'),
(38, 5, 'RUP'),
(39, 5, 'MSF'),
(40, 5, 'DSDM'),
(41, 6, 'Eclipse'),
(42, 6, 'NetBeans'),
(43, 6, 'Cloud9'),
(44, 6, 'VS Code'),
(45, 6, 'Visual Studio'),
(46, 6, 'Android Studio'),
(47, 6, 'Astah'),
(48, 7, 'HTML5'),
(49, 7, 'CSS3'),
(50, 7, 'Ajax'),
(51, 7, 'jQuery'),
(52, 7, 'AngularJS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma`
--

CREATE TABLE `idioma` (
  `cd_idioma` int(11) NOT NULL,
  `ds_idioma` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `idioma`
--

INSERT INTO `idioma` (`cd_idioma`, `ds_idioma`) VALUES
(1, 'Inglês'),
(2, 'Português'),
(3, 'Espanhol'),
(4, 'Mandarim'),
(5, 'Hindi'),
(6, 'Russo'),
(7, 'Francês'),
(8, 'Alemão'),
(9, 'Japonês'),
(10, 'Italiano'),
(11, 'Persa'),
(12, 'Turco'),
(13, 'Coreano'),
(14, 'Tailandês'),
(15, 'Polonês'),
(16, 'Ucraniano'),
(17, 'Curdo'),
(18, 'Grego'),
(19, 'Sueco'),
(20, 'Búlgaro'),
(21, 'Zulu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcao_perfil_comportamental`
--

CREATE TABLE `opcao_perfil_comportamental` (
  `ds_resposta` varchar(50) DEFAULT NULL,
  `ds_resultado` float DEFAULT NULL,
  `cd_opcao_perfil_comportamental` int(11) NOT NULL,
  `cd_pergunta_perfil_comportamental` int(11) NOT NULL
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
  `ds_nome` varchar(100) NOT NULL,
  `ds_email` varchar(50) NOT NULL,
  `b_foto` varchar(32) DEFAULT NULL,
  `ds_senha` varchar(50) NOT NULL,
  `nr_longitude` float DEFAULT NULL,
  `tp_sexo` varchar(1) DEFAULT NULL,
  `tp_conta` varchar(1) NOT NULL,
  `dt_nascimento` date NOT NULL,
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
-- Estrutura da tabela `tipo_habilidade`
--

CREATE TABLE `tipo_habilidade` (
  `cd_tipo_habilidade` int(11) NOT NULL,
  `ds_tipo_habilidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_habilidade`
--

INSERT INTO `tipo_habilidade` (`cd_tipo_habilidade`, `ds_tipo_habilidade`) VALUES
(1, 'Linguagem de programação'),
(2, 'Banco de dados'),
(3, 'FrameWork'),
(4, 'Sistemas Operacionais'),
(5, 'Metodologia ágil'),
(6, 'Ferramentas'),
(7, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `cd_vaga` int(11) NOT NULL,
  `nr_qtd_vaga` int(11) NOT NULL,
  `ds_observacao` varchar(1000) DEFAULT NULL,
  `dt_validade` date DEFAULT NULL,
  `tp_contratacao` varchar(1) NOT NULL,
  `nr_longitude` float DEFAULT NULL,
  `nr_latitude` float DEFAULT NULL,
  `ds_beneficios` varchar(1000) DEFAULT NULL,
  `ds_horario_expediente` varchar(100) DEFAULT NULL,
  `dt_criacao` date NOT NULL,
  `ds_titulo` varchar(100) DEFAULT NULL,
  `vl_salario` varchar(100) NOT NULL,
  `cd_cargo` int(11) NOT NULL,
  `cd_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`cd_vaga`, `nr_qtd_vaga`, `ds_observacao`, `dt_validade`, `tp_contratacao`, `nr_longitude`, `nr_latitude`, `ds_beneficios`, `ds_horario_expediente`, `dt_criacao`, `ds_titulo`, `vl_salario`, `cd_cargo`, `cd_empresa`) VALUES
(1, 3, NULL, '2018-03-01', 'I', NULL, NULL, 'Plano de Saúde / Odontológico\r\nVale Alimentação / Refeição', 'Período Integral', '2018-03-01', 'Vaga Programador JR.', '2500,00', 104, 1),
(2, 1, 'Disponibilidade para viagem .  ', '2018-03-31', 'I', NULL, NULL, 'Plano de Saúde / Odontológico\r\nHorário Flexível\r\nHome Office\r\nVale Alimentação / Refeição', 'Período Integral', '2018-03-09', 'Vaga Administrador de Banco de Dados Júnior', '8000,00', 5, 2),
(3, 1, 'Disponibilidade para viagens de longa duração.', '2018-05-31', 'S', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', 'Home Office', '2018-03-01', 'Vaga Coordenador de Sistemas Urgente', '10000,00', 131, 2),
(4, 1, 'Não Há .', '2018-03-31', 'I', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', 'A combinar', '2018-03-01', 'Vaga Administrador de Redes Júnior', 'A combinar', 15, 1),
(5, 20, 'Contratação Imediata', '2018-03-10', 'R', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição\r\nAcademia ', 'Período Integral', '2018-03-04', 'Vaga Desenvolvedor JR. ', '5', 143, 2),
(6, 1, NULL, NULL, '', NULL, NULL, '	\r\nPlano de Saúde \r\nAlimentação no Refeitório da Empresa ', '08:00 hrs as 14:00 hrs. ', '2018-03-01', 'Vaga Estagiário em Desenvolvimento de Software', '850,00', 146, 2),
(7, 1, NULL, '2018-03-31', '', NULL, NULL, '	\r\nPlano de Saúde \r\nVale Alimentação / Refeição', 'Período Integral .', '2018-03-22', 'Vaga Suporte a Clientes ', '2100,00', 152, 1),
(8, 1, NULL, '2018-03-23', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', NULL, '2018-03-10', 'Vaga Desenvolvedor Home Office .', '6000,00', 102, 2),
(9, 1, NULL, '2018-03-12', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', NULL, '2018-03-11', 'Vaga Web Designer Pleno - URGENTE', '4355,00', 51, 1),
(10, 5, 'Contratação imediata, com chances de plano de carreira rápido . ', '2018-03-26', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', 'a combinar .', '2018-03-04', 'Vaga Auxiliar de Web Development', '1800,00', 181, 1),
(11, 1, NULL, '2018-03-31', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', '08:00 as 18:00', '2018-03-10', NULL, '2750,00', 75, 2),
(12, 6, NULL, '2019-02-28', 'U', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', '08:00 as 12:00 é das  14:00 as 18:00', '2018-10-31', 'Vaga de Assistente em Projeto de Sistemas ERP', '3900,00', 144, 2),
(13, 5, NULL, '2018-08-15', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', '08:00 as 12:00 ou 14:00 as 18:00', '0000-00-00', 'Vaga Estagiário em Suporte a Clientes', '650,00', 159, 1),
(14, 1, NULL, '2018-06-30', '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', NULL, '0000-00-00', 'Vaga Trainee Desenvolvimento Web ', '2100,00', 57, 1),
(15, 2, NULL, NULL, '', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', 'Não informado .', '2018-03-30', 'Vaga Arquiteto de Software JR.', '7500,00', 34, 1),
(16, 1, 'N/A', '2018-04-27', 'I', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', 'Período Integral ', '2018-03-25', 'Vaga Analista de Testes Sênior', '3500,00', 142, 2),
(17, 0, NULL, '2018-03-25', 'A', NULL, NULL, 'Plano de Saúde \r\nVale Alimentação / Refeição', NULL, '2018-03-28', 'Vaga Urgente ', '4000,00', 88, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga_curso`
--

CREATE TABLE `vaga_curso` (
  `cd_formacao` int(11) DEFAULT NULL,
  `cd_curso` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vaga_curso`
--

INSERT INTO `vaga_curso` (`cd_formacao`, `cd_vaga`) VALUES
(4, 3),
(4, 2),
(2, 2),
(2, 1);

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
-- Extraindo dados da tabela `vaga_curso`
--

INSERT INTO `vaga_habilidade` (`nr_nivel`,`cd_habilidade`,`cd_vaga`) VALUES
  (1, 4, 1),
  (1, 2, 1),
  (1, 12, 1),
  (1, 1, 1),
  (1, 1, 2),
  (1, 22, 2),
  (1, 21, 2),
  (1, 26, 2),
  (1, 44, 2),
  (1, 3, 2),
  (1, 2, 3);

--
-- Estrutura da tabela `vaga_idioma`
--

CREATE TABLE `vaga_idioma` (
  `nr_nivel` int(11) DEFAULT NULL,
  `cd_idioma` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vaga_curso`
--

INSERT INTO `vaga_idioma` (`nr_nivel`,`cd_idioma`,`cd_vaga`) VALUES
  (1, 4, 1),
  (1, 2, 1),
  (1, 1, 2),
  (1, 2, 2),
  (1, 2, 3);
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
  ADD KEY `FK_FORMACAO` (`cd_formacao`);

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
  ADD PRIMARY KEY (`cd_habilidade`),
  ADD KEY `FK_TIPO_HABILIDADEE` (`cd_tipo_habilidade`);

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
  ADD KEY `FK_PERGUNTA_PERFIL_COMP` (`cd_pergunta_perfil_comportamental`);

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
-- Indexes for table `tipo_habilidade`
--
ALTER TABLE `tipo_habilidade`
  ADD PRIMARY KEY (`cd_tipo_habilidade`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`cd_vaga`),
  ADD KEY `FK_CARGO` (`cd_cargo`),
  ADD KEY `FK_EMPRESA` (`cd_empresa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cd_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cd_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formacao`
--
ALTER TABLE `formacao`
  MODIFY `cd_formacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `habilidade`
--
ALTER TABLE `habilidade`
  MODIFY `cd_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `idioma`
--
ALTER TABLE `idioma`
  MODIFY `cd_idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- AUTO_INCREMENT for table `tipo_habilidade`
--
ALTER TABLE `tipo_habilidade`
  MODIFY `cd_tipo_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `cd_vaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_FORMACAO` FOREIGN KEY (`cd_formacao`) REFERENCES `formacao` (`cd_formacao`);

--
-- Limitadores para a tabela `habilidade`
--
ALTER TABLE `habilidade`
  ADD CONSTRAINT `FK_TIPO_HABILIDADEE` FOREIGN KEY (`cd_tipo_habilidade`) REFERENCES `tipo_habilidade` (`cd_tipo_habilidade`);

--
-- Limitadores para a tabela `opcao_perfil_comportamental`
--
ALTER TABLE `opcao_perfil_comportamental`
  ADD CONSTRAINT `FK_PERGUNTA_PERFIL_COMP` FOREIGN KEY (`cd_pergunta_perfil_comportamental`) REFERENCES `pergunta_perfil_comportamental` (`cd_pergunta_perfil_comportamental`);

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `FK_CARGO` FOREIGN KEY (`cd_cargo`) REFERENCES `cargo` (`cd_cargo`),
  ADD CONSTRAINT `FK_EMPRESA` FOREIGN KEY (`cd_empresa`) REFERENCES `empresa` (`cd_empresa`);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
