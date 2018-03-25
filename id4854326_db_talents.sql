-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.

CREATE TABLE idioma (
  cd_idioma Integer PRIMARY KEY AUTO_INCREMENT,
  ds_idioma Varchar(100) not null
);

CREATE TABLE cargo (
  cd_cargo Integer PRIMARY KEY AUTO_INCREMENT,
  ds_cargo Varchar(100) not null
);

CREATE TABLE formacao (
  cd_formacao INTEGER PRIMARY KEY AUTO_INCREMENT,
  ds_formacao Varchar(100) not null
);

CREATE TABLE curso (
  cd_curso Integer PRIMARY KEY AUTO_INCREMENT,
  ds_curso Varchar(100) not null,
  cd_formacao INTEGER,
  FOREIGN KEY(cd_formacao) REFERENCES formacao (cd_formacao)
);

CREATE TABLE tipo_competencia_tecnica (
  cd_tipo_competencia_tecnica Integer PRIMARY KEY AUTO_INCREMENT,
  ds_tipo_competencia_tecnica varchar(100) not null
);

CREATE TABLE competencia_tecnica (
  cd_competencia_tecnica Integer PRIMARY KEY AUTO_INCREMENT,
  cd_tipo_competencia_tecnica Integer NOT NULL,
  ds_competencia_tecnica Varchar(100),
  FOREIGN KEY(cd_tipo_competencia_tecnica) REFERENCES tipo_competencia_tecnica (cd_tipo_competencia_tecnica)
);

CREATE TABLE tipo_competencia_comport (
  cd_tipo_competencia_comport Integer PRIMARY KEY AUTO_INCREMENT,
  ds_tipo_competencia_comport Varchar(100) not null
);

CREATE TABLE competencia_comport (
  cd_competencia_comport Integer PRIMARY KEY AUTO_INCREMENT,
  cd_tipo_competencia_comport Integer,       
  ds_competencia_comport varchar(100),
  ds_descricao varchar(500),
  FOREIGN KEY(cd_tipo_competencia_comport) REFERENCES tipo_competencia_comport (cd_tipo_competencia_comport)
);

CREATE TABLE profissional (
  cd_profissional Integer PRIMARY KEY AUTO_INCREMENT,
  ds_nome varchar(100),
  ds_email Varchar(100),
  ds_senha Varchar(50),
  dt_nascimento Date,
  tp_sexo varchar(1),
  tp_conta varchar(1),
  b_foto varchar(100),
  nr_latitude Double,
  nr_longitude Double,
  dt_cadastro timestamp default current_timestamp()
);

CREATE TABLE empresa (
  cd_empresa Integer PRIMARY KEY AUTO_INCREMENT,
  ds_razao_social Varchar(150),
  ds_nome_fantasia Varchar(150),
  nr_porte Varchar(50),
  ds_nome_responsavel Varchar(100),
  ds_area_atuacao Varchar(100),
  ds_site Varchar(100),
  ds_telefone Varchar(15),
  nr_cnpj Integer,
  ds_email Varchar(100),
  ds_senha varchar(50)
);

CREATE TABLE pergunta_perfil_comp (
  cd_pergunta_perfil_comp Integer PRIMARY KEY AUTO_INCREMENT,
  ds_pergunta Varchar(100) not null
);

CREATE TABLE alternativa_perfil_comp (
  cd_alternativa_perfil_comp Integer PRIMARY KEY AUTO_INCREMENT,
  ds_resposta Varchar(100),
  cd_pergunta_perfil_comp Integer,
  FOREIGN KEY(cd_pergunta_perfil_comp) REFERENCES pergunta_perfil_comp (cd_pergunta_perfil_comp)
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
  dt_criacao timestamp default current_timestamp(),
  ds_titulo Varchar(100),
  vl_salario Double,
  tp_contratacao Char,
  status varchar(10),
  nr_experiencia varchar(50),
  cd_cargo Integer,
  cd_empresa Integer,
  FOREIGN KEY(cd_cargo) REFERENCES cargo (cd_cargo),
  FOREIGN KEY(cd_empresa) REFERENCES empresa (cd_empresa)
);

