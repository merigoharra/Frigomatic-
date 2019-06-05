-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 05 Juin 2019 à 12:18
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.2.17-1+ubuntu16.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `frigomatic`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `weight` smallint(6) DEFAULT NULL,
  `height` smallint(6) DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `app_users`
--

INSERT INTO `app_users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `age`, `weight`, `height`, `gender`, `avatar`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$13$KT.4GPcmT/YQflL6QVLvu.Vg2uxTq/xlKyIJ2iWviUvTN12nG9FHq', 'OH grand maître', 'admin', 'admin@admin.fr', 25, NULL, NULL, NULL, 'http://lorempixel.com/output/food-q-c-64-64-4.jpg', 1, '2019-06-03 12:05:50', '2019-06-03 12:05:50'),
(2, 2, 'user', '$2y$13$pOs6IChHudV6yg/HPYI7rOAftOBEfYekSmlFoSDissjwCYNqQ86xC', 'Simple utilisateur', 'user', 'user@user.fr', 45, NULL, NULL, NULL, 'http://lorempixel.com/output/food-q-c-64-64-4.jpg', 1, '2019-06-03 12:05:51', '2019-06-03 12:05:51'),
(3, 3, 'moderator', '$2y$13$X/dWPewhxgFFw9Ij9TG0Eev8D9vmuQF9lpVawU.0X8bjB01kCvnHy', 'Sous chef de grade moderateur', 'moderator', 'moderator@moderator.fr', 58, NULL, NULL, NULL, 'http://lorempixel.com/output/food-q-c-64-64-4.jpg', 1, '2019-06-03 12:05:51', '2019-06-03 12:05:51');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fruit et légume', '2019-06-03 12:07:00', '2019-06-03 12:07:00'),
(4, 'Boisson', '2019-06-03 12:10:00', '2019-06-03 12:10:00'),
(5, 'Céréale et féculent', '2019-06-03 12:10:00', '2019-06-03 12:10:00'),
(6, 'Produit laitier', '2019-06-03 12:10:00', '2019-06-03 12:10:00'),
(7, 'Viande, poisson, œuf', '2019-06-03 12:10:00', '2019-06-03 12:10:00'),
(8, 'Matière grasse', '2019-06-03 12:11:00', '2019-06-03 12:11:00'),
(9, 'Sucre', '2019-06-03 12:11:00', '2019-06-03 12:11:00'),
(10, 'Épice / herbes', '2019-06-05 10:29:00', '2019-06-05 10:29:00');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190603100428', '2019-06-03 10:04:40'),
('20190604100712', '2019-06-04 10:07:28');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `measure`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abricot', 'gr', '2019-06-03 12:12:00', '2019-06-03 12:12:00'),
(2, 1, 'Ananas', 'gr', '2019-06-03 12:13:00', '2019-06-03 12:13:00'),
(3, 1, 'Artichaut', 'pièce', '2019-06-03 12:14:00', '2019-06-03 12:14:00'),
(4, 1, 'Asperge', 'gr', '2019-06-03 12:14:00', '2019-06-03 12:14:00'),
(5, 1, 'Aubergine', 'pièce', '2019-06-03 12:14:00', '2019-06-03 12:14:00'),
(6, 1, 'Avocat', 'pièce', '2019-06-03 12:14:00', '2019-06-03 12:14:00'),
(7, 1, 'Bettrave', 'gr', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(8, 1, 'Brocolli', 'gr', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(9, 1, 'Blette', 'gr', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(10, 1, 'Carotte', 'gr', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(11, 1, 'Champignon', 'gr', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(12, 1, 'Choux-fleur', 'pièce', '2019-06-03 12:15:00', '2019-06-03 12:15:00'),
(13, 1, 'Citron', 'pièce', '2019-06-03 12:16:00', '2019-06-03 12:16:00'),
(14, 1, 'Ctrouille', 'pièce', '2019-06-03 12:16:00', '2019-06-03 12:16:00'),
(15, 1, 'Clementine', 'pièce', '2019-06-03 12:16:00', '2019-06-03 12:16:00'),
(16, 1, 'concombre', 'pièce', '2019-06-03 12:16:00', '2019-06-03 12:16:00'),
(17, 1, 'courgette', 'pièce', '2019-06-03 12:16:00', '2019-06-03 12:16:00'),
(18, 1, 'Endive', 'pièce', '2019-06-03 12:17:00', '2019-06-03 12:17:00'),
(19, 1, 'Epinard', 'gr', '2019-06-03 12:18:00', '2019-06-03 12:18:00'),
(20, 1, 'Feunouille', 'gr', '2019-06-03 12:18:00', '2019-06-03 12:18:00'),
(21, 1, 'Figue', 'gr', '2019-06-03 12:18:00', '2019-06-03 12:18:00'),
(22, 1, 'Fraise', 'gr', '2019-06-03 12:18:00', '2019-06-03 12:18:00'),
(23, 1, 'Framboise', 'gr', '2019-06-03 12:18:00', '2019-06-03 12:18:00'),
(24, 1, 'Haricot vert', 'gr', '2019-06-03 12:19:00', '2019-06-03 12:19:00'),
(25, 1, 'Kiwi', 'pièce', '2019-06-03 12:19:00', '2019-06-03 12:19:00'),
(26, 1, 'laitue', 'pièce', '2019-06-03 12:19:00', '2019-06-03 12:19:00'),
(27, 1, 'mache', 'pièce', '2019-06-03 12:19:00', '2019-06-03 12:19:00'),
(28, 1, 'melon', 'pièce', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(29, 1, 'mure', 'gr', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(30, 1, 'oignon', 'pièce', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(31, 1, 'poireau', 'pièce', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(32, 1, 'pomme', 'gr', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(33, 1, 'pamplemouse', 'pièce', '2019-06-03 12:20:00', '2019-06-03 12:20:00'),
(34, 1, 'prune', 'gr', '2019-06-03 12:21:00', '2019-06-03 12:21:00'),
(35, 1, 'Radis', 'gr', '2019-06-03 12:21:00', '2019-06-03 12:21:00'),
(36, 1, 'Tomate', 'gr', '2019-06-03 12:21:00', '2019-06-03 12:21:00'),
(37, 1, 'Banane', 'pièce', '2019-06-03 12:21:00', '2019-06-03 12:21:00'),
(38, 5, 'Avoine', 'gr', '2019-06-03 12:22:00', '2019-06-03 12:22:00'),
(39, 5, 'blé', 'gr', '2019-06-03 12:22:00', '2019-06-03 12:22:00'),
(40, 5, 'Farine', 'gr', '2019-06-03 12:22:00', '2019-06-03 12:22:00'),
(41, 5, 'Haricot', 'gr', '2019-06-03 12:22:00', '2019-06-03 12:22:00'),
(42, 5, 'lentille', 'gr', '2019-06-03 12:22:00', '2019-06-03 12:22:00'),
(43, 5, 'Fève', 'gr', '2019-06-03 12:23:00', '2019-06-03 12:23:00'),
(44, 5, 'Maïs', 'gr', '2019-06-03 12:24:00', '2019-06-03 12:24:00'),
(45, 5, 'Pain', 'gr', '2019-06-03 12:24:00', '2019-06-03 12:24:00'),
(46, 5, 'patate douce', 'gr', '2019-06-03 12:25:00', '2019-06-03 12:25:00'),
(47, 5, 'Pâte', 'gr', '2019-06-03 12:25:00', '2019-06-03 12:25:00'),
(48, 5, 'Poids cassées', 'gr', '2019-06-03 12:25:00', '2019-06-03 12:25:00'),
(49, 5, 'Poids chiche', 'gr', '2019-06-03 12:26:00', '2019-06-03 12:26:00'),
(50, 5, 'Polenta', 'gr', '2019-06-03 12:26:00', '2019-06-03 12:26:00'),
(51, 5, 'Pomme de terre', 'gr', '2019-06-03 12:26:00', '2019-06-03 12:26:00'),
(52, 5, 'Quinoa', 'gr', '2019-06-03 12:26:00', '2019-06-03 12:26:00'),
(53, 5, 'Topinambour', 'gr', '2019-06-03 12:27:00', '2019-06-03 12:27:00'),
(54, 5, 'Riz', 'gr', '2019-06-03 12:27:00', '2019-06-03 12:27:00'),
(55, 6, 'Buchette de chèvre', 'gr', '2019-06-03 12:27:00', '2019-06-03 12:27:00'),
(56, 6, 'Camembert', 'gr', '2019-06-03 12:28:00', '2019-06-03 12:28:00'),
(57, 6, 'Cheddar', 'gr', '2019-06-03 12:28:00', '2019-06-03 12:28:00'),
(58, 6, 'Chèvre', 'gr', '2019-06-03 12:28:00', '2019-06-03 12:28:00'),
(59, 6, 'Comté', 'gr', '2019-06-03 12:28:00', '2019-06-03 12:28:00'),
(60, 6, 'Emmental', 'gr', '2019-06-03 12:29:00', '2019-06-03 12:29:00'),
(61, 6, 'feta', 'gr', '2019-06-03 12:29:00', '2019-06-03 12:29:00'),
(62, 6, 'Fromage Blanc', 'gr', '2019-06-03 12:29:00', '2019-06-03 12:29:00'),
(63, 6, 'Fromage persillé', 'gr', '2019-06-03 12:29:00', '2019-06-03 12:29:00'),
(64, 6, 'Gruyère', 'gr', '2019-06-03 12:30:00', '2019-06-03 12:30:00'),
(65, 6, 'Lait', 'ml', '2019-06-03 12:30:00', '2019-06-03 12:30:00'),
(66, 6, 'Maroille', 'gr', '2019-06-03 12:30:00', '2019-06-03 12:30:00'),
(67, 6, 'mascarpone', 'gr', '2019-06-03 12:30:00', '2019-06-03 12:30:00'),
(68, 6, 'Mozzarella', 'gr', '2019-06-03 12:31:00', '2019-06-03 12:31:00'),
(69, 6, 'Parmesan', 'gr', '2019-06-03 12:31:00', '2019-06-03 12:31:00'),
(70, 6, 'Reblochon', 'gr', '2019-06-03 12:31:00', '2019-06-03 12:31:00'),
(71, 6, 'Ricotta', 'gr', '2019-06-03 12:31:00', '2019-06-03 12:31:00'),
(72, 6, 'Roquefort', 'gr', '2019-06-03 12:31:00', '2019-06-03 12:31:00'),
(73, 6, 'Yaourt', 'gr', '2019-06-03 12:32:00', '2019-06-03 12:32:00'),
(74, 6, 'Yaourt', 'gr', '2019-06-03 12:32:00', '2019-06-03 12:32:00'),
(75, 7, 'Abats', 'gr', '2019-06-03 12:32:00', '2019-06-03 12:32:00'),
(76, 7, 'Anchois', 'pièces', '2019-06-03 12:33:00', '2019-06-03 12:33:00'),
(77, 7, 'Boeuf', 'gr', '2019-06-03 12:33:00', '2019-06-03 12:33:00'),
(78, 7, 'Cabillaud', 'pièces', '2019-06-03 12:33:00', '2019-06-03 12:33:00'),
(79, 7, 'caille', 'pièces', '2019-06-03 12:33:00', '2019-06-03 12:33:00'),
(80, 7, 'Canard', 'gr', '2019-06-03 12:35:00', '2019-06-03 12:35:00'),
(81, 7, 'cheval', 'gr', '2019-06-03 12:35:00', '2019-06-03 12:35:00'),
(82, 7, 'Chorizo', 'gr', '2019-06-03 12:35:00', '2019-06-03 12:35:00'),
(83, 7, 'Crabe', 'gr', '2019-06-03 12:35:00', '2019-06-03 12:35:00'),
(84, 7, 'crevette', 'gr', '2019-06-03 12:35:00', '2019-06-03 12:35:00'),
(85, 7, 'Dinde', 'gr', '2019-06-03 12:36:00', '2019-06-03 12:36:00'),
(86, 7, 'Foie gras', 'gr', '2019-06-03 12:36:00', '2019-06-03 12:36:00'),
(87, 7, 'Fruit de mer', 'gr', '2019-06-03 12:36:00', '2019-06-03 12:36:00'),
(88, 7, 'Gibiers', 'gr', '2019-06-03 12:36:00', '2019-06-03 12:36:00'),
(89, 7, 'Huitre', 'pièce', '2019-06-03 12:36:00', '2019-06-03 12:36:00'),
(90, 7, 'lard', 'gr', '2019-06-03 12:37:00', '2019-06-03 12:37:00'),
(91, 7, 'poisson', 'gr', '2019-06-03 12:37:00', '2019-06-03 12:37:00'),
(92, 7, 'moule', 'de', '2019-06-03 12:38:00', '2019-06-03 12:38:00'),
(93, 7, 'Mouton', 'gr', '2019-06-03 12:38:00', '2019-06-03 12:38:00'),
(94, 7, 'porc', 'gr', '2019-06-03 12:38:00', '2019-06-03 12:38:00'),
(95, 7, 'pole', 'gr', '2019-06-03 12:38:00', '2019-06-03 12:38:00'),
(96, 7, 'Poulet', 'gr', '2019-06-03 12:38:00', '2019-06-03 12:38:00'),
(97, 7, 'sardine', 'gr', '2019-06-03 12:39:00', '2019-06-03 12:39:00'),
(98, 7, 'saucisse', 'gr', '2019-06-03 12:39:00', '2019-06-03 12:39:00'),
(99, 7, 'thon', 'gr', '2019-06-03 12:39:00', '2019-06-03 12:39:00'),
(100, 7, 'veau', 'gr', '2019-06-03 12:39:00', '2019-06-03 12:39:00'),
(101, 7, 'Viande blanche', 'gr', '2019-06-03 12:39:00', '2019-06-03 12:39:00'),
(102, 7, 'Viande rouge', 'gr', '2019-06-03 12:40:00', '2019-06-03 12:40:00'),
(103, 7, 'Volailles', 'gr', '2019-06-03 12:40:00', '2019-06-03 12:40:00'),
(104, 7, 'Oeuf', 'gr', '2019-06-03 12:40:00', '2019-06-03 12:40:00'),
(105, 8, 'Beurre', 'gr', '2019-06-03 12:41:00', '2019-06-03 12:41:00'),
(106, 8, 'beurre de cacahuète', 'gr', '2019-06-03 12:41:00', '2019-06-03 12:41:00'),
(107, 6, 'Crème fraiche', 'gr', '2019-06-03 12:41:00', '2019-06-03 12:41:00'),
(108, 8, 'Huile d\'olive', 'ml', '2019-06-03 12:41:00', '2019-06-03 12:41:00'),
(109, 8, 'huile', 'ml', '2019-06-03 12:42:00', '2019-06-03 12:42:00'),
(110, 8, 'Lait de coco', 'ml', '2019-06-03 12:42:00', '2019-06-03 12:42:00'),
(111, 8, 'margarine', 'gr', '2019-06-03 12:42:00', '2019-06-03 12:42:00'),
(112, 8, 'Saindoux', 'gr', '2019-06-03 12:42:00', '2019-06-03 12:42:00'),
(113, 9, 'Bonbons', 'gr', '2019-06-03 12:43:00', '2019-06-03 12:43:00'),
(114, 9, 'sucre candi', 'gr', '2019-06-03 12:43:00', '2019-06-03 12:43:00'),
(115, 9, 'sucre de canne', 'gr', '2019-06-03 12:44:00', '2019-06-03 12:44:00'),
(116, 9, 'cassonade', 'gr', '2019-06-03 12:44:00', '2019-06-03 12:44:00'),
(117, 9, 'Chocolat', 'gr', '2019-06-03 12:44:00', '2019-06-03 12:44:00'),
(118, 9, 'Miel', 'gr', '2019-06-03 12:44:00', '2019-06-03 12:44:00'),
(119, 9, 'Sirop d\'érable', 'ml', '2019-06-03 12:45:00', '2019-06-03 12:45:00'),
(120, 9, 'Sucre blanc', 'gr', '2019-06-03 12:45:00', '2019-06-03 12:45:00'),
(121, 9, 'sucre glace', 'gr', '2019-06-03 12:45:00', '2019-06-03 12:45:00'),
(122, 9, 'vergoise', 'gr', '2019-06-03 12:45:00', '2019-06-03 12:45:00'),
(123, 4, 'Alcool', 'ml', '2019-06-03 12:46:00', '2019-06-03 12:46:00'),
(124, 4, 'Bière', 'ml', '2019-06-03 12:46:00', '2019-06-03 12:46:00'),
(125, 4, 'Champagne', 'ml', '2019-06-03 12:46:00', '2019-06-03 12:46:00'),
(126, 4, 'Cidre', 'ml', '2019-06-03 12:47:00', '2019-06-03 12:47:00'),
(127, 4, 'Eau', 'ml', '2019-06-03 12:47:00', '2019-06-03 12:47:00'),
(128, 4, 'lait d\'amande', 'ml', '2019-06-03 12:47:00', '2019-06-03 12:47:00'),
(129, 4, 'Lait végétal', 'ml', '2019-06-03 12:47:00', '2019-06-03 12:47:00'),
(130, 4, 'Rhum', 'ml', '2019-06-03 12:47:00', '2019-06-03 12:47:00'),
(131, 4, 'vin blanc', 'ml', '2019-06-03 12:48:00', '2019-06-03 12:48:00'),
(132, 4, 'Vin rouge', 'ml', '2019-06-03 12:48:00', '2019-06-03 12:48:00'),
(133, 5, 'Pâte feuilletée', 'pièce', '2019-06-03 13:44:00', '2019-06-03 13:44:00'),
(134, 5, 'pâte sablée', 'pièce(s)', '2019-06-05 10:22:00', '2019-06-05 10:22:00'),
(135, 1, 'poudre d\'amande', 'gramme(s)', '2019-06-05 10:24:00', '2019-06-05 10:24:00'),
(138, 1, 'pâte de pistache', 'c à s', '2019-06-05 10:27:00', '2019-06-05 10:27:00'),
(139, 1, 'Potimarron', 'gr', '2019-06-05 10:28:00', '2019-06-05 10:28:00'),
(140, 1, 'pistache non salées', 'gramme(s)', '2019-06-05 10:28:00', '2019-06-05 10:28:00'),
(141, 10, 'Sel', 'gr', '2019-06-05 10:30:00', '2019-06-05 10:30:00'),
(142, 10, 'Poivre', 'gr', '2019-06-05 10:30:00', '2019-06-05 10:30:00'),
(143, 10, 'Ail', 'gr', '2019-06-05 10:30:00', '2019-06-05 10:30:00'),
(144, 10, 'Corriandre', 'gr', '2019-06-05 10:31:00', '2019-06-05 10:31:00'),
(145, 10, 'Persil', 'gr', '2019-06-05 10:31:00', '2019-06-05 10:31:00'),
(146, 10, 'Piment', 'gr', '2019-06-05 10:31:00', '2019-06-05 10:31:00'),
(147, 1, 'Basilic', 'gr', '2019-06-05 10:31:00', '2019-06-05 10:31:00'),
(148, 10, 'Curry', 'gr', '2019-06-05 10:32:00', '2019-06-05 10:32:00'),
(149, 7, 'Tofu', 'gr', '2019-06-05 10:40:00', '2019-06-05 10:40:00');

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people` smallint(6) NOT NULL,
  `level` smallint(6) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_duration` smallint(6) NOT NULL,
  `prep_duration` smallint(6) NOT NULL,
  `baking_duration` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `recipe`
--

INSERT INTO `recipe` (`id`, `user_id`, `name`, `people`, `level`, `image`, `total_duration`, `prep_duration`, `baking_duration`, `created_at`, `updated_at`, `content`, `slug`) VALUES
(1, 1, 'Tarte à la tomate et au chèvre', 4, 1, 'https://static.750g.com/images/auto-427/2b7c59b8ff62b6c0a826f899e640ab4d/tartechevre.jpeg', 55, 15, 40, '2019-06-03 13:45:00', '2019-06-03 13:45:00', 'ÉTAPE 1 :\r\nEtalez votre pâte dans un moule. Mettez de la moutarde sur le fond de pâte.\r\n\r\nÉTAPE 2 :\r\nCoupez les tomates en fines rondelles, le chèvre aussi. Alternez 3 tranches de tomate et 1 tranche de chèvre en formant une rosace. Salez, poivrez et saupoudrez d\'herbe de Provence.\r\n\r\nÉTAPE 3 :\r\nBattez les 3 oeufs en omelette et versez-les dessus.\r\n\r\nÉTAPE 4 :\r\nPréchauffez votre four Th.6 (180°C).\r\n\r\nÉTAPE 5 :\r\nEnfournez votre tarte à Th.5 pendant 40 minutes environ. A la sortie du four, déposez quelques feuilles de basilic fraîche et bon appétit.', 'tarte-a-la-tomate-et-au-chevre'),
(2, 1, 'Tortilla de patatas ou Omelette aux pommes de terre', 4, 1, 'https://es.rc-cdn.community.thermomix.com/recipeimage/flz0tm0r-a2069-162740-cfcd2-zlr8kinc/733f35bb-e440-4c4f-9b87-949a0e20e384/main/tortilla-de-patatas-con-cebolla.jpg', 50, 15, 35, '2019-06-05 10:09:00', '2019-06-05 10:09:00', 'ÉTAPE 1 :\r\nÉpluchez puis lavez vos pommes de terre. Coupez-les en cubes d’environ 1 cm de côté. Sans les rincer, faites les rissoler dans un fond d’huile assez généreux. Faites-les d’abord saisir, salez, poivrez puis couvrez. Laissez cuire environ 15 à 20 minutes, jusqu’à une cuisson à cœur.\r\n\r\n\r\nÉTAPE 2 :\r\nPendant ce temps, battez vos œufs en omelette, salez/poivrez. Séparez votre fond d’huile et vos pommes de terre une fois rissolées, réservez votre fond d’huile car il va vous resservir. Mettez vos pommes de terre dans un cul de poule puis écrasez-les grossièrement à la fourchette.\r\n\r\n\r\nÉTAPE 3 :\r\nVersez vos œufs dessus, mélangez et versez la préparation dans votre restant d’huile que vous aurez remis à chauffer. Choisissez le diamètre de votre poêle afin d’obtenir une bonne épaisseur de la tortilla, environ 3 centimètres. Faites cuire d’abord sur une face puis sur la seconde face.\r\n\r\nLa seule difficulté de cette recette consiste à retourner votre tortilla pour la faire cuire sur les deux faces. L\'idéal est de vous servir d\'un grand couvercle huilé.\r\n\r\nLa bonne cuisson est obtenue quand l’œuf a pris, sans coloration excessive des faces et avec un cœur cuit mais sans être sec. Servez avec une salade.', 'tortilla-de-patatas-ou-omelette-aux-pommes-de-terre'),
(3, 1, 'Tartines avocat, roquette, tomate et œuf mollet', 4, 1, 'https://static.750g.com/images/622-auto/dc404ec1af4a90637f20711851570836/toast.jpg', 5, 5, 0, '2019-06-05 10:24:00', '2019-06-05 10:24:00', 'ÉTAPE 1 :\r\nPlonger les oeufs dans une eau bouillante et laisser cuire 5 minutes dès reprise de l\'ébullition. Retirer les oeufs de l\'eau avec une écumoire et plonger dans un saladier d\'eau froide voire glacée.\r\n\r\nÉTAPE 2 :\r\nCouper l\'avocat en deux, retirer le noyau. Découper les deux moitiés d\'avocat en fines tranches. Couper les tomates en rondelles, la moitié de la feta en petits cubes et l\'autre émiettée. \r\n\r\nÉTAPE 3 :\r\nDéposer quelques lamelles d\'avocat sur les tranches de pain, ajouter un peu de feta émiettée, les tomates cerise coupées en rondelles, un peu de roquette. Écailler les oeufs et en déposer un par tartine. Saler, poivrer et servir.', 'tartines-avocat-roquette-tomate-et-œuf-mollet'),
(4, 1, 'Tomates farcies', 3, 1, 'https://assets.afcdn.com/recipe/20171012/73069_w420h344c1cx1944cy1292cxt0cyt0cxb3888cyb2585.jpg', 80, 20, 60, '2019-06-05 10:25:00', '2019-06-05 10:25:00', 'Etape 1\r\nEplucher et hacher les oignons. Eplucher et hacher les gousses d\'ail.\r\nEtape 2\r\nMettre la moitié des oignons dans la chair à saucisse. Ajouter l\'ail, le sel, le poivre et un peu de persil.\r\nEtape 3\r\nCouper le haut des tomates et les évider. Poivrer et saler l\'intérieur. Mettre la farce à l\'intérieur et remettre les chapeaux.\r\nEtape 4\r\nMettre le reste des oignons dans un plat avec la chair des tomates.\r\nEtape 5\r\nMettre les tomates farcies dans le plat. Parsemez d\'un peu de thym et mette une noisette de beurre sur chaque tomates. Faire cuire au four chaud à 180°C (thermostat 6) pendant 1 heure environ.\r\nEtape 6\r\nServir avec du riz.', 'Tomates-farcies'),
(5, 1, 'Tagliatelles aux crevettes', 4, 2, 'https://assets.afcdn.com/recipe/20190308/89021_w420h344c1cx2659cy1773cxt0cyt0cxb5319cyb3546.jpg', 40, 25, 15, '2019-06-05 10:30:00', '2019-06-05 10:30:00', 'Etape 1\r\nCuire les tagliatelles dans un grand volume d’eau salée 4 à 6 minutes selon la cuisson souhaitée.\r\nEtape 2\r\nLes égoutter, et les rincer à l’eau tiède quelques secondes pour enlever l’excédent d’amidon et les réserver au chaud.\r\nEtape 3\r\nÉplucher la courgette et la tailler en tagliatelles à l’aide d’un économe.\r\nEtape 4\r\nBlanchir 1 minute les tagliatelles de courgette dans de l’eau bouillante salée et les rafraîchir rapidement après la cuisson afin de la stopper.\r\nEtape 5\r\nCouper les tomates cerises en deux et mélanger dans un saladier avec les tagliatelles et les courgettes, ajouter sel, poivre et un trait d’huile d’olive.\r\nEtape 6\r\nDécongeler les crevettes 5 minutes sous l’eau courante, les égoutter puis les saler et poivrer.\r\nEtape 7\r\nMettre les zestes de citron dessus et les poêler rapidement environ 4 à 5 minutes puis déglacer avec le jus de citron, réserver.\r\nEtape 8\r\nÉmulsionner le bouillon de légumes avec le beurre et le mélanger avec le tout pour réchauffer.\r\nEtape 9\r\nDresser dans des assiettes creuses chaudes.', 'Tagliatelles-aux-crevettes'),
(6, 1, 'Tarte à la pistache et fraises', 6, 1, 'https://static.750g.com/images/auto-525/e876be0c3dfd286de09a84a59af70f7e/aop-igp-fraise-tarte-fraise-pistache-bd-web.jpg', 60, 30, 30, '2019-06-05 10:23:00', '2019-06-05 10:23:00', 'ÉTAPE 1 :\r\nPréchauffer le four à 180°C. Placer la pâte sablée dans un moule à tarte idéalement à fond amovible. Piquer le fond de pâte puis réservez au frais. \r\n\r\nÉTAPE 2 :\r\nDans un bol, mélanger le beurre mou avec les 100g de sucre et 3 c à s rase de pâte de pistache. Ajouter les œufs et la poudre d’amande en continuant de mélanger. Verser sur le fond de pâte, lisser le dessus et enfourner pour 30 minutes de cuisson. Sortir la tarte du four, laisser tiédir avant de démouler sur une grille puis laisser complètement refroidir. \r\n\r\nÉTAPE 3 :\r\nRincer rapidement les fraises sous l’eau, les équeuter et les couper en tranches épaisses. Mélanger le mascarpone avec les 40g de sucre glace et 1 c. à soupe de pâte de pistache. Étaler sur le dessus de la tarte puis piquer dedans les tranches de fraises. Parsemer de pistaches concassées et servir. \r\n\r\nÉTAPE 4 :\r\nPetit plus : Préparez votre pâte sablée en mélangeant dans un saladier (ou la cuve d’un robot) 100 g de beurre mou et 80g de sucre pour obtenir une crème. Incorporer 1 œuf puis 200g de farine et une pincée de sel et travailler rapidement pour avoir une pâte molle sans traces de beurre. Former une boule aplatie et laisser reposer au moins 30 minutes au réfrigérateur avant de l’étaler au rouleau sur un plan de travail fariné.', 'Tarte-à-la-pistache-et-fraise'),
(7, 1, 'Soupe de potimarron, oigon, quinoa et chorizo', 4, 2, 'https://static.750g.com/images/622-auto/f8f5e85ea993d9df811e913f1fc50caa/comment-realiser-une-soupe-de-potimarron.jpg', 45, 20, 25, '2019-06-05 10:33:00', '2019-06-05 10:33:00', 'ÉTAPE 1 :\r\nEpluchez l\'oignon et coupez-le en lamelles.\r\n\r\n\r\nÉTAPE 2 :\r\nLavez le potimarron et coupez-le en deux. Enlevez les pépins et détaillez la chair en cubes.\r\n\r\n\r\nÉTAPE 3 :\r\nDans un faitout, faites fondre l\'oignon avec l\'huile d\'olive pendant 5 minutes environ.\r\n\r\n\r\nÉTAPE 4 :\r\nAjoutez le potimarron.\r\n\r\n\r\nÉTAPE 5 :\r\nCouvrez d\'eau et salez. Faites cuire pendant 20 minutes environ jusqu\'à ce que la chair soit bien tendre.\r\nPendant ce temps, préparez le quinoa comme indiqué sur le paquet.\r\n\r\n\r\nÉTAPE 6 :\r\nQuand la soupe est cuite, passez-la au mixeur plongeant et rectifiez l\'assaisonnement si nécessaire.\r\n\r\n\r\nÉTAPE 7 :\r\nCoupez le chorizo en fines tranches.\r\n\r\n\r\nÉTAPE 8 :\r\nServez la soupe bien chaude, ajoutez-y une cuillère de quinoa et les tranches de chorizo. Régalez-vous !', 'soupe-de-potimarron-oignon-quinoa-et-chorizo'),
(8, 1, 'Poulet au curry', 3, 3, 'https://assets.afcdn.com/recipe/20100120/12710_w420h344c1cx256cy192.jpg', 40, 10, 30, '2019-06-05 10:36:00', '2019-06-05 10:36:00', 'Etape 1\r\nCoupez les blancs de poulet en dés.\r\nEtape 2\r\nFaites chauffer l\'huile dans une poêle et faites-y revenir l\'oignon, la gousse d\'ail et les dés de poulet. Ajoutez la chair de tomates, la pomme coupée en dés et la crème. Salez, poivrez, ajoutez le bouquet garni et le curry.\r\nEtape 3\r\nFaites cuire 20-25 min à feu très doux. Accompagnez de riz.\r\nEtape 4\r\nRecette pouvant être cuite au four à micro-ondes.\r\nEtape 5\r\nDans ce cas, cuire 2 min à 750 W, l\'oignon, la gousse d\'ail et le poulet. Salez, poivrez, ajoutez le bouquet garni et le curry.\r\nEtape 6\r\nFaites cuire 10-13 min à 750 W.', 'Poulet-au-curry'),
(9, 1, 'Lasagnes au tofu', 6, 2, 'https://assets.afcdn.com/recipe/20150312/26968_w420h344c1cx1250cy1875.jpg', 110, 60, 50, '2019-06-05 10:41:00', '2019-06-05 10:41:00', 'Etape 1\r\nFaites revenir dans une poêle huilée les oignons et les champignons coupés en lamelles. Ajoutez les tomates pelées et copées en morceaux, le tofu émietté et l\'ail haché.\r\nEtape 2\r\nAjoutez les herbes de Provence, la muscade, la sauce de soja et le poivre. Laissez mijoter 20 minutes.\r\nEtape 3\r\nPréparez la sauce béchamel. Dans un plat à four rectangulaire huilé, disposez un fond de béchamel puis une couche de 3 lasages, recouvrez avec la moitié du mélange tofu + légumes et une couche de béchamel.\r\nEtape 4\r\nDisposez une deuxième couche de lasagnes, les reste du mélange tofu + légumes, les dernières lasagnes et recouvrir de béchamel. Parsemez de parmesan.\r\nEtape 5\r\nCuisez à four chaud 30 minutes (200°C/thermostat 6-7).', 'Lasagnes-au-tofu');

-- --------------------------------------------------------

--
-- Structure de la table `recipe_product`
--

CREATE TABLE `recipe_product` (
  `recipe_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `recipe_product`
