create database bd_srisms;

use bd_srisms;

create table tb_log_acesso(
	id_log int(11) auto_increment not null,
    id_servidor int(11),
    login varchar(14) not null,
    acesso varchar(10) not null,
    data_do_cadastro timestamp default current_timestamp,
    id_status smallint default 1,
    primary key(id_log)
)engine=InnoDB;

select * from tb_log_acesso;

create table tb_avaliador(
    id_avaliador int(11) auto_increment not null,
    id_servidor int(11) not null,
    id_unidade int(11) not null,
    criado_por int(11) not null,    
    data_do_cadastro timestamp default current_timestamp,
    modificador_por int(11),
    data_da_modificacao datetime,
    id_status smallint default 1,
    primary key(id_avaliador)
)engine=InnoDB;

create table tb_administrador(
    id_administrador int(11) auto_increment not null,
    id_servidor int(11) not null,    
    criado_por int(11) not null,    
    data_do_cadastro timestamp default current_timestamp,
    modificado_por int(11),
    data_da_modificacao datetime,
    id_status smallint default 1,
    primary key(id_administrador)
)engine=InnoDB;

create table tb_avaliacao(
    id_avaliacao int(11) auto_increment not null,
    id_inscricao int(11) not null,    
    nota1 int(11) default 0,
    nota2 int(11) default 0,
    nota3 int(11) default 0,
    nota4 int(11) default 0,
    nota5 int(11) default 0,
    pergunta6 varchar(500),
    pergunta7 varchar(3),
    pergunta8 int(11) default 0,
    pergunta9 varchar(500),               
    id_avaliador int(11) not null,    
    data_da_avaliacao timestamp default current_timestamp,
    modificado_por int(11),
    data_da_modificacao datetime,
    id_status smallint default 1,
    primary key(id_avaliacao)
)engine=InnoDB;