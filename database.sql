-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: siket
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(8) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_us` int(11) DEFAULT NULL,
  `id_vo` int(11) DEFAULT NULL,
  `id_eve` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_us` (`id_us`),
  KEY `id_vo` (`id_vo`),
  KEY `id_eve` (`id_eve`),
  CONSTRAINT `registros_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `user` (`id`),
  CONSTRAINT `registros_ibfk_2` FOREIGN KEY (`id_vo`) REFERENCES `voleto` (`id`),
  CONSTRAINT `registros_ibfk_3` FOREIGN KEY (`id_eve`) REFERENCES `evento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eve` int(11) DEFAULT NULL,
  `altos` int(11) DEFAULT NULL,
  `medios` int(11) DEFAULT NULL,
  `vip` int(11) DEFAULT NULL,
  `platino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_eve` (`id_eve`),
  CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`id_eve`) REFERENCES `evento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion`
--

LOCK TABLES `ubicacion` WRITE;
/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `cedula` int(10) unsigned DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sexo` varchar(2) DEFAULT NULL,
  `dire` varchar(100) DEFAULT NULL,
  `telefono` int(10) unsigned DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'andres','colmenares',24153697,'raethandres4@gmail.com','M','por ahi',4143792292,'Raethandres','kara',1),(12,'armando','ortuño',24153697,'kjh','ma','sndbfsfj',6787,'arm','mmmm',0),(13,'kevin','cortes',24153697,'kjh','ma','sndbfsfj',6787,'miki','nnnn',0),(14,'miller','nuñez',2455667,'jdkhkj','ma','jshfjkkk',3745,'mille','mmmm',0),(15,'miller','nuñez',2455667,'jdkhkj','ma','jshfjkkk',3745,'min','mmmm',0),(16,'veronica','parada',237756,'mndfb','ma','nbbndf',23843579,'vero','bbbb',0),(17,'daniel','ala',237465,'nbnb','ma','nnnbn',999999,'ala','bbbb',0),(18,'luzmar','alviares',223334,'bvbvbv','fe','bbvbvbv',101923,'eluz','mmmm',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voleto`
--

DROP TABLE IF EXISTS `voleto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voleto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ser` varchar(8) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ubicacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voleto`
--

LOCK TABLES `voleto` WRITE;
/*!40000 ALTER TABLE `voleto` DISABLE KEYS */;
/*!40000 ALTER TABLE `voleto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-22 16:56:57
