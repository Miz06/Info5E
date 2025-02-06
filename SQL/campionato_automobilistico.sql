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
