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
    id              int auto_increment not null,
    NIS             int unique not null,
    nome            varchar(50) not null,
    folha_resumo    varchar(10) not null, -- modificar depois
    rendafamiliar   float not null,
    endereco        varchar(100) not null,
    numero          varchar(10) not null,
    cep             float(8) not null,
    n_integrantes   int check(n_integrantes > 0),
    cpf             int unique not null,
    telefone        varchar(11) not null, 
    email           varchar(50) not null,
    senha           varchar(50),
    primary key(id)
);

CREATE TABLE doadorfisico
(
    id              int auto_increment not null,
    cpf             int unique not null,
    nome            varchar (50) not null,
    dt_nasc         varchar (15) not null,
    telefone        varchar(11) not null,
    endereco        varchar (100) not null,
    numero          varchar (10) not null,
    cep             float (8) not null,
    email           varchar (50) not null,
    senha           varchar(50),
    primary key(cpf)
);
CREATE TABLE doadorjuridico
(
    id              int auto_increment not null,
    cnpj            int unique not null,
    nomeEmpresarial varchar(100) not null,
    nomeFantasia    varchar(100) not null,
    telefone        varchar(11) not null,
    endereco        varchar(100) not null,
    numero          varchar(4) not null,
    cep             float(8) not null,
    email           varchar(50) not null,
    senha           varchar(50),
    primary key(cnpj)
);

CREATE TABLE cestabasicadf
(
    id                    int auto_increment not null,
    descricao_itens       varchar (200) not null,
    doadorfisico_id       int not null,
    empresa_id            int not null,
    primary key(id),
    KEY fk_cestabasicadf_doadorfisico_idx (doadorfisico_id),
    CONSTRAINT fk_cestabasicadf_doadorfisico FOREIGN KEY (doadorfisico_id) REFERENCES doadorfisico(id),
    KEY fk_cestabasicadf_empresa_idx (empresa_id),
    CONSTRAINT fk_cestabasicadf_empresa FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);
CREATE TABLE cestabasicadj
(
    id                    int auto_increment not null,
    descricao_itens       varchar (500) not null,
    doadorjuridico_id     int not null,
    empresa_id            int not null,
    primary key(id),
    KEY fk_cestabasicadj_doadorjuridico_idx (doadorjuridico_id),
    CONSTRAINT fk_cestabasicadj_doadorjuridico FOREIGN KEY (doadorjuridico_id) REFERENCES doadorjuridico(id),
    KEY fk_cestabasicadj_empresa_idx (empresa_id),
    CONSTRAINT fk_cestabasicadj_empresa FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);

CREATE TABLE empresadistribuicao
(
    cnpj                        int unique not null,
    nome_empresarial            varchar(100) not null,
    nome_fantasia               varchar (50) not null,
    endereco                    varchar (100) not null,
    numero                      varchar (10) not null,
    cep                         float (8) not null,
    telefone                    varchar (11) not null,
    email                       varchar (50) not null,
    senha                       varchar(50),
    primary key(cnpj)
);

CREATE TABLE pedido
(
    id                  int auto_increment not null,
    numeroCestas        int not null,
    tipoentrega         boolean not null,
    beneficiario_id     int not null,
    primary key (id),
    KEY fk_pedido_beneficiario_idx (beneficiario_id),
    CONSTRAINT fk_pedido_beneficiario FOREIGN KEY (beneficiario_id) REFERENCES beneficiario(id)
);
CREATE TABLE estoque
(
    id                  int auto_increment not null,
    cestasrecebidas     int not null,--tem que referenciar registro_cestas
    cestasentregues     int not null,--tem que referenciar registro_pedidos
    cestasestoque       int not null,
    primary key (id),
    KEY fk_cestabasicadf_empresa_idx (empresa_id),
    CONSTRAINT fk_cestabasicadf_empresa FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);