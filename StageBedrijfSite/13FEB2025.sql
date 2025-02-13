-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: stagebedrijf
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblcomments`
--

DROP TABLE IF EXISTS `tblcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcomments` (
  `CommentID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `PostID` int NOT NULL,
  `Content` text NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcomments`
--

LOCK TABLES `tblcomments` WRITE;
/*!40000 ALTER TABLE `tblcomments` DISABLE KEYS */;
INSERT INTO `tblcomments` VALUES (127,1,41,'Ik heb er zin in! Ook al krijg ik wat stress...','2025-02-03 13:28:38'),(128,1,40,'We zijn naar het cafe gegaan!','2025-02-03 14:06:38'),(130,1,36,'Ik ben ready voor volgende week!','2025-02-03 14:10:29');
/*!40000 ALTER TABLE `tblcomments` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblposts`
--

LOCK TABLES `tblposts` WRITE;
/*!40000 ALTER TABLE `tblposts` DISABLE KEYS */;
INSERT INTO `tblposts` VALUES (27,1,'Start van een nieuw avontuur','Vandaag heb ik veel geleerd over ons nieuwe project.','2025-01-15 08:15:00'),(28,1,'Teamvergadering','Onze teammeeting was heel productief, veel nieuwe ideeën besproken.','2025-01-15 13:30:00'),(29,1,'Werkdag afgesloten','Dag afgesloten met een goed gevoel, op naar morgen!','2025-01-15 17:45:00'),(30,1,'Terugblik op de week','De eerste week was uitdagend maar leerzaam.','2025-01-17 11:00:00'),(31,1,'Plannen voor volgende week','Volgende week focus ik op nieuwe doelstellingen.','2025-01-18 07:30:00'),(32,2,'Eerste werkdag','Mijn eerste dag was spannend en interessant.','2025-01-16 09:00:00'),(33,2,'Kennismaking met het team','Iedereen was vriendelijk en behulpzaam vandaag.','2025-01-16 13:45:00'),(34,2,'Project gestart','Ik ben gestart met mijn eerste project en het gaat goed!','2025-01-17 08:00:00'),(35,2,'Leren en groeien','Vandaag veel nieuwe dingen geleerd, heel boeiend!','2025-01-17 15:00:00'),(36,2,'Weekend plannen','Nu wat rust pakken en klaar zijn voor volgende week.','2025-01-18 18:30:00'),(37,5,'Welkom bij het team','Vandaag werd ik officieel welkom geheten in het team.','2025-01-14 08:00:00'),(38,5,'Eerste uitdaging','Ik ben begonnen met een lastige opdracht, maar dat maakt het interessant.','2025-01-14 12:15:00'),(39,5,'Feedback sessie','Positieve feedback gekregen op mijn eerste opdracht.','2025-01-15 10:45:00'),(40,5,'Weekend vooruitzicht','Klaar met de werkweek, nu ontspannen.','2025-01-19 15:00:00'),(41,5,'Planning volgende week','Volgende week staan er veel meetings op de planning.','2025-01-21 08:30:00');
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
INSERT INTO `tblusers` VALUES (1,'Reda','Kadi','redak','$2y$10$ORdSxWnKz3ZA/lukWw4i9uqu45OWK4oPUC/0DP4E/mFw5zIooH79K','Unitme.y@gmail.com','2025-01-14 08:46:24'),(2,'Maxime','Smet','maximehomo','$2y$10$Y2s6yE.0k6/o9Gv7EUQs2.bi.oU2LHFnhp.fjIChfe6dvjjogrS6q','maximesmet@gmail.com','2025-01-14 13:26:41'),(5,'Demian ','Ayala','demiana','$2y$10$gAyYc77aKelAELB6sp0fTOCGmxdNC5JwyopY1ZS4hvu8cCUpLa8RW','Demian140407@Gmail.com','2025-01-30 10:18:56');
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

-- Dump completed on 2025-02-13 17:37:48
