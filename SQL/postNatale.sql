create database if not exists sistems;
use sistems;

create table if not exists sistems.proprietari(
	id int auto_increment primary key,
	nome varchar(30),
	cognome varchar(30)
);

create table if not exists sistems.access_point(
	id_produttore int not null check (id_produttore between 1 and 4),
	prezzo int,
	porte int,
	marca varchar(30),
	foreign key (id_produttore) references sistems.proprietari(id)
);

insert into sistems.proprietari(nome, cognome) values
('nome1', 'cognome1'),
('nome2', 'cognome2'),
('nome3', 'cognome3'),
('nome4', 'cognome4');

insert into sistems.access_point(id_produttore, prezzo, porte, marca) values
(1, 100, 5, 'marca1'),
(3, 130, 3, 'marca2'),
(2, 80, 10, 'marca3'),
(4, 90, 8, 'marca4'),
(2, 150, 4, 'marca5'),
(3, 50, 8, 'marca8'),
(2, 70, 12, 'marca6'),
(4, 850, 3, 'marca7');

select *
from sistems.access_point ap
order by ap.id_produttore asc;

delete from sistems.access_point
where id_produttore = 1;

select *
from sistems.proprietari p
inner join sistems.access_point a on p.id = a.id_produttore;

select *
from sistems.proprietari p
left join sistems.access_point a on p.id = a.id_produttore;

select *
from sistems.proprietari p
right join sistems.access_point a on p.id = a.id_produttore;

update sistems.access_point 
set prezzo = 130 
where marca = 'marca1';

delete from sistems.access_point
where marca = 'marca2';

-- delete from sistems.access_point;
-- truncate table sistems.access_point;

-- drop table sistems.access_point;
-- drop table sistems.proprietari;
-- drop database sistems;





