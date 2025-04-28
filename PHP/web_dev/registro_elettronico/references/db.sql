CREATE database db_registro;

CREATE TABLE db_registro.persone(
                                    nome varchar(30),
                                    cognome varchar(30),
                                    username varchar(30) PRIMARY KEY,
                                    password varchar(255)
);

CREATE TABLE db_registro.ruoli(
                                  ruolo varchar(30) PRIMARY key
);

CREATE TABLE db_registro.persone_ruoli(
                                          ruolo varchar(30),
                                          username varchar(30),
                                          foreign key (ruolo) references db_registro.ruoli(ruolo),
                                          foreign key (username) references db_registro.persone(username)
);

CREATE TABLE db_registro.genitori_studenti(
                                              username_genitore varchar(30),
                                              username_figlio varchar(30),
                                              primary key(username_genitore, username_figlio),
                                              foreign key(username_genitore) references db_registro.persone(username),
                                              foreign key(username_figlio) references db_registro.persone(username)
);

CREATE TABLE db_registro.materie(
                                    nome varchar(100) primary key
);

CREATE TABLE db_registro.indirizzi(
                                      nome varchar(100) primary key
);

CREATE TABLE db_registro.articolazioni(
                                          nome varchar(100) primary key,
                                          indirizzo varchar(100),
                                          foreign key (indirizzo) references db_registro.indirizzi(nome)
);

CREATE TABLE db_registro.PDS(
                                id int auto_increment primary key,
                                descrizione varchar(100),
                                articolazione varchar(100),
                                foreign key (articolazione) references db_registro.articolazioni(nome)
);

CREATE TABLE db_registro.classi(
                                   id varchar(30) primary key,
                                   articolazione varchar(100),
                                   foreign key(articolazione) references db_registro.articolazioni(nome)
);

CREATE TABLE db_registro.docenti_materie(
                                            username varchar(30),
                                            nome varchar(100),
                                            primary key(username, nome),
                                            foreign key(username) references db_registro.persone(username),
                                            foreign key(nome) references db_registro.materie(nome)
);

CREATE TABLE db_registro.docenti_classi(
                                           username varchar(30),
                                           id varchar(30),
                                           primary key(username, id),
                                           foreign key(username) references db_registro.persone(username),
                                           foreign key(id) references db_registro.classi(id)
);

CREATE TABLE db_registro.PDS_materie(
                                        id int,
                                        materia varchar(100),
                                        foreign key (id) references db_registro.PDS(id),
                                        foreign key (materia) references db_registro.materie(nome)
);

CREATE TABLE db_registro.studenti_classi(
                                            id varchar(30),
                                            username varchar(30),
                                            foreign key(username) references db_registro.persone(username),
                                            foreign key(id) references db_registro.classi(id)
);

-- Inserimento dei ruoli
INSERT INTO db_registro.ruoli (ruolo) VALUES
                                          ('genitore'),
                                          ('studente'),
                                          ('insegnante'),
                                          ('amministratore');

-- Associazioni persone-ruoli
INSERT INTO db_registro.persone_ruoli (username, ruolo) VALUES
                                                            ('persona1', 'genitore'),
                                                            ('persona2', 'studente'),
                                                            ('persona3', 'studente'),
                                                            ('persona4', 'insegnante'),
                                                            ('persona5', 'amministratore');

-- Inserimento di alcune materie
INSERT INTO db_registro.materie (nome) VALUES
                                           ('Matematica'),
                                           ('Italiano'),
                                           ('Inglese'),
                                           ('Informatica');

-- Inserimento di alcuni indirizzi
INSERT INTO db_registro.indirizzi (nome) VALUES
                                             ('Informatica e Telecomunicazioni'),
                                             ('Liceo Scientifico');

-- Inserimento di articolazioni
INSERT INTO db_registro.articolazioni (nome, indirizzo) VALUES
                                                            ('Informatica', 'Informatica e Telecomunicazioni'),
                                                            ('Telecomunicazioni', 'Informatica e Telecomunicazioni'),
                                                            ('Scienze Applicate', 'Liceo Scientifico');

-- Inserimento di classi
INSERT INTO db_registro.classi (id, articolazione) VALUES
                                                       ('5A', 'Informatica'),
                                                       ('4B', 'Scienze Applicate');

-- Associazioni docenti-materie (persona4 è insegnante)
INSERT INTO db_registro.docenti_materie (username, nome) VALUES
                                                             ('persona4', 'Informatica'),
                                                             ('persona4', 'Matematica');

-- Associazioni docenti-classi
INSERT INTO db_registro.docenti_classi (username, id) VALUES
    ('persona4', '5A');
('persona4', '4B');

-- Inserimento di alcuni Piani di Studio (PDS)
INSERT INTO db_registro.PDS (descrizione, articolazione) VALUES
                                                             ('Piano di studi Informatica', 'Informatica'),
                                                             ('Piano di studi Scienze Applicate', 'Scienze Applicate');

-- Associazioni PDS-materie
INSERT INTO db_registro.PDS_materie (id, materia) VALUES
                                                      (1, 'Matematica'),
                                                      (1, 'Informatica'),
                                                      (2, 'Italiano'),
                                                      (2, 'Inglese');

-- Associazioni PDS-persone-classi
INSERT INTO db_registro.studenti_classi (id, username) VALUES
                                                           ('5A', 'persona2'),
                                                           ('4B', 'persona3');

-- Query per creare la vista
CREATE VIEW db_registro.classe_indirizzo_articolazione AS
SELECT
    c.id AS classe,
    c.articolazione AS articolazione,
    a.indirizzo AS indirizzo
FROM
    db_registro.classi c
        INNER JOIN
    db_registro.articolazioni a ON c.articolazione = a.nome;
