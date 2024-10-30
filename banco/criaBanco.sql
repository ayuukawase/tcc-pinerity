-- Deleta o banco de dados caso exista
DROP DATABASE IF EXISTS Pinerity;

-- Cria banco de dados caso não exista
CREATE DATABASE IF NOT EXISTS Pinerity;

-- Seleciona o banco de dados
USE Pinerity;

CREATE TABLE benificio --arrumar
(
    id              INT AUTO_INCREMENT,
    qtd_cestas      int,
    pedido_id       int,
    PRIMARY KEY(id),
    KEY fk_beneficio_pedido_idx (pedido_id),
    CONSTRAINT fk_beneficio_pedido FOREIGN KEY (pedido_id) REFERENCES pedido(id)
);

CREATE TABLE benificiario
(
    id              int auto_increment,
    NIS             int,
    nome            varchar(50),
    folha_resumo    varchar(10), -- modificar depois
    rendafamiliar   float,
    endereco        varchar (100),
    numero          varchar (4),
    cep             float (10),
    n_integrantes   int,
    cpf             varchar(11),
    telefone        varchar(11), 
    email           varchar(50),
    senha           varchar(50),
    primary key(id)
);

CREATE TABLE doadorfisico
(
    id              int auto_increment,
    cpf             int,
    nome            varchar (50),
    dt_nasc         varchar (15),
    telefone        varchar(11),
    endereco        varchar (100),
    numero          varchar (4),
    cep             float (10),
    email           varchar (50),
    senha           varchar(50),
    primary key(cpf)
);
CREATE TABLE doadorjuridico
(
    id              int auto_increment,
    cnpj            int,
    nomeEmpresarial varchar(100),
    nomeFantasia    varchar(100),
    telefone        varchar(11),
    endereco        varchar (100),
    numero          varchar (4),
    cep             float (10),
    email           varchar (50),
    senha           varchar(50),
    primary key(cnpj)
);

CREATE TABLE cestabasicadf
(
    id                    int auto_increment,
    descricao_itens       varchar (200),
    doadorfisico_id       int,
    primary key(id),
    KEY fk_cestabasicadf_doadorfisico_idx (doadorfisico_id),
    CONSTRAINT fk_cestabasicadf_doadorfisico FOREIGN KEY (doadorfisico_id) REFERENCES doadorfisico(id)
);
CREATE TABLE cestabasicadj
(
    id                    int auto_increment,
    descricao_itens       varchar (200),
    doadorjuridico_id       int,
    primary key(id),
    KEY fk_cestabasicadj_doadorjuridico_idx (doadorjuridico_id),
    CONSTRAINT fk_cestabasicadj_doadorjuridico FOREIGN KEY (doadorjuridico_id) REFERENCES doadorjuridico(id)
);

CREATE TABLE empresadistribuicao
(
    cnpj                        int,
    nome_empresarial            varchar(100),
    nome_fantasia               varchar (50),
    endereco                    varchar (100),
    numero                      varchar (4),
    cep                         float (10),
    telefone                    varchar (11),
    descricaoItensEstoque       varchar(500),
    email                       varchar (50),
    senha                       varchar(50),
    primary key(cnpj)
);

CREATE TABLE pedido
(
    id                  int auto_increment,
    numeroCestas        varchar (2),
    tipoentrega         boolean,
    beneficiario_id     int,
    primary key (id),
    KEY fk_pedido_beneficiario_idx (beneficiario_id),
    CONSTRAINT fk_pedido_beneficiario FOREIGN KEY (beneficiario_id) REFERENCES beneficiario(id)
);