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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `senha` varchar(16) COLLATE utf8_bin NOT NULL,
  `nome` varchar(25) COLLATE utf8_bin NOT NULL,
  `sobrenome` varchar(45) COLLATE utf8_bin NOT NULL,
  `genero` char(1) COLLATE utf8_bin DEFAULT NULL,
  `dtNasc` date DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `estado` char(2) COLLATE utf8_bin DEFAULT NULL,
  `imgPerfil` varchar(40) COLLATE utf8_bin DEFAULT 'default_user_img.jpg',
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('allanli.uba@hotmail.com','12345','Allan','Montefusco','m','1997-10-30','Ubatuba','SP','perfil_img_default.png'),('amandamedeiros.oliveira@live.c','LifeinEgypt','Amanda','Medeiros','f','1997-10-25','Caraguatatuba','SP','perfil_img_default.png'),('beth_oliveiracaragua@hotmail.c','preguicarainha','Maria Elisabeth','de Oliveira','f','1958-05-11','Caraguatatuba','SP','perfil_img_default.png'),('crisdias40@hotmail.com','asa1415','Agatha Cristina ','Dias ','f','1997-02-20','Caraguatatuba','SP','perfil_img_default.png'),('fefe_globo@hotmail.com','fefegata','Fernanda','Tarallo','f','1998-05-14','ubatuba','SP','perfil_img_default.png'),('isabellabitente@hotmail.com','isah2906','Isabella','Bitente','f','1998-06-29','Caraguatatuba','SP','perfil_img_default.png'),('jessica.vidal.leite@hotmail.co','3883','Jéssica ','Vidal Leite','f','0000-00-00','Caraguatatuba','SP','perfil_img_default.png'),('l.fernando.lfgds@gmail.com','010396futebol','Luis Fernando','Guimaraes da Silva','m','1996-03-01','Caraguatatuba','SP','perfil_img_default.png'),('laura_carvalho38@outlook.com','laura38','Laura ','Cralho','f','0000-00-00','Caraguatatuba','SP','perfil_img_default.png'),('margarida.martines@bpl.com.br','654321ma','margarida','martines','f','1952-10-08','Caraguatatuba','SP','perfil_img_default.png'),('marianabocchi2009@hotmail.com','mmba0897','Mariana ','Bocchi','f','1997-10-08','Caraguatatuba','SP','perfil_img_default.png'),('martines.lucas@bol.com.br','caracolis1','Lucas','Martines','m','1998-10-23','Caraguatatuba','SP','perfil_img_default.png'),('mrtricolouco@gmail.com','atecubanos12345','Marcelo','Stapf Ribeiro','m','1998-04-28','Caraguatatuba','SP','perfil_img_default.png');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-02 19:52:03
