SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =========================
-- Database
-- =========================
CREATE DATABASE IF NOT EXISTS admin_cycling123
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE admin_cycling123;

-- =========================
-- Team Table
-- =========================
CREATE TABLE team (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  location VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO team (id, name, location) VALUES
(1, 'NovaCore', 'Sunderland'),
(2, 'IronWolves', 'Newcastle'),
(3, 'PulseForge', 'Middlesbrough'),
(4, 'ShadowRift', 'Durham');

-- =========================
-- Participant Table
-- =========================
CREATE TABLE participant (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  kills FLOAT DEFAULT 0,
  deaths FLOAT DEFAULT 0,
  team_id INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_participant_email (email),
  CONSTRAINT fk_participant_team
    FOREIGN KEY (team_id) REFERENCES team(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO participant (id, firstname, surname, email, kills, deaths, team_id) VALUES
(1,'Lorette','Lamacraft','llamacraft0@census.gov',0,0,1),
(2,'Georgeanne','Seston','gseston1@networksolutions.com',0,0,1),
(3,'Lemmy','Stavers','lstavers2@cam.ac.uk',0,0,2),
(4,'Eduard','Roelvink','eroelvink3@studiopress.com',0,0,1),
(5,'Dennis','Oxenham','doxenham4@chronoengine.com',0,0,4),
(6,'Lynnett','Christophe','lchristophe5@yahoo.com',0,0,1),
(7,'Ken','Gammidge','kgammidge6@telegraph.co.uk',0,0,4),
(8,'Dorie','Espina','despina7@usnews.com',0,0,1),
(9,'Lawrence','Upsale','lupsale8@accuweather.com',0,0,1),
(10,'Evaleen','Hartin','ehartin9@cornell.edu',0,0,2),
(11,'Therese','Currin','tcurrina@taobao.com',0,0,1),
(12,'Chiquita','Rapi','crapib@sun.com',0,0,2),
(13,'Corabella','Frude','cfrudec@npr.org',0,0,1),
(14,'Eveleen','Cranna','ecrannad@twitpic.com',0,0,1),
(15,'Brier','Westmerland','bwestmerlande@home.pl',0,0,4),
(16,'Petra','Loffhead','ploffheadf@rambler.ru',0,0,2),
(17,'Elinor','Ranscombe','eranscombeg@state.tx.us',0,0,4),
(18,'Reeba','Somerbell','rsomerbellh@alexa.com',0,0,4),
(19,'Dulciana','Kaming','dkamingi@dailymail.co.uk',0,0,1),
(20,'Eal','Willers','ewillersj@businessinsider.com',0,0,1),
(21,'Lucina','Hessentaler','lhessentalerk@histats.com',0,0,4),
(22,'Thatch','Bosse','tbossel@engadget.com',0,0,4),
(23,'Hanson','Adamoli','hadamolim@prnewswire.com',0,0,1),
(24,'Mildrid','Marton','mmartonn@auda.org.au',0,0,4),
(25,'Jeana','Yakuntzov','jyakuntzovo@plala.or.jp',0,0,4),
(26,'Ulrick','Fyall','ufyallp@unc.edu',0,0,3),
(27,'Clary','Wevell','cwevellq@ucoz.com',0,0,3),
(28,'Cissiee','Plewes','cplewesr@smh.com.au',0,0,1),
(29,'Thorn','Richen','trichens@usnews.com',0,0,2),
(30,'Gabriella','Clearley','gclearleyt@tinypic.com',0,0,3);

-- =========================
-- Merchandise Table
-- =========================
CREATE TABLE merchandise (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  terms TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY uq_merch_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================
-- Users Table (Secure)
-- =========================
CREATE TABLE users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (id, username, password)
VALUES (1, 'admin', 'password123');

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;