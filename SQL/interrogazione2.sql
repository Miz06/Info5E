create database if not exists prova2;
use prova2;

create table if not exists prova2.rivista(
	titolo varchar(30),
	prezzo int,
	editore varchar(30),
	data datetime
);

insert into prova2.rivista(titolo, prezzo, editore, data) values
("titolo1", 1, "editore1", '2024-12-06'),
("titolo2", 2, "editore2", '2024-6-16'),
("titolo3", 3, "editore3", '2024-10-18'),
("titolo4", 4, "editore4", '2024-2-7'),
("titolo5", 5, "editore5", '2024-7-9');

-- giorni passati dalla publicazione
select *, datediff(now(), r.data) as pubblicazione
from prova2.rivista r
where r.data < now();

-- riviste pubblicate da ogni editore
select r.editore, count(*) as riviste_pubblicate
from prova2.rivista r
group by r.editore;

-- ----------------------------------------

create table prova2.sedia(
	tipologia varchar(30),
	colore varchar(30),
	n_inventario int not null, 
	data_fabbricazione datetime
);

insert into prova2.sedia(tipologia, colore, n_inventario, data_fabbricazione) values
('legno', 'bianco', 1, '2024-8-10'),
('plastica', 'giallo', 2, '2024-05-19'),
('braccioli', 'bianca', 3, '2024-12-09'),
('legno', 'verde', 4, '2023-8-10'),
('plastica', 'blu', 5, '2021-05-19');

select *
from prova2.sedia s
where s.n_inventario between 3 and 5;

-- per vedere la quantità di sedie per ogni tipologia
select *, count(*) as n_sedie 
from prova2.sedia s
group by s.tipologia;

-- per vedere la quantità di sedie per una tipologia specifica
select *, count(*) as n_sedie 
from prova2.sedia s
where s.tipologia = 'legno'
group by s.tipologia;

-- per vedere la quantità di sedie per una tipologia specifica (almeno aventi più di una sedia)
select *, count(*) as n_sedie 
from prova2.sedia s
group by s.tipologia
having count(*) > 1;




