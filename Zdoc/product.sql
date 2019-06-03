-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 03 Juin 2019 à 10:48
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
-- Contenu de la table `product`
--
INSERT INTO `category` (`id`,`name`, `created_at`, `updated_at`) VALUES
(NULL,'Entrée', '2019-05-29 15:05:45', '2019-05-29 15:05:45'),

INSERT INTO `product` (`id`, `category_id`, `name`, `measure`, `created_at`, `updated_at`) VALUES 
(NULL, '61', 'feuille de brick', 'pièce(s)', '2019-06-20 03:26:31', '2019-06-03 04:37:24');