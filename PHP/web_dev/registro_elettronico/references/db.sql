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

create table db_registro.materie(
                                    nome varchar(30) primary key
);

create table db_registro.indirizzi(
                                      nome varchar(30) primary key
);

create table db_registro.articolazioni(
                                          nome varchar(30) primary key,
                                          indirizzo varchar(30),
                                          foreign key (indirizzo) references db_registro.indirizzi(nome)
);

create table db_registro.PDS(
                                id int auto_increment primary key,
                                descrizione varchar(30)
);

create table db_registro.classi(
                                   id varchar(30) primary key,
                                   articolazione varchar(30),
                                   foreign key(articolazione) references db_registro.articolazioni(nome)
);

create table db_registro.docenti_materie(
                                            username varchar(30),
                                            nome varchar(30),
                                            primary key(username, nome),
                                            foreign key(username) references db_registro.persone(username),
                                            foreign key(nome) references db_registro.materie(nome)
);

create table db_registro.docenti_classi(
                                           username varchar(30),
                                           id varchar(30),
                                           primary key(username, id),
                                           foreign key(username) references db_registro.persone(username),
                                           foreign key(id) references db_registro.classi(id)
);

create table db_registro.PDS_materie(
                                        id int,
                                        materia varchar(30),
                                        foreign key (id) references db_registro.PDS(id),
                                        foreign key (materia) references db_registro.materie(nome)
);







