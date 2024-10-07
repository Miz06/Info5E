select *
from db_amazon.prodotti p;

select p.famiglia ,p.marca
from db_amazon.prodotti p
where p.famiglia ="";

UPDATE db_amazon.prodotti p
SET p.famiglia = null
WHERE p.famiglia ="";

select p.famiglia ,p.marca
from db_amazon.prodotti p
where p.famiglia is null;

select p.descrizione , p.marca
from db_amazon.prodotti p
where p.marca = "TICINO-ABB";

/*
* "=" uguale
* "<>" o "!=" diverso
*
* "<" maggiore
* ">" minore
* "<=" maggiore uguale
* ">=" minore uguale
*
* "<=>" uguale null-safe
*
* like confronta stringa per vedere se sono simili
*
*/

select p.descrizione, p.marca
from db_amazon.prodotti p
where p.marca like '%B'; -- finisce per B

select p.descrizione, p.marca
from db_amazon.prodotti p
where p.marca like 'T%'; -- inizia per T

select p.descrizione, p.marca
from db_amazon.prodotti p
where p.marca like 'T_C%'; -- T_C% inizia per T e la terza lettera è la C

select p.descrizione, p.marca
from db_amazon.prodotti p
where p.marca like 'V%' or p.marca like 'T%'; -- inizia per V o per T

update db_amazon.prodotti p
set p.descrizione = trim(p.descrizione); -- per rimuovere gli spazi a destra e sinistra, volendo esistono anche per destra e sinistra

select distinct descrizione -- mostra le marche senza duplicati
from prodotti -- una volta utilizzato "use DB" all'inizio dello script non serve specificare il database a cui appartiene la tabella a patto che nel database sia presente solo quella tabella

select *
from db_amazon.prodotti p;

select *
from db_amazon.prodotti p
where p.famiglia like "1%";

select *
from db_amazon.prodotti p
where p.marca = "varie";

select distinct p.marca
from db_amazon.prodotti p;

select p.prezzo
from db_amazon.prodotti p
where (p.prezzo between 70 and 100) or (p.prezzo between 10 and 20); -- estremi compresi

select p.prezzo, p.iva, p.prezzo + p.prezzo/100*p.iva as lordo -- lordo che viene visualizzato come colonna non eisste veramente all'interno della tabella
from db_amazon.prodotti p
where (p.prezzo + p.prezzo/100*p.iva) > 100; -- per il motivo sopra riportato non possiamo utilizzare "lordo" nella condizione