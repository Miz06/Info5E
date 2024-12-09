update db_amazon.vendite v
set v.prezzo = 150
where v.prezzo >2000; 

select *
from db_amazon.vendite v 
where v.prezzo = 150;

select v.prezzo
from db_amazon.vendite v 
where v.prezzo between 1000 and 2500;

select v.prezzo
from db_amazon.vendite v;

select distinct v.prezzo 
from db_amazon.vendite v;

select v.prezzo
from db_amazon.vendite v 
where v.prezzo < 2000 and v.prezzo >1000; 

select v.prezzo
from db_amazon.vendite v 
where v.prezzo < 1000 or v.prezzo >2500;

select v.prezzo
from db_amazon.vendite v 
where not v.prezzo = 150;
 
select v.data
from db_amazon.vendite v 
where v.data like "1%";

select v.data
from db_amazon.vendite v 
where v.data like "%0";

select *
from db_amazon.vendite v 
order by v.prezzo;

select *
from db_amazon.vendite v 
order by v.prezzo DESC;

select *
from db_amazon.vendite v 
order by v.prezzo, v.data;


select v.prezzo, v.data, datediff(now(), v.data) as giorni_diff
from db_amazon.vendite v;

-- ordina da più piccolo a più grande 
select v.prezzo, v.data, datediff(now(), v.data) as giorni_diff
from db_amazon.vendite v
order by datediff(now(), v.data) asc;

-- ordina da più grande a più piccolo 
select v.prezzo, v.data, datediff(now(), v.data) as giorni_diff
from db_amazon.vendite v
order by datediff(now(), v.data) desc;

create table db_amazon.personale
(
	prezzo int
);

-- come inserire dei valori in un'altra tabella tramite la select utilizzata su di un'altra tabella
insert into db_amazon.personale
select v.prezzo 
from db_amazon.vendite v
where v.prezzo > 500; 

-- differenza tempo anni, mesi, giorni
select v.prezzo, v.data, 
datediff(now(), v.data)/365 as anniDecimali,
datediff(now(), v.data)div 365 as anniInteri, -- di per ottenere interi dalle divisioni
datediff(now(), v.data)/30 mesiDecimali,
datediff(now(), v.data)div 30 as mesiInteri,
datediff(now(), v.data) as giorni
from db_amazon.vendite v;

-- differenza secondi, minuti, ore
select v.prezzo, v.data,
(unix_timestamp(now())-unix_timestamp(v.data)) as secondi,
(unix_timestamp(now())-unix_timestamp(v.data))div 60 as minuti,
(unix_timestamp(now())-unix_timestamp(v.data))div 3600 as ore,
from db_amazon.vendite v;

-- stampo solamente la "classifica" dei primi 10
select *
from db_amazon.vendite v 
order by v.prezzo desc 
limit 10;

-- count(*) conta le tuple
select count(*)
from db_amazon.vendite v
where v.prezzo <100;

-- max() indica il valore più grande
select max(v.prezzo)
from db_amazon.vendite v;

-- min() indica il valore più piccolo
select min(v.prezzo)
from db_amazon.vendite v;

select sum(v.prezzo)
from db_amazon.vendite v;

-- avg() fa la media del valore specificato di tutte le tuple
select avg(v.prezzo)
from db_amazon.vendite v;

-- group by() 
select *
from db_amazon.vendite v
group by v.data;
