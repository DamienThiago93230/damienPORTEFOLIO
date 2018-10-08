-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 07 sep. 2018 à 14:34
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `damien_portefolio`
--
CREATE DATABASE IF NOT EXISTS `damien_portefolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `damien_portefolio`;

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE `t_users` (
  `id_user` int(3) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_1` varchar(20) NOT NULL,
  `phone_2` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `age` smallint(5) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('Homme','Femme') NOT NULL,
  `civilstatus` enum('M','Mme') NOT NULL,
  `address` text NOT NULL,
  `zip` varchar(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `comments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`id_user`, `first_name`, `last_name`, `email`, `phone_1`, `phone_2`, `password`, `pseudo`, `age`, `birthday`, `gender`, `civilstatus`, `address`, `zip`, `city`, `country`, `comments`) VALUES
(1, 'Thiago', 'Kaylie', 'thiagoKaylie@hotmail.com', '0606060606', '0601010101', 'azerty', 'azerty', 30, '2017-12-04', 'Homme', 'M', '2 rue des étoiles ', '93230', 'Romainville', 'France', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
