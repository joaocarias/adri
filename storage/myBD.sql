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
