    -- Deleta o banco de dados caso exista
DROP DATABASE IF EXISTS pinerity;

-- Cria banco de dados caso não exista
CREATE DATABASE IF NOT EXISTS pinerity;

-- Seleciona o banco de dados
USE pinerity;

CREATE TABLE empresadistribuicao
(
    id                          INT auto_increment,
    cnpj                        varchar (14) not null,
    nome_empresarial            varchar(100) not null,
    nome_fantasia               varchar (50) not null,
    cep                         varchar (9) not null,
    numero                      varchar (10) not null,
    telefone                    varchar (11) not null,
    email                       varchar (50) not null,
    descricaoitensestoque       varchar (500) not null,
    senha                       varchar(50),
    primary key(id)
);

CREATE TABLE beneficio
(
    id              INT AUTO_INCREMENT,
    qtd_cestas      INT,
    pedido_id       INT not null,
    PRIMARY KEY(id),
    KEY fk_beneficio_pedido_idx (pedido_id)
    
);

CREATE TABLE beneficiario
(
    id              INT auto_increment not null,
    id_beneficio    INT null,
    NIS             varchar(11) not null,
    nome            varchar(50) not null,
    folha_resumo    Blob not null,
    rendafamiliar   float not null,
    numero          INT not null,
    cep             varchar(9) not null,
    n_integrantes   INT check(n_integrantes > 0),
    cpf             varchar(11) not null,
    telefone        varchar(11) not null, 
    email           varchar(50) not null,
    senha           varchar(50),
    primary key(id),
    foreign key(id_beneficio) references beneficio(id)	
) ENGINE InnoDB;

CREATE TABLE pedido
(
	id 						INT auto_increment not null,
	id_distribuidora		INT not null,
    numerocestas 			INT not null,
    tipoentrega 			ENUM('retirar', 'entregar') not null,
    beneficiario_id 		INT not null,
    primary key (id),
	foreign key(id_distribuidora) references empresadistribuicao(id),
    foreign key(beneficiario_id) references beneficiario(id)
);

CREATE TABLE beneficio_empresa
(
    id                          INT auto_increment not null,
    beneficio_id                INT not null,
    empresa_id                  INT not null,
    mensagem_emprocessos        varchar(50),
    
    primary key (id),
    FOREIGN KEY (beneficio_id) REFERENCES beneficio(id),
    FOREIGN KEY (empresa_id) REFERENCES empresadistribuicao(id)
);

CREATE TABLE doadorfisico
(
    cpf             varchar(11) unique not null,
    primary key(cpf)
);

CREATE TABLE doadorjuridico
(
	cnpj            	varchar(14) unique not null,
    nomeEmpresarial 	varchar(100) not null,
    nomeFantasia    	varchar(100) not null,
    primary key(cnpj)
);

CREATE TABLE doador
(
    id              INT auto_increment not null,
	cpf             varchar(11) unique ,
	cnpj            varchar(14) unique ,
    telefone        varchar(11) not null,
    numero          varchar (10) not null,
    cep             varchar (9) not null,
    email           varchar (50) not null,
    senha           varchar(50),
	foreign key(cpf) references doadorfisico(cpf),
	foreign key(cnpj) references doadorjuridico(cnpj),
    primary key(id)
) engine InnoDB;

CREATE TABLE cestabasica
(
    id                    					INT auto_increment not null,
    descricao_itens       					varchar (200) not null,
    doadorfisico_id	    					INT not null,
    empresadistribuicao_id	                INT not null,
    primary key(id),
    FOREIGN KEY (empresadistribuicao_id) REFERENCES empresadistribuicao(id)
);

CREATE TABLE cesta_doador
(
	id_cesta                 INT not null,
	id_doador                INT not null,
	mensagem_emprocessos     varchar(50),
    primary key (id_cesta,id_doador),
    FOREIGN KEY (id_cesta) REFERENCES cestabasica(id),
    FOREIGN KEY (id_doador) REFERENCES doador(id)
);
CREATE TABLE usuario
(
    id              INT NOT NULL AUTO_INCREMENT,
    nome            varchar(50) NOT NULL,
    email           varchar(255) NOT NULL,
    senha           varchar(50) NOT NULL,
    data_criacao    datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ativo           tinyint NOT NULL DEFAULT '0',
    adm             tinyint NOT NULL DEFAULT '0',
    PRIMARY KEY(id)
);
