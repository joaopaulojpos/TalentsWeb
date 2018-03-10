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
  `cd_cargo` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_cargo` varchar(300)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cargo` (`ds_cargo`) VALUES
('Gerente de Administração de Banco de Dados'),
('Coordenador de Administração de Banco de Dados'),
('Consultor de Administração de Banco de Dados'),
('Supervisor de Administração de Banco de Dados'),
('Administrador de Banco de Dados Sênior'),
('Administrador de Banco de Dados Pleno'),
('Administrador de Banco de Dados Júnior'),
('Analista de Administração de Banco de Dados Sênior'),
('Analista de Administração de Banco de Dados Pleno'),
('Analista de Administração de Banco de Dados Júnior'),
('Trainee de Administração de Banco de Dados'),
('Assistente de Administração de Banco de Dados'),
('Auxiliar de Administração de Banco de Dados'),
('Estagiário de Administração de Banco de Dados'),
('Gerente de Administração de Redes'),
('Coordenador de Administração de Redes'),
('Consultor de Administração de Redes'),
('Supervisor de Administração de Redes'),
('Administrador de Redes Sênior'),
('Administrador de Redes Pleno'),
('Administrador de Redes Júnior'),
('Analista de Administração de Redes Sênior'),
('Analista de Administração de Redes Pleno'),
('Analista de Administração de Redes Júnior'),
('Trainee de Administração de Redes'),
('Assistente de Administração de Redes'),
('Auxiliar de Administração de Redes'),
('Estagiário de Administração de Redes'),
('Gerente de Arquitetura da Informação'),
('Coordenador de Arquitetura da Informação'),
('Supervisor de Arquitetura da Informação'),
('Arquiteto da Informação Sênior'),
('Arquiteto da Informação Pleno'),
('Arquiteto da Informação Júnior'),
('Assistente de Arquitetura da Informação'),
('Estagiário de Arquitetura da Informação'),
('Gerente de Conteúdo Web'),
('Coordenador de Conteúdo Web'),
('Supervisor de Conteúdo Web'),
('Analista de Conteúdo Web Sênior'),
('Analista de Conteúdo Web Pleno'),
('Analista de Conteúdo Web Júnior'),
('Trainee de Conteúdo Web'),
('Assistente de Conteúdo Web'),
('Auxiliar de Conteúdo Web'),
('Estagiário de Conteúdo Web'),
('Gerente de Web Designer'),
('Coordenador de Criação Web'),
('Supervisor de Criação Web'),
('Web Designer Sênior'),
('Web Designer Pleno'),
('Web Designer Júnior'),
('Webmaster Sênior'),
('Webmaster Pleno'),
('Webmaster Júnior'),
('Revisor de Criação Web'),
('Trainee de Criação Web'),
('Estagiário de Criação Web'),
('Diretor de E-Commerce / E-Business'),
('Gerente de E-Commerce / E-Business'),
('Coordenador de E-Commerce / E-Business'),
('Supervisor de E-Commerce / E-Business'),
('Analista de E-Commerce / E-Business Sênior'),
('Analista de E-Commerce / E-Business Pleno'),
('Analista de E-Commerce / E-Business Júnior'),
('Trainee de E-Commerce / E-Business'),
('Assistente de E-Commerce / E-Business'),
('Auxiliar de E-Commerce / E-Business'),
('Estagiário de E-Commerce / E-Business'),
('Diretor de Negócios Web'),
('Gerente de Negócios Web'),
('Coordenador de Negócios Web'),
('Supervisor de Negócios Web'),
('Executivo de Contas de Negócios Web'),
('Analista de Negócios Web Sênior'),
('Analista de Negócios Web Pleno'),
('Analista de Negócios Web Júnior'),
('Trainee de Negócios Web'),
('Assistente de Negócios Web'),
('Auxiliar de Negócios Web'),
('Estagiário de Negócios Web'),
('Diretor de Processamento de Dados'),
('Gerente de Processamento de Dados'),
('Coordenador de Processamento de Dados'),
('Supervisor de Processamento de Dados'),
('Analista de Processamento de Dados Sênior'),
('Analista de Processamento de Dados Pleno'),
('Analista de Processamento de Dados Júnior'),
('Trainee de Processamento de Dados'),
('Operador de Processamento de Dados'),
('Assistente de Processamento de Dados'),
('Auxiliar de Processamento de Dados'),
('Digitador'),
('Estagiário de Processamento de Dados'),
('Diretor de Programação'),
('Gerente de Programação'),
('Coordenador de Programação'),
('Supervisor de Programação'),
('Analista Programador Sênior'),
('Analista Programador Pleno'),
('Analista Programador Júnior'),
('Programador Sênior'),
('Programador Pleno'),
('Programador Júnior'),
('Assistente de Programação'),
('Trainee de Programação'),
('Auxiliar de Programação'),
('Estagiário de Programação'),
('Gerente de Qualidade de Software'),
('Coordenador de Qualidade de Software'),
('Supervisor de Qualidade de Software'),
('Analista de Qualidade de Software Sênior'),
('Analista de Qualidade de Software Pleno'),
('Analista de Qualidade de Software Júnior'),
('Assistente de Qualidade de Software'),
('Estagiário de Qualidade de Software'),
('Analista de Redes Sociais Sênior'),
('Analista de Redes Sociais Pleno'),
('Analista de Redes Sociais Júnior'),
('Gerente de Segurança da Informação'),
('Coordenador de Segurança da Informação'),
('Consultor de Segurança da Informação'),
('Supervisor de Segurança da Informação'),
('Analista de Segurança da Informação Sênior'),
('Analista de Segurança da Informação Pleno'),
('Analista de Segurança da Informação Júnior'),
('Assistente de Segurança da Informação'),
('Estagiário de Segurança da Informação'),
('Diretor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Gerente de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Coordenador de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Supervisor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Consultor de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Sênior'),
('Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Pleno'),
('Analista de Sistemas (Projetos / Desenvolvimento / Consultoria) Júnior'),
('Analista de Requisitos Sênior'),
('Analista de Requisitos Pleno'),
('Analista de Requisitos Júnior'),
('Analista de Testes Sênior'),
('Analista de Testes Pleno'),
('Analista de Testes Júnior'),
('Trainee de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Assistente de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Auxiliar de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Estagiário de Sistemas (Projetos / Desenvolvimento / Consultoria)'),
('Diretor de Suporte Técnico em Informática – Help Desk'),
('Gerente de Suporte Técnico em Informática – Help Desk'),
('Coordenador de Suporte Técnico em Informática – Help Desk'),
('Supervisor de Suporte Técnico em Informática – Help Desk'),
('Consultor de Suporte Técnico em Informática – Help Desk'),
('Analista de Suporte Técnico em Informática – Help Desk Sênior'),
('Analista de Suporte Técnico em Informática – Help Desk Pleno'),
('Analista de Suporte Técnico em Informática – Help Desk Júnior'),
('Técnico de Suporte em Informática – Help Desk'),
('Trainee de Suporte Técnico em Informática – Help Desk'),
('Assistente de Suporte Técnico em Informática – Help Desk'),
('Auxiliar de Suporte Técnico em Informática – Help Desk'),
('Estagiário de Suporte Técnico em Informática – Help Desk'),
('Diretor de Tecnologia da Informação'),
('Gerente de Tecnologia da Informação'),
('Consultor de Tecnologia da Informação'),
('Coordenador de Tecnologia da Informação'),
('Supervisor de Tecnologia da Informação'),
('Analista de Tecnologia da Informação Sênior'),
('Analista de Tecnologia da Informação Pleno'),
('Analista de Tecnologia da Informação Júnior'),
('Trainee de Tecnologia da Informação'),
('Assistente de Tecnologia da Informação'),
('Auxiliar de Tecnologia da Informação'),
('Estagiário de Tecnologia da Informação'),
('Diretor de Web Development'),
('Gerente de Web Development'),
('Coordenador de Web Development'),
('Supervisor de Web Development'),
('Analista de Web Development Sênior'),
('Analista de Web Development Pleno'),
('Analista de Web Development Júnior'),
('Trainee de Web Development'),
('Assistente de Web Development'),
('Auxiliar de Web Development'),
('Estagiário de Web Development');


