create database db_elettronica;

create table db_elettronica.prodotti(
                                        codice int auto_increment primary key,
                                        descrizione varchar(30),
                                        costo float,
                                        quantita int,
                                        data_produzione date default CURRENT_DATE
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

INSERT INTO db_elettronica.prodotti (descrizione, costo, quantita, data_produzione) VALUES
                                                                                        ('Resistenza 10kΩ', 0.50, 100, '2024-01-15'),
                                                                                        ('Condensatore 100µF', 0.80, 50, '2024-02-10'),
                                                                                        ('Transistor BC547', 1.20, 75, '2023-12-05'),
                                                                                        ('Arduino Uno', 25.00, 30, '2024-03-20'),
                                                                                        ('Raspberry Pi 4', 60.00, 20, '2024-01-08'),
                                                                                        ('LED Rosso 5mm', 0.10, 200, '2024-02-25'),
                                                                                        ('Microcontrollore ATmega328', 5.50, 40, '2023-11-30'),
                                                                                        ('Sensore di temperatura DHT11', 3.00, 60, '2024-03-05'),
                                                                                        ('Modulo Bluetooth HC-05', 7.50, 35, '2024-01-22'),
                                                                                        ('Motore passo-passo NEMA 17', 15.00, 25, '2024-02-18');
