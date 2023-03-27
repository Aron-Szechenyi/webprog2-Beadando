-- user
GRANT ALL PRIVILEGES ON A3KWH7.* TO 'frontend'@'localhost';

-- db
CREATE DATABASE IF NOT EXISTS A3KWH7;
USE A3KWH7;

-- def settings
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- User table
CREATE TABLE IF NOT EXISTS `User`
(
    `ID`       int           NOT NULL AUTO_INCREMENT,
    `Username` varchar(1024) NOT NULL,
    `Password` varchar(1024) NOT NULL,
    `Email`    varchar(1024) NOT NULL,
    `Role`     varchar(1024) DEFAULT 'user',

    PRIMARY KEY (ID)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;


-- dummy data
-- account:
--  root-root
--  user-user
INSERT INTO `User` (`Username`, `Password`, `Email`, `Role`)
VALUES ('root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'test@test.test', 'admin');

INSERT INTO `User` (`Username`, `Password`, `Email`)
VALUES ('user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'test@test.test');

