# Create and use DB
CREATE DATABASE IF NOT EXISTS `shared-gallery` DEFAULT CHARACTER SET `utf8`;
USE `shared-gallery`;

# Create tables
CREATE TABLE IF NOT EXISTS `users`(
    `id`                  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username`            VARCHAR(75) NOT NULL,
    `email`               VARCHAR(75) NOT NULL,
    `password`            VARCHAR(250) NOT NULL,
    `remember_me`         CHAR(25),
    UNIQUE KEY `email` (`email`)
);

CREATE TABLE IF NOT EXISTS `images`(
    `id`                  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `uploaded_by`         INT NOT NULL,
    `name`                VARCHAR(75) NOT NULL,
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`)
);
