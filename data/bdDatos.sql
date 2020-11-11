use MoviePass;

insert into cuentas(email,password,privilegios) values
('admin@admin', 'admin',0),
('matias@matias', 'matias',1),
('pepe@pepe', 'pepe',1);

insert into profiles(idCuenta, dni, nombre, apellido, telefono, direccion) values
(2,1234,'Matias', 'Hidalgo', 1111,"calle 1"),
(3,4321,'Pepe', 'Pep', 2222, "calle 2");

insert into cines(nombre, direccion) values ("Cine1", "Calle 1"), ("Cine2", "Calle 2"), ("Cine3", "Calle 3");

insert into rooms(idCine, nombre, capacidad, precio) value (3,"Sala 1", 100, 75) , 
(3,"Sala 2", 50, 75) ,
(3,"Sala 3", 70, 75) ;

select * from funciones;

insert into funciones(idMovie, idRoom, dayFuncion, hour, soldTickets) value (724989,1,"2020-11-11", "15:30", 0), (446893,1,"2020-11-11", "14:00", 0), (724989,1,"2020-11-11", "16:00", 0);

select * from funciones;

select * from movies;

select * from rooms;

select * from compras;

select * from cuentas;
select * from profiles;

select * from cuentas;

select * from funciones;

select * from tickets;