--

INSERT INTO `recipe_product` (`recipe_id`, `product_id`) VALUES
(1, 36),
(1, 55),
(1, 104),
(1, 133),
(2, 26),
(2, 51),
(2, 104),
(2, 108),
(3, 6),
(3, 26),
(3, 36),
(3, 45),
(3, 61),
(3, 104),
(4, 30),
(4, 36),
(4, 105),
(5, 13),
(5, 17),
(5, 36),
(5, 47),
(5, 84),
(5, 105),
(5, 108),
(5, 141),
(5, 142),
(6, 22),
(6, 67),
(6, 104),
(6, 105),
(6, 120),
(6, 121),
(6, 134),
(6, 135),
(6, 138),
(6, 140),
(7, 30),
(7, 52),
(7, 82),
(7, 108),
(7, 139),
(7, 141),
(7, 142),
(8, 30),
(8, 32),
(8, 36),
(8, 96),
(8, 107),
(8, 108),
(8, 141),
(8, 142),
(8, 143),
(8, 145),
(8, 148),
(9, 11),
(9, 30),
(9, 36),
(9, 108),
(9, 141),
(9, 142),
(9, 143),
(9, 144),
(9, 149);

-- --------------------------------------------------------

--
-- Structure de la table `recipe_tag`
--

CREATE TABLE `recipe_tag` (
  `recipe_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `recipe_tag`
--

INSERT INTO `recipe_tag` (`recipe_id`, `tag_id`) VALUES
(1, 2),
(1, 6),
(1, 11),
(1, 12),
(2, 2),
(2, 11),
(2, 12),
(3, 1),
(3, 6),
(3, 11),
(3, 12),
(4, 2),
(5, 2),
(6, 3),
(7, 1),
(8, 2),
(9, 2),
(9, 6);

-- --------------------------------------------------------

--
-- Structure de la table `recipe_user`
--

CREATE TABLE `recipe_user` (
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `recipe_user`
--

INSERT INTO `recipe_user` (`recipe_id`, `user_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(7, 1),
(7, 2),
(7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `role`, `code`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ROLE_ADMIN', '2019-06-03 12:05:50', '2019-06-03 12:05:50'),
(2, 'user', 'ROLE_USER', '2019-06-03 12:05:50', '2019-06-03 12:05:50'),
(3, 'Moderator', 'ROLE_MODERATOR', '2019-06-03 12:05:50', '2019-06-03 12:05:50');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Entrée', '2019-06-03 13:32:00', '2019-06-03 13:32:00'),
(2, 'Plat', '2019-06-03 13:32:00', '2019-06-03 13:32:00'),
(3, 'Dessert', '2019-06-03 13:33:00', '2019-06-03 13:33:00'),
(4, 'Apéritif', '2019-06-03 13:33:00', '2019-06-03 13:33:00'),
(5, 'Accompagnement', '2019-06-03 13:33:00', '2019-06-03 13:33:00'),
(6, 'Végétarien', '2019-06-03 13:33:00', '2019-06-03 13:33:00'),
(7, 'Viande rouge', '2019-06-03 13:34:00', '2019-06-03 13:34:00'),
(8, 'Viande blanche', '2019-06-03 13:34:00', '2019-06-03 13:34:00'),
(9, 'Poisson', '2019-06-03 13:34:00', '2019-06-03 13:34:00'),
(10, 'Base', '2019-06-03 13:35:00', '2019-06-03 13:35:00'),
(11, 'Rapide', '2019-06-03 13:35:00', '2019-06-03 13:35:00'),
(12, 'Pas chère', '2019-06-03 13:35:00', '2019-06-03 13:35:00'),
(13, 'Authentique', '2019-06-03 13:35:00', '2019-06-03 13:35:00');

-- --------------------------------------------------------

--
-- Structure de la table `user_product`
--

CREATE TABLE `user_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user_product`
--

INSERT INTO `user_product` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 133, 1, '2019-06-03 14:34:00', '2019-06-03 14:34:00'),
(2, 1, 36, 10, '2019-06-03 14:34:00', '2019-06-03 14:34:00'),
(3, 1, 55, 1, '2019-06-03 14:34:00', '2019-06-03 14:34:00'),
(5, 1, 6, 1, '2019-06-03 15:02:48', '2019-06-03 15:02:48'),
(7, 1, 3, 2, '2019-06-03 15:03:36', '2019-06-03 15:03:36'),
(14, 1, 18, 1, '2019-06-03 20:46:00', '2019-06-03 20:46:00'),
(15, 1, 1, 3, '2019-06-04 10:32:52', '2019-06-04 10:32:52'),
(16, 1, 47, 1, '2019-06-04 10:39:40', '2019-06-04 10:39:40'),
(17, 1, 77, 1, '2019-06-05 11:02:01', '2019-06-05 11:02:01'),
(18, 1, 141, 1, '2019-06-05 11:02:27', '2019-06-05 11:02:27'),
(19, 1, 45, 1, '2019-06-05 11:54:42', '2019-06-05 11:54:42');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C2502824D60322AC` (`role_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Index pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DA88B137A76ED395` (`user_id`);

--
-- Index pour la table `recipe_product`
--
ALTER TABLE `recipe_product`
  ADD PRIMARY KEY (`recipe_id`,`product_id`),
  ADD KEY `IDX_9FAE0AED59D8A214` (`recipe_id`),
  ADD KEY `IDX_9FAE0AED4584665A` (`product_id`);

--
-- Index pour la table `recipe_tag`
--
ALTER TABLE `recipe_tag`
  ADD PRIMARY KEY (`recipe_id`,`tag_id`),
  ADD KEY `IDX_72DED3CF59D8A214` (`recipe_id`),
  ADD KEY `IDX_72DED3CFBAD26311` (`tag_id`);

--
-- Index pour la table `recipe_user`
--
ALTER TABLE `recipe_user`
  ADD PRIMARY KEY (`recipe_id`,`user_id`),
  ADD KEY `IDX_F2888C9659D8A214` (`recipe_id`),
  ADD KEY `IDX_F2888C96A76ED395` (`user_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B471AA7A76ED395` (`user_id`),
  ADD KEY `IDX_8B471AA74584665A` (`product_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT pour la table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `app_users`
--
ALTER TABLE `app_users`
  ADD CONSTRAINT `FK_C2502824D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `FK_DA88B137A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`);

--
-- Contraintes pour la table `recipe_product`
--
ALTER TABLE `recipe_product`
  ADD CONSTRAINT `FK_9FAE0AED4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9FAE0AED59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recipe_tag`
--
ALTER TABLE `recipe_tag`
  ADD CONSTRAINT `FK_72DED3CF59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_72DED3CFBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recipe_user`
--
ALTER TABLE `recipe_user`
  ADD CONSTRAINT `FK_F2888C9659D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F2888C96A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `FK_8B471AA74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_8B471AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
