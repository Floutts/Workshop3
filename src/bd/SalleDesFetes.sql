-- MySQL dump 10.16  Distrib 10.1.41-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SalleDesFetes
-- ------------------------------------------------------
-- Server version	10.1.41-MariaDB-0+deb9u1

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
-- Table structure for table `Collaborateur`
--

DROP TABLE IF EXISTS `Collaborateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Collaborateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Collaborateur`
--

LOCK TABLES `Collaborateur` WRITE;
/*!40000 ALTER TABLE `Collaborateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `Collaborateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Locataire`
--

DROP TABLE IF EXISTS `Locataire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Locataire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Locataire`
--

LOCK TABLES `Locataire` WRITE;
/*!40000 ALTER TABLE `Locataire` DISABLE KEYS */;
/*!40000 ALTER TABLE `Locataire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Option`
--

DROP TABLE IF EXISTS `Option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Option`
--

LOCK TABLES `Option` WRITE;
/*!40000 ALTER TABLE `Option` DISABLE KEYS */;
/*!40000 ALTER TABLE `Option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OptionsSalle`
--

DROP TABLE IF EXISTS `OptionsSalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OptionsSalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSalle` int(11) NOT NULL,
  `idOption` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSalle` (`idSalle`),
  KEY `idOption` (`idOption`),
  CONSTRAINT `OptionsSalle_ibfk_1` FOREIGN KEY (`idSalle`) REFERENCES `Salle` (`id`),
  CONSTRAINT `OptionsSalle_ibfk_2` FOREIGN KEY (`idOption`) REFERENCES `Option` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OptionsSalle`
--

LOCK TABLES `OptionsSalle` WRITE;
/*!40000 ALTER TABLE `OptionsSalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `OptionsSalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSalle` int(11) NOT NULL,
  `idLocataire` int(11) NOT NULL,
  `idOptionsSalle` int(11) NOT NULL,
  `DebutLocation` date NOT NULL,
  `FinLocation` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSalle` (`idSalle`),
  KEY `idLocataire` (`idLocataire`),
  KEY `idOptionsSalle` (`idOptionsSalle`),
  CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`idOptionsSalle`) REFERENCES `OptionsSalle` (`id`),
  CONSTRAINT `Reservation_ibfk_2` FOREIGN KEY (`idSalle`) REFERENCES `Salle` (`id`),
  CONSTRAINT `Reservation_ibfk_3` FOREIGN KEY (`idLocataire`) REFERENCES `Locataire` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservation`
--

LOCK TABLES `Reservation` WRITE;
/*!40000 ALTER TABLE `Reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `Reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salle`
--

DROP TABLE IF EXISTS `Salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `idStatut` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idStatut` (`idStatut`),
  CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`idStatut`) REFERENCES `Statut` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salle`
--

LOCK TABLES `Salle` WRITE;
/*!40000 ALTER TABLE `Salle` DISABLE KEYS */;
/*!40000 ALTER TABLE `Salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Statut`
--

DROP TABLE IF EXISTS `Statut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Statut`
--

LOCK TABLES `Statut` WRITE;
/*!40000 ALTER TABLE `Statut` DISABLE KEYS */;
/*!40000 ALTER TABLE `Statut` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-05 10:16:46
