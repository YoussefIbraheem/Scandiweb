CREATE DATABASE `scandiweb-db`;
USE `scandiweb-db`;
CREATE TABLE `types` (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    attribute_value VARCHAR(255) NOT NULL,
    measure_unit VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE `products` (
    id INT NOT NULL AUTO_INCREMENT,
    sku VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL DEFAULT 0,
    amount VARCHAR(255),
    type_id INT,
    PRIMARY KEY (id),
    CONSTRAINT fk_type FOREIGN KEY (type_id) REFERENCES types(id) ON UPDATE CASCADE ON DELETE CASCADE
);