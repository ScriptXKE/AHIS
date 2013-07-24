SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `ahis` ;
CREATE SCHEMA IF NOT EXISTS `ahis` ;
SHOW WARNINGS;
USE `ahis` ;

-- -----------------------------------------------------
-- Table `person`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `person` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `person` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `firstname` VARCHAR(20) NOT NULL ,
  `surname` VARCHAR(20) NOT NULL ,
  `othernames` VARCHAR(30) NOT NULL ,
  `birthdate` DATE NULL DEFAULT NULL ,
  `gender` ENUM('male','female') NOT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `telephone` VARCHAR(50) NULL DEFAULT NULL ,
  `biodata` TEXT NULL DEFAULT NULL ,
  `avatar` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE UNIQUE INDEX ON `person` (`email` ASC) ;

SHOW WARNINGS;

-- POPULATE THE PERSONS TABLE
INSERT INTO person
(firstname, surname, othernames, birthdate, gender, email, telephone, biodata, avatar)
VALUES
('Nicholas','Kerandi','','1978-01-01','male','nkerandi@gmail.com','','Nick is just there',''),
('Germain','Mirindi','','1979-01-01','male','gmirindi@gmail.com','','G is the don',''),
('Andrew','Onyango','','1985-01-01','male','andrew.onyango@yahoo.co.uk','','This is Drew',''),
('Obed','Mubia','','1986-01-01','male','mubiaobed@gmail.com','','Mofaya in the house',''),
('Titus','Nderitu','','1987-01-01','male','titus.nderitu@gmail.com','','G is the don','tito-nderitu.png');


-- -----------------------------------------------------
-- Table `reporter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reporter` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `reporter` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `active` ENUM('0','1') NOT NULL DEFAULT '0' ,
  `is_verified` ENUM('0','1') NOT NULL DEFAULT '0' ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `person_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_reporter_person`
    FOREIGN KEY (`person_id` )
    REFERENCES `person` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `reporter_person_idx` ON `reporter` (`person_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `incident`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `incident` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `incident` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `serial_no` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `reported_date` DATE NULL DEFAULT NULL ,
  `user_id` TINYINT UNSIGNED NULL DEFAULT NULL ,
  `location_id` TINYINT NOT NULL DEFAULT 1 ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `reporter_id` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_incident_reporter`
    FOREIGN KEY (`reporter_id` )
    REFERENCES `reporter` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE UNIQUE INDEX `serial_no_idx` ON `incident` (`serial_no` ASC) ;

SHOW WARNINGS;
CREATE INDEX `incident_reporter_idx` ON `incident` (`reporter_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `symptom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `symptom` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `symptom` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(25) NOT NULL ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE UNIQUE INDEX `id_UNIQUE` ON `symptom` (`id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `incident_symptom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `incident_symptom` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `incident_symptom` (
  `incident_id` SMALLINT UNSIGNED NOT NULL ,
  `symptom_id` TINYINT UNSIGNED NOT NULL ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`incident_id`, `symptom_id`) ,
  CONSTRAINT `fk_incident_symptom`
    FOREIGN KEY (`incident_id` )
    REFERENCES `incident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_symptom_incident`
    FOREIGN KEY (`symptom_id` )
    REFERENCES `symptom` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `fk_incident_symptom_idx` ON `incident_symptom` (`symptom_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `disease`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `disease` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `disease` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(25) NOT NULL ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `disease_symptom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `disease_symptom` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `disease_symptom` (
  `disease_id` TINYINT UNSIGNED NOT NULL ,
  `symptom_id` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`disease_id`, `symptom_id`) ,
  CONSTRAINT `fk_disease_symptom`
    FOREIGN KEY (`disease_id` )
    REFERENCES `disease` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_symptom_disease`
    FOREIGN KEY (`symptom_id` )
    REFERENCES `symptom` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `fk_disease_idx` ON `disease_symptom` (`disease_id` ASC) ;

SHOW WARNINGS;
CREATE INDEX `fk_symptom_idx` ON `disease_symptom` (`symptom_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `species`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `species` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `species` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `incident_species`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `incident_species` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `incident_species` (
  `species_id` SMALLINT UNSIGNED NOT NULL ,
  `incident_id` SMALLINT UNSIGNED NOT NULL ,
  `number` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`species_id`, `incident_id`) ,
  CONSTRAINT `fk_species_incident`
    FOREIGN KEY (`species_id` )
    REFERENCES `species` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incident_species`
    FOREIGN KEY (`incident_id` )
    REFERENCES `incident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `incident_species_idx` ON `incident_species` (`incident_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `sms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sms` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sms` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `phone_number` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `incident_sms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `incident_sms` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `incident_sms` (
  `incident_id` SMALLINT UNSIGNED NOT NULL ,
  `sms_id` SMALLINT UNSIGNED NOT NULL ,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`incident_id`, `sms_id`) ,
  CONSTRAINT `fk_incident_sms`
    FOREIGN KEY (`incident_id` )
    REFERENCES `incident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sms_incident`
    FOREIGN KEY (`sms_id` )
    REFERENCES `sms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `incident_sms_idx` ON `incident_sms` (`sms_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ci_sessions` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(45) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(120) NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT 0 ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `last_activity_idx` ON `ci_sessions` (`last_activity` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `person_id` INT(10) NOT NULL ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  `active` ENUM('0','1') NOT NULL DEFAULT '0' ,
  `is_admin` ENUM('0','1') NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_person_id`
    FOREIGN KEY (`person_id` )
    REFERENCES `person` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE UNIQUE INDEX ON `users` (`username` ASC) ;

SHOW WARNINGS;
CREATE INDEX `person_id_idx` ON `users` (`person_id` ASC) ;

SHOW WARNINGS;

-- POPULATE THE 'users' TABLE WITH USERS
INSERT INTO users 
(person_id, username, password, active, is_admin) 
VALUES
(1,'nkerandi','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(2,'gmirindi','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(3,'andrew','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(4,'obed','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(5,'titus','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0');

USE `ahis` ;

-- -----------------------------------------------------
-- Placeholder table for view `view_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view_users` (`person_id` INT, `firstname` INT, `surname` INT, `othernames` INT, `birthdate` INT, `gender` INT, `email` INT, `telephone` INT, `biodata` INT, `avatar` INT, `user_id` INT, `username` INT, `password` INT, `active` INT, `is_admin` INT);
SHOW WARNINGS;

-- -----------------------------------------------------
-- View `view_users`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `view_users` ;
SHOW WARNINGS;
DROP TABLE IF EXISTS `view_users`;
SHOW WARNINGS;
USE `ahis`;
CREATE OR REPLACE VIEW `view_users` AS
(
SELECT
    `person`.`id` AS `person_id`
    , `person`.`firstname` AS `firstname`
    , `person`.`surname` AS `surname`
    , `person`.`othernames` AS `othernames`
    , `person`.`birthdate` AS `birthdate`
    , `person`.`gender` AS `gender`
    , `person`.`email` AS `email`
    , `person`.`telephone` AS `telephone`
    , `person`.`biodata` AS `biodata`
    , `person`.`avatar` AS `avatar`
    , `users`.`id` AS `user_id`
    , `users`.`username` AS `username`
    , `users`.`password` AS `password`
    , `users`.`active` AS `active`
    , `users`.`is_admin` AS `is_admin`
FROM
    `users`
    INNER JOIN `person` 
        ON (`users`.`person_id` = `person`.`id`)
);
SHOW WARNINGS;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
