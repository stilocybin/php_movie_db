-- --------------------------------------------------------
-- Host:                         localhost
-- Server Version:               5.6.21 - MySQL Community Server (GPL)
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.1.0.4898
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Datenbank Struktur für filmneu
DROP DATABASE IF EXISTS `film`;
CREATE DATABASE IF NOT EXISTS `film` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `film`;


-- Exportiere Struktur von Tabelle filmneu.film
DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Filmgesellschaft_id` int(10) unsigned DEFAULT NULL,
  `Titel` varchar(50) NOT NULL DEFAULT '',
  `Erscheinungsdatum` date DEFAULT NULL,
  `DauerInMinuten` int(10) unsigned DEFAULT NULL,
  `Genre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Filmgesellschaft_id` (`Filmgesellschaft_id`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`Filmgesellschaft_id`) REFERENCES `filmgesellschaft` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle filmneu.film: ~32 rows (ungefähr)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id`, `Filmgesellschaft_id`, `Titel`, `Erscheinungsdatum`, `DauerInMinuten`, `Genre`) VALUES
	(1, 1, 'Ein Fisch namens Wanda', '1988-01-26', 108, 'Comedy'),
	(2, 2, 'True Lies', '1994-08-18', 144, 'Action'),
	(3, 3, 'Unbreakable', '2000-12-28', 106, 'Thriller'),
	(4, 4, 'Twelve Monkeys', '1996-03-21', 129, 'Thriller'),
	(5, 2, 'Stirb langsam 3', '1995-06-22', 131, 'Action'),
	(6, 5, 'Das fünfte Element', '1997-08-28', 126, 'Action'),
	(7, 6, 'Der Herr der Ringe - Die Gefährten', '2001-12-19', 178, 'Fantasy'),
	(8, 6, 'Der Herr der Ringe - Die zwei Türme', '2002-12-18', 179, 'Fantasy'),
	(9, 2, 'Master and Commander', '2003-11-27', 138, 'Action'),
	(10, 4, 'Beautiful Mind, A', '2002-02-12', 138, 'Drama'),
	(11, 4, 'Gladiator', '2000-05-25', 155, 'Action'),
	(12, 2, 'Elizabeth', '1998-10-29', 124, 'Drama'),
	(13, 7, 'talentierte Mr. Ripley, Der', '2000-02-17', 139, 'Drama'),
	(14, 8, 'Matrix', '1999-06-17', 136, 'Action'),
	(15, 9, 'Chocolat', '2001-03-15', 121, 'Comedy'),
	(16, 8, 'Red Planet', '2001-03-01', 106, 'Action'),
	(17, 8, 'Othello', '1995-01-01', 123, 'Drama'),
	(18, 7, 'Event Horizon', '1997-01-01', 95, 'Horror'),
	(23, 2, 'Avatar - Aufbruch nach Pandora', '2009-12-17', 171, 'Fantasy'),
	(25, 8, 'Inception', '2010-07-29', 148, 'Action'),
	(26, 10, 'Django Unchained', '2013-01-17', 141, 'Action'),
	(27, 4, 'Inglourious Basterds', '2009-08-20', 154, 'Action'),
	(28, 8, 'Dark Knight Rises', '2012-07-26', 164, 'Thriller'),
	(29, 8, 'Hobbit - Smaugs Einöde, Der', '2013-12-12', 161, 'Fantasy'),
	(30, 11, 'Eiskönigin - Völlig unverfroren, Die', '2013-11-28', 102, 'Comedy'),
	(31, 12, 'Tribute von Panem - Catching Fire, Die', '2013-11-21', 146, 'Science Fiction'),
	(32, 8, 'Gravity', '2013-10-03', 93, 'Science Fiction'),
	(33, 10, 'Das ist das Ende', '2013-08-08', 107, 'Comedy'),
	(34, 8, 'Conjuring - Die Heimsuchung', '2013-08-01', 112, 'Horror'),
	(35, 11, 'Monster Uni, Die', '2013-06-20', 104, 'Comedy'),
	(36, 13, 'Place Beyond the Pines, The', '2013-06-13', 140, 'Drama'),
	(37, 7, 'Star Trek: Into Darkness', '2013-05-09', 132, 'Science Fiction');
