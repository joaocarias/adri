
/**
 * Author:  joao.franca
 * Created: 09/05/2018
 */

create table tb_usuario (
    id_usuario int(11) auto_increment not null,
    nome varchar(200) not null,    
    cpf varchar(14) not null,    
    data_de_nascimento date not null,
    genero varchar(10),
    email varchar(200),
    telefone varchar(20),
    login varchar(14) not null,
    senha varchar(200) not null,
    criado_por int(11) not null,
    data_da_criacao datetime default now(),
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_usuario)
)engine=InnoDB;


INSERT INTO `tb_usuario`(`nome`, `cpf`, `data_de_nascimento`, `genero`, `email`, `telefone`, `login`, `senha`, `criado_por`) 
    VALUES ('ADMINISTRADOR','111.222.333-44','2018-05-08','MASCULINO','admin@email.com','84-3232-8517','111.222.333-44','111.222.333-44','1');

create table tb_log_acesso(
	id_log int(11) auto_increment not null,
    id_usuario int(11),
    login varchar(14) not null,
    acesso varchar(10) not null,
    data_do_cadastro timestamp default current_timestamp,
    id_status smallint default 1,
    primary key(id_log)
)engine=InnoDB;

create table tb_profissao (
    id_profissao int(11) auto_increment not null,
    profissao varchar(200) not null,        
    criado_por int(11) not null,
    data_da_criacao datetime default now(),
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_profissao)    
)engine=InnoDB;

alter table tb_profissao add constraint `fk_criado_por_profisao` foreign key(`criado_por`) references `tb_usuario` (`id_usuario`);

create table tb_tipo_atendimento (
    id_tipo_atendimento int(11) auto_increment not null,
    tipo_atendimento varchar(200) not null,        
    criado_por int(11) not null,
    data_da_criacao datetime default now(),
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_tipo_atendimento)    
)engine=InnoDB;

alter table tb_tipo_atendimento add constraint `fk_criado_por_tipo_atendimento` foreign key(`criado_por`) references `tb_usuario` (`id_usuario`);

create table tb_log_edicao (
    id_log int(11) auto_increment not null,
    tabela varchar(100),
    id_tabela int(11),
    descricao varchar(1000),
    criado_por int(11) not null,
    data_da_criacao datetime default now(),       
    ativo smallint default 1,
    primary key(id_log)
)engine=InnoDB;

alter table `tb_log_edicao` add constraint `fk_criado_por_log_edicao` foreign key (`criado_por`) references `tb_usuario` (`id_usuario`);

create table tb_estado_civil (
    id_estado_civil int(11) auto_increment not null,
    estado_civil varchar(200) not null,        
    criado_por int(11) not null,
    data_do_cadastro timestamp default current_timestamp,
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_estado_civil)
)engine=InnoDB;

create table tb_paciente (
    id_paciente int(11) auto_increment not null,
    nome varchar(200) not null,    
    cpf varchar(14) not null,    
    cartao_sus varchar(20),  
    genero varchar(10),
    rg varchar(15),
    data_de_nascimento date not null,    
    id_estado_civil varchar(20),
    responsavel varchar(200),
    telefone varchar(20),
    id_profissao int(11),
    cep varchar(20),
    logradouro varchar(200),
    numero varchar(10),
    bairro varchar(200),
    cidade varchar(200),
    uf varchar(200),
    criado_por int(11) not null,
    data_do_cadastro timestamp default current_timestamp,
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_paciente)
)engine=InnoDB;

alter table `tb_paciente` add constraint `fk_criado_por_paciente` foreign key (`criado_por`) references `tb_usuario` (`id_usuario`);
alter table `tb_paciente` add constraint `fk_id_estado_civil_paciente` foreign key (`criado_por`) references `tb_estado_civil` (`id_estado_civil`);
alter table `tb_paciente` add constraint `fk_id_profissao_paciente` foreign key (`criado_por`) references `tb_profissao` (`id_profissao`);

create table tb_estado_civil (
    id_estado_civil int(11) auto_increment not null,
    estado_civil varchar(200) not null,        
    criado_por int(11) not null,
    data_do_cadastro timestamp default current_timestamp,
    modificado_por int(11),
    data_da_modificacao datetime,
    ativo smallint default 1,    
    primary key(id_estado_civil)
)engine=InnoDB;

alter table `tb_estado_civil` add constraint `fk_criado_por_estado_civil` foreign key (`criado_por`) references `tb_usuario` (`id_usuario`);

insert into tb_estado_civil (`estado_civil`, `criado_por`) values ('SOLTEIRO', '1');
insert into tb_estado_civil (`estado_civil`, `criado_por`) values ('CASADO', '1');