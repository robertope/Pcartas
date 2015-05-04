SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Indexes */

DROP INDEX fk_id_carta ON cartas_jugador;
DROP INDEX fk_idcartas_cartas_mazo ON cartas_mazo;
DROP INDEX fk_nombre ON cartas_mazo;
DROP INDEX fk_nombre ON mazos;
DROP INDEX fk_clase_personaje ON personajes;
DROP INDEX fk_raza_personaje ON personajes;



/* Drop Tables */

DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS cartas;
DROP TABLE IF EXISTS cartas_jugador;
DROP TABLE IF EXISTS cartas_mazo;
DROP TABLE IF EXISTS clases;
DROP TABLE IF EXISTS destinos;
DROP TABLE IF EXISTS juego;
DROP TABLE IF EXISTS jugadores;
DROP TABLE IF EXISTS localizaciones;
DROP TABLE IF EXISTS mazos;
DROP TABLE IF EXISTS noticia;
DROP TABLE IF EXISTS personajes;
DROP TABLE IF EXISTS razas;




/* Create Tables */

CREATE TABLE admins
(
	id int NOT NULL,
	name varchar(40) NOT NULL,
	pass varchar(40) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE cartas
(
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(50) NOT NULL,
	rareza varchar(1),
	tipo char DEFAULT 'a' NOT NULL,
	imagen blob NOT NULL,
	textura blob NOT NULL,
	extension char(3) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (nombre)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE cartas_jugador
(
	id_jugador varchar(30) NOT NULL,
	id_carta int DEFAULT 0 NOT NULL,
	n_copias int,
	PRIMARY KEY (id_jugador, id_carta)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE cartas_mazo
(
	nombre varchar(30) NOT NULL,
	idcarta int DEFAULT 0 NOT NULL,
	copias int NOT NULL,
	nombre_jugador varchar(30) NOT NULL,
	PRIMARY KEY (nombre, idcarta, nombre_jugador)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE clases
(
	id int NOT NULL AUTO_INCREMENT,
	clase varchar(30),
	PRIMARY KEY (id),
	UNIQUE (clase)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE destinos
(
	id int DEFAULT 0 NOT NULL,
	destino int DEFAULT 0 NOT NULL,
	PRIMARY KEY (id, destino)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE juego
(
	id int NOT NULL,
	coste int NOT NULL,
	gasta int NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE jugadores
(
	id varchar(30) NOT NULL,
	pass varchar(30) NOT NULL,
	avatar blob,
	mail varchar(100) NOT NULL,
	nombre varchar(30) NOT NULL,
	pais varchar(30),
	recuerdo varchar(555),
	activado boolean DEFAULT '0' NOT NULL,
	monedas int DEFAULT 1000 NOT NULL,
	dinero decimal(6,2) DEFAULT 0,00 NOT NULL,
	activacion varchar(555) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (mail)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE localizaciones
(
	id int NOT NULL,
	localizacion int NOT NULL,
	fbusqueda int NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE mazos
(
	id varchar(30) NOT NULL,
	nombre varchar(30) NOT NULL,
	descripcion varchar(450),
	PRIMARY KEY (id, nombre)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE noticia
(
	id int NOT NULL AUTO_INCREMENT,
	titulo varchar(100) NOT NULL,
	fecha datetime NOT NULL,
	contenido varchar(9999) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


CREATE TABLE personajes
(
	id int NOT NULL,
	fuerza int NOT NULL,
	defensa int NOT NULL,
	coste int NOT NULL,
	gasta int NOT NULL,
	raza int NOT NULL,
	clase int NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;


CREATE TABLE razas
(
	id int NOT NULL AUTO_INCREMENT,
	raza varchar(30),
	PRIMARY KEY (id),
	UNIQUE (raza)
) ENGINE = InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;



/* Create Indexes */

CREATE INDEX fk_id_carta USING BTREE ON cartas_jugador (id_carta ASC);
CREATE INDEX fk_idcartas_cartas_mazo USING BTREE ON cartas_mazo (idcarta ASC);
CREATE INDEX fk_nombre USING BTREE ON cartas_mazo (nombre ASC);
CREATE INDEX fk_nombre USING BTREE ON mazos (nombre ASC);
CREATE INDEX fk_clase_personaje USING BTREE ON personajes (clase ASC);
CREATE INDEX fk_raza_personaje USING BTREE ON personajes (raza ASC);



