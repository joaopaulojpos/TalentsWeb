-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE idioma (
cd_idioma Integer PRIMARY KEY AUTO_INCREMENT,
ds_idioma Varchar(100)
);

CREATE TABLE cargo (
cd_cargo Integer PRIMARY KEY AUTO_INCREMENT,
ds_cargo Varchar(100),
ds_empresa Varchar(50),
dt_fim Date,
dt_inicio Date
);

CREATE TABLE profissional (
cd_profissional Integer PRIMARY KEY AUTO_INCREMENT,
b_foto Blob,
ds_senha Varchar(50),
dt_nascimento Date,
ds_email Varchar(50),
nr_longitude Double,
tp_conta Char,
tp_sexo Char,
ds_nome Varchar(100),
nr_latitude Double,
cd_cargo Integer,
FOREIGN KEY(cd_cargo) REFERENCES cargo (cd_cargo)
);

CREATE TABLE formacao (
cd_formacao INTEGER PRIMARY KEY AUTO_INCREMENT,
ds_formacao Varchar(100)
);

CREATE TABLE tipo_habilidade (
  cd_tipo_habilidade Integer PRIMARY KEY AUTO_INCREMENT,
  ds_tipo_habilidade varchar(100) DEFAULT NULL
);

CREATE TABLE Habilidade (
cd_habilidade Integer PRIMARY KEY AUTO_INCREMENT,
cd_tipo_habilidade Integer NOT NULL,
ds_habilidade Varchar(100)
);

CREATE TABLE curso (
cd_curso Integer PRIMARY KEY AUTO_INCREMENT,
ds_instituicao Varchar(50),
ds_curso Varchar(50),
cd_formacao INTEGER,
FOREIGN KEY(cd_formacao) REFERENCES formacao (cd_formacao)
);

CREATE TABLE vaga (
cd_vaga Integer PRIMARY KEY AUTO_INCREMENT,
nr_qtd_vaga Integer,
ds_observacao Varchar(100),
dt_validade Date,
nr_longitude Double,
nr_latitude Double,
ds_beneficios Varchar(100),
ds_horario_expediente Varchar(100),
dt_criacao Date,
ds_titulo Varchar(100),
vl_salario Double,
tp_contratacao Char,
status varchar(10),
nr_experiencia varchar(50),
cd_cargo Integer,
cd_empresa Integer,
FOREIGN KEY(cd_cargo) REFERENCES cargo (cd_cargo)
);

CREATE TABLE empresa (
ds_razao_social Varchar(100),
ds_nome_fantasia Varchar(100),
nr_porte Varchar(50),
ds_nome_responsavel Varchar(100),
ds_area_atuacao Varchar(100),
ds_site Varchar(50),
ds_telefone Varchar(15),
nr_cnpj Integer,
cd_empresa Integer PRIMARY KEY AUTO_INCREMENT,
ds_email Varchar(50),
ds_senha varchar(30)
);

CREATE TABLE opcao_perfil_comportamental (
cd_opcao_perfil_comportamental Integer PRIMARY KEY AUTO_INCREMENT,
ds_resultado Double,
ds_resposta Varchar(50),
cd_pergunta_perfil_comportamental Integer
);

CREATE TABLE pergunta_perfil_comportamental (
cd_pergunta_perfil_comportamental Integer PRIMARY KEY AUTO_INCREMENT,
ds_pergunta Varchar(50)
);

