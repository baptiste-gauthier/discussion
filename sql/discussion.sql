-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 déc. 2020 à 09:29
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `discussion`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(140) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`) VALUES
(1, 'Teeeeeeeeest', 3, '2020-12-15'),
(2, 'Le commentaire', 2, '2020-12-15'),
(3, 'SoufflÃ© candy canes ice cream lollipop candy fruitcake. Toffee liquorice candy canes. Toffee icing jelly dessert lollipop halvah ice cream.', 2, '2020-12-15'),
(4, 'Cotton candy chocolate bar pastry dragÃ©e. Toffee soufflÃ© chupa chups sesame snaps. Dessert pie bear claw. Sugar plum topping pastry.', 4, '2020-12-15'),
(5, 'Mon message ', 3, '2020-12-15'),
(6, 'teeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeest\r\n', 3, '2020-12-15'),
(7, 'Salut ', 3, '2020-12-15'),
(8, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 4, '2020-12-15'),
(9, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 4, '2020-12-15'),
(10, 'yooooooooooooo\r\n', 3, '2020-12-15'),
(11, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 4, '2020-12-15'),
(12, 'marche ?', 4, '2020-12-15'),
(13, 'msg', 3, '2020-12-15'),
(14, 'msg', 3, '2020-12-15'),
(15, 'zzzzzzzzzzzzzzzzzzzz', 3, '2020-12-15'),
(16, 'Tart sugar plum chocolate jujubes jelly-o. Donut tiramisu croissant gummi bears muffin.', 5, '2020-12-15'),
(17, 'yo', 5, '2020-12-15'),
(18, 'Tart sugar plum chocolate jujubes jelly-o. Donut tiramisu croissant gummi bears muffin.', 5, '2020-12-15'),
(19, 'test', 4, '2020-12-16'),
(20, 'message', 4, '2020-12-16');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(3, 'Test', '$2y$10$1nJf3tb1HLAjXn7nDHsxG.imjlf/qB0bHg0/AVXEctHEymknoccYO'),
(2, 'User', '$2y$10$AeWwzQTDA.ovjYQTX2JvA.gcvRDLlyhEeyJve4UoshROtyMOsX0bO'),
(4, 'Titi', '$2y$10$diAxQ2Wd2x.Thywk1lypKeUbyqnNi03lAHqs7fU.C.wqOYwyKmUea'),
(5, 'Toto', '$2y$10$4Fq08i7elO3h17d.62UhRuibO6nryRWVVXHBypH3z1nmKBk3Gty0O');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
