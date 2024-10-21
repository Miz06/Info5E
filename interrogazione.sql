create database if not exists scuola;
use scuola;

create table if not exists scuola.smartboard(
	marca varchar(20),
	numero_serie int,
	size int,
	data_creazione datetime
);

insert into scuola.smartboard(marca, numero_serie, size, data_creazione) values
('marca1', 1, 90, '2024/6/12'),
('marca2', 2, 90, '2024/5/23'),
('marca4', 3, 90, '2024/12/20'),
('marca4', 4, 90, '2024/8/22'),
('marca5', 5, 90, '2024/10/19'); 

select *
from scuola.smartboard s
where s.size > 85;

select *, datediff(now(), s.data_creazione) as età 
from SCUOLA.smartboard s ;

select count(*)
from scuola.smartboard s;

select *
from scuola.mock_data m
order by m.first_name;

select avg(m.id)
from scuola.mock_data m
where m.id <10;

select sum(m.id)
from scuola.mock_data m;

select max(m.id)
from scuola.mock_data m;

select min(m.id)
from scuola.mock_data m;

select *
from scuola.mock_data m
where m.ip_address like "%/24" or m.ip_address like "%/16";

select *, count(*)
from scuola.mock_data m
where m.ip_address like "%/23" or m.ip_address like "%/16" -- dove utilizziamo le funzioni di aggregazione bisogna utilizzare having al posto di where
group by m.first_name, m.last_name;

select *, count(*) as quantity
from scuola.smartboard s 
group by s.marca;

select *
from scuola.smartboard s 
order by s.numero_serie asc;

delete table scuola.smartboard;
truncate table scuola.smartboard;
drop table scuola.smartboard;
drop table scuola.mock_data;
drop database scuola;


