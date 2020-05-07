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
-- Table structure for table `association`
--

DROP TABLE IF EXISTS `association`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NomAssociation` varchar(100) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Adresse` varchar(256) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NumTelephone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `association`
--

LOCK TABLES `association` WRITE;
/*!40000 ALTER TABLE `association` DISABLE KEYS */;
/*!40000 ALTER TABLE `association` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locataire`
--

DROP TABLE IF EXISTS `locataire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locataire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locataire`
--

LOCK TABLES `locataire` WRITE;
/*!40000 ALTER TABLE `locataire` DISABLE KEYS */;
/*!40000 ALTER TABLE `locataire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
INSERT INTO `option` VALUES (1,'Cuisine',50),(2,'Femme de ménage',30),(3,'Parking',40);
/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `optionsSalle`
--

DROP TABLE IF EXISTS `optionsSalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `optionsSalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSalle` int(11) NOT NULL,
  `idOption` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSalle` (`idSalle`),
  KEY `idOption` (`idOption`),
  CONSTRAINT `optionsSalle_ibfk_1` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`),
  CONSTRAINT `optionsSalle_ibfk_2` FOREIGN KEY (`idOption`) REFERENCES `option` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `optionsSalle`
--

LOCK TABLES `optionsSalle` WRITE;
/*!40000 ALTER TABLE `optionsSalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `optionsSalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
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
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idOptionsSalle`) REFERENCES `optionsSalle` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`),
  CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`idLocataire`) REFERENCES `locataire` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrateur'),(2,'Employe');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `superficie` int(11) NOT NULL,
  `prix` float NOT NULL,
  `idStatut` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idStatut` (`idStatut`),
  CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salle`
--

LOCK TABLES `salle` WRITE;
/*!40000 ALTER TABLE `salle` DISABLE KEYS */;
INSERT INTO `salle` VALUES (3,'salle 1',100,50,1);
/*!40000 ALTER TABLE `salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statut`
--

DROP TABLE IF EXISTS `statut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statut`
--

LOCK TABLES `statut` WRITE;
/*!40000 ALTER TABLE `statut` DISABLE KEYS */;
INSERT INTO `statut` VALUES (1,'bloque');
/*!40000 ALTER TABLE `statut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idRole` (`idRole`),
  CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (3,'Jean','Bon','jean.bon@gmail.com','jambon',1),(4,'Harry','Covert','harry.covert@gmail.com','haricotvert',2);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-07 10:03:59
