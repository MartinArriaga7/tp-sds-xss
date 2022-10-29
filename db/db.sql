GRANT ALL ON *.* to 'prueba'@'%' IDENTIFIED BY 'prueba';

DROP DATABASE IF EXISTS sds;
CREATE DATABASE sds;
USE sds;

CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    userName VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS comment (
    id INT NOT NULL AUTO_INCREMENT,
    comment VARCHAR(5000) NOT NULL,
    idUsuario INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idUsuario) REFERENCES user(id)
        ON DELETE RESTRICT
        ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

INSERT INTO user (userName, `password`) VALUES ('sds', 'sds');
INSERT INTO user (userName, `password`) VALUES ('Valen', '123');
INSERT INTO user (uderName, `password`) VALUES ('martin', 'martin');
