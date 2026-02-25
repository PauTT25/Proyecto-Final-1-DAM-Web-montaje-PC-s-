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

-- PRODUCTOS PARA PC GAMING ID 1 */  /*Para ver los productos de una categoria en concreto, SELECT * FROM productos WHERE id_categoria = 1; */
INSERT INTO productos (nombre, marca, precio, imagen_url, stock, id_categoria) VALUES 
('Starter Gaming R5', 'AMD', 750.00, 'pc-gaming-starter.jpg', 15, 1),
('Pro Gamer RTX 4070', 'MSI', 1450.99, 'pc-gaming-pro.jpg', 8, 1),
('Ultra Enthusiast Liquid', 'ASUS ROG', 2890.00, 'pc-gaming-ultra.jpg', 3, 1),
('NVIDIA GeForce RTX 4080', 'Gigabyte', 1199.00, 'gpu-rtx4080.jpg', 5, 1);

-- PRODUCTOS PARA PC OFICINA ID 2 */
INSERT INTO productos (nombre, marca, precio, imagen_url, stock, id_categoria) VALUES 
('Workstation Office i5', 'Intel', 520.00, 'pc-oficina-basic.jpg', 20, 2),
('Laptop Business Slim', 'Lenovo', 740.50, 'laptop-office.jpg', 12, 2),
('Mini PC Compact Pro', 'HP', 450.00, 'mini-pc.jpg', 10, 2),
('Monitor 24" Eye Care', 'BenQ', 145.00, 'monitor-office.jpg', 25, 2);

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

GRANT ALL PRIVILEGES ON pcbuilder_db.* TO 'U_PCBuilder'@'localhost';

FLUSH PRIVILEGES;