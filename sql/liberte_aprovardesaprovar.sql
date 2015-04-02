CREATE DATABASE  IF NOT EXISTS `liberte` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `liberte`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: liberte
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `aprovardesaprovar`
--

DROP TABLE IF EXISTS `aprovardesaprovar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aprovardesaprovar` (
  `materia` int(11) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_bin NOT NULL,
  `isPositivo` tinyint(1) NOT NULL,
  PRIMARY KEY (`materia`,`usuario`),
  KEY `aprovarDesaprovar_email` (`usuario`),
  CONSTRAINT `aprovarDesaprovar_email` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`email`),
  CONSTRAINT `aprovarDesaprovar_idMateria` FOREIGN KEY (`materia`) REFERENCES `materias` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprovardesaprovar`
--

LOCK TABLES `aprovardesaprovar` WRITE;
/*!40000 ALTER TABLE `aprovardesaprovar` DISABLE KEYS */;
INSERT INTO `aprovardesaprovar` VALUES (13,'martines.lucas@bol.com.br',1);
/*!40000 ALTER TABLE `aprovardesaprovar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-02 19:52:04