CREATE TABLE vaga_habilidade (
nr_nivel SmallInt,
cd_vaga_habilidade integer PRIMARY KEY AUTO_INCREMENT,
cd_habilidade Integer,
cd_vaga Integer,
FOREIGN KEY(cd_habilidade) REFERENCES Habilidade (cd_habilidade),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE vaga_idioma (
nr_nivel SmallInt,
cd_vaga_idioma integer PRIMARY KEY AUTO_INCREMENT,
cd_idioma Integer,
cd_vaga Integer,
FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE `vaga_curso` (
cd_formacao Integer DEFAULT NULL,
cd_curso Integer DEFAULT NULL,
cd_vaga Integer DEFAULT NULL
);

CREATE TABLE profissional_vaga (
tp_acao Varchar(10),
dt_inclusao DATE,
cd_profissional_vaga Integer PRIMARY KEY AUTO_INCREMENT,
cd_profissional Integer,
cd_vaga Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE profissional_perfil_comportamental (
cd_profissional_perfil_comportamental Integer PRIMARY KEY AUTO_INCREMENT,
cd_opcao_perfil_comportamental Integer,
cd_profissional Integer,
FOREIGN KEY(cd_opcao_perfil_comportamental) REFERENCES opcao_perfil_comportamental (cd_opcao_perfil_comportamental),
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_curso (
tp_certificado_validado Char,
dt_inicio Date,
nr_cerificado SmallInt,
dt_fim Date,
nr_periodo SmallInt,
ds_instituicao Varchar(50),
cd_profissional_curso Integer PRIMARY KEY AUTO_INCREMENT,
cd_curso Integer,
cd_profissional Integer,
FOREIGN KEY(cd_curso) REFERENCES curso (cd_curso),
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE vaga_formacao (
cd_vaga_formacao Integer PRIMARY KEY AUTO_INCREMENT,
cd_formacao INTEGER,
cd_vaga Integer,
FOREIGN KEY(cd_formacao) REFERENCES formacao (cd_formacao),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE profissional_idioma (
nr_nivel SmallInt,
cd_profissional_idioma integer PRIMARY KEY AUTO_INCREMENT,
cd_profissional Integer,
cd_idioma Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma)
);

CREATE TABLE contém (
nr_nivel SmallInt,
cd_profissional_habilidade Integer PRIMARY KEY AUTO_INCREMENT,
cd_profissional Integer,
cd_habilidade Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_habilidade) REFERENCES Habilidade (cd_habilidade)
);

ALTER TABLE vaga ADD FOREIGN KEY(cd_empresa) REFERENCES empresa (cd_empresa);
ALTER TABLE opcao_perfil_comportamental ADD FOREIGN KEY(cd_pergunta_perfil_comportamental) REFERENCES pergunta_perfil_comportamental (cd_pergunta_perfil_comportamental);

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

INSERT INTO `formacao` (`cd_formacao`, `ds_formacao`) VALUES
(1, 'Ensino Superior'),
(2, 'Ensino Técnico'),
(3, 'Ensino Médio'),
(4, 'Pós-graduação'),
(5, 'Mestrado'),
(6, 'Doutorado'),
(7, 'PHD');

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

INSERT INTO `empresa` (`ds_razao_social`, `ds_nome_fantasia`, `nr_porte`, `ds_nome_responsavel`, `ds_area_atuacao`, `ds_site`, `ds_telefone`, `nr_cnpj`, `cd_empresa`, `ds_email`, `ds_senha`) VALUES
('Talents LTDA.', 'Talents', '2', 'Bruno Felix', 'Desenvolvimento de sistemas', 'www.gotalents.com.br', '81995782171', 362935730, 1, 'bruno', '123456'),
('123', '123', '123', '123', '123', '123', '123', 123, 2, '123', '123');

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

INSERT INTO `profissional` (`ds_nome`, `ds_email`, `b_foto`, `ds_senha`, `nr_longitude`, `tp_sexo`, `tp_conta`, `dt_nascimento`, `nr_latitude`, `cd_profissional`) VALUES
('TJ Batera', 'tjbatera', '/semfoto.jpg', '123456', 24.12, 'M', '1', '2017-01-11', -897.01, 1);

INSERT INTO `tipo_habilidade` (`cd_tipo_habilidade`, `ds_tipo_habilidade`) VALUES
(1, 'Linguagem de programação'),
(2, 'Banco de dados'),
(3, 'FrameWork'),
(4, 'Sistemas Operacionais'),
(5, 'Metodologia ágil'),
(6, 'Ferramentas'),
(7, 'Outros');

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
