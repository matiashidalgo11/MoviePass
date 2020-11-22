create database IF NOT EXISTS MoviePass;

use MoviePass;

#drop database  moviepass;

create table IF NOT EXISTS cuentas(
idCuenta int not null auto_increment ,
email varchar(50) not null,
password varchar(50),
privilegios int default 1,
idFacebook bigint default null,
primary key (idCuenta),
constraint uniq_email unique (email)
);
#drop table cuentas;

create table  IF NOT EXISTS profiles(
idCuenta int not null,
dni int not null,
nombre varchar(30) not null,
apellido varchar(30) not null,
telefono varchar(30) not null,
direccion varchar(50) not null,
primary key (dni),
constraint fk_idCuenta foreign key (idCuenta) references cuentas(idCuenta),
constraint uniq_email unique (dni)
);
#drop table  profiles;

create table  IF NOT EXISTS generos(
idGenero int not null,
nombre varchar(50),
primary key (idGenero),
constraint uniq_nombre unique (nombre)
);
#truncate table generos;

create table IF NOT EXISTS movies(
idMovie int not null,
popularity double not null,
video varchar(150) not null,
posterPath varchar(150) not null,
originalLanguage varchar(30) not null,
title varchar(100) not null,
overview text not null,
releaseData date not null,
enabled boolean,
primary key(idMovie)
);
#select * from movies;

create table IF NOT EXISTS moviesxgeneros(
idMovie int not null,
idGenero int not null,
primary key(idMovie , idGenero),
constraint fk_idMovie foreign key (idMovie) references movies(idMovie),
constraint fk_idGenero foreign key (idGenero) references generos(idGenero)
);
#drop table IF  moviesxgeneros;
#drop table movies;

create table IF NOT EXISTS cines(
    idCine int not null auto_increment,
    nombre varchar(30) not null,
    direccion varchar(30) not null,
    primary key (idCine)

);
#drop table IF NOT EXISTS cines;

create table IF NOT EXISTS rooms(
    idRoom int not null auto_increment,
    idCine int not null,
    nombre varchar(30) not null,
    capacidad int not null,
    precio int not null,
    primary key (idRoom),
    constraint fk_idCine foreign key (idCine) references cines(idCine)
   
);
#drop table rooms;

create table IF NOT EXISTS funciones(

    idFuncion int not null auto_increment,
    idMovie int ,
    idRoom int ,
    dayFuncion varchar(30) not null,
    hour TIME(4),
	primary key (idFuncion),
    constraint fk_idMovief foreign key (idMovie) references movies(idMovie),
    constraint fk_idRoom foreign key (idRoom) references rooms(idRoom)

);
#drop table funciones;


create table IF NOT EXISTS compras(
	idCompra int not null auto_increment,
    fecha date not null,
    idFuncion int,
    totalTickets double not null,
    descuento double not null,
    idCuenta int not null,
    codigoPago varchar(100),
    primary key (idCompra),
    constraint fk_idCuentaC foreign key (idCuenta) references cuentas(idCuenta),
    constraint fk_idFuncionC foreign key (idFuncion) references funciones (idFuncion)
);
#drop table compras;

create table IF NOT EXISTS tickets(
	idTicket int not null auto_increment,
    idCompra int not null,
    idFuncion int not null,
    primary key (idTicket),
    constraint fk_idCompraT foreign key (idCompra) references compras(idCompra),
    constraint fk_idFuncionT foreign key (idFuncion) references funciones(idFuncion)
);
#drop table tickets;

create table IF NOT EXISTS pagos(
    idPago int NOT null auto_increment,
    idCompra int ,
    total int,
    constraint foreign key (idCompra) references compras(idCompra),
    primary key (idPago)

);
#drop table pagos;

ALTER table funciones ADD enabled boolean;
ALTER table rooms ADD enabled boolean;
ALTER table cines ADD enabled boolean;

ALTER table pagos ADD idCompra int;
ALTER table pagos ADD constraint foreign key (idCompra) references compras(idCompra);
ALTER TABLE pagos DROP COLUMN codigoPago;