CREATE TABLE profissional_cargo (
  cd_cargo Integer,
  cd_profissional Integer,
  ds_empresa Varchar(50),
  dt_fim Date,
  dt_inicio Date,
  FOREIGN KEY(cd_cargo) REFERENCES cargo (cd_cargo),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_curso (
  cd_curso Integer,
  cd_profissional Integer,
  ds_instituicao Varchar(100),
  dt_fim Date,
  dt_inicio Date,
  tp_certificado_validado varchar(1),
  nr_cerificado Integer,
  nr_periodo Integer,
  FOREIGN KEY(cd_curso) REFERENCES curso (cd_curso),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_idioma (
  cd_profissional Integer,
  cd_idioma Integer,
  nr_nivel Integer,
  FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_vaga (
  tp_acao Varchar(10),
  dt_inclusao timestamp DEFAULT current_timestamp(),
  cd_profissional Integer,
  cd_vaga Integer,
  FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_competencia_comport (
  cd_profissional integer,
  cd_competencia_comport integer,
  FOREIGN KEY(cd_competencia_comport) REFERENCES competencia_comport (cd_competencia_comport),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE profissional_competencia_tecnica (
  cd_profissional integer,
  cd_competencia_tecnica integer,
  FOREIGN KEY(cd_competencia_tecnica) REFERENCES competencia_tecnica (cd_competencia_tecnica),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);


CREATE TABLE profissional_alternativa_perfil_comp (
  cd_alternativa_perfil_comp Integer,
  cd_profissional Integer,
  FOREIGN KEY(cd_alternativa_perfil_comp) REFERENCES alternativa_perfil_comp (cd_alternativa_perfil_comp),
  FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE vaga_idioma (
  cd_idioma Integer,
  cd_vaga Integer,
  nr_nivel Integer,
  FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma),
  FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE vaga_curso (
  cd_formacao Integer,
  cd_curso Integer,
  cd_vaga Integer,
  FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE vaga_competencia_comport ( 
  cd_competencia_comport Integer,
  cd_vaga Integer,
  FOREIGN KEY(cd_competencia_comport) REFERENCES competencia_comport (cd_competencia_comport),
  FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE vaga_competencia_tecnica (
  cd_competencia_tecnica Integer,
  cd_vaga Integer,
  nr_nivel Integer,
  FOREIGN KEY(cd_competencia_tecnica) REFERENCES competencia_tecnica (cd_competencia_tecnica),
  FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

-- inserts
                                              
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

INSERT INTO `tipo_competencia_tecnica` (`cd_tipo_competencia_tecnica`, `ds_tipo_competencia_tecnica`) VALUES
(1, 'Linguagem de programação'),
(2, 'Banco de dados'),
(3, 'FrameWork'),
(4, 'Sistemas Operacionais'),
(5, 'Metodologia ágil'),
(6, 'Ferramentas'),
(7, 'Outros');

INSERT INTO `competencia_tecnica` (`cd_competencia_tecnica`, `cd_tipo_competencia_tecnica`, `ds_competencia_tecnica`) VALUES
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
(18, 2, 'Oracle'),
(19, 2, 'MySQL'),
(20, 2, 'Firebird'),
(21, 2, 'SQL Server'),
(22, 2, 'Acess'),
(23, 2, 'MariaDB'),
(24, 2, 'PostGreSQL'),
(25, 2, 'Firebase'),
(26, 2, 'Oracle'),
(27, 3, 'Slim FrameWork'),
(28, 3, 'Laravel'),
(29, 3, 'Zend FrameWork'),
(30, 3, 'CakePHP'),
(31, 3, 'CodeIgniter'),
(32, 3, 'Bootstrap'),
(33, 3, 'Symfony'),
(34, 3, 'AngularJS'),
(35, 3, 'Ajax'),
(36, 3, 'jQuery'),
(37, 3, '.NET'),
(38, 3, 'LDAP'),
(39, 3, 'Spring Boot'),
(40, 3, 'JSF'),
(41, 3, 'JavaEE'),
(42, 3, 'Cordova'),
(43, 3, 'EmberJS'),
(44, 4, 'Windows'),
(45, 4, 'Linux'),
(46, 4, 'ChromeOS'),
(47, 4, 'Android'),
(48, 5, 'XP'),
(49, 5, 'Scrum'),
(50, 5, 'Kanban'),
(51, 5, 'RUP'),
(52, 5, 'MSF'),
(53, 5, 'DSDM'),
(54, 5, 'ITIL'),
(55, 6, 'Eclipse'),
(56, 6, 'NetBeans'),
(57, 6, 'Cloud9'),
(58, 6, 'VS Code'),
(59, 6, 'Visual Studio'),
(60, 6, 'Android Studio'),
(61, 6, 'Astah'),
(62, 6, 'Maven'),
(63, 6, 'Microsoft Office'),
(64, 7, 'HTML5'),
(65, 7, 'CSS3'),
(66, 7, 'Manutenção geral de Hardware e equipamentos'),
(67, 7, 'Instalação e manutenção geral de softwares'),
(68, 7, 'ERP'),
(69, 7, 'SOAP'),
(70, 7, 'REST'),
(71, 7, 'XSD'),
(72, 7, 'XML'),
(73, 7, 'XSLT'),
(74, 7, 'WS-Polices'),
(75, 7, 'JSON'),
(76, 7, 'Business Intelligence (BI)'),
(77, 7, 'EJB'),
(78, 7, 'JMS'),
(79, 7, 'ETL'),
(80, 7, 'Machine Learn'),
(81, 7, 'Deep Learn'),
(82, 7, 'Redes Neurais');


INSERT INTO `tipo_competencia_comport` (`cd_tipo_competencia_comport`, `ds_tipo_competencia_comport`) VALUES
(1, 'Gestão de pessoas'),
(2, 'Desenvolvimento pessoal'),
(3, 'Liderança'),
(4, 'Comunicação'),
(5, 'Raciocínio lógico'),
(6, 'Genéricas'),
(7, 'Técnicas gerais');

INSERT INTO `competencia_comport` (`cd_competencia_comport`, `cd_tipo_competencia_comport`, `ds_competencia_comport`,  `ds_descricao`) VALUES
(1, 1, 'Formação e desenvolvimento', 'Empenhado em desenvolver habilidades da equipe e com disposição de participar na formação e desenvolvimento da sua equipe'),
(2, 1, 'Gestão de desempenho', 'Ajuda a organização a atingir seus objetivos, mantém altos padrões pessoais e da equipe, o que faz quando surgem problemas de desempenho e como desenvolve seu próprio desempenho e da equipe através de treinamento ou mentoria'),
(3, 1, 'Coaching e mentoria', 'Capaz de trabalhar com colegas ou parceiros oferecendo coaching e mentoria para melhorar a sua prática e suas habilidades ou avançar seus conhecimentos'),
(4, 1, 'Trabalho em equipe', 'Incentiva o compartilhamento de informações e o trabalho em parceria e encoraja ativamente outros a participar do processo de tomada de decisão'),
(5, 2, 'Compromisso com a excelência', 'À procura de oportunidades de melhorar a sua forma de trabalhar, gerar ideias para a melhoria de processos e verificar cuidadosamente o seu trabalho'),
(6, 2, 'Pensamento estruturado', 'Definir suas ideias e pensamentos em um padrão lógico usando mapas mentais'),
(7, 2, 'Crescimento na carreira', 'Busca ativa de oportunidades de treinamento que facilitem a sucessão'),
(8, 3, 'Gestão estratégica', 'Rever várias áreas de negócio e avaliar dados, sistemas e processos para tomar decisões corretas'),
(9, 3, 'Planejamento futuro', 'Demonstrar sua capacidade de meticulosamente planejar atividades de negócios e implementar projetos com sucesso'),
(10, 3, 'Persuasão e influência sob a equipe', 'Convencer e influenciar as pessoas em um negócio, definir claramente o que espera, planejar com antecedência e ouvir atentamente aqueles que estão se comunicando'),
(11, 3, 'Gestão da mudança', 'Receptivo à mudança que ocorre dentro do local de trabalho, demonstrar habilidades de relacionamento e definir uma direção clara para a organização para que os colaboradores entendam o que é esperado'),
(12, 4, 'Compromisso com a excelência do cliente', 'Resolução rápida e eficaz de problemas e reclamações de clientes, adotar processos para rastrear a satisfação do cliente'),
(13, 4, 'Trabalho colaborativo', 'Expressar interesse pelas experiências e ideias dos outros, trabalhar para construir canais fortes de comunicação com parceiros / departamentos externos'),
(14, 4, 'Gestão de relacionamento com o cliente', 'Comunicar frequentemente com os clientes para oferecer um melhor serviço, assegurar que as interações com os clientes são sempre educadas e positivas'),
(15, 4, 'Inteligência social e emocional', 'Capacidade de reconhecer e regular emoções e comportamentos no local de trabalho, capacidade de reconhecer as emoções e perspectivas dos outros e levá-las em conta'),
(16, 4, 'Técnicas de persuasão', 'Abordar com êxito preocupações fundamentais e apresentar soluções mutuamente benéficas, construir relacionamentos bem-sucedidos para assegurar apoio durante as negociações'),
(17, 4, 'Comunicação escrita', 'Usar linguagem concisa, clara e apropriada. Estruturar ideias claramente. Utilizar a gramática de forma correta'),
(18, 4, 'Comunicação verbal', 'Falar claramente e em um ritmo medido, manter o contato visual para manter a atenção dos ouvintes'),
(19, 5, 'Tomada de decisões', 'Analisar dados e informações para tomar decisões, capacidade de priorizar diferentes necessidades de negócios'),
(20, 5, 'Abordagem metódica', 'Quebrar tarefas complexas em segmentos gerenciáveis, ter a capacidade de identificar possíveis problemas ou obstáculos'),
(21, 5, 'Identificação de padrões ou conexões', 'Compreender o impacto de padrões e tendências de dados específicos nos negócios, identificar inconsistências nos dados e informações'),
(22, 5, 'Pesquisa e análise', 'Capacidade de identificar fontes de informação relevantes, utilização eficaz de dados e pesquisas para alcançar decisões informadas e eficazes'),
(23, 5, 'Resolução de problemas', 'Capacidade de identificar a causa e os efeitos dos problemas no local de trabalho, analisar as informações existentes para encontrar soluções adequadas, pesquisar fontes de solução dos problemas, '),
(24, 6, 'Inovação e desenvoltura', 'Utilizar a informação existente para conceber novas formas de trabalhar, capacidade de enfrentar desafios imprevistos usando recursos existentes'),
(25, 6, 'Confiabilidade', 'Comunicar abertamente e honestamente com colegas e clientes, assumir a responsabilidade pessoal pela qualidade e conteúdo do seu trabalho'),
(26, 6, 'Controle do estresse', 'Responder calmamente à crítica, gerenciamento proativo de sentimentos ou sintomas de estresse (saber buscar ajuda)'),
(27, 6, 'Princípios morais e padrões éticos', 'Assumir a responsabilidade por erros e erros no seu trabalho, respeitar os acordos de confidencialidade'),
(28, 6, 'Planejamento e organização', 'Utilizar os recursos de forma eficaz para alcançar os objetivos, priorizar a carga de trabalho para garantir que os prazos sejam cumpridos'),
(29, 6, 'Perspicácia nos negócios', 'Analisar os produtos e serviços dos concorrentes para melhor compreender a sua posição, compreender como as tendências da indústria afetam o negócio'),
(30, 7, 'Pensamento criativo', 'Utilizar os conhecimentos existentes para desenvolver novas formas de trabalho, trabalhar com outras pessoas para pensar em novas soluções, mutuamente benéficas'),
(31, 7, 'Gestão de dados', 'Capacidade de verificação de todos os dados disponíveis para obter uma visão mais completa, utilizar os dados para propor soluções eficazes e identificar riscos potenciais'),
(32, 7, 'Conhecimento de equipamentos e programas', 'Entender como equipamentos e programas específicos podem beneficiar o negócio e seus clientes, capacidade de usar o conhecimento existente para diagnosticar problemas técnicos'),
(33, 7, 'Políticas e planejamento', 'Conhecer como e porque a política é importante, capacidade de comunicar eficazmente os valores e cultura do negócio');
