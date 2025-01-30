CREATE DATABASE  IF NOT EXISTS `stagebedrijf` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `stagebedrijf`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: stagebedrijf
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblposts`
--

DROP TABLE IF EXISTS `tblposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblposts` (
  `PostID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PostID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `tblposts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblposts`
--

LOCK TABLES `tblposts` WRITE;
/*!40000 ALTER TABLE `tblposts` DISABLE KEYS */;
INSERT INTO `tblposts` VALUES (7,2,'Eerste werkdag','Mijn eerste dag was spannend en interessant.','2025-01-16 09:00:00'),(8,2,'Kennismaking met het team','Iedereen was vriendelijk en behulpzaam vandaag.','2025-01-16 13:45:00'),(9,2,'Project gestart','Ik ben gestart met mijn eerste project en het gaat goed!','2025-01-17 08:00:00'),(10,2,'Leren en groeien','Vandaag veel nieuwe dingen geleerd, heel boeiend!','2025-01-17 15:00:00'),(11,2,'Weekend plannen','Nu wat rust pakken en klaar zijn voor volgende week.','2025-01-18 18:30:00'),(17,1,'Start van een nieuw avontuur','Vandaag heb ik veel geleerd over ons nieuwe project.','2025-01-15 08:15:00'),(19,1,'Werkdag afgesloten','Dag afgesloten met een goed gevoel, op naar morgen!','2025-01-15 17:45:00'),(22,1,'Teamvergadering','Onze teammeeting was heel productief, veel nieuwe ideeën besproken.','2025-01-15 13:30:00'),(23,1,'Terugblik op de week','De eerste week was uitdagend maar leerzaam.','2025-01-17 11:00:00'),(24,1,'Plannen voor volgende week','Volgende week focus ik op nieuwe doelstellingen.','2025-01-18 07:30:00');
/*!40000 ALTER TABLE `tblposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblusers` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblusers`
--

LOCK TABLES `tblusers` WRITE;
/*!40000 ALTER TABLE `tblusers` DISABLE KEYS */;
INSERT INTO `tblusers` VALUES (1,'Reda','Kadi','redak','$2y$10$ORdSxWnKz3ZA/lukWw4i9uqu45OWK4oPUC/0DP4E/mFw5zIooH79K','Unitme.y@gmail.com','2025-01-14 08:46:24'),(2,'Maxime','Smet','maximehomo','$2y$10$Y2s6yE.0k6/o9Gv7EUQs2.bi.oU2LHFnhp.fjIChfe6dvjjogrS6q','maximesmet@gmail.com','2025-01-14 13:26:41'),(5,'Demian ','Ayala','Demiana','$2y$10$gAyYc77aKelAELB6sp0fTOCGmxdNC5JwyopY1ZS4hvu8cCUpLa8RW','Demian140407@Gmail.com','2025-01-30 10:18:56');
/*!40000 ALTER TABLE `tblusers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-30 21:38:00