/*!40000 ALTER TABLE `film` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmneu.filmgesellschaft
DROP TABLE IF EXISTS `filmgesellschaft`;
CREATE TABLE IF NOT EXISTS `filmgesellschaft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle filmneu.filmgesellschaft: ~13 rows (ungefähr)
/*!40000 ALTER TABLE `filmgesellschaft` DISABLE KEYS */;
INSERT INTO `filmgesellschaft` (`id`, `Name`) VALUES
	(1, 'MGM'),
	(2, '20th Century Fox'),
	(3, 'Touchstone Pictures'),
	(4, 'Universal Pictures'),
	(5, 'Gaumont'),
	(6, 'New Line Cinema'),
	(7, 'Paramount'),
	(8, 'Warner'),
	(9, 'Miramax'),
	(10, 'Sony Pictures'),
	(11, 'Walt Disney'),
	(12, 'Lionsgate'),
	(13, 'Studiocanal');
/*!40000 ALTER TABLE `filmgesellschaft` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmneu.hauptdarsteller
DROP TABLE IF EXISTS `hauptdarsteller`;
CREATE TABLE IF NOT EXISTS `hauptdarsteller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  `Vorname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle filmneu.hauptdarsteller: ~52 rows (ungefähr)
/*!40000 ALTER TABLE `hauptdarsteller` DISABLE KEYS */;
INSERT INTO `hauptdarsteller` (`id`, `Name`, `Vorname`) VALUES
	(1, 'Willis', 'Bruce'),
	(2, 'Astin', 'Sean'),
	(3, 'Crowe', 'Russell'),
	(4, 'Blanchett', 'Cate'),
	(5, 'Moss', 'Carrie-Anne'),
	(6, 'Fishburne', 'Laurence'),
	(7, 'Lee Curtis', 'Jamie'),
	(8, 'DiCaprio', 'Leonardo'),
	(9, 'Waltz', 'Christoph'),
	(10, 'Pitt', 'Brad'),
	(11, 'Bale', 'Christian'),
	(12, 'Saldana', 'Zoe'),
	(13, 'Freeman', 'Martin'),
	(14, 'McKellen', 'Ian'),
	(15, 'Lee', 'Christopher'),
	(16, 'Bell', 'Kristen'),
	(17, 'Menzel', 'Idina'),
	(18, 'Lawrence', 'Jennifer'),
	(19, 'Hemsworth', 'Liam'),
	(20, 'Quaid', 'Jack'),
	(21, 'Bullock', 'Sandra'),
	(22, 'Clooney', 'George'),
	(23, 'Franco', 'James'),
	(24, 'Hill', 'Jonah'),
	(25, 'Rogen', 'Seth'),
	(26, 'Farmiga', 'Vera'),
	(27, 'Wilson', 'Patrick'),
	(28, 'Taylor', 'Lili'),
	(29, 'Crystal', 'Billy'),
	(30, 'Goodman', 'John'),
	(31, 'Buscemi', 'Steve'),
	(32, 'Gosling', 'Ryan'),
	(33, 'Van Hook', 'Craig'),
	(34, 'Mendes', 'Eva'),
	(35, 'Pine', 'Chris'),
	(36, 'Quinto', 'Zachary'),
	(38, 'Oldman', 'Gary'),
	(39, 'Jovovich', 'Milla'),
	(40, 'Foxx', 'Jamie'),
	(41, 'Phoenix', 'Joaquin'),
	(42, 'Nielsen', 'Connie'),
	(43, 'Gordon-Levitt', 'Joseph'),
	(44, 'Page', 'Ellen'),
	(45, 'Cleese', 'John'),
	(46, 'Kline', 'Kevin'),
	(47, 'Worthington', 'Sam'),
	(48, 'Weaver', 'Sigourney'),
	(49, 'Rush', 'Geoffrey'),
	(50, 'Jackson', 'Samuel L.'),
	(51, 'Wood', 'Elijah'),
	(52, 'Bloom', 'Orlando'),
	(53, 'Stowe', 'Madeleine');
