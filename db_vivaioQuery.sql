-- vedere quante volte compare una pianta nel vivaio
select r.nome_latino, count(*)
from vivaio.report r
group by r.nome_latino;

-- vedere quante volte compare una pianta nel vivaio in base all'id 
select distinct r.id,  count(*)
from vivaio.report r
group by r.id
order by count(*) desc;

-- non si può fare!!
select distinct r.id, count(r.id) 
from vivaio.report r;

-- per vedere quante piante ha fornito ogni fornitore
select r.nome, r.fornitore_id , count(r.nome)
from vivaio.report r
group by r.fornitore_id;

create table if not exists vivaio.piante(
	 id int,
	 nome_latino varchar(100),
	 nome_comune varchar(100),
	 esotica boolean
);

create table if not exists vivaio.fornitori(
	 fornitore_id int,
	 partita_iva VARCHAR(11),
	 codice_fiscale VARCHAR(16),
	 nome VARCHAR(50),
	 cognome VARCHAR(50),
	 indirizzo VARCHAR(100),
	 cap VARCHAR(5),
	 comune VARCHAR(50),
	 provincia VARCHAR(2)
);

-- aggiungere a una nuova teballa delle tuple già esistenti appartenenti ad un'altra tabella
insert into vivaio.piante(id, nome_latino, nome_comune, esotica)
select r.id, r.nome_latino, r.nome_comune, r.esotica
from vivaio.report r;

-- aggiungere a una nuova teballa delle tuple già esistenti appartenenti ad un'altra tabella
-- (fornitori inseriti solamente una volta)
insert into vivaio.fornitori(fornitore_id, partita_iva, codice_fiscale, nome, cognome, indirizzo, cap, comune, provincia)
select distinct r.fornitore_id, r.partita_iva, r.codice_fiscale, r.nome, r.cognome, r.indirizzo, r.cap, r.comune, r.provincia
from vivaio.report r
group by r.fornitore_id;

-- rimuovere il contentuto da una tabella
delete from vivaio.fornitori;
truncate table vivaio.fornitori;

-- eliminare una tabella
drop table vivaio.fornitori;

-- eliminare un database
drop database vivaio.fornitori;
