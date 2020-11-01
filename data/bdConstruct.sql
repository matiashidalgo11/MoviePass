create database MoviePass;

use MoviePass;

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

create table cines(
    idCine int not null auto_increment,
    nombre varchar(30) not null,
    direccion varchar(30) not null,
    room varchar(30) not null,
    constraint pkCine primary key (idCine)

);
#drop table cines;

create table rooms(
    idRoom int not null auto_increment,
    idCine int unsigned,
    nombre varchar(30) not null,
    capacidad int not null,
    precio int not null,
    constraint fk_idCine foreign key (idCine) references cines(idCine)
   
)
#drop table rooms;

create table funciones(
    idFuncion int not null auto_increment,
    idMovie int unsigned,
    idRoom int unsigned,
    date varchar(30) not null,
    hour TIME(4),
    constraint fk_idCine foreign key (idMovie) references cines(idMovie),
    constraint fk_idCine foreign key (idRoom) references cines(idRoom),
    constraint pkFuncion primary key (idFuncion)

)
#drop table funciones;


