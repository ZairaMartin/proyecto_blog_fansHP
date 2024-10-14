DROP DATABASE IF EXISTS blog_harry;
CREATE DATABASE blog_harry;
USE blog_harry;

CREATE TABLE casas(
    id_casa int auto_increment PRIMARY KEY,
    nombre_casa ENUM('Gryffindor', 'Slytherin', 'Hufflepuff','Ravenclaw') UNIQUE,
    puntos_totales int NOT NULL DEFAULT 0
);

CREATE TABLE usuarios(
    id_usuario int auto_increment PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_casa int NOT NULL,
    puntos int NOT NULL DEFAULT 0,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    FOREIGN KEY (id_casa) REFERENCES casas(id_casa)
);

CREATE TABLE categorias(
    id_categoria int auto_increment PRIMARY KEY,
    nombre ENUM('Personajes', 'Criaturas', 'Hechizos', 'Lugares', 'Noticias') UNIQUE
);

CREATE TABLE post(
    id_post int auto_increment PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    contenido TEXT NOT NULL,
    id_usuario int NOT NULL,
    id_categoria int NOT NULL,
    fecha_publicacion DATE NOT NULL ,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);



INSERT INTO casas (nombre_casa, puntos_totales) VALUES ('Gryffindor', 0);
INSERT INTO casas (nombre_casa, puntos_totales) VALUES ('Slytherin', 0);
INSERT INTO casas (nombre_casa, puntos_totales) VALUES ('Hufflepuff', 0);
INSERT INTO casas (nombre_casa, puntos_totales) VALUES ('Ravenclaw', 0);


INSERT INTO categorias (nombre) VALUES ('Noticias');
INSERT INTO categorias (nombre) VALUES ('Personajes');
INSERT INTO categorias (nombre) VALUES ('Criaturas');
INSERT INTO categorias (nombre) VALUES ('Hechizos');
INSERT INTO categorias (nombre) VALUES ('Lugares');

INSERT INTO `usuarios` ( `nombre`, `email`, `password`, `id_casa`, `puntos`, `rol`) VALUES
('Harry Potter', 'harry@potter.com', '$2y$04$YFK2ONS40vlKNGi57EJ7wuzyXP7LkdRyZS4/OY3/61vkjEnMmfePK', 1, 0, 'usuario'),
('Hermione Granger', 'hermione@granger.com', '$2y$04$SjKfTZew3CQ75zPSZrJUO.AU.BEZXlbnTBPbFIUrTEhT7lQSvKWea', 1, 0, 'usuario'),
('Luna Lovegood', 'luna@lovegood.com', '$2y$04$pWqh7QgLWQXttj7LMhmlOOsD5OHSwgevRLntltF4L0RIfnF7ub.IS', 4, 0, 'usuario'),
('Sybill Trelawney', 'sybill@trelawney.com', '$2y$04$TlB1LRF.tNh0DWo19nLXVe/AxEMjjBq/nCx3henSjKCVMGvaZU7ce', 4, 0, 'usuario'),
('Cedric Diggory', 'cedric@diggory.com', '$2y$04$xJGjZSsZ3W4aTTanW5n/6O7cVMapqFn/s2gpyMyohhmAsP/ZdSZ3S', 3, 0, 'usuario'),
('Rolf Scamander', 'rolf@scamander.com', '$2y$04$jnv.QBzXw43JepgAr/NzVe0d8B/WF5hjrQrLTMtkfF/QZHNz6bNJi', 3, 0, 'usuario'),
('Draco Malfoy', 'draco@malfoy.com', '$2y$04$2.7PkxeCbZaE7oatFLi2vuTbiIgz4jKZ2XNdlzhyiOs8jb2S5vetu', 2, 0, 'usuario'),
('Seveurs Snape', 'severus@snape.com', '$2y$04$5GxM81UwhytMeJ9Lf4JkuepxTAeTuxZL8yzVodz8Gd6P3b3EcRMl.', 2, 0, 'usuario');



