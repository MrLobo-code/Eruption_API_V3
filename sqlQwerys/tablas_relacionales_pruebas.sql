use pruebas

create table cargo(
	idcargo int identity(1,1) primary key,
	nombre_cargo varchar(50) not null
)

create table genero(
	idgenero int identity(1,1) primary key,
	nombre_genero varchar(50) not null
)

create table persona (
    idpersona int identity(1,1) primary key,
    dni char(10), 
    nombres varchar(80) ,
    apellidos varchar(80),
    idcargo int, /*clave foranea*/
    idgenero int /*clave foranea*/
    /*Relaciones de tablas*/
    constraint fk_cargo foreign key(idcargo) references cargo(idcargo),
    constraint fk_genero foreign key(idgenero) references genero(idgenero)
)
 select * from persona

 insert into persona (dni, nombres, apellidos, idcargo, idgenero) values('AHHHH', 'AHHHH', 'AHHHH', 2, 2)
 insert into cargo (nombre_cargo) values('mando3')
 insert into genero (nombre_genero) values('trans')

 select *
 from persona
 inner join cargo on cargo.idcargo = persona.idcargo
 inner join genero on genero.idgenero = persona.idgenero
