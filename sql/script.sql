CREATE TABLE razas
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE mascotas
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    nombre  VARCHAR(100) NOT NULL,
    edad    INT          NOT NULL,
    raza_id INT,
    FOREIGN KEY (raza_id) REFERENCES razas (id) ON DELETE SET NULL
);


INSERT INTO razas (nombre) VALUES ('Labrador'), ('Pug'), ('Pastor Alemán');