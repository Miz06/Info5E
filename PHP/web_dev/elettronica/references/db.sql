create database db_elettronica;

create table db_elettronica.prodotti(
                                        codice int auto_increment primary key,
                                        descrizione varchar(30),
                                        costo float,
                                        quantita int,
                                        data_produzione date
);

create table db_elettronica.users(
                                     nome varchar(30),
                                     email varchar(30) primary key,
                                     password varchar(255)
);

create table db_elettronica.admins(
                                     nome varchar(30),
                                     email varchar(30) primary key,
                                     password varchar(255)
);