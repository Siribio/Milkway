create database milkway

use milkway

create table usuario(
    id_usuario int primary key auto_increment,
    usuario varchar(50) not null,
    senha varchar(50) not null,
    email varchar(50) not null,
    data_login date,
    endereco varchar(50) not null,
    token varchar(64) not null
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

create table estoque(
    id_produtos int primary key auto_increment,
    nome varchar(50) not null,
    quantidade float not null,
    valor float not null
);

insert into estoque values 
    (null, 'CHOCOLATE', 50.0, 10.0),
    (null, 'MORANGO', 30.0, 15.0),
    (null, 'BAUNILHJA', 20.0, 20.0)


insert into usuario values (null, 'eduardo', 'eduardo123', 'eduardo@email.com', 'null', 'ponte', 'aleatorio')