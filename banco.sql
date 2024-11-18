create database atv_pratica_isabela;
use atv_pratica_isabela;

create table cliente (
	id_cliente int primary key auto_increment not null,
    nome_cliente varchar(70),
    email_cliente varchar(50),
    telefone_cliente varchar(11)
);

create table colaborador (
	id_colaborador int primary key auto_increment not null,
    nome_colaborador varchar(70),
    email_colaborador varchar(50),
    telefone_colaborador varchar(11)
);

create table chamados (
	id_chamado int primary key auto_increment not null,
    desc_chamado varchar(200),
    criticidade_chamado enum('Baixa', 'Média', 'Alta'),
    status_chamado enum('Aberto', 'Em andamento', 'Resolvido'),
    data_abertura_chamado date,
    fk_cliente int,
    fk_colaborador int,
    foreign key (fk_cliente) references cliente (id_cliente),
    foreign key (fk_colaborador) references colaborador (id_colaborador)
);

select * from cliente;
select * from colaborador;