create database db_FastRoute;

create table db_FastRoute.destinatari(
 nome varchar(30),
 cognome varchar(30),
 primary key(nome,
cognome)
 );

create table db_FastRoute.stati(
	descrizione varchar(30) primary key -- in partenza/in transito/consegnato
 );

create table db_FastRoute.sedi(
 città varchar(30),
 via varchar(30),
 primary key(città,
via)
 );

create table db_FastRoute.personale(
 email varchar(30) primary key,
 nome varchar(30),
 password varchar(30),
	città varchar(30),
	via varchar(30),
	foreign key (città,
via) references db_FastRoute.sedi(città,
via)
 );

create table db_FastRoute.clienti(
	nome varchar(30),
	cognome varchar(30),
	password varchar(30),
	indirizzo varchar(30),
	punteggio int default 0,
	email varchar(30),
	telefono varchar(30) primary key,
	email_personale varchar(30),
	foreign key (email_personale) references db_FastRoute.personale(email)
);

create table db_FastRoute.plichi(
	id int auto_increment primary key,
	email_personale varchar (30),
	stato varchar(30),
	foreign key (email_personale) references db_FastRoute.personale(email),	
	foreign key (stato) references db_FastRoute.stati(descrizione)
);

create table db_FastRoute.spedire(
	data_spedizione date,
	ora_spedizione time,
	email_personale varchar(30),
	id_plico int,
	foreign key (email_personale) references db_FastRoute.personale(email),
	foreign key (id_plico) references db_FastRoute.plichi(id),
	primary key (email_personale, id_plico)
);

create table db_FastRoute.ritirare(
	data_ritiro date,
	ora_ritiro time,
	nome_destinatario varchar(30),
	cognome_destinatario varchar(30),
	id_plico int,
	foreign key (id_plico) references db_FastRoute.plichi(id),
	foreign key (nome_destinatario, cognome_destinatario) references db_FastRoute.destinatari(nome, cognome),
	primary key (nome_destinatario, cognome_destinatario, id_plico)
);

create table db_FastRoute.consegnare(
	data_consegna date,
	ora_consegna time,
	telefono_mittente varchar(30),
	id_plico int,
	foreign key (telefono_mittente) references db_FastRoute.clienti(telefono),
	foreign key (id_plico) references db_FastRoute.plichi(id),
	primary key (telefono_mittente, id_plico)
);

INSERT INTO db_FastRoute.sedi (città, via) VALUES 
('Milano', 'Via Roma 10'),
('Roma', 'Via Milano 20'),
('Torino', 'Corso Francia 30');

INSERT INTO db_FastRoute.personale (email, nome, password, città, via) VALUES 
('m.rossi@fastroute.com', 'Marco Rossi', 'password123', 'Milano', 'Via Roma 10'),
('l.bianchi@fastroute.com', 'Laura Bianchi', 'secure456', 'Roma', 'Via Milano 20'),
('g.verdi@fastroute.com', 'Giovanni Verdi', 'mypassword', 'Torino', 'Corso Francia 30');

SELECT p.email, p.password FROM db_FastRoute.personale p;
