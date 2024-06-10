DROP TABLE IF EXISTS rt_usuario CASCADE;
DROP TABLE IF EXISTS like_usuario CASCADE;
DROP TABLE IF EXISTS respuestas CASCADE;
DROP TABLE IF EXISTS rt CASCADE;
DROP TABLE IF EXISTS likes CASCADE;
DROP TABLE IF EXISTS seguidores CASCADE;
DROP TABLE IF EXISTS notificaciones CASCADE;
DROP TABLE IF EXISTS perfil CASCADE;
DROP TABLE IF EXISTS tweets CASCADE;
DROP TABLE IF EXISTS usuario CASCADE;
DROP TABLE IF EXISTS usuario_lista CASCADE;
DROP TABLE IF EXISTS lista CASCADE;

CREATE TABLE usuario (
    id serial PRIMARY KEY NOT NULL,
    nombre varchar(255),
    apellido varchar(255),
    nick varchar(255),
    contrasenya varchar(255),
    correo varchar (255),
    foto varchar (255),
    fecha_nacimiento date,
    rol varchar(255)
);

CREATE TABLE tweets (
    id serial PRIMARY KEY NOT NULL,
    texto varchar(255),
    link varchar(255),
    fecha_publicacion varchar(255),
    id_usuario integer REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE perfil (
    id serial primary key NOT NULL,
    subidas integer,
    estado varchar(255),
    id_usuario Integer,
    id_tweet Integer,
    constraint fk_perfil_usuario foreign key (id_usuario)  references usuario(id) ON DELETE CASCADE,
    constraint fk_perfil_tweet foreign key (id_tweet)  references tweets(id) ON DELETE CASCADE
);

CREATE TABLE notificaciones (
    id serial primary key NOT NULL,
    id_usuarioEm Integer,
    id_usuarioRe Integer,
    Tipo_notificacion varchar(255),
    visto boolean,
    constraint fk_notificaciones_usuarioem foreign key (id_usuarioem)  references usuario(id) ON DELETE CASCADE,
    constraint fk_notificaciones_usuariore foreign key (id_usuariore)  references usuario(id) ON DELETE CASCADE
);

CREATE TABLE seguidores (
    id SERIAL PRIMARY KEY,
    id_usuario_seguidor INTEGER,
    id_usuario_seguido INTEGER,
    fecha_seguimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_seguidor) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario_seguido) REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE likes (
    id serial primary key NOT NULL,
    recuento Integer,
    id_usuario Integer,
    id_tweet Integer,
    constraint fk_likes_usuario foreign key (id_usuario)  references usuario(id) ON DELETE CASCADE,
    constraint fk_likes_tweet foreign key (id_tweet)  references tweets(id) ON DELETE CASCADE
);

CREATE TABLE rt (
    id serial primary key NOT NULL,
    recuento Integer,
    id_usuario Integer,
    id_tweet Integer,
    constraint fk_rt_usuario foreign key (id_usuario)  references usuario(id) ON DELETE CASCADE,
    constraint fk_rt_tweet foreign key (id_tweet)  references tweets(id) ON DELETE CASCADE
);

CREATE TABLE respuestas (
    id serial primary key NOT NULL,
    texto varchar(255),
    id_usuario Integer,
    id_tweet Integer,
    constraint fk_respuestas_tweet foreign key (id_tweet)  references tweets(id) ON DELETE CASCADE
);

CREATE TABLE like_usuario (
    id_usuario Integer,
    id_like Integer,
    constraint fk_like_usuario_usuario foreign key (id_usuario) references usuario(id) ON DELETE CASCADE,
    constraint fk_like_usuario_like foreign key (id_like) references usuario(id) ON DELETE CASCADE
);

CREATE TABLE rt_usuario (
    id_usuario Integer,
    id_rt Integer,
    constraint fk_rt_usuario_usuario foreign key (id_usuario) references usuario(id) ON DELETE CASCADE,
    constraint fk_rt_usuario_rt foreign key (id_rt) references tweets(id) ON DELETE CASCADE
);

