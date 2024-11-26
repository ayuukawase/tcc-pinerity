-- Deleta o banco de dados caso exista
DROP DATABASE IF EXISTS pinerity;

-- Cria banco de dados caso não exista
CREATE DATABASE IF NOT EXISTS pinerity;

-- Seleciona o banco de dados
USE pinerity;

CREATE TABLE beneficiario
(
    id              INT unsigned auto_increment not null,
    id_beneficio int not null,

    NIS             INT not null,
    nome            varchar(50) not null,
    folha_resumo    varchar(10) not null, -- modificar depois
    rendafamiliar   float not null,
    endereco        varchar(100) not null,
    numero          INT not null,
    cep             varchar(9) not null,
    n_integrantes   INT check(n_integrantes > 0),
    cpf             INT not null,
    telefone        varchar(11) not null, 
    email           varchar(50) not null,
    senha           varchar(50),
    primary key(id),
    foreign key(id_beneficio) references beneficio(id)	
) ENGINE InnoDB;

CREATE TABLE pedido
(
	id 						int auto_increment not null,
	id_distribuidora int not null,
    numerocestas 			int not null,
    tipoentrega 			boolean not null,
    beneficiario_id 		int unsigned not null,
    primary key (id),
   -- key fk_pedido_beneficiario_idx (beneficiario_id),
   --// constraint fk_pedido_beneficiario foreign key (beneficiario_id) references beneficiario(id)
	 foreign key(id_distribuidora) references empresadistribuicao(cnpj)
) engine InnoDB;

CREATE TABLE beneficio
(
    id              INT AUTO_INCREMENT,
    qtd_cestas      INT,
    pedido_id       INT not null,
    PRIMARY KEY(id),
    KEY fk_beneficio_pedido_idx (pedido_id)
    
);
CREATE TABLE doador
(
    id              INT auto_increment not null,
	 cpf             INT unique ,
	cnpj            INT unique ,
    nome            varchar (50) not null,
    dt_nasc         varchar (15) not null,
    telefone        varchar(11) not null,
    endereco        varchar (100) not null,
    numero          varchar (10) not null,
    cep             float (8) not null,
    email           varchar (50) not null,
    senha           varchar(50),
foreign key(cpf) references doadorfisico(cpf),
foreign key(cnpj) references doadorjuridico(cnpj),
    primary key(id)
);
CREATE TABLE doadorfisico
(
  
    cpf             INT unique not null,
    
    primary key(    cpf             )
);
CREATE TABLE doadorjuridico
(
      cnpj            INT unique not null,
    nomeEmpresarial varchar(100) not null,
    nomeFantasia    varchar(100) not null,
    primary key(cnpj)
);

CREATE TABLE cestabasicadf
(
    id                    				INT auto_increment not null,
    descricao_itens       				varchar (200) not null,
    doadorfisico_id	    				INT not null,
    empresadistribuicao_cnpj	            INT not null,
    primary key(id),
    FOREIGN KEY (empresadistribuicao_cnpj) REFERENCES empresadistribuicao(cnpj)
);
CREATE TABLE cestabasicadj
(
    id                    				INT auto_increment not null,
    descricao_itens       				varchar (500) not null,
    doadorjuridico_id     				INT not null,
    empresadistribuiucao_id             INT not null,
    primary key(id),
    KEY fk_cestabasicadj_doadorjuridico_idx (doadorjuridico_id),
    CONSTRAINT fk_cestabasicadj_doadorjuridico FOREIGN KEY (doadorjuridico_id) REFERENCES doadorjuridico(id),
    KEY fk_cestabasicadj_empresadistribuicao_idx (empresadistribuicao_id),
    CONSTRAINT fk_cestabasicadj_empresadistribuicao FOREIGN KEY (empresadistribuica_id) REFERENCES empresadistribuicao(id)
);

CREATE TABLE empresadistribuicao
(
    cnpj                        INT unique not null,
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

CREATE TABLE estoque -- rever esta tabela relacionamento errado
(
    id                  INT auto_increment not null,
    cestasrecebidas     INT not null, -- tem que referenciar registro_cestas
    cestasentregues     INT not null, -- tem que referenciar registro_pedidos
    cestasestoque       INT not null,
    empresa_id          INT not null,
    primary key (id),
    KEY fk_estoque_empresa_idx (empresa_id),
    CONSTRAINT fk_estoque_empresa FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);

CREATE TABLE beneficio_empresa
(
    id                  INT auto_increment not null,
    cnpj                        INT unique not null,
    mensagem_emprocessos     varchar(50),
    
    primary key (id,cnpj),
    FOREIGN KEY (id) REFERENCES beneficio(id),
    FOREIGN KEY (cnpj) REFERENCES empresadistribuicao(cnpj)
);
