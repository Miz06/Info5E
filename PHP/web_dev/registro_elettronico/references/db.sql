create database db_registro;

create table db_registro.insegnanti(
                                       username varchar(30) primary key,
                                       password varchar(255),
                                       nome varchar(30),
                                       cognome varchar(30)
);

create table db_registro.amministratori(
                                           username varchar(30) primary key,
                                           password varchar(255),
                                           nome varchar(30),
                                           cognome varchar(30)
);

create table db_registro.studenti(
                                     username varchar(30) primary key,
                                     password varchar(255),
                                     nome varchar(30),
                                     cognome varchar(30)
);

create table db_registro.genitori(
                                     username varchar(30) primary key,
                                     password varchar(255),
                                     nome varchar(30),
                                     cognome varchar(30),
                                     username_studente varchar(30),
                                     foreign key (username_studente) references db_registro.studenti(username)
);