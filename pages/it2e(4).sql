-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 juin 2022 à 11:22
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `it2e`
--

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `id_niveau` int(11) NOT NULL,
  `id_univ` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`,`id_univ`),
  KEY `Composer_Ecole0_FK` (`id_univ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `id_univ` int(11) NOT NULL,
  `id_domaine` int(11) NOT NULL,
  `id_univ_Ecole` int(11) NOT NULL,
  PRIMARY KEY (`id_univ`,`id_domaine`,`id_univ_Ecole`),
  KEY `Contenir_Domaine0_FK` (`id_domaine`),
  KEY `Contenir_Ecole1_FK` (`id_univ_Ecole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `diplome`
--

DROP TABLE IF EXISTS `diplome`;
CREATE TABLE IF NOT EXISTS `diplome` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `img_blob` longblob NOT NULL,
  `img_taille` text NOT NULL,
  `img_nom` text NOT NULL,
  `img_type` text NOT NULL,
  `id_etudiant` int(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_etudiant` (`id_etudiant`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE IF NOT EXISTS `domaine` (
  `id_domaine` int(11) NOT NULL AUTO_INCREMENT,
  `nom_domaine` varchar(50) NOT NULL,
  PRIMARY KEY (`id_domaine`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`id_domaine`, `nom_domaine`) VALUES
(1, 'INFORMATIQUE'),
(2, 'EDUCATION'),
(3, 'MILITAIRE');

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `id_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `fichier` varchar(50) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id_dossier`),
  KEY `Dossier_Etudiant_FK` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

DROP TABLE IF EXISTS `ecole`;
CREATE TABLE IF NOT EXISTS `ecole` (
  `id_univ` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ecole` varchar(50) NOT NULL,
  `date_ouverture` varchar(50) NOT NULL,
  `localisation` varchar(50) NOT NULL,
  `id_public` int(120) NOT NULL,
  PRIMARY KEY (`id_univ`),
  KEY `id_public` (`id_public`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id_univ`, `nom_ecole`, `date_ouverture`, `localisation`, `id_public`) VALUES
(1, 'ENI', '1988', 'Fianarantsoa', 2),
(2, 'ESTI', '2012', 'Antananarivo', 1),
(3, 'EMIT', '1985', 'Fianarantsoa', 2);

-- --------------------------------------------------------

--
-- Structure de la table `equivalence`
--

DROP TABLE IF EXISTS `equivalence`;
CREATE TABLE IF NOT EXISTS `equivalence` (
  `id_equivalence` int(11) NOT NULL AUTO_INCREMENT,
  `titre_equivalence` varchar(50) NOT NULL,
  `date_demande` date NOT NULL,
  `reference` varchar(50) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_statut` int(11) NOT NULL,
  `num_diplome` varchar(120) NOT NULL,
  PRIMARY KEY (`id_equivalence`),
  UNIQUE KEY `reference` (`reference`),
  UNIQUE KEY `reference_2` (`reference`),
  UNIQUE KEY `num_diplome` (`num_diplome`),
  KEY `Equivalence_Etudiant_FK` (`id_etudiant`),
  KEY `Equivalence_Statut_equivalence0_FK` (`id_statut`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etudiant` varchar(50) NOT NULL,
  `prenom_etudiant` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `numero_etudiant` varchar(50) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_univ` int(11) NOT NULL,
  `id_statutEt` int(11) NOT NULL,
  `CIN` varchar(120) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `CIN` (`CIN`),
  KEY `Etudiant_Genre_FK` (`id_genre`),
  KEY `Etudiant_Ecole0_FK` (`id_univ`),
  KEY `Etudiant_Statut_Marietal1_FK` (`id_statutEt`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `genre_etudiant` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `genre_etudiant`) VALUES
(1, 'Masculin'),
(2, 'Feminin');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_existant`
--

DROP TABLE IF EXISTS `niveau_existant`;
CREATE TABLE IF NOT EXISTS `niveau_existant` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` varchar(50) NOT NULL,
  PRIMARY KEY (`id_niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_existant`
--

INSERT INTO `niveau_existant` (`id_niveau`, `niveau`) VALUES
(1, 'License'),
(2, 'Master'),
(3, 'Doctorat');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` int(11) NOT NULL AUTO_INCREMENT,
  `poste` varchar(50) NOT NULL,
  `date_annonce` date NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

DROP TABLE IF EXISTS `postuler`;
CREATE TABLE IF NOT EXISTS `postuler` (
  `id_offre` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id_offre`,`id_etudiant`),
  KEY `Postuler_Etudiant0_FK` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `public`
--

DROP TABLE IF EXISTS `public`;
CREATE TABLE IF NOT EXISTS `public` (
  `id_public` int(120) NOT NULL AUTO_INCREMENT,
  `public` varchar(120) NOT NULL,
  PRIMARY KEY (`id_public`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `public`
--

INSERT INTO `public` (`id_public`, `public`) VALUES
(1, 'PRIVE'),
(2, 'PUBLIC');

-- --------------------------------------------------------

--
-- Structure de la table `statut_equivalence`
--

DROP TABLE IF EXISTS `statut_equivalence`;
CREATE TABLE IF NOT EXISTS `statut_equivalence` (
  `id_statut` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(50) NOT NULL,
  PRIMARY KEY (`id_statut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statut_equivalence`
--

INSERT INTO `statut_equivalence` (`id_statut`, `statut`) VALUES
(1, 'VALIDE'),
(2, 'EN ATTENTE DE VALIDATION'),
(3, 'REJETE');

-- --------------------------------------------------------

--
-- Structure de la table `statut_marietal`
--

DROP TABLE IF EXISTS `statut_marietal`;
CREATE TABLE IF NOT EXISTS `statut_marietal` (
  `id_statutEt` int(11) NOT NULL AUTO_INCREMENT,
  `statut_etudiant` varchar(50) NOT NULL,
  PRIMARY KEY (`id_statutEt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statut_marietal`
--

INSERT INTO `statut_marietal` (`id_statutEt`, `statut_etudiant`) VALUES
(1, 'MARIE'),
(2, 'CELIBATAIRE');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `Composer_Ecole0_FK` FOREIGN KEY (`id_univ`) REFERENCES `ecole` (`id_univ`),
  ADD CONSTRAINT `Composer_Niveau_existant_FK` FOREIGN KEY (`id_niveau`) REFERENCES `niveau_existant` (`id_niveau`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `Contenir_Domaine0_FK` FOREIGN KEY (`id_domaine`) REFERENCES `domaine` (`id_domaine`),
  ADD CONSTRAINT `Contenir_Ecole1_FK` FOREIGN KEY (`id_univ_Ecole`) REFERENCES `ecole` (`id_univ`),
  ADD CONSTRAINT `Contenir_Ecole_FK` FOREIGN KEY (`id_univ`) REFERENCES `ecole` (`id_univ`);

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `Dossier_Etudiant_FK` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `equivalence`
--
ALTER TABLE `equivalence`
  ADD CONSTRAINT `Equivalence_Etudiant_FK` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `Equivalence_Statut_equivalence0_FK` FOREIGN KEY (`id_statut`) REFERENCES `statut_equivalence` (`id_statut`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `Etudiant_Ecole0_FK` FOREIGN KEY (`id_univ`) REFERENCES `ecole` (`id_univ`),
  ADD CONSTRAINT `Etudiant_Genre_FK` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `Etudiant_Statut_Marietal1_FK` FOREIGN KEY (`id_statutEt`) REFERENCES `statut_marietal` (`id_statutEt`);

--
-- Contraintes pour la table `postuler`
--
ALTER TABLE `postuler`
  ADD CONSTRAINT `Postuler_Etudiant0_FK` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `Postuler_Offre_FK` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
