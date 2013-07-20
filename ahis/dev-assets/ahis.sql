-- DROP DATABASE AND CREATE IT
DROP DATABASE IF EXISTS `ahis`;

-- CREATE DATABASE
CREATE DATABASE `ahis`;

-- USE DATABASE
USE `ahis`;

-- SESSION TABLE
-- All AHIS sessions are database managed ... more secure that way
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- PERSONS TABLE
-- This table contains a list of all persons associated with the AHIS
DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `othernames` varchar(30) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) DEFAULT NULL UNIQUE,
  `telephone` varchar(50) DEFAULT NULL,
  `biodata` text DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- POPULATE THE PERSONS TABLE
INSERT INTO persons
(firstname, surname, othernames, birthdate, gender, email, telephone, biodata, avatar)
VALUES
('Nicholas','Kerandi','','1978-01-01','male','nkerandi@gmail.com','','Nick is just there',''),
('Germain','Mirindi','','1979-01-01','male','gmirindi@gmail.com','','G is the don',''),
('Andrew','Onyango','','1985-01-01','male','andrew.onyango@yahoo.co.uk','','This is Drew',''),
('Obed','Mubia','','1986-01-01','male','mubiaobed@gmail.com','','Mofaya in the house',''),
('Titus','Nderitu','','1987-01-01','male','titus.nderitu@gmail.com','','G is the don','tito-nderitu.png');

-- USERS TABLE
-- This table contains all AHIS user accounts
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	id INT(10) AUTO_INCREMENT NOT NULL,
	person_id INT(10) NOT NULL,
	username varchar(20) NOT NULL UNIQUE,
	password varchar(40) NOT NULL,
	active ENUM('0','1') DEFAULT '0' NOT NULL,
	is_admin ENUM('0','1') DEFAULT '0' NOT NULL,
	FOREIGN KEY (person_id) REFERENCES persons(id) ON DELETE RESTRICT,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- POPULATE THE 'users' TABLE WITH USERS
INSERT INTO users 
(person_id, username, password, active, is_admin) 
VALUES
(1,'nkerandi','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(2,'gmirindi','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(3,'andrew','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(4,'obed','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0'),
(5,'titus','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','1','0');

-- NOW CREATE A VIEW TO JOIN THE TWO TABLES I.E. PERSONS AND USERS
DROP VIEW IF EXISTS `view_users`;
CREATE OR REPLACE VIEW `view_users` AS
(
SELECT
    `persons`.`id` AS `person_id`
    , `persons`.`firstname` AS `firstname`
    , `persons`.`surname` AS `surname`
    , `persons`.`othernames` AS `othernames`
    , `persons`.`birthdate` AS `birthdate`
    , `persons`.`gender` AS `gender`
    , `persons`.`email` AS `email`
    , `persons`.`telephone` AS `telephone`
    , `persons`.`biodata` AS `biodata`
    , `persons`.`avatar` AS `avatar`
    , `users`.`id` AS `user_id`
    , `users`.`username` AS `username`
    , `users`.`password` AS `password`
    , `users`.`active` AS `active`
    , `users`.`is_admin` AS `is_admin`
FROM
    `users`
    INNER JOIN `persons` 
        ON (`users`.`person_id` = `persons`.`id`)
);
