USE `u925071396_lbt`;
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
  `materia` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL,
  `isPositivo` tinyint(1) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`materia`,`usuario`),
  KEY `aprovarDesaprovar_userid` (`usuario`),
  CONSTRAINT `aprovarDesaprovar_userid` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`),
  CONSTRAINT `aprovarDesaprovar_idMateria` FOREIGN KEY (`materia`) REFERENCES `materias` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprovardesaprovar`
--

LOCK TABLES `aprovardesaprovar` WRITE;
/*!40000 ALTER TABLE `aprovardesaprovar` DISABLE KEYS */;
INSERT INTO `aprovardesaprovar` VALUES (13,1,1,'2015-04-20 17:26:08',1),(13,5,1,'2015-04-20 17:42:05',1),(13,12,0,'2015-09-01 10:23:13',1),(15,5,1,'2015-04-26 23:15:41',1),(17,5,1,'2015-05-31 22:44:28',1),(18,12,1,'2015-09-29 14:17:43',0),(27,12,1,'2015-09-25 00:39:59',0),(29,12,1,'2015-09-28 13:23:32',0),(30,12,1,'2015-09-28 13:52:27',0),(31,12,0,'2015-09-30 14:41:01',0);
/*!40000 ALTER TABLE `aprovardesaprovar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assinaturas`
--

DROP TABLE IF EXISTS `assinaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assinaturas` (
  `assinante` int(11) NOT NULL,
  `assinado` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`assinante`,`assinado`),
  KEY `assinaturas_userid_assinante` (`assinado`),
  CONSTRAINT `assinaturas_userid_assinado` FOREIGN KEY (`assinante`) REFERENCES `usuarios` (`userid`),
  CONSTRAINT `assinaturas_userid_assinante` FOREIGN KEY (`assinado`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assinaturas`
--

LOCK TABLES `assinaturas` WRITE;
/*!40000 ALTER TABLE `assinaturas` DISABLE KEYS */;
INSERT INTO `assinaturas` VALUES (1,12,'2015-10-07 00:11:48',0),(5,12,'2015-04-23 01:18:09',1),(12,1,'2015-10-07 13:21:19',0);
/*!40000 ALTER TABLE `assinaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `materia` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(30) COLLATE utf8_bin NOT NULL,
  `conteudo` blob,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(1) DEFAULT '0',
  `replyOf` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`materia`),
  KEY `comentarios_idMateria` (`materia`),
  KEY `comentarios_email` (`autor`),
  CONSTRAINT `comentarios_email` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`email`),
  CONSTRAINT `comentarios_idMateria` FOREIGN KEY (`materia`) REFERENCES `materias` (`idMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (17,1,12,'xiuuu','2015-08-27 17:47:12',1,0),(17,2,12,'Hahaha','2015-08-27 22:10:21',1,1),(17,3,12,'ASKjhdakjahd','2015-08-27 22:12:08',1,0),(17,4,12,'sdalknkldsaj','2015-08-27 22:12:14',1,3),(17,5,12,'LJDLDJ','2015-09-01 00:54:48',1,3),(17,6,12,'aslJDLKAJ','2015-09-01 00:55:04',1,3),(17,7,12,'akdlkjad','2015-09-01 00:55:56',1,3),(17,8,12,'AHAHHHHA','2015-09-01 00:57:49',1,3),(17,9,12,'Foi sáporra','2015-09-01 00:58:33',1,3),(17,10,12,'Foi mais ainda','2015-09-01 01:02:54',1,3),(17,11,12,'Testando classe Date','2015-09-03 17:49:06',1,0),(17,12,12,'Testando classe Date pra resposta de comentário','2015-09-03 17:49:28',1,11),(17,13,12,'Huahuahsu','2015-09-04 08:03:33',1,0),(17,14,12,'Mostrando comentário','2015-09-04 21:34:54',1,13);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentsvotes`
--

DROP TABLE IF EXISTS `commentsvotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentsvotes` (
  `commentId` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL,
  `isPositive` tinyint(1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`commentId`,`usuario`),
  KEY `commentsVotes_usuarios` (`usuario`),
  CONSTRAINT `commentsVotes_comentarios` FOREIGN KEY (`commentId`) REFERENCES `comentarios` (`id`),
  CONSTRAINT `commentsVotes_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentsvotes`
--

LOCK TABLES `commentsvotes` WRITE;
/*!40000 ALTER TABLE `commentsvotes` DISABLE KEYS */;
INSERT INTO `commentsvotes` VALUES (2,12,0,'2015-09-01 04:20:28',1),(3,12,0,'2015-08-30 19:35:20',1),(4,12,1,'2015-08-30 18:20:46',1),(11,12,0,'2015-09-21 12:10:41',1),(13,12,1,'2015-09-21 12:10:44',1);
/*!40000 ALTER TABLE `commentsvotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denuncias`
--

DROP TABLE IF EXISTS `denuncias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `materia` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `denuncias_usuario` (`autor`),
  KEY `denuncias_materias` (`materia`),
  CONSTRAINT `denuncias_materias` FOREIGN KEY (`materia`) REFERENCES `materias` (`idMateria`),
  CONSTRAINT `denuncias_usuario` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `juri`
--

DROP TABLE IF EXISTS `juri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `juri` (
  `denuncia` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL,
  `resposta` tinyint(1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`denuncia`,`usuario`),
  KEY `juri_usuarios` (`usuario`),
  CONSTRAINT `juri_denuncias` FOREIGN KEY (`denuncia`) REFERENCES `denuncias` (`id`),
  CONSTRAINT `juri_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jurinegado`
--

DROP TABLE IF EXISTS `jurinegado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jurinegado` (
  `denuncia` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`denuncia`,`usuario`),
  KEY `juriNegado_usuarios` (`usuario`),
  CONSTRAINT `juriNegado_denuncias` FOREIGN KEY (`denuncia`) REFERENCES `denuncias` (`id`),
  CONSTRAINT `juriNegado_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `juriselecionado`
--

DROP TABLE IF EXISTS `juriselecionado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `juriselecionado` (
  `denuncia` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`denuncia`,`usuario`),
  KEY `juriSelecionado_usuarios` (`usuario`),
  CONSTRAINT `juriSelecionado_denuncias` FOREIGN KEY (`denuncia`) REFERENCES `denuncias` (`id`),
  CONSTRAINT `juriSelecionado_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias` (
  `idMateria` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) NOT NULL,
  `capa` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `titulo` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `subtitulo` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `isRascunho` tinyint(1) NOT NULL,
  `conteudo` blob,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMateria`),
  KEY `materias_usuarios` (`autor`),
  CONSTRAINT `materias_usuarios` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (13,12,'capa_default.png','Rascunho','Sub-titulo',1,'<p>Mat&eacute;ria teste rascuho, teste 2</p>','2015-08-13 13:10:54'),(15,12,'754a92f7f3412a4bb6e6940e6f1b3417.jpg','Matéria Teste','Sub-titulo, nhenhemnhem nhenehm, nehenhe, nehnehheem, nehhemehe',0,'<p>Mat&eacute;ria teste rascuho, teste 2</p>','2015-08-13 13:10:54'),(16,12,'006f36996ac7fa1bfb2d3aa2e596e0a5.jpg','Rascunho','Sub-titulo',0,'<p>Mat&eacute;ria teste rascuho, teste 2</p>','2015-08-13 13:10:54'),(17,12,'d8bd03ee4203fc8a4e38eff6b9f0c0cf.jpg',' Desigualdade e o resto só pra ficar bem grande kajkfhkajhfk','Sub-titulo grande pra teste, nhenhem, nhenhem nhem, nhenhem, nhem, nhenhem, nhem, nhenhem, nhem, n nehnehem, nehnehnem, nenehenehne, nehnehe',0,'<p>Testando coment&aacute;rios;<br />Aprova&ccedil;&otilde;es e desaprova&ccedil;&otilde;es de coment&aacute;rios;<br />Respostas de coment&aacute;rios.</p>','2015-08-13 13:10:54'),(18,12,'capa_default.png','Teste jQuery','Transição de código',0,'<h2 style=\"text-align: center;\">Usando jQuery para manipula&ccedil;&atilde;o de dados&nbsp;das mat&eacute;rias,<br />Enviando os dados pra uma p&aacute;gina PHP que faz a inser&ccedil;&atilde;o</h2>','2015-08-13 13:10:54'),(19,12,'23ed56a34630fb6e4951906768375c82.jpg','Teste de Classe PHP','Testando Data',0,'<p>kjdlakjlsafkjslafkjflk&ccedil;jslfakjlsafkjlsaf</p>','2015-09-02 20:53:46'),(27,12,'859851e9d2897c6045e39926d4ddb0b1.jpg','Testando Tags','Vai CARALHOOO',0,'<p>d&ccedil;lja&ccedil;ljd&ccedil;ladj&ccedil;dja</p>','2015-09-11 14:42:29'),(29,12,'capa_default.png','Nova matéria','Sub-titulo',0,'<p>fdngddn5wg</p>','2015-09-21 09:11:26'),(30,12,'5eb56d6f1db5beb966dfcd4655cc4ede.jpg','Ygor e Lays','.............',0,'<p>18/06/14 - O dia em que eu voltei a ficar com o amor da minha vida.</p>\r\n<p>&nbsp; &nbsp; &nbsp;V&iacute;nhamos nos falando a um tempo, logo ap&oacute;s desilus&otilde;es amorosas com nossos antigos parceiros -dois babacas, por sinal-, e como nos gost&aacute;vamos, voltamos a ficar. Resumindo a hist&oacute;ria, ap&oacute;s um m&ecirc;s e pouco, quando o Ygor estava indo a um show na Ilhabela, um dos seus amigos lhe perguntou: \"voc&ecirc; est&aacute; namorando com a Lays?\", o mesmo foi enrolado at&eacute; esquecer do que se tratava a pergunta. Fui logo questionada quando houvemos contato novamente, \"N&oacute;s estamos namorando?\" \"Acho que sim\" -isso foi, basicamente, um pedido de namoro-, neste dia corri atr&aacute;s da data em que voltamos a ficar. Sabia que era uma quarta-feira, em uma semana&nbsp;onde a segunda-feira havia sido um jogo do Brasil, dia 18/06/2014 (eu acho).&nbsp;</p>','2015-09-25 19:24:03'),(31,12,'capa_default.png','Saber como funciona','Sub-titulo',0,'<p>&Atilde;&aacute;&egrave;&acirc;&eacute;&egrave;&ecirc;&otilde;&oacute;&ograve;&ocirc;&iacute;&igrave;&icirc;&uacute;&ugrave;&ccedil;&lt;&gt;,.;+_!@#$%&amp;*</p>','2015-09-27 13:57:27'),(33,12,'capa_default.png','Tags','Sub-titulo',0,'','2015-10-01 17:41:57');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `native_tags`
--

DROP TABLE IF EXISTS `native_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `native_tags` (
  `tag` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `native_tags`
--

LOCK TABLES `native_tags` WRITE;
/*!40000 ALTER TABLE `native_tags` DISABLE KEYS */;
INSERT INTO `native_tags` VALUES ('Arte'),('Entretenimento'),('Ciência'),('Mundo'),('Política'),('Tecnologia'),('Viagem'),('Design'),('Justiça Social'),('Movimentos Sociais'),('Economia'),('Games'),('Esportes'),('Filosofia'),('Cinema'),('Ética'),('Música'),('Séries'),('Astronomia'),('Minorias'),('Feminismo'),('Religião'),('Homossexualidade'),('Notícias'),('Cultura Pop'),('Hobbies'),('Física'),('Biologia'),('Química');
/*!40000 ALTER TABLE `native_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recomendacoes`
--

DROP TABLE IF EXISTS `recomendacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recomendacoes` (
  `materia` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualized` tinyint(4) NOT NULL,
  PRIMARY KEY (`materia`,`usuario`),
  KEY `recomendacoes_usuarios` (`usuario`),
  CONSTRAINT `recomendacoes_materias` FOREIGN KEY (`materia`) REFERENCES `materias` (`idMateria`),
  CONSTRAINT `recomendacoes_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recomendacoes`
--

LOCK TABLES `recomendacoes` WRITE;
/*!40000 ALTER TABLE `recomendacoes` DISABLE KEYS */;
INSERT INTO `recomendacoes` VALUES (30,12,'2015-09-28 09:08:43',0);
/*!40000 ALTER TABLE `recomendacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_assinatura`
--

DROP TABLE IF EXISTS `tag_assinatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_assinatura` (
  `Usuario` int(11) NOT NULL,
  `Tag` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Usuario`,`Tag`),
  CONSTRAINT `tag_assinatura_usuario` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_assinatura`
--

LOCK TABLES `tag_assinatura` WRITE;
/*!40000 ALTER TABLE `tag_assinatura` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_assinatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `tag` varchar(30) COLLATE utf8_bin NOT NULL,
  `materia` int(11) NOT NULL,
  PRIMARY KEY (`tag`,`materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES ('Amor',30),('Amor',33),('Arte',33),('Entretenimento',33),('Seila',33),('Teste',27),('Teste',33),('hhh',29);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,  
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `senha` varchar(16) COLLATE utf8_bin NOT NULL,
  `nome` varchar(25) COLLATE utf8_bin NOT NULL,
  `sobrenome` varchar(45) COLLATE utf8_bin NOT NULL,
  `genero` char(1) COLLATE utf8_bin DEFAULT NULL,
  `dtNasc` date DEFAULT NULL,
  `imgPerfil` varchar(40) COLLATE utf8_bin DEFAULT 'default_user_img.jpg',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1, 'allanli.uba@hotmail.com','12345','Allan','Montefusco','m','1997-10-30','perfil_img_default.png'),(2, 'amandamedeiros.oliveira@live.c','LifeinEgypt','Amanda','Medeiros','f','1997-10-25','perfil_img_default.png'),(3, 'beth_oliveiracaragua@hotmail.c','preguicarainha','Maria Elisabeth','de Oliveira','f','1958-05-11','perfil_img_default.png'),(4,'crisdias40@hotmail.com','asa1415','Agatha Cristina ','Dias ','f','1997-02-20','perfil_img_default.png'),(5,'fefe_globo@hotmail.com','fefegata','Fernanda','Tarallo','f','1998-05-14','perfil_img_default.png'),(6,'isabellabitente@hotmail.com','isah2906','Isabella','Bitente','f','1998-06-29','perfil_img_default.png'),(7,'jessica.vidal.leite@hotmail.co','3883','Jéssica ','Vidal Leite','f','0000-00-00','perfil_img_default.png'),(8,'l.fernando.lfgds@gmail.com','010396futebol','Luis Fernando','Guimaraes da Silva','m','1996-03-01','perfil_img_default.png'),(9,'laura_carvalho38@outlook.com','laura38','Laura ','Cralho','f','0000-00-00','perfil_img_default.png'),(10,'margarida.martines@bpl.com.br','654321ma','margarida','martines','f','1952-10-08','perfil_img_default.png'),(11,'marianabocchi2009@hotmail.com','mmba0897','Mariana ','Bocchi','f','1997-10-08','perfil_img_default.png'),(12,'martines.lucas@bol.com.br','caracolis1','Lucas','Martines','m','1998-10-23','perfil_img_default.png'),(13,'mrtricolouco@gmail.com','atecubanos12345','Marcelo','Stapf Ribeiro','m','1998-04-28','perfil_img_default.png');
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

-- Dump completed on 2015-10-20 21:39:11
