-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: reaksjonsregistrering
-- ------------------------------------------------------
-- Server version	5.7.34

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
-- Table structure for table `Reaksjoner`
--

DROP TABLE IF EXISTS `Reaksjoner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reaksjoner` (
  `Reaksjon` varchar(45) NOT NULL,
  PRIMARY KEY (`Reaksjon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reaksjoner`
--

LOCK TABLES `Reaksjoner` WRITE;
/*!40000 ALTER TABLE `Reaksjoner` DISABLE KEYS */;
INSERT INTO `Reaksjoner` VALUES ('bæsj'),('nøytral'),('smil'),('solbriller'),('sur'),('trist');
/*!40000 ALTER TABLE `Reaksjoner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reaksjonsregistrering`
--

DROP TABLE IF EXISTS `Reaksjonsregistrering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reaksjonsregistrering` (
  `Dato` date NOT NULL,
  `Tid` time NOT NULL,
  `Navn` varchar(45) NOT NULL,
  `rommene_has_Reaksjoner_rommene_rom` varchar(45) NOT NULL,
  `rommene_has_Reaksjoner_Reaksjoner_Reaksjon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Tid`,`Navn`,`Dato`),
  KEY `fk_Reaksjonsregistrering_rommene_has_Reaksjoner1_idx` (`rommene_has_Reaksjoner_rommene_rom`,`rommene_has_Reaksjoner_Reaksjoner_Reaksjon`),
  CONSTRAINT `fk_Reaksjonsregistrering_rommene_has_Reaksjoner1` FOREIGN KEY (`rommene_has_Reaksjoner_rommene_rom`, `rommene_has_Reaksjoner_Reaksjoner_Reaksjon`) REFERENCES `rommene_has_Reaksjoner` (`rommene_rom`, `Reaksjoner_Reaksjon`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reaksjonsregistrering`
--

LOCK TABLES `Reaksjonsregistrering` WRITE;
/*!40000 ALTER TABLE `Reaksjonsregistrering` DISABLE KEYS */;
/*!40000 ALTER TABLE `Reaksjonsregistrering` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rommene`
--

DROP TABLE IF EXISTS `rommene`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rommene` (
  `rom` varchar(45) NOT NULL,
  PRIMARY KEY (`rom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rommene`
--

LOCK TABLES `rommene` WRITE;
/*!40000 ALTER TABLE `rommene` DISABLE KEYS */;
INSERT INTO `rommene` VALUES ('main');
/*!40000 ALTER TABLE `rommene` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rommene_has_Reaksjoner`
--

DROP TABLE IF EXISTS `rommene_has_Reaksjoner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rommene_has_Reaksjoner` (
  `rommene_rom` varchar(45) NOT NULL,
  `Reaksjoner_Reaksjon` varchar(45) NOT NULL,
  PRIMARY KEY (`rommene_rom`,`Reaksjoner_Reaksjon`),
  KEY `fk_rommene_has_Reaksjoner_Reaksjoner1_idx` (`Reaksjoner_Reaksjon`),
  KEY `fk_rommene_has_Reaksjoner_rommene1_idx` (`rommene_rom`),
  CONSTRAINT `fk_rommene_has_Reaksjoner_Reaksjoner1` FOREIGN KEY (`Reaksjoner_Reaksjon`) REFERENCES `Reaksjoner` (`Reaksjon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rommene_has_Reaksjoner_rommene1` FOREIGN KEY (`rommene_rom`) REFERENCES `rommene` (`rom`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rommene_has_Reaksjoner`
--

LOCK TABLES `rommene_has_Reaksjoner` WRITE;
/*!40000 ALTER TABLE `rommene_has_Reaksjoner` DISABLE KEYS */;
INSERT INTO `rommene_has_Reaksjoner` VALUES ('main','bæsj'),('main','nøytral'),('main','smil'),('main','solbriller'),('main','sur'),('main','trist');
/*!40000 ALTER TABLE `rommene_has_Reaksjoner` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-29 16:09:27
