-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 29 Avril 2020 à 10:15
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `SalleDesFetes`
--

-- --------------------------------------------------------

--
-- Structure de la table `Locataire`
--

CREATE TABLE `Locataire` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Option`
--

CREATE TABLE `Option` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `OptionsSalle`
--

CREATE TABLE `OptionsSalle` (
  `id` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `idOption` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `idLocataire` int(11) NOT NULL,
  `idOptionsSalle` int(11) NOT NULL,
  `DebutLocation` date NOT NULL,
  `FinLocation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE `Salle` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `idStatut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Statut`
--

CREATE TABLE `Statut` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Locataire`
--
ALTER TABLE `Locataire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Option`
--
ALTER TABLE `Option`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `OptionsSalle`
--
ALTER TABLE `OptionsSalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSalle` (`idSalle`),
  ADD KEY `idOption` (`idOption`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSalle` (`idSalle`),
  ADD KEY `idLocataire` (`idLocataire`),
  ADD KEY `idOptionsSalle` (`idOptionsSalle`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idStatut` (`idStatut`);

--
-- Index pour la table `Statut`
--
ALTER TABLE `Statut`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Locataire`
--
ALTER TABLE `Locataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Option`
--
ALTER TABLE `Option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `OptionsSalle`
--
ALTER TABLE `OptionsSalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Salle`
--
ALTER TABLE `Salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Statut`
--
ALTER TABLE `Statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `OptionsSalle`
--
ALTER TABLE `OptionsSalle`
  ADD CONSTRAINT `OptionsSalle_ibfk_1` FOREIGN KEY (`idSalle`) REFERENCES `Salle` (`id`),
  ADD CONSTRAINT `OptionsSalle_ibfk_2` FOREIGN KEY (`idOption`) REFERENCES `Option` (`id`);

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`idOptionsSalle`) REFERENCES `OptionsSalle` (`id`),
  ADD CONSTRAINT `Reservation_ibfk_2` FOREIGN KEY (`idSalle`) REFERENCES `Salle` (`id`),
  ADD CONSTRAINT `Reservation_ibfk_3` FOREIGN KEY (`idLocataire`) REFERENCES `Locataire` (`id`);

--
-- Contraintes pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`idStatut`) REFERENCES `Statut` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
