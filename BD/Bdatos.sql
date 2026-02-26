--Inicio Mysql
sudo mysql -u root -p

--Creo la base de datos y la selecciono.
CREATE DATABASE PCBuilder;

USE PCBuilder;


--Creo la tabla de categorias definiedo las diferentes categorias (oficina y gaming).
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL);

--Creo la tabla de productos la cual guardara los productos que se muestran en las tarjetas.
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255),           /* URL de la imagen del producto */
    stock INT DEFAULT 0,               /* Para poder mantener un control de inventario */
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE SET NULL);

/* Inserto las categorias */
INSERT INTO categorias (nombre_categoria) VALUES ('PC Gaming');
INSERT INTO categorias (nombre_categoria) VALUES ('PC Oficina');

/* Inserto los productos */
/* ID 1 = PC Gaming | ID 2 = PC Oficina */

-- PRODUCTOS PARA PC GAMING ID 1  /* Para ver los productos de una categoria en concreto, SELECT * FROM productos WHERE id_categoria = 1; */
-- Insertamos Procesadores (id_categoria = 1)
INSERT INTO productos (nombre, marca, precio, imagen_url, stock, id_categoria) VALUES 
('AMD Ryzen 5 5600X', 'AMD', 155.00, 'cpu-r5.jpg', 20, 1),
('Intel Core i7-12700K', 'Intel', 320.00, 'cpu-i7.jpg', 15, 1);

-- PRODUCTOS PARA PC OFICINA ID 2 
-- Insertamos Memorias RAM (id_categoria = 2)
INSERT INTO productos (nombre, marca, precio, imagen_url, stock, id_categoria) VALUES 
('Corsair Vengeance 16GB (2x8)', 'Corsair', 75.00, 'ram-16gb.jpg', 30, 2),
('G.Skill Trident Z 32GB', 'G.Skill', 120.00, 'ram-32gb.jpg', 10, 2);

-- Creamos el usuario con su contraseña y asignamos los permisos necesarios.
CREATE USER 'U_PCBuilder'@'localhost' 
IDENTIFIED BY 'PCBuilder2026$';

GRANT USAGE ON *.* TO 'U_PCBuilder'@'localhost';

ALTER USER 'U_PCBuilder'@'localhost' 
REQUIRE NONE
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON PCBuilder.* TO 'U_PCBuilder'@'localhost';

FLUSH PRIVILEGES;