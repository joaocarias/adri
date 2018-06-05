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