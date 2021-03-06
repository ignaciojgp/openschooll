-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: openschool
-- ------------------------------------------------------
-- Server version	5.6.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id_container` int(11) unsigned NOT NULL,
  `id_contentKind` int(11) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'ES',
  `content` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `version` varchar(16) NOT NULL DEFAULT '1.0',
  `title` varchar(125) DEFAULT NULL,
  `description` text,
  KEY `lang` (`lang`),
  KEY `kind` (`id_contentKind`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,6,'es','cursos','2016-09-02 03:05:18',NULL,1,'1.0',NULL,NULL),(2,6,'es','mis temas','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(3,6,'es','mis estudiantes','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(4,6,'es','usuarios','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(5,6,'es','administrar','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(6,6,'es','moderar temas','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(7,6,'es','insidencias','2016-09-02 03:09:01',NULL,1,'1.0',NULL,NULL),(8,6,'es','mis estudiantes','2016-09-02 03:11:47',NULL,1,'1.0',NULL,NULL);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contentkind`
--

DROP TABLE IF EXISTS `contentkind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contentkind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contentkind`
--

LOCK TABLES `contentkind` WRITE;
/*!40000 ALTER TABLE `contentkind` DISABLE KEYS */;
INSERT INTO `contentkind` VALUES (1,'theme-title'),(2,'theme-description'),(3,'lesson-title'),(4,'lesson-description'),(5,'media'),(6,'menuoption');
/*!40000 ALTER TABLE `contentkind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_content` int(11) unsigned NOT NULL,
  `id_contentKind` int(4) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructorbadge`
--

DROP TABLE IF EXISTS `instructorbadge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructorbadge` (
  `id_user` int(11) unsigned NOT NULL,
  `id_theme` int(11) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ranking` int(4) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructorbadge`
--

LOCK TABLES `instructorbadge` WRITE;
/*!40000 ALTER TABLE `instructorbadge` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructorbadge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_theme` int(11) unsigned NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `value` tinyint(4) DEFAULT NULL,
  `content` text,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` VALUES (1,29,'acentos','2016-09-05 02:42:09',NULL,'cómo poner un acento',1,3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec volutpat neque. Maecenas laoreet enim sit amet magna vehicula, varius sagittis nulla sodales. Maecenas elementum in nisi ac lacinia. Aliquam feugiat ligula euismod ex suscipit, et congue velit pellentesque. Ut placerat sapien quis tortor accumsan, eu fermentum diam dignissim. Fusce laoreet leo in lacinia pretium. Nullam vitae dolor ut velit fermentum ultricies quis ac nisi. In molestie efficitur nisl, vitae convallis lectus luctus ac. Phasellus efficitur, elit nec vestibulum dapibus, est enim mollis felis, eget mattis tortor diam sed magna. Nullam quis sapien porttitor, luctus nisi non, pharetra turpis. Curabitur nec convallis lorem, aliquet congue risus. Suspendisse quis tincidunt ipsum, id accumsan sem.\n\nIn quis tincidunt dolor. Nam viverra, lacus nec dictum viverra, odio enim egestas urna, in ultrices ipsum justo eu nulla. Maecenas turpis ligula, mattis eget neque a, consequat ultrices orci. Fusce sed convallis tortor. Pellentesque in felis nec mauris scelerisque sollicitudin. Vestibulum sit amet leo quis elit rutrum fermentum. Sed ullamcorper lacus massa, eget imperdiet dui efficitur ut. Praesent scelerisque ut purus non placerat. Nam viverra, arcu eget mollis auctor, ex nisi finibus dolor, eu rhoncus leo est at nulla. Fusce et luctus sem, in vestibulum neque. Aenean ut egestas est. Aliquam lectus turpis, ullamcorper eget nisl in, varius volutpat enim. Duis tortor velit, pharetra vitae ullamcorper sit amet, commodo nec purus. Donec vehicula nisi in rhoncus molestie.\n\nDonec tempus lacus nec urna condimentum pellentesque. Etiam quis sapien id libero luctus fermentum. Fusce at magna nisl. Fusce ultrices, risus a rhoncus lacinia, sapien risus ullamcorper tellus, id varius magna nulla quis quam. Curabitur tristique tempor ante in posuere. Aliquam mollis gravida nibh. Donec felis elit, hendrerit at consequat id, hendrerit id lacus. Aliquam erat volutpat. Cras non metus mauris. Cras iaculis fermentum pulvinar. Praesent ultrices, felis ut interdum ullamcorper, nibh lectus efficitur sem, non accumsan ex ante vel sapien. Nullam sollicitudin libero dignissim metus tristique, nec suscipit orci pharetra. Donec nec eros consequat, placerat felis eget, sollicitudin mi. Donec suscipit feugiat sapien, eu tempor felis faucibus et. Suspendisse luctus luctus est, ut egestas ipsum fermentum gravida. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\n\nNunc fermentum eget ex sollicitudin pulvinar. Donec nec dolor ultricies, dictum magna a, finibus lacus. Cras faucibus laoreet ipsum, vitae blandit arcu condimentum et. Vivamus cursus nisl non quam semper elementum. Vestibulum nec ullamcorper mi. Duis iaculis hendrerit velit et tempus. Phasellus elementum accumsan nunc sed bibendum. Fusce sit amet orci eu augue ornare tincidunt in consequat nibh. Mauris tempus congue consequat. Pellentesque lectus nisi, venenatis eu pharetra vel, maximus at quam. Etiam neque nunc, vehicula sit amet consectetur eget, auctor non nisl. Aenean eget dictum augue. Nam eu malesuada turpis, in sodales nibh. Praesent semper non metus in volutpat. Donec molestie lacus sit amet nisl congue, non vestibulum lectus condimentum. Duis odio massa, placerat vitae mattis non, maximus nec nibh.\n\nMorbi metus felis, ultricies et fringilla at, molestie eu mauris. Maecenas egestas odio vel luctus efficitur. Curabitur et nulla tempus, facilisis ante in, lobortis ante. Mauris nec laoreet risus. Vivamus ac nulla pretium, sagittis risus id, egestas lorem. Morbi scelerisque nisl nec semper pellentesque. Etiam nisi augue, vulputate et tortor at, condimentum volutpat ipsum. Ut in euismod neque. Praesent sit amet mi nec enim ornare finibus. Pellentesque eget elit orci. Mauris efficitur, massa vel rhoncus ullamcorper, ipsum diam ornare mauris, eget porttitor nulla tellus in lacus. Curabitur quis vulputate turpis. Nullam vitae nunc nec sapien consectetur pretium vel nec elit. Curabitur ac malesuada nisi. Fusce vehicula, ex et tincidunt ullamcorper, nulla arcu venenatis eros, ac rutrum tortor mi ut nisi.',1),(2,29,'el punto','2016-09-05 02:46:01',NULL,'usos del punto',1,3,'algo de contenidos',2),(3,30,'algo','2016-09-17 16:22:58',NULL,'asdasdasdasdasdasdasd',1,3,'contenido',NULL),(4,30,'leccion 2','2016-09-17 16:24:05',NULL,'descripcion leccion 2',1,3,'hhjkhjkjk',NULL),(5,30,'algo','2016-09-17 21:46:56',NULL,'asdasdasdasdasd',1,3,'contenido',NULL),(6,31,'prueba','2016-09-18 14:06:23',NULL,'description',0,5,'content',NULL),(7,31,'Tercer tema','2016-09-18 14:06:28',NULL,'description',1,7,'content',NULL),(8,31,'Segundo tema','2016-09-18 14:16:09',NULL,'description',1,7,'content',NULL),(9,31,'Algo nuevo','2016-09-18 14:16:12',NULL,'otra description',0,5,'otro content',NULL),(10,29,'Nueva lección','2016-09-19 03:50:43',NULL,'asdas',0,5,'asdmasmdñas',NULL);
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediakind`
--

DROP TABLE IF EXISTS `mediakind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mediakind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediakind`
--

LOCK TABLES `mediakind` WRITE;
/*!40000 ALTER TABLE `mediakind` DISABLE KEYS */;
/*!40000 ALTER TABLE `mediakind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuoption`
--

DROP TABLE IF EXISTS `menuoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuoption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `id_role` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuoption`
--

LOCK TABLES `menuoption` WRITE;
/*!40000 ALTER TABLE `menuoption` DISABLE KEYS */;
INSERT INTO `menuoption` VALUES (1,'courses',1),(2,'my_themes',2),(3,'my_students',2),(4,'users',4),(5,'administration',5),(6,'moderate_themes',3),(7,'issues',3),(8,'my_students',5);
/*!40000 ALTER TABLE `menuoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagegroup`
--

DROP TABLE IF EXISTS `messagegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagegroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_content` int(11) unsigned NOT NULL,
  `id_contentKind` int(4) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagegroup`
--

LOCK TABLES `messagegroup` WRITE;
/*!40000 ALTER TABLE `messagegroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagegroupusers`
--

DROP TABLE IF EXISTS `messagegroupusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagegroupusers` (
  `id_user` int(11) unsigned NOT NULL,
  `id_messageGroup` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagegroupusers`
--

LOCK TABLES `messagegroupusers` WRITE;
/*!40000 ALTER TABLE `messagegroupusers` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagegroupusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionary`
--

DROP TABLE IF EXISTS `questionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'ES',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionary`
--

LOCK TABLES `questionary` WRITE;
/*!40000 ALTER TABLE `questionary` DISABLE KEYS */;
/*!40000 ALTER TABLE `questionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questiongroup`
--

DROP TABLE IF EXISTS `questiongroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questiongroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questiongroup`
--

LOCK TABLES `questiongroup` WRITE;
/*!40000 ALTER TABLE `questiongroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `questiongroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionkind`
--

DROP TABLE IF EXISTS `questionkind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionkind` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionkind`
--

LOCK TABLES `questionkind` WRITE;
/*!40000 ALTER TABLE `questionkind` DISABLE KEYS */;
/*!40000 ALTER TABLE `questionkind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationkind`
--

DROP TABLE IF EXISTS `relationkind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationkind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationkind`
--

LOCK TABLES `relationkind` WRITE;
/*!40000 ALTER TABLE `relationkind` DISABLE KEYS */;
/*!40000 ALTER TABLE `relationkind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'alumno','usuario comun','2015-03-01 16:10:17',NULL,1),(2,'instructor','usuario que puede asesorar a algun alumno y redactar temas','2015-03-01 16:10:48',NULL,1),(3,'Modearador','revisa los temas y los mensajes para bannear o desbloquer contenidos','2015-03-01 16:11:12',NULL,1),(4,'Administrador','tiene permisos de bloquear a usuarios alumno, o instructor, temas, grupos y mensajes','2015-03-01 16:12:08',NULL,1),(5,'Superadmin','puede bloquear todo tipo de usuarios y contenidos del sistema','2015-03-01 16:12:39',NULL,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `description` text,
  `content` text,
  `lang` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (29,'Español','2016-09-17 16:18:49','2016-09-17 16:18:49',1,'Curso de español','adalsdlaskdña','es'),(30,'Otro tema','2016-09-17 16:21:24','2016-09-17 16:21:24',1,'matematicas','adaskdasjlkd','es'),(31,'El tercer tema','2016-09-17 20:34:20','2016-09-18 23:40:35',1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu neque ut arcu consequat sollicitudin. Maecenas interdum congue metus, ac commodo lectus dictum vitae. Aenean in ornare ex. Vivamus pretium justo non sagittis eleifend. Donec dignissim vulputate sapien, quis euismod nisl posuere ut. Phasellus imperdiet velit justo, vitae mattis libero.','asdasd','es'),(32,'Química orgánica','2016-09-19 03:52:51','2016-09-19 03:52:51',1,'asdasda','aadsdas','es');
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themeauthor`
--

DROP TABLE IF EXISTS `themeauthor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themeauthor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `role` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`id_user`,`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themeauthor`
--

LOCK TABLES `themeauthor` WRITE;
/*!40000 ALTER TABLE `themeauthor` DISABLE KEYS */;
INSERT INTO `themeauthor` VALUES (21,3,29,'creator'),(22,3,30,'creator'),(24,3,31,'creator'),(25,3,32,'creator');
/*!40000 ALTER TABLE `themeauthor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themegroup`
--

DROP TABLE IF EXISTS `themegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themegroup` (
  `id_theme` int(11) unsigned NOT NULL,
  `id_group` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themegroup`
--

LOCK TABLES `themegroup` WRITE;
/*!40000 ALTER TABLE `themegroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `themegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themerequirements`
--

DROP TABLE IF EXISTS `themerequirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themerequirements` (
  `id_theme` int(11) unsigned NOT NULL,
  `id_RequiredTheme` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themerequirements`
--

LOCK TABLES `themerequirements` WRITE;
/*!40000 ALTER TABLE `themerequirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `themerequirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'\'ignaciojpg@gmail.com\'','1c8c5ef73ec6a7a9069604b9648f33cf',0,0,'\'\'',0,'2016-08-28 19:15:49','\'e'),(5,'\'contacto@visualeaks.com\'','1c8c5ef73ec6a7a9069604b9648f33cf',0,0,'\'\'',0,'2016-09-02 04:02:38','\'e');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `id_user` int(11) unsigned NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Address1` varchar(256) DEFAULT NULL,
  `Address2` varchar(256) DEFAULT NULL,
  `Country` varchar(128) DEFAULT NULL,
  `genre` varchar(16) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES (3,33,NULL,NULL,NULL,'male','2016-10-04 03:31:35',1,'nacho'),(5,33,NULL,NULL,NULL,'male','2016-10-04 03:32:58',1,'contacto');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlessonprogress`
--

DROP TABLE IF EXISTS `userlessonprogress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlessonprogress` (
  `id_user` int(11) unsigned NOT NULL,
  `id_lesson` int(11) unsigned DEFAULT NULL,
  `status` tinyint(4) unsigned DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlessonprogress`
--

LOCK TABLES `userlessonprogress` WRITE;
/*!40000 ALTER TABLE `userlessonprogress` DISABLE KEYS */;
/*!40000 ALTER TABLE `userlessonprogress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrelation`
--

DROP TABLE IF EXISTS `userrelation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrelation` (
  `id_user` int(11) unsigned NOT NULL,
  `id_user2` int(11) unsigned NOT NULL,
  `id_relationKind` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrelation`
--

LOCK TABLES `userrelation` WRITE;
/*!40000 ALTER TABLE `userrelation` DISABLE KEYS */;
/*!40000 ALTER TABLE `userrelation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_role` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrole`
--

LOCK TABLES `userrole` WRITE;
/*!40000 ALTER TABLE `userrole` DISABLE KEYS */;
INSERT INTO `userrole` VALUES (1,3,5),(2,3,2),(3,3,1),(4,2,4),(5,5,1);
/*!40000 ALTER TABLE `userrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userthemesubscription`
--

DROP TABLE IF EXISTS `userthemesubscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userthemesubscription` (
  `id_user` int(11) unsigned NOT NULL,
  `id_theme` int(11) unsigned NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY `id_user` (`id_user`,`id_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userthemesubscription`
--

LOCK TABLES `userthemesubscription` WRITE;
/*!40000 ALTER TABLE `userthemesubscription` DISABLE KEYS */;
INSERT INTO `userthemesubscription` VALUES (3,29,'2016-09-22 04:52:09',1),(3,30,'2016-09-24 17:05:17',1),(3,31,'2016-09-22 04:52:16',1),(5,30,'2016-09-28 03:50:09',1),(5,31,'2016-09-28 03:50:13',1);
/*!40000 ALTER TABLE `userthemesubscription` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-11 23:08:25
