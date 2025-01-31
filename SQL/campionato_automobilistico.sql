create database db_campionato_automobilistico;

create table db_campionato_automobilistico.piloti(
	nome varchar(30),
	cognome varchar(30),
	nazionalita varchar(30),
	vittorie int default 0,
	numero int auto_increment primary key,
	nome_casa varchar(30) not null,
	colore_casa varchar (30) not null,
	foreign key (nome_casa, colore_casa) references db_campionato_automobilistico.case(nome, colore)
);
 
create table db_campionato_automobilistico.case(
	nome varchar(30),
	colore varchar (30),
	primary key (nome, colore) 
);

create table db_campionato_automobilistico.gara(
	data datetime,
	luogo varchar(30),
	giro_veloce time,
	primary key (data, luogo)
);