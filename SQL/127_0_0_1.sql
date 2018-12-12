-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 22 oct. 2018 à 14:07
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_forumuser`
--
CREATE DATABASE IF NOT EXISTS `db_forumuser` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_forumuser`;

-- --------------------------------------------------------

--
-- Structure de la table `be`
--

CREATE TABLE `be` (
  `idxPeople` int(11) NOT NULL,
  `idxType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `be`
--

INSERT INTO `be` (`idxPeople`, `idxType`) VALUES
(1, 1),
(1, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `idContent` int(11) NOT NULL,
  `conNotePress` int(11) DEFAULT NULL,
  `conNotePublic` int(11) DEFAULT NULL,
  `idxType` int(11) NOT NULL,
  `idxUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `content`
--

INSERT INTO `content` (`idContent`, `conNotePress`, `conNotePublic`, `idxType`, `idxUser`) VALUES
(8, 9, 9, 1, 8),
(25, 9, 9, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `idCountry` int(11) NOT NULL,
  `couCapital` varchar(255) DEFAULT NULL,
  `couFlag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`idCountry`, `couCapital`, `couFlag`) VALUES
(1, 'Berne', NULL),
(2, 'Paris', NULL),
(3, 'london', NULL),
(4, 'washington', NULL),
(5, 'Berlin', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE `episode` (
  `idEpisode` int(11) NOT NULL,
  `epiNum` int(11) DEFAULT NULL,
  `epiSeason` int(11) DEFAULT NULL,
  `idxUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`idEpisode`, `epiNum`, `epiSeason`, `idxUser`) VALUES
(1, 1, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `field`
--

CREATE TABLE `field` (
  `idField` int(11) NOT NULL,
  `idxItem` int(11) NOT NULL,
  `idxCountry` int(11) DEFAULT NULL,
  `idxEpisode` int(11) DEFAULT NULL,
  `idxGenre` int(11) DEFAULT NULL,
  `idxPeople` int(11) DEFAULT NULL,
  `idxType` int(11) DEFAULT NULL,
  `idxContent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `field`
--

INSERT INTO `field` (`idField`, `idxItem`, `idxCountry`, `idxEpisode`, `idxGenre`, `idxPeople`, `idxType`, `idxContent`) VALUES
(2, 2, 1, NULL, NULL, NULL, NULL, NULL),
(3, 7, 1, NULL, NULL, NULL, NULL, NULL),
(4, 12, 1, NULL, NULL, NULL, NULL, NULL),
(5, 17, 1, NULL, NULL, NULL, NULL, NULL),
(6, 21, NULL, NULL, 1, NULL, NULL, NULL),
(7, 22, NULL, NULL, 1, NULL, NULL, NULL),
(8, 23, NULL, NULL, 1, NULL, NULL, NULL),
(9, 24, NULL, NULL, 1, NULL, NULL, NULL),
(10, 25, NULL, NULL, 1, NULL, NULL, NULL),
(11, 26, NULL, NULL, 1, NULL, NULL, NULL),
(12, 27, NULL, NULL, 1, NULL, NULL, NULL),
(13, 28, NULL, NULL, 1, NULL, NULL, NULL),
(14, 29, NULL, NULL, NULL, 1, NULL, NULL),
(16, 31, NULL, NULL, NULL, 1, NULL, NULL),
(17, 32, NULL, NULL, NULL, 1, NULL, NULL),
(18, 33, NULL, NULL, NULL, 1, NULL, NULL),
(19, 34, NULL, NULL, 3, NULL, NULL, NULL),
(20, 35, NULL, NULL, 3, NULL, NULL, NULL),
(21, 36, NULL, NULL, 3, NULL, NULL, NULL),
(22, 37, NULL, NULL, 3, NULL, NULL, NULL),
(23, 38, NULL, NULL, 3, NULL, NULL, NULL),
(24, 39, NULL, NULL, 3, NULL, NULL, NULL),
(25, 40, NULL, NULL, 3, NULL, NULL, NULL),
(26, 41, NULL, NULL, 3, NULL, NULL, NULL),
(35, 50, NULL, NULL, NULL, NULL, 1, NULL),
(36, 51, NULL, NULL, NULL, NULL, 1, NULL),
(37, 52, NULL, NULL, NULL, NULL, 1, NULL),
(38, 53, NULL, NULL, NULL, NULL, 1, NULL),
(39, 54, NULL, NULL, NULL, NULL, 1, NULL),
(40, 55, NULL, NULL, NULL, NULL, 1, NULL),
(41, 56, NULL, NULL, NULL, NULL, 1, NULL),
(42, 57, NULL, NULL, NULL, NULL, 1, NULL),
(43, 58, NULL, 1, NULL, NULL, NULL, NULL),
(44, 59, NULL, 1, NULL, NULL, NULL, NULL),
(45, 60, NULL, 1, NULL, NULL, NULL, NULL),
(46, 61, NULL, 1, NULL, NULL, NULL, NULL),
(47, 62, NULL, 1, NULL, NULL, NULL, NULL),
(48, 63, NULL, 1, NULL, NULL, NULL, NULL),
(49, 64, NULL, 1, NULL, NULL, NULL, NULL),
(50, 65, NULL, 1, NULL, NULL, NULL, NULL),
(51, 66, NULL, 1, NULL, NULL, NULL, NULL),
(52, 67, NULL, 1, NULL, NULL, NULL, NULL),
(208, 68, NULL, NULL, NULL, NULL, NULL, 8),
(209, 69, NULL, NULL, NULL, NULL, NULL, 8),
(210, 70, NULL, NULL, NULL, NULL, NULL, 8),
(211, 71, NULL, NULL, NULL, NULL, NULL, 8),
(212, 72, NULL, NULL, NULL, NULL, NULL, 8),
(213, 73, NULL, NULL, NULL, NULL, NULL, 8),
(214, 74, NULL, NULL, NULL, NULL, NULL, 8),
(215, 75, NULL, NULL, NULL, NULL, NULL, 8),
(216, 204, NULL, NULL, NULL, NULL, NULL, 25),
(217, 205, NULL, NULL, NULL, NULL, NULL, 25),
(218, 206, NULL, NULL, NULL, NULL, NULL, 25),
(219, 207, NULL, NULL, NULL, NULL, NULL, 25),
(220, 208, NULL, NULL, NULL, NULL, NULL, 25),
(221, 209, NULL, NULL, NULL, NULL, NULL, 25),
(222, 210, NULL, NULL, NULL, NULL, NULL, 25),
(223, 211, NULL, NULL, NULL, NULL, NULL, 25),
(224, 212, NULL, NULL, NULL, NULL, 2, NULL),
(225, 213, NULL, NULL, NULL, NULL, 2, NULL),
(226, 214, NULL, NULL, NULL, NULL, 2, NULL),
(227, 215, NULL, NULL, NULL, NULL, 2, NULL),
(228, 216, NULL, NULL, NULL, NULL, 2, NULL),
(229, 217, NULL, NULL, NULL, NULL, 2, NULL),
(230, 218, NULL, NULL, NULL, NULL, 2, NULL),
(231, 219, NULL, NULL, NULL, NULL, 2, NULL),
(240, 228, NULL, NULL, NULL, NULL, 4, NULL),
(241, 229, NULL, NULL, NULL, NULL, 4, NULL),
(242, 230, NULL, NULL, NULL, NULL, 4, NULL),
(243, 231, NULL, NULL, NULL, NULL, 4, NULL),
(244, 232, NULL, NULL, NULL, NULL, 4, NULL),
(245, 233, NULL, NULL, NULL, NULL, 4, NULL),
(246, 234, NULL, NULL, NULL, NULL, 4, NULL),
(247, 235, NULL, NULL, NULL, NULL, 4, NULL),
(252, 1, 2, NULL, NULL, NULL, NULL, NULL),
(253, 6, 2, NULL, NULL, NULL, NULL, NULL),
(254, 11, 2, NULL, NULL, NULL, NULL, NULL),
(255, 16, 2, NULL, NULL, NULL, NULL, NULL),
(256, 3, 3, NULL, NULL, NULL, NULL, NULL),
(257, 8, 3, NULL, NULL, NULL, NULL, NULL),
(258, 13, 3, NULL, NULL, NULL, NULL, NULL),
(259, 18, 3, NULL, NULL, NULL, NULL, NULL),
(260, 5, 4, NULL, NULL, NULL, NULL, NULL),
(261, 10, 4, NULL, NULL, NULL, NULL, NULL),
(262, 15, 4, NULL, NULL, NULL, NULL, NULL),
(263, 20, 4, NULL, NULL, NULL, NULL, NULL),
(264, 4, 5, NULL, NULL, NULL, NULL, NULL),
(265, 9, 5, NULL, NULL, NULL, NULL, NULL),
(266, 14, 5, NULL, NULL, NULL, NULL, NULL),
(267, 19, 5, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `idGenre` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idGenre`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `idGroup` int(11) NOT NULL,
  `groName` varchar(30) NOT NULL,
  `groPermission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `group`
--

INSERT INTO `group` (`idGroup`, `groName`, `groPermission`) VALUES
(1, 'admin', 8191),
(4, 'all', 1),
(8, 'membre', 83),
(9, 'moderateur', 119);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `idItem` int(11) NOT NULL,
  `iteText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`idItem`, `iteText`) VALUES
(1, 'France'),
(2, 'Suisse'),
(3, 'Angleterre'),
(4, 'Allemagne'),
(5, 'États-Unis'),
(6, 'France'),
(7, 'Swiss'),
(8, 'England'),
(9, 'Germany'),
(10, 'United States'),
(11, 'Francia'),
(12, 'Svizzera'),
(13, 'Inghilterra'),
(14, 'Germania'),
(15, 'Stati Uniti'),
(16, 'Frankreich'),
(17, 'Schweiz'),
(18, 'England'),
(19, 'Deutschland'),
(20, 'Vereinigte Staaten'),
(21, 'comédie'),
(22, 'comedy'),
(23, 'commedia'),
(24, 'Komödie'),
(25, 'genre pour faire rire'),
(26, 'kind to make people laugh'),
(27, 'tipo di far ridere la gente'),
(28, 'Art, Leute lachen zu'),
(29, 'bon acteur'),
(31, 'guter Schauspieler'),
(32, 'bravo attore'),
(33, 'good actor'),
(34, 'action'),
(35, 'Action'),
(36, 'azione'),
(37, 'action'),
(38, 'film qui est tourné pour les scènes d\'actions'),
(39, 'film è girato per le scene d\'azione'),
(40, 'Film ist für Action-Szenen gedreht'),
(41, 'film is shot for action scenes'),
(50, 'acteur'),
(51, 'Schauspieler'),
(52, 'attore'),
(53, 'actor'),
(54, 'une personne qui joue un rôle au cinéma ou au théatre'),
(55, 'eine Person, die eine Rolle in Kinos und Theatern spielt'),
(56, 'una persona che svolge un ruolo di Cinema e teatro'),
(57, 'a person who plays a role Cinema or theater'),
(58, 'le crash'),
(59, 'le crash'),
(60, 'Absturz'),
(61, 'schianto'),
(62, 'crash'),
(63, 'les survivants du crash s\'organisent pour pas mourire de froid'),
(64, 'les survivants du crash s\'organisent pour pas mourire de froid'),
(65, 'Crash Lebenden organisieren sich, um nicht zu erfrieren'),
(66, 'sopravvissuti Crash si organizzano per non congelare a morte'),
(67, 'crash survivors organize themselves to not freeze to death'),
(68, 'l\'age de glace'),
(69, 'Eiszeit'),
(70, 'era glaciale'),
(71, 'ice age'),
(72, 'beau film d\'animation'),
(73, 'schöne Animationsfilm'),
(74, 'bellissimo film d\'animazione'),
(75, 'beautiful animated film'),
(204, 'dieHard'),
(205, 'dieHard'),
(206, 'dieHard'),
(207, 'dieHard'),
(208, 'Monsieur John McClane doit encore sauver sa peau dans contre un groupe de terroristes'),
(209, 'Mr. John McClane noch retten sich in gegen eine Gruppe von Terroristen'),
(210, 'Mr. John McClane si è ancora salvare in contro un gruppo di terroristi'),
(211, 'Mr. John McClane has yet save himself in against a group of terrorists'),
(212, 'producteur'),
(213, 'Hersteller'),
(214, 'produttore'),
(215, 'producer'),
(216, 'une personne qui met l\'argent dans un projet'),
(217, 'jemand, der Geld in ein Projekt steckt'),
(218, 'qualcuno che mette i soldi in un progetto'),
(219, 'someone who puts money into a project'),
(228, 'réalisateur'),
(229, 'Regisseur'),
(230, 'direttore'),
(231, 'director'),
(232, 'une personne qui s\'occupe de l\'organisation d\'un film'),
(233, 'eine Person, die sich um die Organisation eines Films nimmt'),
(234, 'una persona che si prende cura l\'organizzazione di un film'),
(235, 'a person who takes care of the organization of a film');

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `idLanguage` int(11) NOT NULL,
  `lanName` varchar(255) NOT NULL,
  `lanCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`idLanguage`, `lanName`, `lanCode`) VALUES
(1, 'Français', 'ch-fr'),
(2, 'English', 'uk-en'),
(3, 'italiano', 'ch-it'),
(4, 'Deutsch', 'ch-de');

-- --------------------------------------------------------

--
-- Structure de la table `ofcountry`
--

CREATE TABLE `ofcountry` (
  `idxContent` int(11) NOT NULL,
  `idxCountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ofepisode`
--

CREATE TABLE `ofepisode` (
  `idxContent` int(11) NOT NULL,
  `idxEpisode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ofepisodepeople`
--

CREATE TABLE `ofepisodepeople` (
  `idxEpisode` int(11) NOT NULL,
  `idxPeople` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ofgenre`
--

CREATE TABLE `ofgenre` (
  `idxContent` int(11) NOT NULL,
  `idxGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ofpeople`
--

CREATE TABLE `ofpeople` (
  `idxContent` int(11) NOT NULL,
  `idxPeople` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

CREATE TABLE `people` (
  `idPeople` int(11) NOT NULL,
  `peoName` varchar(255) NOT NULL,
  `peoLastName` varchar(255) NOT NULL,
  `peoBirthDate` date NOT NULL,
  `peoBirthPlace` varchar(255) DEFAULT NULL,
  `idxCountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `people`
--

INSERT INTO `people` (`idPeople`, `peoName`, `peoLastName`, `peoBirthDate`, `peoBirthPlace`, `idxCountry`) VALUES
(1, 'Potterat', 'Thierry', '1987-11-18', 'Paris', 1);

-- --------------------------------------------------------

--
-- Structure de la table `translate`
--

CREATE TABLE `translate` (
  `idxItem` int(11) NOT NULL,
  `idxLanguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `translate`
--

INSERT INTO `translate` (`idxItem`, `idxLanguage`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(21, 1),
(25, 1),
(29, 1),
(34, 1),
(38, 1),
(50, 1),
(54, 1),
(58, 1),
(59, 1),
(63, 1),
(64, 1),
(68, 1),
(72, 1),
(204, 1),
(208, 1),
(212, 1),
(216, 1),
(228, 1),
(232, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(22, 2),
(26, 2),
(33, 2),
(37, 2),
(41, 2),
(53, 2),
(57, 2),
(62, 2),
(67, 2),
(71, 2),
(75, 2),
(207, 2),
(211, 2),
(215, 2),
(219, 2),
(231, 2),
(235, 2),
(11, 3),
(12, 3),
(13, 3),
(15, 3),
(23, 3),
(27, 3),
(32, 3),
(36, 3),
(40, 3),
(52, 3),
(56, 3),
(61, 3),
(66, 3),
(70, 3),
(74, 3),
(206, 3),
(210, 3),
(214, 3),
(218, 3),
(230, 3),
(234, 3),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(24, 4),
(28, 4),
(31, 4),
(35, 4),
(39, 4),
(51, 4),
(55, 4),
(60, 4),
(65, 4),
(69, 4),
(73, 4),
(205, 4),
(209, 4),
(213, 4),
(217, 4),
(229, 4),
(233, 4);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `idType` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idType`) VALUES
(1),
(2),
(4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `useNickname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `usePassword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `useStatus` tinyint(1) NOT NULL DEFAULT '0',
  `useName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useLastName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useBirthDate` date DEFAULT NULL,
  `useSignature` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useAvatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useMail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `idxGroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `useNickname`, `usePassword`, `useStatus`, `useName`, `useLastName`, `useBirthDate`, `useSignature`, `useAvatar`, `useMail`, `idxGroup`) VALUES
(8, 'Potteratth', '1dc8a24e8695e329051af662c87285c6e3a26223', 1, 'Potterat', 'Thierry', '1987-11-18', '../upload/user/fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f/signature/a21ea3edd43d14752cb406e8073d7871e0db66cc.jpeg', '../upload/user/fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f/avatar/a04d1fa2cb44c646d740835be3fa55dbd5420dd3.jpeg', 'potterat.thierry@gmail.com', 1),
(42, 'f&euml;linya', '1dc8a24e8695e329051af662c87285c6e3a26223', 1, 'hime', 'f&euml;linya', NULL, '../upload/user/92cfceb39d57d914ed8b14d0e37643de0797ae56/signature/4dbeb5066d8ced236636e0406b0bed09422516e5.jpeg', '../upload/user/92cfceb39d57d914ed8b14d0e37643de0797ae56/avatar/e69dd3847de166e92e8bd2b1c9008860ba2aa0e1.jpeg', 'felinya@uroboros.com', 9),
(47, 'utilisateur1', '1dc8a24e8695e329051af662c87285c6e3a26223', 0, 'utilisateur', 'numero1', '1982-11-18', NULL, NULL, 'utilisateur@numero1.ch', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `be`
--
ALTER TABLE `be`
  ADD PRIMARY KEY (`idxPeople`,`idxType`),
  ADD KEY `be_idType` (`idxType`);

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`idContent`),
  ADD KEY `idxType` (`idxType`,`idxUser`),
  ADD KEY `idxUser` (`idxUser`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`idCountry`);

--
-- Index pour la table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`idEpisode`),
  ADD KEY `idxPeople` (`idxUser`),
  ADD KEY `idxUser` (`idxUser`);

--
-- Index pour la table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`idField`),
  ADD KEY `idxCountry` (`idxCountry`,`idxEpisode`,`idxGenre`,`idxPeople`,`idxType`),
  ADD KEY `idxEpisode` (`idxEpisode`),
  ADD KEY `idxGenre` (`idxGenre`),
  ADD KEY `idxPeople` (`idxPeople`),
  ADD KEY `idxType` (`idxType`),
  ADD KEY `idxItem` (`idxItem`),
  ADD KEY `idxContent` (`idxContent`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idGroup`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`idLanguage`);

--
-- Index pour la table `ofcountry`
--
ALTER TABLE `ofcountry`
  ADD PRIMARY KEY (`idxContent`,`idxCountry`),
  ADD KEY `ofCountry_idCountry` (`idxCountry`);

--
-- Index pour la table `ofepisode`
--
ALTER TABLE `ofepisode`
  ADD PRIMARY KEY (`idxContent`,`idxEpisode`),
  ADD KEY `idxContent` (`idxContent`),
  ADD KEY `idxEpisode` (`idxEpisode`);

--
-- Index pour la table `ofepisodepeople`
--
ALTER TABLE `ofepisodepeople`
  ADD PRIMARY KEY (`idxEpisode`,`idxPeople`),
  ADD KEY `ofEpisodePeople_idPeople` (`idxPeople`);

--
-- Index pour la table `ofgenre`
--
ALTER TABLE `ofgenre`
  ADD PRIMARY KEY (`idxContent`,`idxGenre`),
  ADD KEY `ofGenre_idGenre` (`idxGenre`);

--
-- Index pour la table `ofpeople`
--
ALTER TABLE `ofpeople`
  ADD PRIMARY KEY (`idxContent`,`idxPeople`),
  ADD KEY `ofPeople_idPeople` (`idxPeople`);

--
-- Index pour la table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPeople`),
  ADD KEY `idxCountry` (`idxCountry`);

--
-- Index pour la table `translate`
--
ALTER TABLE `translate`
  ADD PRIMARY KEY (`idxItem`,`idxLanguage`),
  ADD KEY `trans_idLanguage` (`idxLanguage`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD KEY `id` (`idUser`),
  ADD KEY `userGroup` (`idxGroup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `idContent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `idCountry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `episode`
--
ALTER TABLE `episode`
  MODIFY `idEpisode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `field`
--
ALTER TABLE `field`
  MODIFY `idField` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `idGenre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `group`
--
ALTER TABLE `group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `idLanguage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `people`
--
ALTER TABLE `people`
  MODIFY `idPeople` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `idType` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `be`
--
ALTER TABLE `be`
  ADD CONSTRAINT `be_idPeople` FOREIGN KEY (`idxPeople`) REFERENCES `people` (`idPeople`),
  ADD CONSTRAINT `be_idType` FOREIGN KEY (`idxType`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_IdUser` FOREIGN KEY (`idxUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `content_idType` FOREIGN KEY (`idxType`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `episode_idUser` FOREIGN KEY (`idxUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_idContent` FOREIGN KEY (`idxContent`) REFERENCES `content` (`idContent`),
  ADD CONSTRAINT `field_idCountry` FOREIGN KEY (`idxCountry`) REFERENCES `country` (`idCountry`),
  ADD CONSTRAINT `field_idEpisode` FOREIGN KEY (`idxEpisode`) REFERENCES `episode` (`idEpisode`),
  ADD CONSTRAINT `field_idGenre` FOREIGN KEY (`idxGenre`) REFERENCES `genre` (`idGenre`),
  ADD CONSTRAINT `field_idItem` FOREIGN KEY (`idxItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `field_idPeople` FOREIGN KEY (`idxPeople`) REFERENCES `people` (`idPeople`),
  ADD CONSTRAINT `field_idType` FOREIGN KEY (`idxType`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `ofcountry`
--
ALTER TABLE `ofcountry`
  ADD CONSTRAINT `ofCountry_idContent` FOREIGN KEY (`idxContent`) REFERENCES `content` (`idContent`),
  ADD CONSTRAINT `ofCountry_idCountry` FOREIGN KEY (`idxCountry`) REFERENCES `country` (`idCountry`);

--
-- Contraintes pour la table `ofepisode`
--
ALTER TABLE `ofepisode`
  ADD CONSTRAINT `ofEpisode_idContent` FOREIGN KEY (`idxContent`) REFERENCES `content` (`idContent`),
  ADD CONSTRAINT `ofEpisode_idEpisode` FOREIGN KEY (`idxEpisode`) REFERENCES `episode` (`idEpisode`);

--
-- Contraintes pour la table `ofepisodepeople`
--
ALTER TABLE `ofepisodepeople`
  ADD CONSTRAINT `ofEpisodePeople_idEpisode` FOREIGN KEY (`idxEpisode`) REFERENCES `episode` (`idEpisode`),
  ADD CONSTRAINT `ofEpisodePeople_idPeople` FOREIGN KEY (`idxPeople`) REFERENCES `people` (`idPeople`);

--
-- Contraintes pour la table `ofgenre`
--
ALTER TABLE `ofgenre`
  ADD CONSTRAINT `ofGenre_idContent` FOREIGN KEY (`idxContent`) REFERENCES `content` (`idContent`),
  ADD CONSTRAINT `ofGenre_idGenre` FOREIGN KEY (`idxGenre`) REFERENCES `genre` (`idGenre`);

--
-- Contraintes pour la table `ofpeople`
--
ALTER TABLE `ofpeople`
  ADD CONSTRAINT `ofPeople_idContent` FOREIGN KEY (`idxContent`) REFERENCES `content` (`idContent`),
  ADD CONSTRAINT `ofPeople_idPeople` FOREIGN KEY (`idxPeople`) REFERENCES `people` (`idPeople`);

--
-- Contraintes pour la table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `idxCountry_idTranslate` FOREIGN KEY (`idxCountry`) REFERENCES `country` (`idCountry`);

--
-- Contraintes pour la table `translate`
--
ALTER TABLE `translate`
  ADD CONSTRAINT `trans_idItem` FOREIGN KEY (`idxItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `trans_idLanguage` FOREIGN KEY (`idxLanguage`) REFERENCES `language` (`idLanguage`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `idxGroup_idGroup` FOREIGN KEY (`idxGroup`) REFERENCES `group` (`idGroup`);
--
-- Base de données :  `twixtel`
--
CREATE DATABASE IF NOT EXISTS `twixtel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `twixtel`;

-- --------------------------------------------------------

--
-- Structure de la table `belong`
--

CREATE TABLE `belong` (
  `idxCustomer` int(11) NOT NULL,
  `idxNationality` int(11) NOT NULL DEFAULT '0',
  `idxOrigin` int(11) NOT NULL DEFAULT '0',
  `idxHome` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `belong`
--

INSERT INTO `belong` (`idxCustomer`, `idxNationality`, `idxOrigin`, `idxHome`) VALUES
(1, 0, 0, 2),
(1, 0, 1, 0),
(1, 1, 0, 0),
(2, 0, 0, 1),
(2, 0, 2, 0),
(2, 2, 0, 0),
(9, 0, 0, 1),
(9, 0, 2, 0),
(9, 1, 0, 0),
(10, 0, 0, 1),
(10, 0, 1, 0),
(10, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `business`
--

CREATE TABLE `business` (
  `idBusiness` int(11) NOT NULL COMMENT 'id du type d''entreprise',
  `busName` varchar(32) NOT NULL COMMENT 'nom de du type d''entreprise',
  `busDescription` text NOT NULL COMMENT 'description du type d''entreprise'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `business`
--

INSERT INTO `business` (`idBusiness`, `busName`, `busDescription`) VALUES
(1, 'PME', ''),
(2, 'particulier', '');

-- --------------------------------------------------------

--
-- Structure de la table `canton`
--

CREATE TABLE `canton` (
  `idCanton` int(5) NOT NULL COMMENT 'id du canton',
  `canName` varchar(32) DEFAULT NULL COMMENT 'nom du canton',
  `canCode` varchar(4) NOT NULL,
  `canFlag` text,
  `idxCountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='données du canton';

--
-- Déchargement des données de la table `canton`
--

INSERT INTO `canton` (`idCanton`, `canName`, `canCode`, `canFlag`, `idxCountry`) VALUES
(1, 'étranger', 'HS', NULL, 2),
(2, 'Vaud', 'VD', NULL, 1),
(5, NULL, 'BS', NULL, 1),
(6, NULL, 'FR', NULL, 1),
(7, NULL, 'BE', NULL, 1),
(8, NULL, 'BL', NULL, 1),
(9, NULL, 'NE', NULL, 1),
(10, NULL, 'GE', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `idCountry` int(11) NOT NULL COMMENT 'id du pays',
  `couName` varchar(35) NOT NULL COMMENT 'nom du pays',
  `couCode` text NOT NULL,
  `couFlag` text NOT NULL COMMENT 'drapeau du pays'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='données du pays';

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`idCountry`, `couName`, `couCode`, `couFlag`) VALUES
(1, 'Suisse', 'ch', ''),
(2, 'france', 'fr', '');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL COMMENT 'id du client',
  `cusName` varchar(32) NOT NULL COMMENT 'prénom du client',
  `cusFirstName` varchar(32) NOT NULL COMMENT 'nom du client',
  `cusBirthDate` date NOT NULL COMMENT 'date de naissance',
  `cusStreet` varchar(32) NOT NULL COMMENT 'rue',
  `cusStreetNumber` varchar(10) NOT NULL COMMENT 'numro de rue',
  `cusEMail` varchar(32) DEFAULT NULL COMMENT 'email du client',
  `cusWebSite` varchar(32) DEFAULT NULL COMMENT 'site web du client',
  `cusKind` tinyint(1) DEFAULT '0' COMMENT 'genre homme/femme',
  `cusCar` tinyint(1) DEFAULT '0' COMMENT 'possède un véhicule',
  `cusPhone` varchar(13) NOT NULL COMMENT 'téléphone',
  `cusFax` varchar(13) DEFAULT NULL COMMENT 'fax',
  `cusMobile` varchar(13) DEFAULT NULL COMMENT 'téléphone mobile',
  `idxBusiness` int(11) NOT NULL COMMENT 'clef étrangère du type d''entreprise',
  `idxRubric` int(11) NOT NULL,
  `idxJob` int(11) NOT NULL,
  `idxLocality` int(5) NOT NULL COMMENT 'clef étrangère de la localité',
  `idxStatus` int(5) NOT NULL COMMENT 'clef étrangère du status',
  `idxLanguage` int(5) NOT NULL COMMENT 'clef étrangère de la langue',
  `cusAddData1` text COMMENT 'donnée supplémentaire 1 ',
  `cusAddData2` text COMMENT 'données supplémentaire 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table du client';

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`idCustomer`, `cusName`, `cusFirstName`, `cusBirthDate`, `cusStreet`, `cusStreetNumber`, `cusEMail`, `cusWebSite`, `cusKind`, `cusCar`, `cusPhone`, `cusFax`, `cusMobile`, `idxBusiness`, `idxRubric`, `idxJob`, `idxLocality`, `idxStatus`, `idxLanguage`, `cusAddData1`, `cusAddData2`) VALUES
(1, 'alpha', 'toto', '2018-09-01', 'ch. du centenaire', '4', 'toto@alpha.ch', '', 2, 2, '0216830001', '', '', 2, 1, 1, 4, 2, 1, NULL, NULL),
(2, 'alpha', 'tata', '2018-09-01', 'ch. du centenaire', '4', 'tata@alpha.ch', '', 1, 1, '0216830001', '', '', 2, 2, 2, 1, 1, 1, NULL, NULL),
(9, 'alpha', 'titi', '2018-09-01', 'ch. du centenaire', '4', 'tata@alpha.ch', '', 1, 2, '0216830001', '', '', 2, 2, 2, 3, 1, 1, NULL, NULL),
(10, 'alpha', 'tete', '2018-09-01', 'ch. du centenaire', '4', 'tata@alpha.ch', '', 2, 1, '0216830001', '', '', 1, 2, 2, 2, 1, 1, NULL, NULL),
(645, 'Litzistorf', 'Yvonne', '1900-01-01', 'Gotthardstr.', '99', NULL, NULL, 8, 0, '061 301 27 08', NULL, NULL, 2, 1, 1, 5, 6, 4, NULL, NULL),
(646, 'Litzistorf', 'Gabriel', '1900-01-01', 'impasse de la Fontaine', '4', NULL, NULL, 8, 0, '026 475 17 93', '026 475 30 59', '026 475 30 59', 2, 1, 1, 6, 6, 4, NULL, NULL),
(648, 'Gloor Litzistorf', 'Rosmarie', '1900-01-01', 'Schafmattweg', '62', NULL, NULL, 8, 0, '061 421 47 64', NULL, NULL, 2, 1, 1, 8, 6, 4, NULL, NULL),
(649, 'Litzistorf', 'André', '1900-01-01', 'le Perré', '38', NULL, NULL, 8, 0, '026 927 21 89', NULL, NULL, 2, 1, 1, 9, 6, 4, NULL, NULL),
(650, 'Litzistorf', 'Agnès', '1900-01-01', 'route des Pléiades', '64', NULL, NULL, 8, 0, '021 948 95 87', NULL, NULL, 2, 1, 1, 10, 6, 4, NULL, NULL),
(651, 'Litzistorf', 'Carine', '1900-01-01', 'rue du Vieux-Moulin', '2', NULL, NULL, 8, 0, '032 835 24 14', NULL, NULL, 2, 1, 1, 11, 6, 4, NULL, NULL),
(652, 'Litzistorf', 'Marie-José', '1900-01-01', 'route de la Côte', '5', NULL, NULL, 8, 0, '026 477 12 81', NULL, NULL, 2, 1, 1, 12, 6, 4, NULL, NULL),
(653, 'Litzistorf', 'Henri', '1900-01-01', 'ch. des Tilleuls', '22', NULL, NULL, 8, 0, '021 653 08 72', NULL, NULL, 2, 1, 1, 13, 6, 4, NULL, NULL),
(654, 'Litzistorf', 'Florence', '1900-01-01', 'ch. des Bougeries', '19D', NULL, NULL, 8, 0, '022 771 11 57', NULL, NULL, 2, 1, 1, 14, 6, 4, NULL, NULL),
(655, 'Litzistorf', 'Gérald', '1900-01-01', 'ch. Champ-Gilbert', '5', NULL, NULL, 8, 0, '022 342 15 74', NULL, NULL, 2, 1, 1, 15, 6, 4, NULL, NULL),
(656, 'Litzistorf', 'Edith', '1900-01-01', 'ch. Champ-Gilbert', '5', NULL, NULL, 8, 0, '022 342 15 74', NULL, NULL, 2, 1, 1, 15, 6, 4, NULL, NULL),
(657, 'Litzistorf', 'Gilbert', '1900-01-01', 'ch. des Hutins', '8', NULL, NULL, 8, 0, '022 751 19 88', NULL, NULL, 2, 1, 1, 16, 6, 4, NULL, NULL),
(658, 'Litzistorf', 'Henri', '1900-01-01', 'av. de Vaudagne', '42', NULL, NULL, 8, 0, '022 782 80 63', NULL, NULL, 2, 1, 1, 17, 6, 4, NULL, NULL),
(659, 'Litzistorf', 'Jean-Pierre', '1900-01-01', 'ch. des Mésanges', '3', NULL, NULL, 8, 0, '022 794 67 55', NULL, NULL, 2, 1, 1, 18, 6, 4, NULL, NULL),
(660, 'Litzistorf', 'Pascal', '1900-01-01', 'av. de l\'Amandolier', '22', NULL, NULL, 8, 0, '022 786 91 17', NULL, NULL, 2, 1, 1, 19, 6, 4, NULL, NULL),
(661, 'Litzistorf', 'Michel', '1900-01-01', 'route du Village', '8', NULL, NULL, 8, 0, '079 938 76 54', '', NULL, 2, 1, 1, 20, 6, 4, NULL, NULL),
(662, 'Litzistorf', 'Emmanuelle', '1900-01-01', 'route du Village', '8', NULL, NULL, 8, 0, '079 938 76 54', NULL, '', 2, 1, 1, 20, 6, 4, NULL, NULL),
(663, 'Litzistorf', 'Daniel', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '021 646 80 82', NULL, NULL, 2, 1, 1, 21, 6, 4, NULL, NULL),
(664, 'Litzistorf', 'Michèle', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '021 646 80 82', NULL, NULL, 2, 1, 1, 21, 6, 4, NULL, NULL),
(665, 'Litzistorf', 'Yann', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '078 842 06 34', NULL, NULL, 2, 1, 1, 21, 6, 4, NULL, NULL),
(666, 'Litzistorf', 'Marie Pierre', '1900-01-01', 'rue d\'Yverdon', '47BIS', NULL, NULL, 8, 0, '026 660 62 81', NULL, NULL, 2, 1, 1, 22, 6, 4, NULL, NULL),
(667, 'Litzistorf', 'Françoise', '1900-01-01', 'ch. des Fléoles', '21', NULL, NULL, 8, 0, '032 365 99 93', NULL, NULL, 2, 1, 1, 7, 6, 4, NULL, NULL),
(668, 'Litzistorf', 'Yvonne', '1900-01-01', 'Gotthardstr.', '99', NULL, NULL, 8, 0, '061 301 27 08', NULL, NULL, 2, 1, 1, 23, 6, 4, NULL, NULL),
(669, 'Litzistorf', 'Gabriel', '1900-01-01', 'impasse de la Fontaine', '4', NULL, NULL, 8, 0, '026 475 17 93', '026 475 30 59', '026 475 30 59', 2, 1, 1, 24, 6, 4, NULL, NULL),
(670, 'Litzistorf', 'Françoise', '1900-01-01', 'ch. des Fléoles', '21', NULL, NULL, 8, 0, '032 365 99 93', NULL, NULL, 2, 1, 1, 25, 6, 4, NULL, NULL),
(671, 'Gloor Litzistorf', 'Rosmarie', '1900-01-01', 'Schafmattweg', '62', NULL, NULL, 8, 0, '061 421 47 64', NULL, NULL, 2, 1, 1, 26, 6, 4, NULL, NULL),
(672, 'Litzistorf', 'André', '1900-01-01', 'le Perré', '38', NULL, NULL, 8, 0, '026 927 21 89', NULL, NULL, 2, 1, 1, 27, 6, 4, NULL, NULL),
(673, 'Litzistorf', 'Agnès', '1900-01-01', 'route des Pléiades', '64', NULL, NULL, 8, 0, '021 948 95 87', NULL, NULL, 2, 1, 1, 28, 6, 4, NULL, NULL),
(674, 'Litzistorf', 'Carine', '1900-01-01', 'rue du Vieux-Moulin', '2', NULL, NULL, 8, 0, '032 835 24 14', NULL, NULL, 2, 1, 1, 29, 6, 4, NULL, NULL),
(675, 'Litzistorf', 'Marie-José', '1900-01-01', 'route de la Côte', '5', NULL, NULL, 8, 0, '026 477 12 81', NULL, NULL, 2, 1, 1, 30, 6, 4, NULL, NULL),
(676, 'Litzistorf', 'Henri', '1900-01-01', 'ch. des Tilleuls', '22', NULL, NULL, 8, 0, '021 653 08 72', NULL, NULL, 2, 1, 1, 31, 6, 4, NULL, NULL),
(677, 'Litzistorf', 'Florence', '1900-01-01', 'ch. des Bougeries', '19D', NULL, NULL, 8, 0, '022 771 11 57', NULL, NULL, 2, 1, 1, 32, 6, 4, NULL, NULL),
(678, 'Litzistorf', 'Gérald', '1900-01-01', 'ch. Champ-Gilbert', '5', NULL, NULL, 8, 0, '022 342 15 74', NULL, NULL, 2, 1, 1, 33, 6, 4, NULL, NULL),
(679, 'Litzistorf', 'Edith', '1900-01-01', 'ch. Champ-Gilbert', '5', NULL, NULL, 8, 0, '022 342 15 74', NULL, NULL, 2, 1, 1, 33, 6, 4, NULL, NULL),
(680, 'Litzistorf', 'Gilbert', '1900-01-01', 'ch. des Hutins', '8', NULL, NULL, 8, 0, '022 751 19 88', NULL, NULL, 2, 1, 1, 34, 6, 4, NULL, NULL),
(681, 'Litzistorf', 'Henri', '1900-01-01', 'av. de Vaudagne', '42', NULL, NULL, 8, 0, '022 782 80 63', NULL, NULL, 2, 1, 1, 35, 6, 4, NULL, NULL),
(682, 'Litzistorf', 'Jean-Pierre', '1900-01-01', 'ch. des Mésanges', '3', NULL, NULL, 8, 0, '022 794 67 55', NULL, NULL, 2, 1, 1, 36, 6, 4, NULL, NULL),
(683, 'Litzistorf', 'Pascal', '1900-01-01', 'av. de l\'Amandolier', '22', NULL, NULL, 8, 0, '022 786 91 17', NULL, NULL, 2, 1, 1, 37, 6, 4, NULL, NULL),
(684, 'Litzistorf', 'Michel', '1900-01-01', 'route du Village', '8', NULL, NULL, 8, 0, '079 938 76 54', '', NULL, 2, 1, 1, 38, 6, 4, NULL, NULL),
(685, 'Litzistorf', 'Emmanuelle', '1900-01-01', 'route du Village', '8', NULL, NULL, 8, 0, '079 938 76 54', NULL, '', 2, 1, 1, 38, 6, 4, NULL, NULL),
(686, 'Litzistorf', 'Daniel', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '021 646 80 82', NULL, NULL, 2, 1, 1, 39, 6, 4, NULL, NULL),
(687, 'Litzistorf', 'Michèle', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '021 646 80 82', NULL, NULL, 2, 1, 1, 39, 6, 4, NULL, NULL),
(688, 'Litzistorf', 'Yann', '1900-01-01', 'ch. Isabelle-de-Montolieu', '32B', NULL, NULL, 8, 0, '078 842 06 34', NULL, NULL, 2, 1, 1, 39, 6, 4, NULL, NULL),
(689, 'Litzistorf', 'Marie Pierre', '1900-01-01', 'rue d\'Yverdon', '47BIS', NULL, NULL, 8, 0, '026 660 62 81', NULL, NULL, 2, 1, 1, 40, 6, 4, NULL, NULL),
(690, 'alpha', 'jiji', '1900-01-01', 'Chemin du centenaire', '4', '', '', 1, 1, '0216830001', '', '', 2, 2, 2, 1, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE `job` (
  `idJob` int(11) NOT NULL,
  `jobName` varchar(32) NOT NULL,
  `jobDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='données des job';

--
-- Déchargement des données de la table `job`
--

INSERT INTO `job` (`idJob`, `jobName`, `jobDescription`) VALUES
(1, 'inconnu', NULL),
(2, 'beta test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `idLanguage` int(11) NOT NULL COMMENT 'id de la langue',
  `lanName` varchar(32) NOT NULL COMMENT 'nom de la langue',
  `lanCode` varchar(10) NOT NULL COMMENT 'code de la langue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='données des langues';

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`idLanguage`, `lanName`, `lanCode`) VALUES
(1, 'français', 'ch-fr'),
(2, 'allemand', 'ch-de'),
(3, 'anglais', 'gb-en'),
(4, 'italien', 'ch-it');

-- --------------------------------------------------------

--
-- Structure de la table `locality`
--

CREATE TABLE `locality` (
  `idLocality` int(11) NOT NULL COMMENT 'id de la localité',
  `locName` varchar(32) NOT NULL COMMENT 'nom de la localité',
  `locNPA` int(5) NOT NULL COMMENT 'Numéro postal de a localité',
  `idxCanton` int(10) NOT NULL COMMENT 'clef étrangère du canton'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='données de la localité';

--
-- Déchargement des données de la table `locality`
--

INSERT INTO `locality` (`idLocality`, `locName`, `locNPA`, `idxCanton`) VALUES
(1, 'Lausanne', 1004, 2),
(2, 'Grandvaux', 1091, 2),
(3, 'Cully', 1096, 2),
(4, 'Paris', 750000, 1),
(23, 'Basel', 4054, 5),
(24, 'Belfaux', 1782, 6),
(25, 'Biel/Bienne', 2503, 7),
(26, 'Binningen', 4102, 8),
(27, 'Charmey (Gruyère)', 1637, 6),
(28, 'Châtel-St-Denis', 1618, 6),
(29, 'Colombier NE', 2013, 9),
(30, 'Cottens FR', 1741, 6),
(31, 'Echallens', 1040, 2),
(32, 'Plan-les-Ouates', 1228, 10),
(33, 'Troinex', 1256, 10),
(34, 'Anières', 1247, 10),
(35, 'Meyrin', 1217, 10),
(36, 'Grand-Lancy', 1212, 10),
(37, 'Genève', 1208, 10),
(38, 'Grolley', 1772, 6),
(39, 'Lausanne', 1010, 2),
(40, 'Payerne', 1530, 2);

-- --------------------------------------------------------

--
-- Structure de la table `rubric`
--

CREATE TABLE `rubric` (
  `idRubric` int(11) NOT NULL COMMENT 'id de la rubrique',
  `rubName` varchar(32) NOT NULL COMMENT 'nom de la rubrique',
  `rubDescription` text NOT NULL COMMENT 'déscription de la rubrique'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rubric`
--

INSERT INTO `rubric` (`idRubric`, `rubName`, `rubDescription`) VALUES
(3, 'garagiste', ''),
(2, 'fiducaire', ''),
(1, 'inconnu', '');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL COMMENT 'id du status',
  `staName` varchar(32) NOT NULL COMMENT 'nom du staus',
  `staDescription` text NOT NULL COMMENT 'description du status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='status de du client (retraité AI actif etc...)';

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`idStatus`, `staName`, `staDescription`) VALUES
(1, 'mineur', ''),
(2, 'en activité', ''),
(3, 'sans emploi', ''),
(4, 'retraité', ''),
(5, 'majeur', ''),
(6, 'inconnu', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `useNickname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `usePassword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `useStatus` tinyint(1) NOT NULL DEFAULT '0',
  `useName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useLastName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useBirthDate` date DEFAULT NULL,
  `useSignature` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useAvatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `useMail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `idxGroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `useNickname`, `usePassword`, `useStatus`, `useName`, `useLastName`, `useBirthDate`, `useSignature`, `useAvatar`, `useMail`, `idxGroup`) VALUES
(8, 'Potteratth', '1dc8a24e8695e329051af662c87285c6e3a26223', 1, 'Potterat', 'Thierry', '1987-11-18', '../upload/user/fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f/signature/a21ea3edd43d14752cb406e8073d7871e0db66cc.jpeg', '../upload/user/fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f/avatar/a04d1fa2cb44c646d740835be3fa55dbd5420dd3.jpeg', 'potterat.thierry@gmail.com', 1),
(42, 'f&euml;linya', '1dc8a24e8695e329051af662c87285c6e3a26223', 1, 'hime', 'f&euml;linya', NULL, '../upload/user/92cfceb39d57d914ed8b14d0e37643de0797ae56/signature/4dbeb5066d8ced236636e0406b0bed09422516e5.jpeg', '../upload/user/92cfceb39d57d914ed8b14d0e37643de0797ae56/avatar/e69dd3847de166e92e8bd2b1c9008860ba2aa0e1.jpeg', 'felinya@uroboros.com', 9),
(47, 'utilisateur1', '1dc8a24e8695e329051af662c87285c6e3a26223', 0, 'utilisateur', 'numero1', '1982-11-18', NULL, NULL, 'utilisateur@numero1.ch', 4);

-- --------------------------------------------------------

--
-- Structure de la table `usergroup`
--

CREATE TABLE `usergroup` (
  `idGroup` int(11) NOT NULL,
  `groName` varchar(30) NOT NULL,
  `groPermission` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `usergroup`
--

INSERT INTO `usergroup` (`idGroup`, `groName`, `groPermission`) VALUES
(1, 'admin', 8191),
(4, 'all', 1),
(8, 'membre', 83),
(9, 'modérateur', 119);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `belong`
--
ALTER TABLE `belong`
  ADD KEY `idxCustomer` (`idxCustomer`,`idxNationality`,`idxOrigin`,`idxHome`);

--
-- Index pour la table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`idBusiness`);

--
-- Index pour la table `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`idCanton`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`idCountry`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD UNIQUE KEY `idCustomer` (`idCustomer`),
  ADD KEY `idxLocality` (`idxLocality`,`idxStatus`),
  ADD KEY `idxStatus` (`idxStatus`),
  ADD KEY `idxLangue` (`idxLanguage`),
  ADD KEY `idxJob` (`idxJob`),
  ADD KEY `idxRubric` (`idxRubric`),
  ADD KEY `idxBusiness` (`idxBusiness`);

--
-- Index pour la table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`idJob`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`idLanguage`);

--
-- Index pour la table `locality`
--
ALTER TABLE `locality`
  ADD PRIMARY KEY (`idLocality`),
  ADD KEY `idxCanton` (`idxCanton`);

--
-- Index pour la table `rubric`
--
ALTER TABLE `rubric`
  ADD PRIMARY KEY (`idRubric`),
  ADD UNIQUE KEY `idRubric` (`idRubric`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD KEY `id` (`idUser`),
  ADD KEY `userGroup` (`idxGroup`);

--
-- Index pour la table `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`idGroup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `business`
--
ALTER TABLE `business`
  MODIFY `idBusiness` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du type d''entreprise', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `canton`
--
ALTER TABLE `canton`
  MODIFY `idCanton` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id du canton', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `idCountry` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du pays', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du client', AUTO_INCREMENT=691;
--
-- AUTO_INCREMENT pour la table `job`
--
ALTER TABLE `job`
  MODIFY `idJob` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `idLanguage` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la langue', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `locality`
--
ALTER TABLE `locality`
  MODIFY `idLocality` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la localité', AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `rubric`
--
ALTER TABLE `rubric`
  MODIFY `idRubric` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la rubrique', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du status', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `locality`
--
ALTER TABLE `locality`
  ADD CONSTRAINT `locality_ibfk_1` FOREIGN KEY (`idxCanton`) REFERENCES `canton` (`idCanton`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
