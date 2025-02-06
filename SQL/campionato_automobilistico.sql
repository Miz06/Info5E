create
database db_campionato_automobilistico;
use
db_campionato_automobilistico;

create table db_campionato_automobilistico.case
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
    foreign key (nome_casa) references db_campionato_automobilistico.case (nome)
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
    posizione  int,
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
    foreign key (nome_casa) references db_campionato_automobilistico.case (nome),
    foreign key (data_gara, luogo_gara) references db_campionato_automobilistico.gare (data, luogo)
);

INSERT INTO db_campionato_automobilistico.case (nome, colore)
VALUES ('Mercedes', 'Argento'),
       ('Red Bull', 'Blu'),
       ('McLaren', 'Arancione'),
       ('Aston Martin', 'Verde');

INSERT INTO db_campionato_automobilistico.piloti (nome, cognome, nazionalita, vittorie, nome_casa)
VALUES ('Charles', 'Leclerc', 'Monegasco', 5, 'Ferrari'),
       ('Lewis', 'Hamilton', 'Inglese', 103, 'Mercedes'),
       ('Max', 'Verstappen', 'Olandese', 55, 'Red Bull'),
       ('Lando', 'Norris', 'Inglese', 1, 'McLaren'),
       ('Fernando', 'Alonso', 'Spagnolo', 32, 'Aston Martin');

INSERT INTO db_campionato_automobilistico.gare (data, luogo, tempo_veloce)
VALUES ('2024-03-10 14:00:00', 'Monza', '01:20:34'),
       ('2024-04-07 14:00:00', 'Silverstone', '01:25:6'),
       ('2024-05-12 14:00:00', 'Monaco', '01:12:8'),
       ('2024-06-16 14:00:00', 'Spa-Francorchamps', '01:45:12'),
       ('2024-07-21 14:00:00', 'Suzuka', '01:30:46');

INSERT INTO db_campionato_automobilistico.gareggiare (id_pilota, luogo_gara, data_gara, posizione)
VALUES (1, 'Monza', '2024-03-10 14:00:00', 2),
       (2, 'Monza', '2024-03-10 14:00:00', 1),
       (3, 'Monza', '2024-03-10 14:00:00', 3),
       (4, 'Silverstone', '2024-04-07 14:00:00', 2),
       (5, 'Silverstone', '2024-04-07 14:00:00', 1),
       (3, 'Silverstone', '2024-04-07 14:00:00', 3),
       (1, 'Monaco', '2024-05-12 14:00:00', 1),
       (2, 'Monaco', '2024-05-12 14:00:00', 3),
       (5, 'Monaco', '2024-05-12 14:00:00', 2);

INSERT INTO db_campionato_automobilistico.partecipare (nome_casa, luogo_gara, data_gara)
VALUES ('Ferrari', 'Monza', '2024-03-10 14:00:00'),
       ('Mercedes', 'Monza', '2024-03-10 14:00:00'),
       ('Red Bull', 'Monza', '2024-03-10 14:00:00'),
       ('McLaren', 'Silverstone', '2024-04-07 14:00:00'),
       ('Aston Martin', 'Silverstone', '2024-04-07 14:00:00'),
       ('Red Bull', 'Silverstone', '2024-04-07 14:00:00'),
       ('Ferrari', 'Monaco', '2024-05-12 14:00:00'),
       ('Mercedes', 'Monaco', '2024-05-12 14:00:00'),
       ('Aston Martin', 'Monaco', '2024-05-12 14:00:00');
