-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE idioma (
cd_idioma Integer PRIMARY KEY,
ds_idioma Varchar(100)
);

CREATE TABLE cargo (
cd_cargo Integer PRIMARY KEY,
ds_cargo Varchar(100),
ds_empresa Varchar(50),
dt_fim Date,
dt_inicio Date
);

CREATE TABLE profissional (
cd_profissional Integer PRIMARY KEY,
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
cd_formacao INTEGER PRIMARY KEY,
ds_formacao Varchar(100)
);

CREATE TABLE Habilidade (
cd_habilidade Integer PRIMARY KEY,
ds_habilidade Varchar(100)
);

CREATE TABLE curso (
cd_curso Integer PRIMARY KEY,
ds_instituicao Varchar(50),
ds_curso Varchar(50),
cd_formacao INTEGER,
FOREIGN KEY(cd_formacao) REFERENCES formacao (cd_formacao)
);

CREATE TABLE vaga (
cd_vaga Integer PRIMARY KEY,
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
cd_empresa Integer PRIMARY KEY,
ds_email Varchar(50)
);

CREATE TABLE opcao_perfil_comportamental (
cd_opcao_perfil_comportamental Integer PRIMARY KEY,
ds_resultado Double,
ds_resposta Varchar(50),
cd_pergunta_perfil_comportamental Integer
);

CREATE TABLE pergunta_perfil_comportamental (
cd_pergunta_perfil_comportamental Integer PRIMARY KEY,
ds_pergunta Varchar(50)
);

CREATE TABLE vaga_habilidade (
nr_nivel SmallInt,
cd_vaga_habilidade integer PRIMARY KEY,
cd_habilidade Integer,
cd_vaga Integer,
FOREIGN KEY(cd_habilidade) REFERENCES Habilidade (cd_habilidade),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE vaga_idioma (
nr_nivel SmallInt,
cd_vaga_idioma integer PRIMARY KEY,
cd_idioma Integer,
cd_vaga Integer,
FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE `vaga_curso` (
  `cd_formacao` int(11) DEFAULT NULL,
  `cd_curso` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
);




CREATE TABLE profissional_vaga (
tp_acao Varchar(10),
dt_inclusao DATE,
cd_profissional_vaga Integer PRIMARY KEY,
cd_profissional Integer,
cd_vaga Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE profissional_perfil_comportamental (
cd_profissional_perfil_comportamental Integer PRIMARY KEY,
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
cd_profissional_curso Integer PRIMARY KEY,
cd_curso Integer,
cd_profissional Integer,
FOREIGN KEY(cd_curso) REFERENCES curso (cd_curso),
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional)
);

CREATE TABLE vaga_formacao (
cd_vaga_formacao Integer PRIMARY KEY,
cd_formacao INTEGER,
cd_vaga Integer,
FOREIGN KEY(cd_formacao) REFERENCES formacao (cd_formacao),
FOREIGN KEY(cd_vaga) REFERENCES vaga (cd_vaga)
);

CREATE TABLE profissional_idioma (
nr_nivel SmallInt,
cd_profissional_idioma integer PRIMARY KEY,
cd_profissional Integer,
cd_idioma Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_idioma) REFERENCES idioma (cd_idioma)
);

CREATE TABLE contém (
nr_nivel SmallInt,
cd_profissional_habilidade Integer PRIMARY KEY,
cd_profissional Integer,
cd_habilidade Integer,
FOREIGN KEY(cd_profissional) REFERENCES profissional (cd_profissional),
FOREIGN KEY(cd_habilidade) REFERENCES Habilidade (cd_habilidade)
);

ALTER TABLE vaga ADD FOREIGN KEY(cd_empresa) REFERENCES empresa (cd_empresa);
ALTER TABLE opcao_perfil_comportamental ADD FOREIGN KEY(cd_pergunta_perfil_comportamental) REFERENCES pergunta_perfil_comportamental (cd_pergunta_perfil_comportamental);
