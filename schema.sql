DROP TABLE IF EXISTS persona;
DROP TABLE IF EXISTS compania_aerea;
DROP TABLE IF EXISTS empleado_en;

DROP TABLE IF EXISTS tripulacion_en;
DROP TABLE IF EXISTS piloto_en;
DROP TABLE IF EXISTS copiloto_en;
DROP TABLE IF EXISTS licencia_piloto;

DROP TABLE IF EXISTS cliente;
DROP TABLE IF EXISTS reserva;
DROP TABLE IF EXISTS ticket;

DROP TABLE IF EXISTS vuelo;
DROP TABLE IF EXISTS aerodromo;
DROP TABLE IF EXISTS ciudad;
DROP TABLE IF EXISTS punto;
DROP TABLE IF EXISTS ruta;
DROP TABLE IF EXISTS aeronave;
DROP TABLE IF EXISTS costo;


CREATE TABLE persona(
	id serial PRIMARY KEY,
	nombre varchar NOT NULL,
	nacimiento date NOT NULL,
	pasaporte varchar UNIQUE NOT NULL
);

CREATE TABLE compania_aerea(
	codigo char(3) PRIMARY KEY,
	nombre varchar NOT NULL
);

CREATE TABLE empleado_en(
	trabajador_id integer,
	compania_codigo char(3),
	PRIMARY KEY (trabajador_id, compania_codigo)
);

CREATE TABLE tripulacion_en(
	trabajador_id integer,
	vuelo_id integer,
	rol varchar NOT NULL,
	PRIMARY KEY (trabajador_id, vuelo_id)
);

CREATE TABLE piloto_en(
	trabajador_id integer,
	vuelo_id integer,
	rol varchar NOT NULL,
	PRIMARY KEY(trabajador_id, vuelo_id)
);

CREATE TABLE copiloto_en(
	trabajador_id integer,
	vuelo_id integer,
	rol varchar NOT NULL,
	PRIMARY KEY(trabajador_id, vuelo_id)
);

CREATE TABLE licencia_piloto(
	piloto_id integer,
	licencia_id integer,
	PRIMARY KEY(piloto_id, licencia_id)
);

CREATE TABLE cliente(
	persona_id integer PRIMARY KEY,
	nacionalidad varchar NOT NULL
);

CREATE TABLE reserva(
	id serial PRIMARY KEY,
	comprador_id integer NOT NULL,
	codigo varchar UNIQUE NOT NULL
);

CREATE TABLE ticket(
	numero serial PRIMARY KEY,
	reserva_id integer NOT NULL,
	vuelo_id integer NOT NULL,
	persona_id integer NOT NULL,
	numero_asiento varchar NOT NULL, -- REVISAR tipo
	clase varchar NOT NULL,
	comida_y_maleta boolean NOT NULL

	-- UNIQUE vuelo asiento
);

CREATE TABLE vuelo(
	id serial PRIMARY KEY,
	aerodromo_salida_id integer NOT NULL,
	aerodromo_llegada_id integer NOT NULL,
	ruta_id integer NOT NULL,
	codigo_aeronave char(7) NOT NULL,
	codigo_compania char(3) NOT NULL,
	fecha_salida timestamp NOT NULL,
	fecha_llegada timestamp NOT NULL,
	velocidad real NOT NULL,
	altitud real NOT NULL,
	estado varchar NOT NULL
);

CREATE TABLE aerodromo(
	id serial PRIMARY KEY,
	ciudad_id integer NOT NULL,
	nombre varchar NOT NULL,
	ICAO char(4) UNIQUE NOT NULL,
	IATA char(3) UNIQUE NOT NULL,
	latitud real NOT NULL,
	longitud real NOT NULL
);

CREATE TABLE ciudad(
	id serial PRIMARY KEY,
	nombre varchar NOT NULL,
	pais varchar NOT NULL
);

CREATE TABLE ruta(
	id serial PRIMARY KEY,
	nombre varchar NOT NULL
);

CREATE TABLE punto(
	ruta_id integer NOT NULL,
	cardinalidad integer NOT NULL,
	nombre varchar NOT NULL,
	latitud real NOT NULL,
	longitud real NOT NULL,
	PRIMARY KEY(ruta_id, cardinalidad)
);

CREATE TABLE aeronave(
	codigo char(7) PRIMARY KEY,
	nombre varchar NOT NULL,
	modelo varchar NOT NULL,
	peso real NOT NULL
);

CREATE TABLE costo(
	peso real,
	ruta_id integer,
	valor integer NOT NULL,
	PRIMARY KEY(peso, ruta_id)
);


\copy persona from './data/persona.csv' DELIMITER ',' CSV HEADER;
\copy compania_aerea from './data/compania_aerea.csv' DELIMITER ',' CSV HEADER;
\copy empleado_en from './data/empleado_en.csv' DELIMITER ',' CSV HEADER;

\copy tripulacion_en from './data/tripulacion_en.csv' DELIMITER ',' CSV HEADER;
\copy piloto_en from './data/piloto_en.csv' DELIMITER ',' CSV HEADER;
\copy copiloto_en from './data/copiloto_en.csv' DELIMITER ',' CSV HEADER;
\copy licencia_piloto from './data/licencia_piloto.csv' DELIMITER ',' CSV HEADER;

\copy cliente from './data/cliente.csv' DELIMITER ',' CSV HEADER;
\copy reserva from './data/reserva.csv' DELIMITER ',' CSV HEADER;
\copy ticket from './data/ticket.csv' DELIMITER ',' CSV HEADER;

\copy vuelo from './data/vuelo.csv' DELIMITER ',' CSV HEADER;
\copy aerodromo from './data/aerodromo.csv' DELIMITER ',' CSV HEADER;
\copy ciudad from './data/ciudad.csv' DELIMITER ',' CSV HEADER;
\copy ruta from './data/ruta.csv' DELIMITER ',' CSV HEADER;
\copy punto from './data/punto.csv' DELIMITER ',' CSV HEADER;
\copy aeronave from './data/aeronave.csv' DELIMITER ',' CSV HEADER;
\copy costo from './data/costo.csv' DELIMITER ',' CSV HEADER;
