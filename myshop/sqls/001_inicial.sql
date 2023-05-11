CREATE DATABASE myshop COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(60) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT ,
    vendedor_id INT NOT NULL ,
    nome_produto VARCHAR(60) NOT NULL ,
    descricao VARCHAR(255) NOT NULL ,
    preco VARCHAR(24) NOT NULL,
    vendido BIT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (vendedor_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;

CREATE TABLE produtos_usuario (
    id INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_produto INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
    FOREIGN KEY (id_produto) REFERENCES produtos (id)
)
ENGINE = InnoDB;
