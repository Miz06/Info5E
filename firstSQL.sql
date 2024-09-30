create database if not exists scuola;
use scuola;

create table if not exists studenti(
	nome varchar(30),
	cognome varchar(30),
	anni int
); 

insert into studenti (nome, cognome, anni)
values ('Pippo', 'Rossi', 18);

insert into studenti (nome, cognome, anni)
values ('Pluto', 'Rossi', 19), ('Lello', 'Rossi', 17);

delete from scuola.studenti;
drop table studenti;
drop database scuola;


