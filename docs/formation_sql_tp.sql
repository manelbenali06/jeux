-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 19 nov. 2021 à 16:04
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formation_sql_tp`
--

-- --------------------------------------------------------

--
-- Structure de la table `association_utilisateur_jeu`
--

CREATE TABLE `association_utilisateur_jeu` (
  `id_association` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `association_utilisateur_jeu`
--

INSERT INTO `association_utilisateur_jeu` (`id_association`, `id_utilisateur`, `id_jeu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 5),
(7, 2, 6),
(8, 3, 1),
(9, 4, 4),
(10, 4, 7),
(11, 4, 8),
(12, 5, 9),
(13, 6, 3),
(14, 6, 5),
(15, 6, 8),
(16, 6, 10),
(17, 7, 1),
(18, 7, 11),
(19, 7, 13),
(20, 8, 13),
(21, 9, 3),
(22, 9, 7),
(23, 9, 9),
(24, 9, 13),
(25, 10, 2),
(26, 10, 8),
(27, 10, 10),
(28, 10, 13);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id_jeu` int(11) NOT NULL,
  `categorie` varchar(45) NOT NULL,
  `editeur` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `joueurs_min` tinyint(2) DEFAULT NULL,
  `joueurs_max` tinyint(2) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `age_minimum` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `categorie`, `editeur`, `nom`, `joueurs_min`, `joueurs_max`, `duree`, `age_minimum`) VALUES
(1, 'coop&eacute;ration', 'Zman Games', 'Pandemic', 2, 4, '00:45:00', 8),
(2, 'placement', 'Next Move', 'Azul', 2, 4, '00:45:00', 8),
(3, 'd&eacute;veloppement', 'filosofia', 'Catan', 3, 4, '01:15:00', 10),
(4, 'placement', 'BLACKROCK Editions', 'Ga&iuml;a', 2, 5, '00:30:00', 8),
(5, 'programmation', 'Ludonaute', 'Colt Express', 2, 6, '00:40:00', 10),
(6, 'cartes', 'AEG', 'Smash Up', 2, 4, '00:45:00', 12),
(7, 'placement', 'filosofia', 'Carcassonne', 2, 5, '00:35:00', 7),
(8, 'placement', 'blue orange', 'Kingdomino', 2, 4, '00:15:00', 8),
(9, 'coop&eacute;ration', 'Gigamic', 'Gal&egrave;rapagos', 3, 12, '00:20:00', 10),
(10, 'cartes', 'Edge', 'Citadelles', 2, 8, '01:00:00', 10),
(11, 'coop&eacute;ration', 'Zman Games', 'Pandemic Zone Rouge - Am&eacute;rique du Nord', 2, 4, '00:30:00', 8),
(12, 'coop&eacute;ration', 'Zman Games', 'Pandemic - Mont&eacute;e des Eaux', 2, 5, '01:00:00', 8),
(13, 'bluff', 'Gigamic', 'Saboteur', 3, 10, '00:30:00', 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pseudo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `pseudo`) VALUES
(1, 'clement.tine@gmail.com', 'clem'),
(2, 'jean.nemar@laposte.net', 'jean-ti'),
(3, 'louis.fine@gmail.com', 'loulou'),
(4, 'alain.tuission@orange.fr', 'al-1'),
(5, 'jerry.guolay@gmail.com', 'riri'),
(6, 'serge.ouin@gmail.com', 'labarbe'),
(7, 'yves.remord@yahoo.fr', 'sevy'),
(8, 'thomas.toketchup@yahoo.fr', 'toto'),
(9, 'sacha.touille@orange.fr', 'sachou'),
(10, 'jean.serre-rien@gmail.com', 'j&eacute;j&eacute;');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `association_utilisateur_jeu`
--
ALTER TABLE `association_utilisateur_jeu`
  ADD PRIMARY KEY (`id_association`),
  ADD KEY `id_jeu` (`id_jeu`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id_jeu`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `association_utilisateur_jeu`
--
ALTER TABLE `association_utilisateur_jeu`
  MODIFY `id_association` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id_jeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `association_utilisateur_jeu`
--
ALTER TABLE `association_utilisateur_jeu`
  ADD CONSTRAINT `association_utilisateur_jeu_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`) ON DELETE CASCADE,
  ADD CONSTRAINT `association_utilisateur_jeu_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
