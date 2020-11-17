-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 29 juin 2020 à 14:11
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livequestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle_categorie` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Id_categorie`, `Libelle_categorie`) VALUES
(1, 'automobile'),
(2, 'pop culture'),
(4, 'nature'),
(5, 'cuisine'),
(6, 'sciences'),
(50, 'art');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `Id_like` int(11) NOT NULL AUTO_INCREMENT,
  `Id_question` int(11) NOT NULL,
  `Id_likeur` int(11) NOT NULL,
  PRIMARY KEY (`Id_like`),
  KEY `Id_question` (`Id_question`),
  KEY `Id_likeur` (`Id_likeur`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `Id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Mail_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `MotDePasse_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Genre_profil` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Id_role` int(11) NOT NULL,
  `Image_profil` varchar(255) NOT NULL DEFAULT 'https://i2.wp.com/yellowsummary.com/wp-content/uploads/2019/02/Icone-profil.png?fit=512%2C512&ssl=1',
  PRIMARY KEY (`Id_profil`),
  KEY `#Id_role` (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`Id_profil`, `Pseudo_profil`, `Mail_profil`, `MotDePasse_profil`, `Genre_profil`, `Id_role`, `Image_profil`) VALUES
(22, 'leo', 'bruantleo@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$SlQzRjZ3ZGpKajUuR0RIWg$bQf/3OuKo1xWaiH2NxYoSIWa7/shxbaLU14rzcqfD6I', 'homme', 1, 'https://i2.wp.com/yellowsummary.com/wp-content/uploads/2019/02/Icone-profil.png?fit=512%2C512&ssl=1'),
(23, 'leo2', 'lespectredu95470@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$Q3JLekJIWVgwN2xaV25mYQ$YBCsfnsUAoK/mkb/JL1kI7PPPo9BmSPjd17SpEVF4YQ', 'homme', 1, 'https://i2.wp.com/yellowsummary.com/wp-content/uploads/2019/02/Icone-profil.png?fit=512%2C512&ssl=1'),
(24, 'leo3', 'lespectredu95@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$c3IwMC50cWRQQlZiWldlTQ$WwSZdJtj+e/MI6pv2YElTdfmQHZxPPz9lL2RLDKfnYU', 'homme', 1, 'https://i2.wp.com/yellowsummary.com/wp-content/uploads/2019/02/Icone-profil.png?fit=512%2C512&ssl=1');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `Id_question` int(11) NOT NULL AUTO_INCREMENT,
  `Titre_question` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Date_creation_question` date NOT NULL,
  `Id_profil` int(11) NOT NULL,
  `Id_categorie` int(11) NOT NULL,
  `Amis_seulement` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_question`),
  KEY `#Id_profil` (`Id_profil`),
  KEY `Id_categorie` (`Id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`Id_question`, `Titre_question`, `Date_creation_question`, `Id_profil`, `Id_categorie`, `Amis_seulement`) VALUES
(111, 'question test 1', '2020-06-29', 22, 1, 0),
(112, 'question test 2', '2020-06-29', 22, 2, 0),
(113, 'question test 3', '2020-06-29', 22, 4, 0),
(114, 'question test 4', '2020-06-29', 22, 5, 0),
(115, 'question test 1', '2020-06-29', 22, 1, 0),
(116, 'question test 2', '2020-06-29', 22, 2, 0),
(117, 'question test 3', '2020-06-29', 22, 4, 0),
(118, 'question test 4', '2020-06-29', 22, 5, 0),
(119, 'question test 1', '2020-06-29', 22, 1, 0),
(120, 'question test 2', '2020-06-29', 22, 2, 0),
(121, 'question test 3', '2020-06-29', 22, 4, 0),
(122, 'question test 4', '2020-06-29', 22, 5, 0),
(123, 'question test 1', '2020-06-29', 22, 1, 0),
(124, 'question test 2', '2020-06-29', 22, 2, 0),
(125, 'question test 3', '2020-06-29', 22, 4, 0),
(126, 'question test 4', '2020-06-29', 22, 5, 0),
(127, 'question test 1', '2020-06-29', 22, 1, 0),
(128, 'question test 2', '2020-06-29', 22, 2, 0),
(129, 'question test 3', '2020-06-29', 22, 4, 0),
(130, 'question test 4', '2020-06-29', 22, 5, 0),
(131, 'question test 1', '2020-06-29', 22, 1, 0),
(132, 'question test 2', '2020-06-29', 22, 2, 0),
(133, 'question test 3', '2020-06-29', 22, 4, 0),
(134, 'question test 4', '2020-06-29', 22, 5, 0),
(135, 'question test 1', '2020-06-29', 22, 1, 0),
(136, 'question test 2', '2020-06-29', 22, 2, 0),
(137, 'question test 3', '2020-06-29', 22, 4, 0),
(138, 'question test 4', '2020-06-29', 22, 5, 0),
(139, 'question test 1', '2020-06-29', 22, 1, 0),
(140, 'question test 2', '2020-06-29', 22, 2, 0),
(141, 'question test 3', '2020-06-29', 22, 4, 0),
(142, 'question test 4', '2020-06-29', 22, 5, 0),
(143, 'question test 1', '2020-06-29', 22, 1, 0),
(144, 'question test 2', '2020-06-29', 22, 2, 0),
(145, 'question test 3', '2020-06-29', 22, 4, 0),
(146, 'question test 4', '2020-06-29', 22, 5, 0),
(147, 'question test 1', '2020-06-29', 22, 1, 0),
(148, 'question test 2', '2020-06-29', 22, 2, 0),
(149, 'question test 3', '2020-06-29', 22, 4, 0),
(150, 'question test 4', '2020-06-29', 22, 5, 0),
(151, 'question test 1', '2020-06-29', 22, 1, 0),
(152, 'question test 2', '2020-06-29', 22, 2, 0),
(153, 'question test 3', '2020-06-29', 22, 4, 0),
(154, 'question test 4', '2020-06-29', 22, 5, 0),
(155, 'question test 1', '2020-06-29', 22, 1, 0),
(156, 'question test 2', '2020-06-29', 22, 2, 0),
(157, 'question test 3', '2020-06-29', 22, 4, 0),
(158, 'question test 4', '2020-06-29', 22, 5, 0),
(159, 'question test 1', '2020-06-29', 22, 1, 0),
(160, 'question test 2', '2020-06-29', 22, 2, 0),
(161, 'question test 3', '2020-06-29', 22, 4, 0),
(162, 'question test 4', '2020-06-29', 22, 5, 0),
(163, 'question test 1', '2020-06-29', 22, 1, 0),
(164, 'question test 2', '2020-06-29', 22, 2, 0),
(165, 'question test 3', '2020-06-29', 22, 4, 0),
(166, 'question test 4', '2020-06-29', 22, 5, 0),
(167, 'question test 1', '2020-06-29', 22, 1, 0),
(168, 'question test 2', '2020-06-29', 22, 2, 0),
(169, 'question test 3', '2020-06-29', 22, 4, 0),
(170, 'question test 4', '2020-06-29', 22, 5, 0),
(171, 'question test 1', '2020-06-29', 22, 1, 0),
(172, 'question test 2', '2020-06-29', 22, 2, 0),
(173, 'question test 3', '2020-06-29', 22, 4, 0),
(174, 'question test 4', '2020-06-29', 22, 5, 0),
(175, 'question pour mes amis', '2020-06-29', 22, 50, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `Id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `Contenu_reponse` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Date_reponse` date NOT NULL,
  `Id_profil` int(11) NOT NULL,
  `Id_question` int(11) NOT NULL,
  PRIMARY KEY (`Id_reponse`),
  KEY `#Id_profil` (`Id_profil`),
  KEY `#Id_question` (`Id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `requete`
--

DROP TABLE IF EXISTS `requete`;
CREATE TABLE IF NOT EXISTS `requete` (
  `Id_requete` int(11) NOT NULL AUTO_INCREMENT,
  `Status_requete` varchar(255) NOT NULL DEFAULT 'attente',
  `Id_envoyeur` int(11) NOT NULL,
  `Id_receveur` int(11) NOT NULL,
  PRIMARY KEY (`Id_requete`),
  KEY `Id_envoyeur` (`Id_envoyeur`),
  KEY `Id_receveur` (`Id_receveur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `requete`
--

INSERT INTO `requete` (`Id_requete`, `Status_requete`, `Id_envoyeur`, `Id_receveur`) VALUES
(2, 'acceptee', 22, 23);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `Id_role` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle_role` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`Id_role`, `Libelle_role`) VALUES
(1, 'utilisateur'),
(2, 'administrateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`Id_likeur`) REFERENCES `profil` (`Id_profil`);

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `FK_#Id_role` FOREIGN KEY (`Id_role`) REFERENCES `role` (`Id_role`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_#Id_profil2` FOREIGN KEY (`Id_profil`) REFERENCES `profil` (`Id_profil`),
  ADD CONSTRAINT `FK_#Id_question` FOREIGN KEY (`Id_question`) REFERENCES `question` (`Id_question`);

--
-- Contraintes pour la table `requete`
--
ALTER TABLE `requete`
  ADD CONSTRAINT `requete_ibfk_1` FOREIGN KEY (`Id_envoyeur`) REFERENCES `profil` (`Id_profil`),
  ADD CONSTRAINT `requete_ibfk_2` FOREIGN KEY (`Id_receveur`) REFERENCES `profil` (`Id_profil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
