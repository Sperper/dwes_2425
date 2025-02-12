-- Base de datos Proyecto Album
-- Proyecto Tema 7 - Gestión Album Fotografías

DROP DATABASE IF EXISTS album;
CREATE DATABASE IF NOT EXISTS album;

USE album;

DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE,
    descripcion VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categorias (nombre, descripcion) VALUES
('Naturaleza', 'Fotos de paisajes, plantas y animales'),
('Urbano', 'Fotos de ciudades y arquitectura'),
('Retratos', 'Fotos de personas y retratos'),
('Eventos', 'Fotos de eventos y celebraciones'),
('Abstracto', 'Fotos abstractas y artísticas');


DROP TABLE IF EXISTS albumes;
CREATE TABLE IF NOT EXISTS albumes(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    titulo varchar(100) NOT NULL,
    descripcion TEXT NOT NULL,
    autor varchar(50),
    fecha DATE,
    lugar varchar(50),
	categoria_id INT UNSIGNED,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL ON UPDATE CASCADE,
    num_fotos smallint unsigned,
    num_visitas smallint unsigned,
    carpeta varchar(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password CHAR(60),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS roles;
CREATE TABLE IF NOT EXISTS roles(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    description VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS roles_users;
CREATE TABLE IF NOT EXISTS roles_users(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNSIGNED,
    role_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roles VALUES
(1, 'Administrador', 'Todos los privilegios de la aplicación', default, default),
(2, 'Editor', 'Sólo podrá consultar, modificar y añadir información. No podrá eliminar', default, default),
(3, 'Registrado', 'Sólo podrá realizar consultas', default, default);

DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(

    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE,
    descripcion VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);