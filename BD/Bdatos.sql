--Inicio Mysql
sudo mysql -u root -p

--Creo la base de datos y la selecciono.
CREATE DATABASE PCBuilder;

USE PCBuilder;


--Creo la tabla de categorias.
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL);

--Creo la tabla de productos.
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) 
    ON DELETE SET NULL);