/*!40000 ALTER TABLE `hauptdarsteller` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmneu.spielt
DROP TABLE IF EXISTS `spielt`;
CREATE TABLE IF NOT EXISTS `spielt` (
  `Film_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Hauptdarsteller_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Rolle` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Film_id`,`Hauptdarsteller_id`),
  KEY `Film_id` (`Film_id`),
  KEY `Hauptdarsteller_id` (`Hauptdarsteller_id`),
  CONSTRAINT `spielt_ibfk_1` FOREIGN KEY (`Film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spielt_ibfk_2` FOREIGN KEY (`Hauptdarsteller_id`) REFERENCES `hauptdarsteller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle filmneu.spielt: ~74 rows (ungefähr)
/*!40000 ALTER TABLE `spielt` DISABLE KEYS */;
INSERT INTO `spielt` (`Film_id`, `Hauptdarsteller_id`, `Rolle`) VALUES
	(1, 7, 'Wanda Gershwitz'),
	(1, 45, 'Archie Leach'),
	(1, 46, 'Otto'),
	(2, 7, 'Helen Tasker'),
	(3, 1, 'David Dunn'),
	(3, 50, 'Elijah Price'),
	(4, 1, 'James Cole'),
	(4, 10, 'Jeffrey Goines'),
	(4, 53, 'Kathryn Railly'),
	(5, 1, 'John McClane'),
	(6, 1, 'Major Korben Dallas'),
	(6, 38, 'Jean-Baptiste Emanuel Zorg'),
	(6, 39, 'Leeloo'),
	(7, 2, 'Sam Gamgee'),
	(7, 4, 'Galadriel'),
	(7, 14, 'Gandalf'),
	(7, 15, 'Saruman'),
	(7, 51, 'Frodo Baggins'),
	(7, 52, 'Legolas Greenleaf'),
	(8, 2, 'Sam Gamgee'),
	(8, 4, 'Galadriel'),
	(8, 14, 'Gandalf der Graue'),
	(8, 51, 'Frodo Baggins'),
	(9, 3, 'Capt. Jack Aubrey'),
	(10, 3, 'John Nash'),
	(11, 3, 'Maximus'),
	(11, 41, 'Commodus'),
	(11, 42, 'Lucilla'),
	(12, 4, 'Elizabeth I'),
	(12, 49, 'Sir Francis Walsingham'),
	(13, 4, 'Meredith Logue'),
	(14, 5, 'Trinity'),
	(14, 6, 'Morpheus'),
	(15, 5, 'Caroline Clairmont'),
	(16, 5, 'Cmdr. Kate Bowman'),
	(17, 6, 'Othello'),
	(18, 6, 'Captain Miller'),
	(23, 12, 'Neytiri'),
	(23, 47, 'Jake Sully'),
	(23, 48, 'Grace'),
	(25, 8, 'Cobb'),
	(25, 43, 'Arthur'),
	(25, 44, 'Ariadne'),
	(26, 8, 'Calvin Candie'),
	(26, 9, 'Dr. King Schultz'),
	(26, 40, 'Django'),
	(27, 9, 'Col. Hans Landa'),
	(27, 10, 'Lt. Aldo Raine'),
	(28, 11, 'Bruce Wayne'),
	(29, 13, 'Bilbo'),
	(29, 14, 'Gandalf'),
	(29, 15, 'Saruman'),
	(30, 16, 'Anna'),
	(30, 17, 'Elsa'),
	(31, 18, 'Katniss Everdeen'),
	(31, 19, 'Gale Hawthorne'),
	(31, 20, 'Marvel'),
	(32, 21, 'Ryan Stone'),
	(32, 22, 'Matt Kowalski'),
	(33, 23, 'James Franco'),
	(33, 24, 'Jonah Hill'),
	(33, 25, 'Seth Rogen'),
	(34, 26, 'Lorraine Warren'),
	(34, 27, 'Ed Warren'),
	(34, 28, 'Carolyn Perron'),
	(35, 29, 'Mike'),
	(35, 30, 'Sullivan'),
	(35, 31, 'Randy'),
	(36, 32, 'Luke'),
	(36, 33, 'Jack'),
	(36, 34, 'Romina'),
	(37, 12, 'Uhura'),
	(37, 35, 'Kirk'),
	(37, 36, 'Spock');
/*!40000 ALTER TABLE `spielt` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
