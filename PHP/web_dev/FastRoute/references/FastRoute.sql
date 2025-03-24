create database db_FastRoute;

create table db_FastRoute.destinatari(
                                         nome varchar(30),
                                         cognome varchar(30),
                                         CF varchar(30) primary key
);

create table db_FastRoute.stati(
                                   descrizione varchar(30) primary key -- in partenza/in transito/consegnato
);

create table db_FastRoute.sedi(
                                  citta varchar(30),
                                  via varchar(30),
                                  primary key(citta,
                                              via)
);

create table db_FastRoute.personale(
                                       email varchar(30) primary key,
                                       nome varchar(30),
                                       password varchar(255),
                                       citta varchar(30),
                                       via varchar(30),
                                       foreign key (citta,
                                                    via) references db_FastRoute.sedi(citta,
                                                                                      via)
);

create table db_FastRoute.clienti(
                                     nome varchar(30),
                                     cognome varchar(30),
                                     indirizzo varchar(30),
                                     punteggio int default 0,
                                     email varchar(30) primary key,
                                     telefono varchar(30),
                                     email_personale varchar(30),
                                     foreign key (email_personale) references db_FastRoute.personale(email)
);

create table db_FastRoute.plichi(
                                    id int auto_increment primary key,
                                    email_personale_magazziniere varchar (30),
                                    email_personale_recapito varchar (30),
                                    stato varchar(30) default 'in partenza',
                                    email_mittente varchar(30),
                                    CF_destinatario varchar(30),
                                    foreign key (CF_destinatario) references db_FastRoute.destinatari(CF),
                                    foreign key (email_mittente) references db_FastRoute.clienti(email),
                                    foreign key (email_personale_magazziniere) references db_FastRoute.personale(email),
                                    foreign key (email_personale_recapito) references db_FastRoute.personale(email),
                                    foreign key (stato) references db_FastRoute.stati(descrizione)
);

create table db_FastRoute.spedire(
                                     data_spedizione date NULL,
                                     ora_spedizione time NULL,
                                     email_personale varchar(30),
                                     id_plico int,
                                     foreign key (email_personale) references db_FastRoute.personale(email),
                                     foreign key (id_plico) references db_FastRoute.plichi(id),
                                     primary key (email_personale, id_plico)
);

create table db_FastRoute.ritirare(
                                      data_ritiro DATE NULL,
                                      ora_ritiro TIME NULL,
                                      CF varchar(30),
                                      id_plico int,
                                      foreign key (id_plico) references db_FastRoute.plichi(id),
                                      foreign key (CF) references db_FastRoute.destinatari(CF),
                                      primary key (CF, id_plico)
);

create table db_FastRoute.consegnare(
                                        data_consegna date DEFAULT CURRENT_DATE,
                                        ora_consegna time DEFAULT CURRENT_TIME,
                                        email_mittente varchar(30),
                                        id_plico int,
                                        foreign key (email_mittente) references db_FastRoute.clienti(email),
                                        foreign key (id_plico) references db_FastRoute.plichi(id),
                                        primary key (email_mittente, id_plico)
);

-- ho utilizzato view e non table per consenitre l'aggiornamento automatico della tabella dashboard la quale fa riferimento alle altre sottotabelle da cui è composta
-- utilizzando table la tabella è statica e va aggiornata manualmente in quanto non tiene conto del cambiamento di statodelle sue sottotabelle

create view db_FastRoute.dashboard AS
select
    p.id,
    p.stato,
    c.email_mittente,
    r.CF as CF_destinatario,
    p.email_personale_magazziniere as email_magazziniere,
    c.data_consegna,
    c.ora_consegna,
    s.email_personale as email_corriere,
    s.data_spedizione,
    s.ora_spedizione,
    p.email_personale_recapito as email_recapito,
    r.data_ritiro,
    r.ora_ritiro
    from  db_FastRoute.plichi p
          inner join db_fastroute.ritirare r on r.id_plico = p.id
          inner join db_fastroute.consegnare c on c.id_plico = p.id
          inner join db_fastroute.spedire s on s.id_plico = p.id;
