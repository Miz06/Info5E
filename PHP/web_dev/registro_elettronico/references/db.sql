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
                                          foreign (ruolo) references db_registro.persona(persone),
                                          foreign (username) references db_registro.persona(persone),
);

CREATE TABLE db_registro.genitori_studenti(
                                              username_genitore varchar(30),
                                              username_figlio varchar(30),
                                              foreign key(username_genitore) references db_registro.persone(username),
                                              foreign key(username_figlio) references db_registro.persone(username)
);

CREATE TABLE db_registro.materie(
                                    materia

);


