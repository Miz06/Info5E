create database db_dinastia_sovrani;
use db_dinastia_sovrani;

create table db_dinastia_sovrani.sovrani(
	nome varchar(30) primary key,
	immagine varchar(30),
	inizio_regno date,
	fine_regno date,
	successore varchar(30),
	predecessore varchar(30),
	foreign key (successore) references db_dinastia_sovrani.sovrani (nome),
	foreign key (predecessore) references db_dinastia_sovrani.sovrani (nome)
);