DELIMITER //
CREATE PROCEDURE `all`()
BEGIN
 SELECT id, name, type, year FROM robots;
END

DELIMITER //
CREATE PROCEDURE `by-name`(IN robot VARCHAR(15))
BEGIN
 SELECT id, name FROM robots WHERE name=robot;
END

DELIMITER //
CREATE PROCEDURE `by-id`(IN robot INT(10))
BEGIN
 SELECT id, name, type FROM robots WHERE id=robot;
END

DELIMITER //
CREATE PROCEDURE `update-robot`(IN robot INT(10), IN name VARCHAR(15))
BEGIN
 UPDATE robots SET name = name WHERE id=robot;
END

DELIMITER //
CREATE PROCEDURE `delete-robot`(IN `rid` INT(10))
BEGIN
 DELETE FROM robots WHERE id=rid;
END

DELIMITER //
CREATE PROCEDURE `new-robot`(IN `name` VARCHAR(15), IN `type` VARCHAR(15), IN `year` SMALLINT(4))
BEGIN
 INSERT INTO `stored-procedures`.`robots` (`name`, `type`, `year`) VALUES (name, type, year);
END