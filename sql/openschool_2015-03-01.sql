# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: openschool
# Generation Time: 2015-03-01 18:02:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id_container` int(11) unsigned NOT NULL,
  `id_contentKind` int(11) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'ES',
  `content` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `version` varchar(16) NOT NULL DEFAULT '1.0',
  KEY `lang` (`lang`),
  KEY `kind` (`id_contentKind`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table contentKind
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contentKind`;

CREATE TABLE `contentKind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `contentKind` WRITE;
/*!40000 ALTER TABLE `contentKind` DISABLE KEYS */;

INSERT INTO `contentKind` (`id`, `name`)
VALUES
	(1,'theme-title'),
	(2,'theme-description'),
	(3,'lesson-title'),
	(4,'lesson-description'),
	(5,'media');

/*!40000 ALTER TABLE `contentKind` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table favorite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_content` int(11) unsigned NOT NULL,
  `id_contentKind` int(4) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table instructorBadge
# ------------------------------------------------------------

DROP TABLE IF EXISTS `instructorBadge`;

CREATE TABLE `instructorBadge` (
  `id_user` int(11) unsigned NOT NULL,
  `id_theme` int(11) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ranking` int(4) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table lesson
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lesson`;

CREATE TABLE `lesson` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_theme` int(11) unsigned NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `value` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) unsigned NOT NULL,
  `id_mediaKind` int(11) unsigned NOT NULL,
  `src` text,
  `description` text,
  `css` varchar(128) DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table mediaKind
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mediaKind`;

CREATE TABLE `mediaKind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_messageGroup` int(11) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(512) NOT NULL DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `id_parent` int(11) unsigned DEFAULT NULL,
  `visibility` tinyint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table messageGroup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messageGroup`;

CREATE TABLE `messageGroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_content` int(11) unsigned NOT NULL,
  `id_contentKind` int(4) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table messageGroupUsers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messageGroupUsers`;

CREATE TABLE `messageGroupUsers` (
  `id_user` int(11) unsigned NOT NULL,
  `id_messageGroup` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int(11) unsigned DEFAULT NULL,
  `id_questionary` int(11) unsigned NOT NULL,
  `id_questionKind` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `content` varchar(256) DEFAULT NULL,
  `points` tinyint(4) unsigned DEFAULT NULL,
  `correctValue` varchar(256) DEFAULT '',
  `options` text,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `weigth` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table questionary
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questionary`;

CREATE TABLE `questionary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'ES',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table questionGroup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questionGroup`;

CREATE TABLE `questionGroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table questionKind
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questionKind`;

CREATE TABLE `questionKind` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table relationKind
# ------------------------------------------------------------

DROP TABLE IF EXISTS `relationKind`;

CREATE TABLE `relationKind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id`, `name`, `description`, `createdAt`, `updatedAt`, `enabled`)
VALUES
	(1,'alumno','usuario comun','2015-03-01 10:10:17',NULL,1),
	(2,'instructor','usuario que puede asesorar a algun alumno y redactar temas','2015-03-01 10:10:48',NULL,1),
	(3,'Modearador','revisa los temas y los mensajes para bannear o desbloquer contenidos','2015-03-01 10:11:12',NULL,1),
	(4,'Administrador','tiene permisos de bloquear a usuarios alumno, o instructor, temas, grupos y mensajes','2015-03-01 10:12:08',NULL,1),
	(5,'Superadmin','puede bloquear todo tipo de usuarios y contenidos del sistema','2015-03-01 10:12:39',NULL,1);

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table theme
# ------------------------------------------------------------

DROP TABLE IF EXISTS `theme`;

CREATE TABLE `theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table themeGroup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `themeGroup`;

CREATE TABLE `themeGroup` (
  `id_theme` int(11) unsigned NOT NULL,
  `id_group` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table themeRequirements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `themeRequirements`;

CREATE TABLE `themeRequirements` (
  `id_theme` int(11) unsigned NOT NULL,
  `id_RequiredTheme` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `visibility` tinyint(1) unsigned DEFAULT NULL,
  `ipAddress` varbinary(16) DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prefered_languaje` varchar(2) NOT NULL DEFAULT 'es',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# Dump of table userInfo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userInfo`;

CREATE TABLE `userInfo` (
  `id_user` int(11) unsigned NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Address1` varchar(256) DEFAULT NULL,
  `Address2` varchar(256) DEFAULT NULL,
  `Country` varchar(128) DEFAULT NULL,
  `genre` varchar(16) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(4) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table userLessonProgress
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userLessonProgress`;

CREATE TABLE `userLessonProgress` (
  `id_user` int(11) unsigned NOT NULL,
  `id_lesson` int(11) unsigned DEFAULT NULL,
  `status` tinyint(4) unsigned DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table userRelation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userRelation`;

CREATE TABLE `userRelation` (
  `id_user` int(11) unsigned NOT NULL,
  `id_user2` int(11) unsigned NOT NULL,
  `id_relationKind` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table userRole
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userRole`;

CREATE TABLE `userRole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_role` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table userThemeSubscription
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userThemeSubscription`;

CREATE TABLE `userThemeSubscription` (
  `id_user` int(11) unsigned NOT NULL,
  `id_theme` int(11) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
