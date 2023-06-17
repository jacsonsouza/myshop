CREATE DATABASE myshop COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id_usuario)
)
ENGINE = InnoDB;

CREATE TABLE produtos (
    id_produto INT NOT NULL AUTO_INCREMENT ,
    vendedor_id INT NOT NULL ,
    nome_produto VARCHAR(255) NOT NULL ,
    descricao VARCHAR(255) NOT NULL ,
    preco DECIMAL(10, 2) NOT NULL,
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

INSERT INTO usuarios (email, nome, senha) VALUES 
('jacson@teste.com', 'Jacson', '$2y$10$OoZIXSZox/tJSZObtP6kLOj.w6A5tGGq6GnlQHzc4.beQiQE1ueB6'),
('maria@teste.com', 'Maria', '$2y$10$OoZIXSZox/tJSZObtP6kLOj.w6A5tGGq6GnlQHzc4.beQiQE1ueB6');

INSERT INTO produtos (vendedor_id, nome_produto, descricao, preco, vendido) VALUES 
(1, 'Computador', 'Computador Completo Intel Dual Core 4GB HD 500GB Monitor 19.5" HDMI Full HD Áudio 5.1 canais Skill DC', '1099.00', 0),
(1, 'Notebook Samsung', 'Samsung Book Core i5-1135G7, 8G, 256GB SSD, Iris Xe, 15.6"FHD, W11 Cinza', '2969.10', 0),
(1, 'Celular Samsung', 'Samsung Galaxy A14 128GB 4G Wi-Fi Tela 6.6'' Dual Chip 4GB RAM Câmera Tripla de até 50MP + Selfie 13MP Bateria de 5000mAh - Preto', '965.65', 0),
(2, 'Smartphone Xiaomi', 'Smartphone Xiaomi Redmi 12C 128GB - 4GB Ram (Cinza)', '797.99', 0),
(2, 'Notebook gamer Dell', 'Notebook Gamer Dell G15-a0506-M10P 15.6" FHD AMD Ryzen™ 5 6600H 8GB 256GB SSD NVIDIA RTX 3050 Windows 11', '5759.00', 0),
(2, 'Fone', 'Headset Gamer HyperX Cloud Stinger Core PC HX-HSCSC2-BK/WW, Preto, Pequeno', '149.90', 0),
(1, 'Teclado', 'Teclado Mecânico sem fio Logitech POP Keys com teclas Emoji Personalizáveis, Design Compacto Durável, Conexão USB ou Bluetooth - Daydream', '429.90', 1),
(1, 'Mouse', 'Mouse sem fio Logitech Pebble M350 com Clique Silencioso, Design Slim Ambidestro, Conexão USB ou Bluetooth e Pilha Inclusa - Azul', '99.90', 1),
(2, 'Mouse Pad', 'Mouse Pad Tecido Preto 22 x 17.8 cm - 01 Unidade, Maxprint, 603579, Outros Acessórios para Notebooks', '6.99', 1),
(2, 'Tablet Samsung', 'Tablet Samsung Galaxy Tab S6 Lite, 64GB, 4GB RAM, Tela Imersiva de 10.4", Câmera Traseira 8MP, Câmera frontal de 5MP, Wifi, Android 13', '2204.90', 1);

INSERT INTO produtos_usuario (id_usuario, id_produto, date) VALUES 
(2, 7, '2023-05-19'),
(2, 8, '2023-03-02'),
(1, 9, '2023-01-07'),
(1, 10, '2022-12-23');
