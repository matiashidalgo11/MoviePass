use MoviePass;

insert into cuentas(email,password,privilegios) values
('admin@admin', 'admin',0),
('matias@matias', 'matias',1),
('pepe@pepe', 'pepe',1);

select * from cuentas;
select exists (select * from cuentas where email = 'matias@matias');

insert into clientes(idCuenta, dni, nombre, apellido, telefono) values
(2,1234,'Matias', 'Hidalgo', 1111),
(3,4321,'Pepe', 'Pep', 2222);

select * from clientes;

insert into cines(nombre,capacidad,direccion,precioXentrada) values as ('Cinema',100,'Calle Feliz 123',200);

select * from cines;
