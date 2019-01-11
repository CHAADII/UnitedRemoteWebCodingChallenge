-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 11 Janvier 2019 à 01:36
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Shops`
--

-- --------------------------------------------------------

--
-- Structure de la table `DislikedShops`
--

CREATE TABLE `DislikedShops` (
  `Email` varchar(250) NOT NULL,
  `Id` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `DislikedShops`
--

INSERT INTO `DislikedShops` (`Email`, `Id`, `Date`) VALUES
('admin@gm.com', 6, '2019-01-10 11:34:55');

-- --------------------------------------------------------

--
-- Structure de la table `likedShops`
--

CREATE TABLE `likedShops` (
  `Email` varchar(250) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Shop`
--

CREATE TABLE `Shop` (
  `Id` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Shop`
--

INSERT INTO `Shop` (`Id`, `Name`, `Location`) VALUES
(1, 'Shop', '31.791702,-7.092619999999999'),
(2, 'new Shop 1', '32.791702,8.092619999999999'),
(3, 'Vikings Shop', '31.791702,-7.092619999999999'),
(4, 'Luis Shop', '9.791702,-8.09261999'),
(5, 'Valhala Shop', '21.091702,-8.092619999999999'),
(6, 'Lorem Shop ', '31.7917077,-7.09');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Email` varchar(250) NOT NULL,
  `password` varchar(64) NOT NULL,
  `Location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`Email`, `password`, `Location`) VALUES
('admin@gm.com', '$2y$10$wzwcoAINPj91X2EG0LTUK.YwcTz7pEW0y.U4w72HiaaVU.jU7vUIK', '31.791702,-7.092619999999999'),
('chadi@gm.cpo', '$2y$10$aTbVIB4Nd51rkUx0lPNBKeGBJrORRxaK8vp3AzwzexBzF5IoIDiTS', '31.791702,-7.092619999999999');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `DislikedShops`
--
ALTER TABLE `DislikedShops`
  ADD KEY `Email` (`Email`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `likedShops`
--
ALTER TABLE `likedShops`
  ADD KEY `Email` (`Email`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `Shop`
--
ALTER TABLE `Shop`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Shop`
--
ALTER TABLE `Shop`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `DislikedShops`
--
ALTER TABLE `DislikedShops`
  ADD CONSTRAINT `DislikedShops_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `Shop` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DislikedShops_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likedShops`
--
ALTER TABLE `likedShops`
  ADD CONSTRAINT `likedShops_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `Shop` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedShops_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
