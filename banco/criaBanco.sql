-- Deleta o banco de dados caso exista
DROP DATABASE IF EXISTS Pinerity;

-- Cria banco de dados caso não exista
CREATE DATABASE IF NOT EXISTS Pinerity;

-- Seleciona o banco de dados
USE Pinerity;

CREATE TABLE Benificio
(
    id              INT AUTO_INCREMENT,
    nome            VARCHAR(),
    estado          VARCHAR(),
    PRIMARY KEY(id)
);

CREATE TABLE Benificiario
(
    id              int auto_increment,
    NIS             int,
    nome            varchar(50),
    folha_resumo    varchar(10), -- modificar depois
    rendafamiliar   float,
    cep             int,
    num             int,
    n_integrantes   int,
    cpf             varchar(11),
    telefone        varchar(11), 
    email           varchar(50),
    senha           varchar(50),
    primary key(id)
);

CREATE TABLE Doadorfisico
(
    id              int auto_increment,
    cpf             int,
    nome            varchar (50),
    dt_nasc         varchar (15),
    telefone        varchar(11),
    endereco        varchar (100),
    numero          varchar (4),
    cep             char (9),
    email           varchar (50),
    senha           varchar(50),
    primary key(cpf)
);
CREATE TABLE Doadorjuridica
(
    id              int auto_increment,
    cnpj            int,
    nomeEmpresarial varchar(100),
    nomeFantasia    varchar(100),
    telefone        varchar(11),
    endereco        varchar (100),
    numero          varchar (4),
    cep             char (9),
    email           varchar (50),
    senha           varchar(50),
    primary key(cnpj)
);

CREATE TABLE CestaBasica
(
    id              int auto_increment,
    descricao       varchar (200),
    primary key(id)
);

CREATE TABLE EmpresaDistribuicao
(
    cnpj                        int,
    nome_empresarial            varchar(100),
    nome_fantasia               varchar (50),
    cep                         varchar (9),
    numero                      varchar (4),
    telefone                    varchar (11),
    descricaoItensEstoque       varchar(500),
    email                       varchar (50),
    senha                       varchar(50),
    primary key(cnpj)
);

CREATE TABLE Pedido
(
    id                  int auto_increment,
    numeroCestas        varchar (2),
    tipo_entrega         boolean,
    destinatario        varchar (100),
    primary key (id)
);