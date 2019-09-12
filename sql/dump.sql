-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: mproject
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `range_id` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `client_ranges` (`range_id`),
  CONSTRAINT `client_ranges` FOREIGN KEY (`range_id`) REFERENCES `ranges` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'catcoder','dev','catcoder.php@gmail.com.uk','5570598297',1,1),(7,'catcoder','dev','catcoder.php@gmail.com.ar','5570598297',1,1),(9,'catcoder','dev','catcoder.php@gmail.com.io','5570598297',1,1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collaborator_session`
--

DROP TABLE IF EXISTS `collaborator_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collaborator_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) DEFAULT NULL,
  `ttl` int(11) DEFAULT NULL,
  `collaborator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `collaborator_id` (`collaborator_id`),
  CONSTRAINT `collaborator_session_ibfk_1` FOREIGN KEY (`collaborator_id`) REFERENCES `collaborators` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborator_session`
--

LOCK TABLES `collaborator_session` WRITE;
/*!40000 ALTER TABLE `collaborator_session` DISABLE KEYS */;
INSERT INTO `collaborator_session` VALUES (7,'dcadc23db3f90dedcc9a0935abcc0e7e',1568324950,53);
/*!40000 ALTER TABLE `collaborator_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collaborators`
--

DROP TABLE IF EXISTS `collaborators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborators`
--

LOCK TABLES `collaborators` WRITE;
/*!40000 ALTER TABLE `collaborators` DISABLE KEYS */;
INSERT INTO `collaborators` VALUES (53,'collaborator catcoder','developer','me@collaborator.com.mx','a879a237a4aae15c07441c2a971ff87b','5555555555');
/*!40000 ALTER TABLE `collaborators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collaborators_memberships`
--

DROP TABLE IF EXISTS `collaborators_memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collaborators_memberships` (
  `collaborator_id` int(11) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  KEY `collaborators_collaborators_memberships` (`collaborator_id`),
  KEY `memberships_collaboratos_memberships` (`membership_id`),
  CONSTRAINT `collaborators_collaborators_memberships` FOREIGN KEY (`collaborator_id`) REFERENCES `collaborators` (`id`),
  CONSTRAINT `memberships_collaboratos_memberships` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborators_memberships`
--

LOCK TABLES `collaborators_memberships` WRITE;
/*!40000 ALTER TABLE `collaborators_memberships` DISABLE KEYS */;
INSERT INTO `collaborators_memberships` VALUES (53,1),(53,2);
/*!40000 ALTER TABLE `collaborators_memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foo`
--

DROP TABLE IF EXISTS `foo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foo`
--

LOCK TABLES `foo` WRITE;
/*!40000 ALTER TABLE `foo` DISABLE KEYS */;
INSERT INTO `foo` VALUES (1,'Monster sounds');
/*!40000 ALTER TABLE `foo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `invoked_by` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_events_users` (`user_type_id`),
  CONSTRAINT `log_events_users` FOREIGN KEY (`user_type_id`) REFERENCES `users_type_cat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `range_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'Membresia 1',1,100,1),(2,'Membresia 2',2,150,1),(4,'Membresia 3',3,200,1),(5,'Membresia 4',4,250,1),(6,'Membresia 5',5,300,1),(7,'Membresia 3',3,200,1);
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1566600713),('m190820_213544_db_system',1566600717);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collaborator_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `processes_collaborators` (`collaborator_id`),
  KEY `procesees_clients` (`client_id`),
  KEY `processes_users` (`user_id`),
  KEY `proccess_status_cat` (`status_id`),
  CONSTRAINT `proccess_status_cat` FOREIGN KEY (`status_id`) REFERENCES `status_cat` (`id`),
  CONSTRAINT `procesees_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `processes_collaborators` FOREIGN KEY (`collaborator_id`) REFERENCES `collaborators` (`id`),
  CONSTRAINT `processes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processes`
--

LOCK TABLES `processes` WRITE;
/*!40000 ALTER TABLE `processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranges`
--

DROP TABLE IF EXISTS `ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranges`
--

LOCK TABLES `ranges` WRITE;
/*!40000 ALTER TABLE `ranges` DISABLE KEYS */;
INSERT INTO `ranges` VALUES (1,'100,000 to 250,000','Range to credits from 100,000 to 250,000'),(2,'250,001 to 400,000','Range to credits from 250,001 to 400,000'),(3,'400,001 to 600,000','Range to credits from 400,001 to 600,000'),(4,'600,001 to 1,000,000','Range to credits from 600,001 to 1,000,000'),(5,'1,000,001 to 2,000,000','Range to credits from 1,000,001 to 2,000,000');
/*!40000 ALTER TABLE `ranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_cat`
--

DROP TABLE IF EXISTS `status_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_cat`
--

LOCK TABLES `status_cat` WRITE;
/*!40000 ALTER TABLE `status_cat` DISABLE KEYS */;
INSERT INTO `status_cat` VALUES (1,'Visita'),(2,'Venta'),(3,'Escritura'),(4,'Pago');
/*!40000 ALTER TABLE `status_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscriptions`
--

DROP TABLE IF EXISTS `suscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collaborator_id` int(11) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `ttl` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suscriptions_collaborators` (`collaborator_id`),
  KEY `suscriptions_memberships` (`membership_id`),
  CONSTRAINT `suscriptions_collaborators` FOREIGN KEY (`collaborator_id`) REFERENCES `collaborators` (`id`),
  CONSTRAINT `suscriptions_memberships` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscriptions`
--

LOCK TABLES `suscriptions` WRITE;
/*!40000 ALTER TABLE `suscriptions` DISABLE KEYS */;
INSERT INTO `suscriptions` VALUES (1,53,1,1569110400,0),(2,53,2,1569110400,1);
/*!40000 ALTER TABLE `suscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_session`
--

DROP TABLE IF EXISTS `user_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) DEFAULT NULL,
  `ttl` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_session`
--

LOCK TABLES `user_session` WRITE;
/*!40000 ALTER TABLE `user_session` DISABLE KEYS */;
INSERT INTO `user_session` VALUES (21,'e6e62605b918980c60264e7fe073a4f1',1567710252,2);
/*!40000 ALTER TABLE `user_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `recover_key` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `root` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'catcoder','4dfd04646d5c380e890c5b4b5487f999','','catcoder.php@gmail.com',1),(2,'mario_mejia','dac65a55528f762b8f28bcc1ebfb8305','','mariomejia@mail.com',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_type_cat`
--

DROP TABLE IF EXISTS `users_type_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_type_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_type_cat`
--

LOCK TABLES `users_type_cat` WRITE;
/*!40000 ALTER TABLE `users_type_cat` DISABLE KEYS */;
INSERT INTO `users_type_cat` VALUES (1,'root'),(2,'collaborator');
/*!40000 ALTER TABLE `users_type_cat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-12 12:39:04
