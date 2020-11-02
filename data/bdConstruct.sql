create database MoviePass;

use MoviePass;

#drop database moviepass;

create table cuentas(
idCuenta int not null auto_increment ,
email varchar(50) not null,
password varchar(50) not null,
privilegios int default 1,
primary key (idCuenta),
constraint uniq_email unique (email)
);
#drop table cuentas;

create table clientes(
idCliente int not null auto_increment,
idCuenta int not null,
dni int not null,
nombre varchar(30) not null,
apellido varchar(30) not null,
telefono varchar(30) not null,
primary key (idCliente),
constraint fk_idCuenta foreign key (idCuenta) references cuentas(idCuenta),
constraint uniq_email unique (dni)
);
#drop table clientes;

create table generos(
idGenero int not null,
nombre varchar(50),
primary key (idGenero),
constraint uniq_nombre unique (nombre)
);
#truncate table generos;

create table movies(
idMovie int not null,
popularity double not null,
video varchar(50) not null,
posterPath varchar(50) not null,
originalLanguage varchar(30) not null,
title varchar(50) not null,
overview text not null,
releaseData date not null,
enabled boolean,
primary key(idMovie)
);
#select * from movies;

create table moviesxgeneros(
idMovie int not null,
idGenero int not null,
primary key(idMovie , idGenero),
constraint fk_idMovie foreign key (idMovie) references movies(idMovie),
constraint fk_idGenero foreign key (idGenero) references generos(idGenero)
);


#drop table moviesxgeneros;
#drop table movies;


