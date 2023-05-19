CREATE DATABASE myshop COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(30) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id_usuario)
)
ENGINE = InnoDB;

CREATE TABLE produtos (
    id_produto INT NOT NULL AUTO_INCREMENT ,
    vendedor_id INT NOT NULL ,
    nome_produto VARCHAR(24) NOT NULL ,
    descricao VARCHAR(255) NOT NULL ,
    preco VARCHAR(24) NOT NULL,
    vendido BOOLEAN NOT NULL,
    PRIMARY KEY (id_produto),
    FOREIGN KEY (vendedor_id) REFERENCES usuarios (id_usuario)
)
ENGINE = InnoDB;

CREATE TABLE produtos_usuario (
    id_produtos_usuario INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_produto INT NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (id_produtos_usuario),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_produto) REFERENCES produtos (id_produto)
)
ENGINE = InnoDB;