INSERT INTO post(titulo, contenido, id_usuario, id_categoria) VALUES
    ('Ver más allá de las apariencias.',
    '¡Hola a todos! Soy Luna Lovegood y hoy quiero compartir con ustedes algo sobre los Thestrals. Estas criaturas asombrosas pueden parecer un poco aterradoras al principio, con su apariencia esquelética y sus alas de murciélago, pero en realidad son muy pacíficas y leales. Sólo aquellos que han visto la muerte pueden verlos, lo cual les confiere un aire de misterio y melancolía. Los Thestrals tienen una increíble habilidad para encontrar su camino a través de los lugares más intrincados y peligrosos, lo que los convierte en magníficos guías. Recuerdo mi primer vuelo en uno de ellos: fue una experiencia liberadora, como si comprendieran el dolor y la pérdida que cargamos. Así que, aunque a menudo se les malinterprete, los Thestrals son un recordatorio de que la verdadera belleza puede encontrarse en los lugares más insospechados. ¡Nunca dejen de ver más allá de las apariencias!',
    3,3),

    ('Héroes sin nombre',
    'Hola, soy Harry Potter. Hoy quiero hablarles de un personaje que quizá no conozcan mucho, pero que tiene un corazón tan valiente como cualquier héroe: Regulus Arcturus Black. Regulus, el hermano menor de Sirius, fue un Slytherin que comenzó como un ferviente seguidor de Lord Voldemort, pero su lealtad a su familia y su conciencia lo llevaron a un camino diferente. Descubrió los horrocruxes de Voldemort y, comprendiendo el peligro que representaban, decidió destruir uno de ellos. Aunque su sacrificio pasó desapercibido para la mayoría, su acto de valentía y arrepentimiento fue crucial en la caída del Señor Tenebroso. Es un recordatorio de que incluso en la oscuridad más profunda, siempre hay esperanza para la redención. Así que, la próxima vez que escuchen el nombre Regulus Black, recuerden su coraje y la importancia de seguir nuestros principios, incluso cuando nadie más lo vea.',
    1,2),

    ('Antiguo Profesor de Criaturas Mágicas',
    'Hoy quiero contarles sobre un personaje menos conocido pero muy importante en la historia de Hogwarts: Silvanus Kettleburn. Él fue el profesor de Cuidado de Criaturas Mágicas antes de Hagrid y era famoso por su amor apasionado por las criaturas mágicas, aunque a veces esa pasión le costaba más de un dedo. Kettleburn era un mago excéntrico y entusiasta, que dedicó su vida a estudiar y cuidar de las criaturas más extraordinarias del mundo mágico. Aunque su enfoque a veces era un poco temerario, su conocimiento y dedicación inspiraron a muchos estudiantes. Se retiró para disfrutar de un tiempo tranquilo con sus criaturas después de perder varios de sus miembros en sus aventuras. La próxima vez que piensen en la clase de Cuidado de Criaturas Mágicas, recuerden a Silvanus Kettleburn y su inquebrantable espíritu de aventura y amor por la naturaleza mágica.',
    5,2),

    ('Conversaciones Privadas',
    'Hola a todos, soy Hermione Granger y hoy quiero hablarles de un hechizo poco conocido pero increíblemente útil: el "Muffliato". Este encantamiento, que descubrimos en el libro del Príncipe Mestizo, es fascinante por su simplicidad y efectividad. Al conjurarlo, llenas los oídos de cualquier persona cercana con un zumbido indetectable, impidiendo que escuchen conversaciones privadas. Es especialmente útil en situaciones donde la discreción es esencial. Aunque inicialmente parecía algo que sólo los estudiantes traviesos usarían, su valor en la protección de información confidencial no puede ser subestimado. Sin embargo, como con cualquier hechizo, es importante usarlo con responsabilidad y ética. En el mundo mágico, el conocimiento es poder, pero la integridad y el respeto por los demás son aún más importantes. ¡Espero que esta pequeña lección sobre "Muffliato" les haya resultado interesante!',
    2,4),
    
    ('Agua para días calurosos',
    'Hoy quiero hablarles sobre un hechizo poco conocido pero sumamente intrigante: "Aguamenti". Este encantamiento conjura agua potable de la punta de la varita, lo cual puede ser increíblemente útil en diversas situaciones. Imaginen estar atrapados en un lugar sin acceso a agua fresca o necesitar apagar un pequeño incendio rápidamente; Aguamenti puede ser la solución perfecta.
    Aunque parece sencillo, dominar este hechizo requiere una concentración precisa y una clara visualización del agua fluyendo. No es tan espectacular como algunos de los hechizos más llamativos, pero su practicidad y versatilidad lo convierten en una herramienta valiosa en el arsenal de cualquier mago o bruja. Además, este hechizo nos recuerda que la magia no siempre se trata de grandes explosiones o transformaciones dramáticas; a veces, los encantamientos más simples pueden tener el mayor impacto en nuestra vida diaria.',
    7,4),
    
    ('Malinterpretados por su aspecto, de nuevo',
    '¡Hola a todos! Soy Rolf Scamander, magizoólogo y nieto del famoso Newt Scamander. Hoy quiero hablarles sobre una de las criaturas mágicas más fascinantes que he tenido el privilegio de estudiar: el Augurey. También conocido como el fénix irlandés, el Augurey es una ave de aspecto sombrío con plumas negras y verdosas, y un canto que se asemeja a un lamento.
    Durante siglos, se creyó que el canto del Augurey presagiaba la muerte, lo que llevó a mucha gente a temer y evitar a estas criaturas. Sin embargo, mi abuelo descubrió que su canto, en realidad, predice la lluvia, lo cual es mucho menos siniestro. Los Augureys son criaturas tímidas y suelen habitar en regiones boscosas y lluviosas.
    Su plumaje tiene propiedades repelentes de agua, y sus plumas son usadas en la elaboración de tinta invisible. Aunque su apariencia puede parecer un poco lúgubre, los Augureys son criaturas inofensivas y muy útiles para los magos que saben apreciar su verdadero valor. Así que, la próxima vez que escuchen un lamento en el bosque, no se asusten; puede que simplemente estén recibiendo un pronóstico del tiempo de una de las criaturas mágicas más malinterpretadas del mundo.',
    6,3);