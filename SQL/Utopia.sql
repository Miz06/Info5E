create database db_dinastia_sovrani;
use db_dinastia_sovrani;

create table db_dinastia_sovrani.sovrani(
	nome varchar(30) primary key,
	immagine varchar(30) not null,
	inizio_regno date not null,
	fine_regno date not null,
	successore varchar(30) default '',
	predecessore varchar(30) default '',
	foreign key (successore) references db_dinastia_sovrani.sovrani (nome),
	foreign key (predecessore) references db_dinastia_sovrani.sovrani (nome)
);
