-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 27 sep. 2020 à 15:47
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id14535770_local_epicporn`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`id14535770_root`@`%` PROCEDURE `SelectConfirmedUsers` ()  SELECT *
FROM epic_users
WHERE confirmed = 1$$

CREATE DEFINER=`id14535770_root`@`%` PROCEDURE `SelectPremiumUsers` ()  SELECT *
FROM epic_users
WHERE premium > CURRENT_DATE$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `mail`, `rank`) VALUES
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'null', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Threesome'),
(2, 'BBC'),
(3, 'Autres'),
(4, 'Fellation'),
(10, 'Group Sex'),
(6, 'Gros Seins'),
(7, 'Petit Seins'),
(8, 'Anal'),
(9, 'College'),
(11, 'Gangbang'),
(12, 'Amateur'),
(13, 'Milf'),
(14, 'Plage'),
(15, 'Asians'),
(16, 'Teens'),
(17, 'Thai'),
(18, 'BBW'),
(19, 'Solo'),
(20, 'Couple'),
(21, 'Compilation'),
(22, 'Exhibition'),
(23, 'Publique');

-- --------------------------------------------------------

--
-- Structure de la table `coms`
--

CREATE TABLE `coms` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `epic_users`
--

CREATE TABLE `epic_users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `premium` date DEFAULT NULL,
  `proposer` int(11) DEFAULT NULL,
  `confirmed` int(11) NOT NULL,
  `dateRegistred` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `epic_users`
--

INSERT INTO `epic_users` (`id`, `username`, `password`, `mail`, `premium`, `proposer`, `confirmed`, `dateRegistred`) VALUES
(24, 'user2', 'd41d8cd98f00b204e9800998ecf8427e', 'null', '2020-08-29', NULL, 0, '2020-07-15'),
(23, 'user', 'd41d8cd98f00b204e9800998ecf8427e', 'null', NULL, NULL, 0, '2020-07-15'),
(25, 'user3', 'd41d8cd98f00b204e9800998ecf8427e', 'null', NULL, 23, 1, '2020-07-15');

-- --------------------------------------------------------

--
-- Structure de la table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `rank_name` text NOT NULL,
  `rank_right` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ranks`
--

INSERT INTO `ranks` (`id`, `rank_name`, `rank_right`) VALUES
(1, 'Administrator', '3033333');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `embed` text NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `status` text NOT NULL,
  `url_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `title`, `embed`, `date`, `author`, `status`, `url_name`) VALUES
(64, 'Cum For Scarlet And Kim - Kim Anh, Scarlet Andrews, And Juan Largo - 60PlusMilfs ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16546179/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:31:48', 1, 'published', ''),
(66, 'junior college girl couple baise sur cam ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/6483280/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:33:26', 1, 'published', ''),
(67, 'Cheryl Blossom: The Rating Game - ScoreLand ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15874707/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:34:06', 1, 'published', ''),
(68, 'Une double bite pour une brune aux gros seins - PornMegaLoad', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15866556/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:34:42', 1, 'published', ''),
(69, 'Doubler son plaisir - XLGirls', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15882510/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:35:17', 1, 'published', ''),
(65, 'Anissa Jolie et Danny D dans Chock-Full Of Cock - BrazzersNetwork ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/6309718/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:33:00', 1, 'published', ''),
(74, 'Nila Mason\'s Big-boob Sex Studies - PornMegaLoad', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15867120/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:52:24', 1, 'published', ''),
(73, 'Lilly, 19ans va se faire defoncer', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16566373/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:47:47', 1, 'published', ''),
(75, 'German Erotic Exhibitionism M12', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16482777/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:54:38', 1, 'published', ''),
(76, 'I haven\'t a clue as to what the hell they are saying so don\'t ask me', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16460689/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:55:01', 1, 'published', ''),
(77, 'Nacho Vidal baise une adolescente de 18 ans déguisée en écolière', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15884934/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 19:28:50', 1, 'published', ''),
(87, 'Mature Whore', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/1934989/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-11 14:29:42', 1, 'published', '');

-- --------------------------------------------------------

--
-- Structure de la table `videos_meta`
--

CREATE TABLE `videos_meta` (
  `meta_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `videos_meta`
--

INSERT INTO `videos_meta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(187, 75, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/16482000/16482777/288x162/1.jpg'),
(186, 75, 'category', '23'),
(185, 75, 'category', '22'),
(184, 75, 'category', '19'),
(183, 74, 'views', '1'),
(182, 74, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15867000/15867120/288x162/1.jpg'),
(181, 74, 'category', '6'),
(180, 73, 'views', '4'),
(179, 73, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/16566000/16566373/288x162/1.jpg'),
(178, 73, 'category', '13'),
(166, 69, 'views', '2'),
(165, 69, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15882000/15882510/288x162/1.jpg'),
(164, 69, 'category', '13'),
(163, 69, 'category', '1'),
(162, 69, 'category', '6'),
(161, 69, 'category', '18'),
(160, 68, 'views', '35'),
(159, 68, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15866000/15866556/288x162/1.jpg'),
(158, 68, 'category', '13'),
(157, 68, 'category', '6'),
(156, 68, 'category', '1'),
(155, 67, 'views', '8'),
(153, 67, 'category', '13'),
(154, 67, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15874000/15874707/288x162/1.jpg'),
(152, 67, 'category', '19'),
(150, 66, 'views', '8'),
(151, 67, 'category', '18'),
(149, 66, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/6483000/6483280/288x162/1.jpg'),
(148, 66, 'category', '16'),
(147, 66, 'category', '12'),
(146, 65, 'views', '0'),
(142, 64, 'views', '0'),
(143, 65, 'category', '6'),
(144, 65, 'category', '13'),
(145, 65, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/6309000/6309718/288x162/1.jpg'),
(141, 64, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/16546000/16546179/288x162/1.jpg'),
(249, 64, 'category', '13'),
(248, 64, 'category', '6'),
(188, 75, 'views', '20'),
(189, 76, 'category', '2'),
(190, 76, 'category', '8'),
(191, 76, 'category', '4'),
(192, 76, 'category', '16'),
(193, 76, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/16460000/16460689/288x162/1.jpg'),
(194, 76, 'views', '20'),
(195, 77, 'category', '16'),
(196, 77, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15884000/15884934/288x162/1.jpg'),
(197, 77, 'views', '20'),
(247, 64, 'category', '15'),
(241, 87, 'views', '11'),
(240, 87, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/1934000/1934989/288x162/1.jpg'),
(239, 87, 'category', '13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coms`
--
ALTER TABLE `coms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `epic_users`
--
ALTER TABLE `epic_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `videos_meta`
--
ALTER TABLE `videos_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `coms`
--
ALTER TABLE `coms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `epic_users`
--
ALTER TABLE `epic_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `videos_meta`
--
ALTER TABLE `videos_meta`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
