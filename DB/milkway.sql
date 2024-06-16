create database milkway

use milkway

CREATE TABLE usuarios (
    id_usuario VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    usuario VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    senha VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    data_login DATE DEFAULT NULL,
    endereco VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    token VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id_usuario)
);

create table pedidos(
    id_pedido int primary key auto_increment,
    id_usuario int not null,
    valor float not null,
    status_pedido varchar(50) not null,
    id_produtos int not null,
    data_pedido date not null,
    endereco_entrega varchar(50) not null,
    forma_pagamento varchar(50) not null
);

create table carrinho(
    id_usuario int not null,
    valor float not null,
    status_pedido varchar(50) not null,
    id_produtos int not null,
    data_pedido date not null,
);

CREATE TABLE estoque (
    id_produtos INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    quantidade FLOAT NOT NULL,
    valor FLOAT NOT NULL,
    tipo VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id_produtos)
);

insert into estoque values 
    (null, 'CHOCOLATE', 50.0, 10.0),
    (null, 'MORANGO', 30.0, 15.0),
    (null, 'BAUNILHJA', 20.0, 20.0)


insert into usuario values (null, 'eduardo', 'eduardo123', 'eduardo@email.com', 'null', 'ponte', 'aleatorio')

INSERT INTO estoque (id_produtos, nome, quantidade, valor, tipo) VALUES
(4, 'CHOCOLATE', 20, 7, 'SAB'),
(5, 'MORANGO', 30, 8, 'SAB'),
(6, 'DOCE DE LEITE', 10, 10, 'SAB'),
(7, 'PISTACHE', 25, 12, 'SAB'),
(8, 'FLOCOS', 20, 8, 'SAB'),
(17, 'CALDA DE CHOCOLATE', 30, 4, 'ACOM'),
(18, 'GRANULADO', 30, 2, 'ACOM'),
(19, 'KIT KAT', 30, 6, 'ACOM'),
(20, 'LEITE CONDENSADO', 30, 4, 'ACOM'),
(21, 'CHANTILY', 30, 6, 'ACOM'),
(22, 'NUTELLA', 30, 8, 'ACOM'),
(23, 'MORANGOS', 30, 5, 'ACOM'),
(24, 'M&MS', 30, 5, 'ACOM'),
(25, 'AMENDOIM', 30, 4, 'ACOM'),
(26, 'TUBOS DE WAFFLE', 30, 3, 'ACOM');