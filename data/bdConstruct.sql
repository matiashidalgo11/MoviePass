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