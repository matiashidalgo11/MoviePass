use MoviePass;

insert into cuentas(email,password,privilegios) values
('admin@admin', 'admin',0),
('matias@matias', 'matias',1),
('pepe@pepe', 'pepe',1);

select * from cuentas;
select exists (select * from cuentas where email = 'a@a');
SELECT EXISTS (SELECT * FROM cuentas WHERE email = 'a@a');


insert into clientes(idCuenta, dni, nombre, apellido, telefono) values
(2,1234,'Matias', 'Hidalgo', 1111),
(3,4321,'Pepe', 'Pep', 2222);

select * from clientes;
select * from cuentas;
SELECT * from movies;
select * from generos;
select * from moviesxgeneros
where idMovie = 337401;

delete from moviesxgeneros
where idMovie = 337401;


UPDATE movies
SET popularity = 821.904,
video = "",
posterPath = 'asda',
originalLanguage = 'ja',
title = 'Pepe',
overview = 'pelicula extranjera',
releaseData = '2020-09-04',
enabled = true
WHERE idMovie = 337401;