-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao`
--

CREATE TABLE `formacao` (
  `cd_formacao` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_formacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `ds_curso` varchar(300),
  `cd_curso` int(11) PRIMARY KEY AUTO_INCREMENT,
  `cd_formacao` int(11),
  CONSTRAINT `FK_FORMACAO` FOREIGN KEY (`cd_formacao`) REFERENCES `formacao` (`cd_formacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `curso` (`ds_curso`, `cd_formacao`) VALUES
('Análise e desenvolvimento de sistemas', 1), 
('Sistema da informação', 1),
('Engenharia da computação', 1),
('Ciências da computação', 1),
('Técnico em informática', 2),
('Engenharia de produção', 1),
('Redes de computadores', 1),
('Técnico em redes de computadores', 2),
('Técnico em desenvolvimento de sistemas', 2);

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
  `ds_site` varchar(50) NULL,
  `ds_telefone` varchar(15) NOT NULL,
  `nr_cnpj` int(11) DEFAULT NULL,
  `cd_empresa` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_email` varchar(50) NULL,
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
-- Estrutura da tabela `tipo_habilidade`
--

CREATE TABLE `tipo_habilidade` (
  `cd_tipo_habilidade` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_tipo_habilidade` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estrutura da tabela `habilidade`
--

CREATE TABLE `habilidade` (
  `cd_habilidade` int(11) PRIMARY KEY AUTO_INCREMENT,
  `cd_tipo_habilidade` int(11) NOT NULL,
  `ds_habilidade` varchar(100),
  CONSTRAINT `FK_TIPO_HABILIDADEE` FOREIGN KEY (`cd_tipo_habilidade`) REFERENCES `tipo_habilidade` (`cd_tipo_habilidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `habilidade` (`ds_habilidade`, `cd_tipo_habilidade`) VALUES
('Java', 1),
('Php', 1),
('C#', 1),
('Delphi', 1),
('Python', 1),
('Assembly', 1),
('Ruby on Rails', 1),
('Java Web', 1),
('C', 1),
('C++', 1),
('ASP.NET', 1),
('JavaScript', 1),
('Android', 1),
('Ionic', 1),
('Oracle', 2),
('MySQL', 2),
('Firebird', 2),
('SQL Server', 2),
('Acess', 2),
('MariaDB', 2),
('PostGreSQL', 2),
('Firebase', 2),
('Oracle', 2),
('Slim FrameWork', 3),
('Laravel', 3),
('Zend FrameWork', 3),
('CakePHP', 3),
('CodeIgniter', 3),
('Bootstrap', 3),
('Symfony', 3),
('Windows', 4),
('Linux', 4),
('ChromeOS', 4),
('Android', 4),
('XP', 5),
('Scrum', 5),
('Kanban', 5),
('RUP', 5),
('MSF', 5),
('DSDM', 5),
('Eclipse', 6),
('NetBeans', 6),
('Cloud9', 6),
('VS Code', 6),
('Visual Studio', 6),
('Android Studio', 6),
('Astah', 6),
('HTML5', 7),
('CSS3', 7),
('Ajax', 7),
('jQuery', 7),
('AngularJS', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma`
--

CREATE TABLE `idioma` (
  `cd_idioma` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_idioma` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `idioma` (`ds_idioma`) VALUES 
('Inglês'),
('Português'),
('Espanhol'),
('Mandarim'),
('Hindi'),
('Russo'),
('Francês'),
('Alemão'),
('Japonês'),
('Italiano'),
('Persa'),
('Turco'),
('Coreano'),
('Tailandês'),
('Polonês'),
('Ucraniano'),
('Curdo'),
('Grego'),
('Sueco'),
('Búlgaro'),
('Zulu');

-- --------------------------------------------------------


--
-- Estrutura da tabela `pergunta_perfil_comportamental`
--

CREATE TABLE `pergunta_perfil_comportamental` (
  `cd_pergunta_perfil_comportamental` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ds_pergunta` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcao_perfil_comportamental`
--

CREATE TABLE `opcao_perfil_comportamental` (
  `ds_resposta` varchar(50),
  `ds_resultado` float,
  `cd_opcao_perfil_comportamental` int(11) PRIMARY KEY AUTO_INCREMENT,
  `cd_pergunta_perfil_comportamental` int(11) NOT NULL,
  CONSTRAINT `FK_PERGUNTA_PERFIL_COMP` FOREIGN KEY (`cd_pergunta_perfil_comportamental`) REFERENCES `pergunta_perfil_comportamental` (`cd_pergunta_perfil_comportamental`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE `profissional` (
  `ds_nome` varchar(100) NOT NULL,
  `ds_email` varchar(50) NOT NULL,
  `b_foto` varchar(32),
  `ds_senha` varchar(50) NOT NULL,
  `nr_longitude` float,
  `tp_sexo` varchar(1),
  `tp_conta` varchar(1) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `nr_latitude` float,
  `cd_profissional` int(11) PRIMARY KEY AUTO_INCREMENT
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
  `cd_vaga` int(11) PRIMARY KEY AUTO_INCREMENT,
  `nr_qtd_vaga` int(11) NOT NULL,
  `ds_observacao` varchar(1000),
  `dt_validade` date,
  `tp_contratacao` varchar(1) NOT NULL,
  `nr_longitude` float,
  `nr_latitude` float,
  `ds_beneficios` varchar(1000),
  `ds_horario_expediente` varchar(100),
  `dt_criacao` date NOT NULL,
  `ds_titulo` varchar(100),
  `vl_salario` varchar(100) NOT NULL,
  `cd_cargo` int(11) NOT NULL,
  `cd_empresa` int(11) NOT NULL,
  CONSTRAINT `FK_CARGO` FOREIGN KEY (`cd_cargo`) REFERENCES `cargo` (`cd_cargo`),
  CONSTRAINT `FK_EMPRESA` FOREIGN KEY (`cd_empresa`) REFERENCES `empresa` (`cd_empresa`)
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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
