CREATE DATABASE IF NOT EXISTS PROYECTO;

USE PROYECTO;

CREATE TABLE IF NOT EXISTS USUARIOS(
	id_usuario int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255),
    correo varchar(255),
    usuario varchar(255),
    contraseña varchar(255),
    imagen_url varchar(255) DEFAULT 'img/default_avatar.png',
    tipo_usuario int DEFAULT 0
);

CREATE TABLE IF NOT EXISTS TICKET(
	id_ticket int AUTO_INCREMENT PRIMARY KEY,
    asunto varchar(255),
    fecha datetime DEFAULT CURRENT_TIMESTAMP,
    ultima_actividad datetime DEFAULT CURRENT_TIMESTAMP,
    departamento varchar(255),
    estado varchar(255) DEFAULT 'Pendiente',
    descripcion text,
    respuesta text,
    correo varchar(255),
    usuario_id int,
    CONSTRAINT FK_usuario FOREIGN KEY (usuario_id) REFERENCES USUARIOS(id_usuario)
);

INSERT INTO usuarios(nombre, correo, usuario, contraseña, tipo_usuario) VALUES('administrador', 'admin123@gmail.com', 'admin', '1234', 1);
