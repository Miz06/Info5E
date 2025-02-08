create
database db_campionato_automobilistico;
use
db_campionato_automobilistico;

create table db_campionato_automobilistico.case_automobilistiche
(
    nome   varchar(30) primary key,
    colore varchar(30)
);

create table db_campionato_automobilistico.piloti
(
    nome        varchar(30),
    cognome     varchar(30),
    nazionalita varchar(30),
    vittorie    int default 0,
    numero      int auto_increment primary key,
    nome_casa   varchar(30) not null,
    foreign key (nome_casa) references db_campionato_automobilistico.case_automobilistiche (nome)
);

create table db_campionato_automobilistico.gare
(
    data         datetime,
    luogo        varchar(30),
    tempo_veloce time,
    primary key (data, luogo)
);

-- rappresenta la relazione molti a molti tra piloti e gare
create table db_campionato_automobilistico.gareggiare
(
    id_pilota  int,
    luogo_gara varchar(30),
    data_gara  datetime,
    tempo      time,
    primary key (id_pilota, luogo_gara, data_gara),
    foreign key (id_pilota) references db_campionato_automobilistico.piloti (numero),
    foreign key (data_gara, luogo_gara) references db_campionato_automobilistico.gare (data, luogo)
);

-- rappresenta la relazione molti a molti tra case e gare
create table db_campionato_automobilistico.partecipare
(
    nome_casa  varchar(30),
    luogo_gara varchar(30),
    data_gara  datetime,
    primary key (nome_casa, luogo_gara, data_gara),
    foreign key (nome_casa) references db_campionato_automobilistico.case_automobilistiche (nome),
    foreign key (data_gara, luogo_gara) references db_campionato_automobilistico.gare (data, luogo)
);

INSERT INTO db_campionato_automobilistico.case_automobilistiche (nome, colore)
VALUES ('Mercedes', 'Argento'),
       ('Red Bull', 'Blu'),
       ('McLaren', 'Arancione'),
       ('Aston Martin', 'Verde');

INSERT INTO db_campionato_automobilistico.piloti (nome, cognome, nazionalita, vittorie, nome_casa)
VALUES ('Lewis', 'Hamilton', 'Inglese', 103, 'Mercedes'),
       ('Max', 'Verstappen', 'Olandese', 55, 'Red Bull'),
       ('Lando', 'Norris', 'Inglese', 1, 'McLaren'),
       ('Fernando', 'Alonso', 'Spagnolo', 32, 'Aston Martin'),
       ('Sebastian', 'Vettel', 'Tedesco', 53, 'Aston Martin');

INSERT INTO db_campionato_automobilistico.gare (data, luogo, tempo_veloce)
VALUES ('2024-03-10 14:00:00', 'Monza', '00:01:34'),
       ('2024-04-07 14:00:00', 'Silverstone', '00:01:40'),
       ('2024-05-12 14:00:00', 'Monaco', '00:01:45'),
       ('2024-06-16 14:00:00', 'Spa-Francorchamps', '00:01:28'),
       ('2024-07-21 14:00:00', 'Suzuka', '00:01:51');

INSERT INTO db_campionato_automobilistico.gareggiare (id_pilota, luogo_gara, data_gara, tempo)
VALUES (1, 'Monza', '2024-03-10 14:00:00', '01:15:36'),
       (2, 'Monza', '2024-03-10 14:00:00', '01:20:24'),
       (3, 'Monza', '2024-03-10 14:00:00', '01:45:11'),
       (4, 'Silverstone', '2024-04-07 14:00:00', '01:15:10'),
       (5, 'Silverstone', '2024-04-07 14:00:00', '01:55:01'),
       (3, 'Silverstone', '2024-04-07 14:00:00', '01:15:09'),
       (1, 'Monaco', '2024-05-12 14:00:00', '01:39:56'),
       (2, 'Monaco', '2024-05-12 14:00:00', '01:27:35'),
       (5, 'Monaco', '2024-05-12 14:00:00', '01:26:22');

INSERT INTO db_campionato_automobilistico.partecipare (nome_casa, luogo_gara, data_gara)
VALUES ('Mercedes', 'Monza', '2024-03-10 14:00:00'),
       ('Red Bull', 'Monza', '2024-03-10 14:00:00'),
       ('McLaren', 'Silverstone', '2024-04-07 14:00:00'),
       ('Aston Martin', 'Silverstone', '2024-04-07 14:00:00'),
       ('Red Bull', 'Silverstone', '2024-04-07 14:00:00'),
       ('Mercedes', 'Monaco', '2024-05-12 14:00:00'),
       ('Aston Martin', 'Monaco', '2024-05-12 14:00:00');

create table db_campionato_automobilistico.datiCampionato as
select p.nome,
       p.cognome,
       p.nazionalita,
       p.numero,
       p.vittorie,
       p.nome_casa,
       c.colore     as colore_casa,
       g.data_gara  as data_gara,
       g.luogo_gara as luogo_gara,
       g.tempo      as tempo,
       g1.tempo_veloce
from db_campionato_automobilistico.piloti p
         join db_campionato_automobilistico.case_automobilistiche c on p.nome_casa = c.nome
         join db_campionato_automobilistico.gareggiare g on p.numero = g.id_pilota
         join db_campionato_automobilistico.gare g1 on g.luogo_gara = g1.luogo and g.data_gara = g1.data;
