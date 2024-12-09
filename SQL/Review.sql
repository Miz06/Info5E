use fc;

select *
from fc.report r;

update fc.report r
set r.Ruolo = null 
where r.Ruolo = "";

delete from fc.report 
where Id_ruolo = 1;

select distinct r.Ruolo 
from fc.report r
order by r.Ruolo desc;

select r.Ruolo, count(*)
from fc.report r 
group by r.Ruolo
having r.Ruolo like "A%";

create table fc.new(
	Ruolo varchar(30),
	quantità int
);

insert into fc.new (Ruolo, quantità) 
select r.Ruolo, count(*) 
from fc.report r
group by r.Ruolo;