CREATE TABLE lista (
    id SERIAL PRIMARY KEY,
    id_usuario INT REFERENCES usuario(id) ON DELETE CASCADE,
    nombre_lista VARCHAR(50)
);

CREATE TABLE usuario_lista (
    id SERIAL PRIMARY KEY,
    id_lista INT REFERENCES lista(id) ON DELETE CASCADE,
    id_usuario INT REFERENCES usuario(id) ON DELETE CASCADE
);


INSERT INTO usuario (nombre, apellido, nick, contrasenya, correo, foto, fecha_nacimiento, rol)
VALUES
('Juan', 'Pérez', 'juanp', 'password123', 'juan.perez@example.com', 'juan.jpg', '1985-05-20', 'user'),
('María', 'Gómez', 'mariag', 'mypassword', 'maria.gomez@example.com', 'maria.jpg', '1990-06-15', 'user'),
('Carlos', 'López', 'carlito', '1234abcd', 'carlos.lopez@example.com', 'carlos.jpg', '1978-11-30', 'user'),
('Ana', 'Martínez', 'ana123', 'ana2020', 'ana.martinez@example.com', 'ana.jpg', '1992-03-25', 'user'),
('Luis', 'Fernández', 'luisf', 'password456', 'luis.fernandez@example.com', 'luis.jpg', '1988-09-12', 'admin');



INSERT INTO tweets (texto, link, fecha_publicacion, id_usuario)
VALUES
('Este es mi primer tweet!', 'image1.jpg', '2023-01-01', 1),
('Disfrutando de unas vacaciones', 'vacaciones.jpg', '2023-01-05', 2),
('Leyendo un libro fascinante', 'libro.jpg', '2023-01-10', 3),
('Hoy cociné una receta nueva', 'receta.jpg', '2023-01-15', 4),
('Trabajo duro, pero vale la pena', 'trabajo.jpg', '2023-01-20', 5);

INSERT INTO perfil (subidas, estado, id_usuario, id_tweet)
VALUES
(10, 'Activo', 1, 1),
(8, 'En vacaciones', 2, 2),
(15, 'Leyendo', 3, 3),
(5, 'Cocinando', 4, 4),
(20, 'Trabajando', 5, 5);



INSERT INTO respuestas (texto, id_usuario, id_tweet)
VALUES
('¡Genial tweet!', 2, 1),
('Me encantó la foto', 3, 2),
('¿Qué libro es?', 4, 3),
('Quiero la receta', 5, 4),
('Muy inspirador', 1, 5);


INSERT INTO notificaciones (id_usuarioEm, id_usuarioRe, Tipo_notificacion, visto)
VALUES
(1, 2, 'like', false),
(2, 3, 'retweet', true),
(3, 4, 'follow', false),
(4, 5, 'mention', true),
(5, 1, 'like', false);


INSERT INTO seguidores (id_usuario_seguidor, id_usuario_seguido, fecha_seguimiento)
VALUES
(1, 1, CURRENT_TIMESTAMP), -- Cambia los valores de id_usuario_seguidor e id_usuario_seguido según tu estructura de usuarios.
(2, 2, CURRENT_TIMESTAMP),
(3, 3, CURRENT_TIMESTAMP),
(4, 4, CURRENT_TIMESTAMP),
(5, 5, CURRENT_TIMESTAMP);



INSERT INTO likes (recuento, id_usuario, id_tweet)
VALUES
(10, 1, 1),
(20, 2, 2),
(30, 3, 3),
(40, 4, 4),
(50, 5, 5);


INSERT INTO rt (recuento, id_usuario, id_tweet)
VALUES
(5, 1, 1),
(15, 2, 2),
(25, 3, 3),
(35, 4, 4),
(45, 5, 5);


INSERT INTO like_usuario (id_usuario, id_like)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);



INSERT INTO rt_usuario (id_usuario, id_rt)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);


INSERT INTO lista (id_usuario, nombre_lista) VALUES
(1, 'Amigos'),
(2, 'Familia'),
(3, 'Trabajo');


INSERT INTO usuario_lista (id_lista, id_usuario) VALUES
(1, 2),
(2, 3),
(3, 1);