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

create table dn_artifex.turisti(
                                   recapito varchar(100),
                                   nome varchar(100),
                                   nazionalita varchar(100),
                                   email varchar(100),
                                   lingua_madre varchar(30),
                                   foreign key (lingua_madre) references db_artifex.lingue(nome)
);

create table db_artifex.eventi(
                                  data date,
                                  ora_inizio datetime,
                                  prezzo float,
                                  min_partecipanti int,
                                  max_partecipanti int,
                                  titolo_visita varchar(100),
                                  id_guida int,
                                  foreign key (id_guida) references db_artifex.guide(id),
                                  primary key (data, ora_inizio, titolo_visita),
                                  foreign key (titolo_visita) references db_artifex.visite(titolo)
);

create table db_artifex.prenotare(
                                     data date,
                                     ora_inizio time,
                                     titolo_visita varchar(100),
                                     email varchar(100),
                                     primary key(data, ora_inizio, titolo_visita, email)
                                         foreign key (data, ora_inizio, titolo_visita) references db_artifex.eventi(nome, ora_inizio, titolo_visita),
                                     foreign key (email) references db_artifex.turisti(email)
);

create table db_artifex.conoscere(
                                     id_guida int,
                                     nome varchar(100),
                                     foreign key (id_guida) references db_artifex.guide(id),
                                     foreign key (nome) references db_artifex.ligue(nome),
);

