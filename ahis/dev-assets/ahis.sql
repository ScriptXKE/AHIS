-- DROP DATABASE AND CREATE IT
DROP DATABASE IF EXISTS `ahis`;

-- CREATE DATABASE
CREATE DATABASE `ahis`;

-- USE DATABASE
USE `ahis`;

-- CREATE SESSION TABLE
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

-- CREATE THE USERS TABLE
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	id INT(10) AUTO_INCREMENT NOT NULL,
	firstname varchar(30) NOT NULL,
	surname varchar(30) NOT NULL,
	othernames varchar(30) NULL,
	email varchar(50) NOT NULL,
	username varchar(20) NOT NULL,
	password varchar(40) NOT NULL,
	gender ENUM('male','female') NOT NULL,
	biodata TEXT NOT NULL,
	active ENUM('0','1') DEFAULT '0' NOT NULL,
	is_admin ENUM('0','1') DEFAULT '0' NOT NULL,
	avatar varchar(100) NULL,
	PRIMARY KEY (id)
);

-- POPULATE THE 'users' TABLE WITH USERS
INSERT INTO users 
(firstname, surname, othernames, email, username, password, gender, biodata, active, is_admin, avatar)
VALUES
('Nicholas','Kerandi','','nkerandi@gmail.com','nicholas','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','male','Nick is just there ...','1','1',''),
('Germain','Mirindi','','gmirindi@gmail.com','germain','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','male','Germain runs the show on behalf of FAO Somalia','1','1',''),
('Andrew','Onyango','','andrew.onyango@yahoo.co.uk','andrew','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','male','Andrew is the don from ScriptX ... when he sneezes, everyone in ScriptX catches a flu','1','1',''),
('Obed','Mubia','','mubiaobed@gmail.com','obed','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','male','Oh-who? Am not familiar with that vocabulary ... :)','1','1',''),
('Titus','Nderitu','','titus.nderitu@gmail.com','titus','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','male','He does crazy stuff that qualifies as art ... it\'s still a mystery I tell ya!','1','1','tito-nderitu.png');
