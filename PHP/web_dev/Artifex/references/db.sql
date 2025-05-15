create database db_artifex;

create table db_artifex.lingue(
                                  nome varchar(100) primary key
);

create table db_artifex.visite(
                                  titolo varchar(100) primary key,
                                  durata_media time,
                                  luogo varchar(100)
);

create table db_artifex.guide(
                                 id int auto_increment primary key,
                                 titolo_studio varchar(100),
                                 cognome varchar(100),
                                 nome varchar(100),
                                 data_nascita date,
                                 luogo_nascita varchar(100)
);

create table db_artifex.turisti(
                                   recapito varchar(100),
                                   nome varchar(100),
                                   nazionalita varchar(100),
                                   email varchar(100) primary key,
                                   lingua_madre varchar(30),
                                   password varchar(255),
                                   foreign key (lingua_madre) references db_artifex.lingue(nome)
);

create table db_artifex.eventi(
                                  id int auto_increment primary key,
                                  data date,
                                  ora_inizio time,
                                  prezzo float,
                                  min_partecipanti int,
                                  max_partecipanti int,
                                  titolo_visita varchar(100),
                                  id_guida int,
                                  foreign key (id_guida) references db_artifex.guide(id),
                                  foreign key (titolo_visita) references db_artifex.visite(titolo)
);

create table db_artifex.prenotare(
                                     id_evento int,
                                     email varchar(100),
                                     primary key (id_evento, email),
                                     foreign key (id_evento) references db_artifex.eventi(id),
                                     foreign key (email) references db_artifex.turisti(email)
);

create table db_artifex.salvare(
                                   id_evento int,
                                   email varchar(100),
                                   primary key (id_evento, email),
                                   foreign key (id_evento) references db_artifex.eventi(id),
                                   foreign key (email) references db_artifex.turisti(email)
);

create table db_artifex.conoscere(
                                     id_guida int,
                                     nome varchar(100),
                                     foreign key (id_guida) references db_artifex.guide(id),
                                     foreign key (nome) references db_artifex.lingue(nome)
);

create table db_artifex.amministratori(
                                          email varchar(30) primary key,
                                          password varchar(255)
);

-- Inserimento lingue
INSERT INTO db_artifex.lingue (nome) VALUES
                                         ('Italiano'),
                                         ('Inglese'),
                                         ('Francese'),
                                         ('Tedesco');

-- Inserimento guide
INSERT INTO db_artifex.guide (titolo_studio, cognome, nome, data_nascita, luogo_nascita) VALUES
                                                                                             ('Laurea in Storia dell’Arte', 'Rossi', 'Maria', '1985-04-12', 'Roma'),
                                                                                             ('Laurea in Archeologia', 'Bianchi', 'Luca', '1978-09-22', 'Milano');

-- Inserimento visite
INSERT INTO db_artifex.visite (titolo, durata_media, luogo) VALUES
                                                                ('Tour Colosseo', '01:30:00', 'Roma'),
                                                                ('Visita Uffizi', '02:00:00', 'Firenze'),
                                                                ('Passeggiata Venezia', '01:00:00', 'Venezia');

-- Inserimento turisti
INSERT INTO db_artifex.turisti (recapito, nome, nazionalita, email, lingua_madre, password) VALUES
                                                                                                ('Via Roma 1', 'John', 'USA', 'john.doe@example.com', 'Inglese', 'pwd123'),
                                                                                                ('Via Milano 45', 'Claire', 'Francia', 'claire.fr@example.com', 'Francese', 'pwd456'),
                                                                                                ('Via Napoli 9', 'Anna', 'Italia', 'anna.rossi@example.com', 'Italiano', 'pwd789');

-- Inserimento eventi
INSERT INTO db_artifex.eventi (data, ora_inizio, prezzo, min_partecipanti, max_partecipanti, titolo_visita, id_guida) VALUES
                                                                                                                          ('2025-06-10', '10:00:00', 25.00, 5, 20, 'Tour Colosseo', 1),
                                                                                                                          ('2025-06-11', '14:00:00', 30.00, 5, 15, 'Visita Uffizi', 2),
                                                                                                                          ('2025-02-10', '10:00:00', 25.00, 5, 20, 'Tour Colosseo', 1),
                                                                                                                          ('2025-02-11', '14:00:00', 30.00, 5, 15, 'Visita Uffizi', 2),
                                                                                                                          ('2025-02-10', '10:00:00', 25.00, 5, 20, 'Passeggiata Venezia', 1),
                                                                                                                          ('2025-02-11', '14:00:00', 30.00, 5, 15, 'Passeggiata Venezia', 2);



-- Inserimento lingue conosciute dalle guide
INSERT INTO db_artifex.conoscere (id_guida, nome) VALUES
                                                      (1, 'Italiano'),
                                                      (1, 'Inglese'),
                                                      (2, 'Francese'),
                                                      (2, 'Italiano');

-- Inserimento amministratori
INSERT INTO db_artifex.amministratori (email, password) VALUES
                                                            ('admin@artifex.com', 'adminpwd'),
                                                            ('direttore@artifex.com', 'direttorepwd');

SELECT * from db_artifex.eventi join db_artifex.visite v on v.titolo = db_artifex.eventi.titolo_visita join db_artifex.guide g on g.id = eventi.id_guida order by db_artifex.eventi.titolo_visita;

SELECT * FROM db_artifex.eventi
                  JOIN db_artifex.visite v ON v.titolo = db_artifex.eventi.titolo_visita
                  JOIN db_artifex.guide g ON g.id = eventi.id_guida;
