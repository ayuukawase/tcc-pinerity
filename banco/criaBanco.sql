-- Deleta o banco de dados caso exista
DROP DATABASE IF EXISTS Pinerity;

-- Cria banco de dados caso não exista
CREATE DATABASE IF NOT EXISTS Pinerity;

-- Seleciona o banco de dados
USE Pinerity;

CREATE TABLE Benificio
(
    id              int auto_increment,
    nome            varchar(50),
    estado          varchar(2),
    PRIMARY KEY(id)
);

CREATE TABLE Benificiario
(
    id              int auto_increment,
    NIS             int,
    nome            varchar(50),
    folha_resumo    varchar(10),
    cpf             varchar(11),
    telefone        varchar(11),
    genero          varchar (10), -- modificar depois
    email           varchar(50),
    senha           varchar(50),
    primary key(id)
);

CREATE TABLE Doador
(
    id              int auto_increment,
    telefone        varchar(11),
    endereco        varchar (100),
    numero          varchar (4),
    cep             char (9),
    email           varchar (50),
    primary key(id)
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
    nomeEmpresarial             varchar(100),
    nomeFantasia                varchar (50),
    cep                         char (9),
    numero                      varchar (4),
    telefone                    varchar (11),
    estoque                     varchar (500),
    descricaoItensEstoque       varchar(500),
    email                       varchar (50),
    primary key(cnpj)
);

CREATE TABLE Pedido
(
    id                  int auto_increment,
    numeroCestas        varchar (2),
    tipoEntrega         boolean,
    destinatario        varchar (100),
    primary key (id)
);

CREATE TABLE PessoaFisica
(
    cpf         int,
    genero      varchar (10), --modificar depois 
    nome        varchar (50),
    nascimento  varchar (15),
    primary key(cpf)
);

CREATE TABLE PessoaJuridica
(
    cnpj            int,
    nomeEmpresarial varchar(100),
    nomeFantasia    varchar(100),
    primary key(cnpj)
);