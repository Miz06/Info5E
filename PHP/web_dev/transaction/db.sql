CREATE database registroscuola2;

CREATE TABLE registroscuola2.Persone (
                                         cf CHAR(16) PRIMARY KEY,
                                         nome VARCHAR(100),
                                         cognome VARCHAR(100),
                                         dataDiNascita DATE,
                                         residenza VARCHAR(255),
                                         telefono VARCHAR(20)
);

CREATE TABLE registroscuola2.Studenti (
                                          cf CHAR(16) PRIMARY KEY,
                                          matricola VARCHAR(50) unique,
                                          indirizzo VARCHAR(255),
                                          media DECIMAL(4,2) check (media>=1 and media <=10),
                                          foreign key (cf) references registroscuola2.Persone(cf) on delete cascade on update cascade
);

select * from registroscuola2.Persone p
                  join registroscuola2.Studenti s on s.cf = p.cf;

delete from registroscuola2.Persone where cf = 'MZZSDRTFOTEIRF22';

update registroscuola2.Persone set cf = 'MZZSDRTFOTEIRF00' where cf = 'MZZSDRTFOTEIRF55';