DROP DATABASE IF EXISTS Geslibros;
CREATE DATABASE  IF NOT EXISTS Geslibros;
USE Geslibros;

DROP TABLE IF EXISTS generos;
CREATE TABLE IF NOT EXISTS generos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tema VARCHAR(30),
    
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO generos (id, tema) VALUES
(1, 'Informática'),
(2, 'Matemáticas'),
(3, 'Novela'),
(4, 'Viajes'),
(5, 'Belleza'),
(6, 'Deportes'),
(7, 'Astronomía'),
(8, 'Música'),
(9, 'Ciencia'),
(10, 'Idiomas'),
(11, 'Salud');

DROP TABLE IF EXISTS provincias;
CREATE TABLE provincias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    provincia VARCHAR(40),
    
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Provincias (id, provincia) VALUES 
(1, 'Álava'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almería'),
(5, 'Ávila'),
(6, 'Badajoz'),
(7, 'Baleares (Illes)'),
(8, 'Barcelona'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(12, 'Castellón'),
(13, 'Ciudad Real'),
(14, 'Córdoba'),
(15, 'A Coruña'),
(16, 'Cuenca'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(20, 'Guipúzcoa'),
(21, 'Huelva'),
(22, 'Huesca'),
(23, 'Jaén'),
(24, 'León'),
(25, 'Lleida'),
(26, 'La Rioja'),
(27, 'Lugo'),
(28, 'Madrid'),
(29, 'Málaga'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(33, 'Asturias'),
(34, 'Palencia'),
(35, 'Las Palmas'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(38, 'Santa Cruz de Tenerife'),
(39, 'Cantabria'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(48, 'Vizcaya'),
(49, 'Zamora'),
(50, 'Zaragoza'),
(51, 'Ceuta'),
(52, 'Melilla');
 
 DROP TABLE IF EXISTS editoriales;
CREATE TABLE IF NOT EXISTS editoriales (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    direccion VARCHAR(50),
    poblacion VARCHAR(25),
    provincia_id INT,
    c_postal CHAR(5),
    nif CHAR(9) UNIQUE,
    telefono CHAR(9),
    movil CHAR(9) UNIQUE,
    email VARCHAR(40) UNIQUE,
    web VARCHAR(40) UNIQUE,
    contacto VARCHAR(40),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (provincia_id) REFERENCES provincias (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Editoriales (id, nombre, direccion, poblacion, provincia_id, c_postal, nif, telefono, movil, email, web, contacto) VALUES
(1,'Ediciones Paraninfo S.A.','Avda. Filipinas, 50, Bajo, Dcha. puerta A', 'Madrid',28,'28003','A81461477','902995240',NULL, NULL, 'http://www.paraninfo.es', 'Patricia García'),
(2,'MCGRAWHILL','C/ Basauri, 17, 1ª Planta','Aravaca',28,'28023','B28914323', '911803000',NULL, NULL, 'http://www.mcgraw-hill.es/', 'Raquel Huertas'),
(3,'RA-MA, S.A. Editorial y Publicaciones','Cl. Jarama, 3A Polígono Industrial IGARSA','Paracuellos de Jarama',28, '28860','M16584280', '916628139', '916628131','editorial@ra-ma.com','http://www.ra-ma.es/', 'Rocio García'),
(4,'Editorial Planeta, S.A.U.','Avda Diagonal 662-664','Barcelona',8,'08034','A08186249','934928978',NULL,'viajeros@geoplaneta.es','www.editorial.planeta.es','Roberto Rodríguez' ),
(5,'Alfaguara','Calle Torrelaguna, 60','Madrid',28,'28043','A0818624X','917449060','917449224','alfaguara@santillana.es','http://www.alfaguara.com/es/', 'Isidoro Moreno'),
(6, 'Anaya', 'Calle San Francisco, 30 A', 'Madrid', 28, '28014', 'A0012514C', '917458458', '963547852', 'info@anaya.es', 'www.anaya.com', 'Rosario Vázquez'),
(7, 'Santillana', 'Torero Romerito, 30 A', 'Sevilla', 21, '21014', 'A0012518R', '927459458', '963597852', 'info@santillana.es', 'www.santillana.com', 'Rocío Márquez');

--
-- Table structure for table Escritores
--

DROP TABLE IF EXISTS autores;
CREATE TABLE autores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    nacionalidad VARCHAR(20),
    email VARCHAR(45) UNIQUE,
    fecha_nac DATETIME,
    fecha_def DATETIME,
    premios TEXT,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Autores (id, nombre, nacionalidad, email, fecha_nac, fecha_def, premios) VALUES 
(1, 'Gabriel García Márquez', 'Méjico', 'garciamarquez@gmail.com', '1927/12/21', '2014/12/21', 'Planeta, Cervantes, Nobel' ),
(2, 'Oscar Wilde',   'Irlanda', 'oscarwilde@gmail.com', '1854/12/21', '1900/12/21', 'Nobel' ),
(3, 'Jorge Luís Borges', 'Argentina',  'jorgeluisborges@gmail.com', '1899/12/21', '1986/12/21', 'Nobel, Cervantes' ),
(4, 'Ernest Hemingway', 'Estados Unidos',  'ernesthemingway@gmail.com', '1899/12/21', '1961/12/21', 'Nobel, Cervantes' ),
(5, 'Pablo Neruda', 'Chile',  'pabloneruda@gmail.com', '1904/12/21', '1973/12/21', 'Nobel, Cervantes, Planeta' ),
(6, 'Federico García Lorca', 'España',  'federicogarcialorca@gmail.com', '1898/12/21', '1936/12/21', 'Cervantes' );

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS Clientes;
CREATE TABLE Clientes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    direccion VARCHAR(50),
    poblacion VARCHAR(50),
    c_postal CHAR(5),
    provincia_id INT,
    nif CHAR(9) UNIQUE,
    telefono CHAR(9),
    movil CHAR(9) UNIQUE,
    email VARCHAR(45) UNIQUE,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (Provincia_id)
        REFERENCES Provincias (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);


--
-- Dumping data for table `clientes`
--

INSERT INTO Clientes (id, nombre, direccion, poblacion, c_postal, provincia_id, nif, telefono, movil, email, create_at) VALUES 
(1,'CP Rio Tajo','C/Las Flores 23','Guadalajara','19003',19,'34343434L','949876655','949876655','cpriotajo@gmail.com','2011/03/24'),
(2,'IES Brianda de Mendoza','C/Hnos Fernández Galiano 6','Guadalajara','19004',19,'76767667F','949772211','949256376','brianda@correo.es','2011/03/20'),
(3,'Manuel Fernández','Avenida del Atance 24','Guadalajara','19008',19,'22234567E','94980009','949800090','manuel@correo.es','2011-2-28'),
(4,'Alicia Perez González','C/La Azucena 123','Talavera de La Reina','45678',45,'56564564J','925678090','','alicia@sucorreo.es','2011-05-21'),
(5,'Academia Central','C/Espliego 25, Polig Industrial Balconcillo','Azuqueca de Henares','19008',19,'23124234G','949008866','949008866','academia@central.es','2011-07-12'),
(6, 'Ayuntamiento de Ubrique', 'La Plaza, 1', 'Ubrique', '11600', 11, 'E2333213R', '956461290', '956463230', 'info@aytoubrique.es', '2012-08-11'),
(7, 'IES Ntra. Sra. Los Remedios', 'Avd. Herrera Oria, s/n', 'Ubrique', '11600', 11, 'E1212121R', '956461293', '956847841', 'info@ieslosremedios.org', '2013-08-10'),
(9, 'Librería Sierra Nevada', 'Avd. España, 20', 'Ubrique', '11600', 11, 'E1218121T', '956461200', '956847800', 'info@sierrablanca.org', '2017-05-13');


--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS libros;

CREATE TABLE libros (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(80) NOT NULL,
    precio DECIMAL(10 , 2 ) DEFAULT '0.00',
    stock INT UNSIGNED DEFAULT '0',
    fecha_edicion DATE,
    isbn CHAR(13) UNIQUE,
    autor_id INT UNSIGNED,
    editorial_id INT UNSIGNED,
    generos_id varchar(255),
    
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (Editorial_id)
        REFERENCES Editoriales (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Autor_id)
        REFERENCES Autores (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Dumping data for table `libros`
--

INSERT INTO Libros (id, titulo, precio, stock, fecha_edicion, isbn, autor_id, editorial_id, generos_id) VALUES 
(1,'Operaciones Bases de Datos',20.00,16,'2011-05-10', '1231233211234', 1, 3, '3,5,7,9'),
(2, 'Cien Años de Soledad', 25.99, 12, '1967-06-05', '9780307474728', 1, 1, '3,9'),
(3, 'El Retrato de Dorian Gray', 15.49, 8, '1890-07-01', '9780141439570', 2, 2, '3,8'),
(4, 'Ficciones', 18.00, 5, '1944-01-01', '9788467032012', 3, 3, '9,7'),
(5, 'El Viejo y el Mar', 20.00, 10, '1952-09-01', '9780684801223', 4, 4, '3,5'),
(6, 'Veinte Poemas de Amor y una Canción Desesperada', 14.99, 20, '1924-06-01', '9788472232697', 5, 5, '9,8'),
(7, 'La Casa de Bernarda Alba', 12.50, 18, '1936-01-01', '9788491220140', 6, 6, '3,7'),
(8, 'Crónicas de una Muerte Anunciada', 19.90, 6, '1981-01-01', '9780307387143', 1, 1, '3,9'),
(9, 'El Aleph', 21.00, 9, '1949-01-01', '9788467032357', 3, 3, '7,9'),
(10, 'Por Quién Doblan las Campanas', 22.99, 4, '1940-01-01', '9780684803357', 4, 4, '9,3'),
(11, 'Confieso que He Vivido', 24.50, 7, '1974-01-01', '9788432239467', 5, 5, '8,9');



