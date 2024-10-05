create database if not exists db_negozio;
use db_negozio;

create table if not exists db_negozio.prodotti(
	nome_articolo varchar(30),
	prezzo int
);

insert into db_negozio.prodotti(nome_articolo, prezzo)
values("Articolo11", 8), ("Articolo43", 19); 

update db_negozio.prodotti 
set prezzo = 12
where prezzo = 8;

select prezzo
from db_negozio.prodotti
where prezzo=12;

/*
select *
from db_negozio.prodotti
*/