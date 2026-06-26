CREATE DATABASE IF NOT EXISTS santotomasescuela CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE santotomasescuela;

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rango VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    ci VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL,
    domicilio VARCHAR(255) NOT NULL,
    telefono VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS cursante (
    id_cursante INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    CONSTRAINT fk_cursante_cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE IF NOT EXISTS agenda (
    id_agenda INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    CONSTRAINT fk_agenda_cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE IF NOT EXISTS asistencia (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ci VARCHAR(20) NOT NULL,
    asistencia1 VARCHAR(20) NOT NULL,
    asistencia2 VARCHAR(20) NOT NULL,
    asistencia3 VARCHAR(20) NOT NULL,
    asistencia4 VARCHAR(20) NOT NULL,
    asistencia5 VARCHAR(20) NOT NULL
);