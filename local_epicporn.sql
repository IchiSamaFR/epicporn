-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 août 2020 à 11:36
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `local_epicporn`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `mail`, `rank`) VALUES
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'null', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Threesome'),
(2, 'BBC'),
(3, 'Others'),
(4, 'Fellation'),
(10, 'Group Sex'),
(6, 'Gros Seins'),
(7, 'Petis Seins'),
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

DROP TABLE IF EXISTS `coms`;
CREATE TABLE IF NOT EXISTS `coms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `coms`
--

INSERT INTO `coms` (`id`, `id_author`, `id_video`, `content`, `date`) VALUES
(1, 22, 77, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-06-01 02:40:08'),
(2, 22, 69, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-07-16 00:00:00'),
(3, 22, 64, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-07-16 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `epic_users`
--

DROP TABLE IF EXISTS `epic_users`;
CREATE TABLE IF NOT EXISTS `epic_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `premium` date DEFAULT NULL,
  `proposer` int(11) DEFAULT NULL,
  `confirmed` int(11) NOT NULL,
  `dateRegistred` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `epic_users`
--

INSERT INTO `epic_users` (`id`, `username`, `password`, `mail`, `premium`, `proposer`, `confirmed`, `dateRegistred`) VALUES
(22, 'user', 'd41d8cd98f00b204e9800998ecf8427e', 'null', NULL, NULL, 0, '2020-07-15');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `embed` text NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `status` text NOT NULL,
  `url_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `title`, `embed`, `date`, `author`, `status`, `url_name`) VALUES
(64, 'Cum For Scarlet And Kim - Kim Anh, Scarlet Andrews, And Juan Largo - 60PlusMilfs ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16546179/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:31:48', 13, 'published', ''),
(66, 'junior college girl couple baise sur cam ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/6483280/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:33:26', 13, 'published', ''),
(67, 'Cheryl Blossom: The Rating Game - ScoreLand ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15874707/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:34:06', 13, 'published', ''),
(68, 'Une double bite pour une brune aux gros seins - PornMegaLoad', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15866556/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:34:42', 13, 'published', ''),
(69, 'Doubler son plaisir - XLGirls', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15882510/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:35:17', 13, 'published', ''),
(65, 'Anissa Jolie et Danny D dans Chock-Full Of Cock - BrazzersNetwork ', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/6309718/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:33:00', 13, 'published', ''),
(74, 'Nila Mason\'s Big-boob Sex Studies - PornMegaLoad', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15867120/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:52:24', 13, 'published', ''),
(73, 'Lilly, 19ans va se faire defoncer', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16566373/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:47:47', 13, 'published', ''),
(75, 'German Erotic Exhibitionism M12', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16482777/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:54:38', 13, 'published', ''),
(76, 'I haven\'t a clue as to what the hell they are saying so don\'t ask me', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/16460689/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 15:55:01', 13, 'published', ''),
(77, 'Nacho Vidal baise une adolescente de 18 ans déguisée en écolière', '<iframe width=\"426\" height=\"265\" src=\"https://txxx.com/embed/15884934/\" frameborder=\"0\" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>', '2020-08-02 19:28:50', 13, 'published', '');

-- --------------------------------------------------------

--
-- Structure de la table `videos_categories`
--

DROP TABLE IF EXISTS `videos_categories`;
CREATE TABLE IF NOT EXISTS `videos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `videos_meta`
--

DROP TABLE IF EXISTS `videos_meta`;
CREATE TABLE IF NOT EXISTS `videos_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`meta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

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
(166, 69, 'views', '0'),
(165, 69, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15882000/15882510/288x162/1.jpg'),
(164, 69, 'category', '13'),
(163, 69, 'category', '1'),
(162, 69, 'category', '6'),
(161, 69, 'category', '18'),
(160, 68, 'views', '32'),
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
(140, 64, 'category', '13'),
(138, 64, 'category', '15'),
(139, 64, 'category', '6'),
(188, 75, 'views', '10'),
(189, 76, 'category', '2'),
(190, 76, 'category', '8'),
(191, 76, 'category', '4'),
(192, 76, 'category', '16'),
(193, 76, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/16460000/16460689/288x162/1.jpg'),
(194, 76, 'views', '18'),
(195, 77, 'category', '16'),
(196, 77, 'thumbnail', 'https://cdn37804682.ahacdn.me/contents/videos_screenshots/15884000/15884934/288x162/1.jpg'),
(197, 77, 'views', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
