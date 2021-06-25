
CREATE DATABASE bdTeatro;
USE bdTeatro;

CREATE TABLE Teatro(
    id_Teatro int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_Teatro varchar(50) NOT NULL,
    direccion_Teatro varchar(30) NOT NULL
);

CREATE TABLE Funciones(
    id_Teatro int UNSIGNED NOT NULL,
    id_Funciones int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_Funcion varchar(60) NOT NULL,
    horaInicio varchar(10) NOT NULL,
    duracion varchar(10) NOT NULL,
    precioPublico int(10) NOT NULL,
    costoSala int(10) NOT NULL,
    FOREIGN KEY (id_Teatro) REFERENCES Teatro(id_Teatro) 
);

CREATE TABLE Cine(
    id_Funciones int UNSIGNED,
    paisOrigen varchar(100) NOT NULL,
    genero varchar(100) NOT NULL,
    FOREIGN KEY (id_Funciones) REFERENCES Funciones(id_Funciones) 
);

CREATE TABLE Musical(
    id_Funciones int UNSIGNED,
    director varchar(100) NOT NULL,
    cantPersonas int(3) NOT NULL,
    FOREIGN KEY (id_Funciones) REFERENCES Funciones(id_Funciones) 
);

CREATE TABLE obraTeatral(
    id_Funciones int UNSIGNED,
    FOREIGN KEY (id_Funciones) REFERENCES Funciones(id_Funciones)
);

INSERT INTO teatro(id_Teatro,nombre_Teatro,direccion_Teatro) VALUES (1,'colon','coronel villegas 123');

INSERT INTO Funciones(id_Teatro,id_Funciones,nombre_Funcion,horaInicio,duracion,precioPublico,costoSala) VALUES(1,1,"iron man", "13:00", "1:00",400,0);
INSERT INTO Cine(id_Funciones,paisOrigen,genero) VALUES (1,"EEUU","ciencia ficcion");
