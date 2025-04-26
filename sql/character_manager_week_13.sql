/*
-----------------------------------------------------------------------------------------------
Name:       character_manager_week_13.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-04-26
Language:   SQL
System:     MySQL 8.2.12
Purpose:    Database backup generated using myphpadmin. RUN THIS FIRST before using the
character manager.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-04-26      Original Version
-----------------------------------------------------------------------------------------------
*/

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 11:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `character_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--
DROP DATABASE IF EXISTS `character_manager`;

CREATE DATABASE IF NOT EXISTS `character_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `character_manager`;
CREATE TABLE `abilities` (
  `Ability_ID` int(11) NOT NULL,
  `Ability_Name` varchar(12) NOT NULL,
  `Ability_Short` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`Ability_ID`, `Ability_Name`, `Ability_Short`) VALUES
(1, 'Strength', 'STR'),
(2, 'Dexterity', 'DEX'),
(3, 'Constitution', 'CON'),
(4, 'Intelligence', 'INT'),
(5, 'Wisdom', 'WIS'),
(6, 'Charisma', 'CHA');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `Character_ID` int(11) NOT NULL,
  `Character_Name` varchar(100) DEFAULT NULL,
  `Class_ID` int(11) NOT NULL DEFAULT 1,
  `Race_ID` int(11) NOT NULL DEFAULT 1,
  `Str_Base` int(11) DEFAULT 0,
  `Dex_Base` int(11) DEFAULT 0,
  `Con_Base` int(11) DEFAULT 0,
  `Int_Base` int(11) DEFAULT 0,
  `Wis_Base` int(11) DEFAULT 0,
  `Cha_Base` int(11) DEFAULT 0,
  `Acrob_Ranks` int(11) DEFAULT 0,
  `Acrob_Racial` int(11) DEFAULT 0,
  `Acrob_Feats` int(11) DEFAULT 0,
  `Acrob_Misc` int(11) DEFAULT 0,
  `Appra_Ranks` int(11) DEFAULT 0,
  `Appra_Racial` int(11) DEFAULT 0,
  `Appra_Feats` int(11) DEFAULT 0,
  `Appra_Misc` int(11) DEFAULT 0,
  `Bluff_Ranks` int(11) DEFAULT 0,
  `Bluff_Racial` int(11) DEFAULT 0,
  `Bluff_Feats` int(11) DEFAULT 0,
  `Bluff_Misc` int(11) DEFAULT 0,
  `Climb_Ranks` int(11) DEFAULT 0,
  `Climb_Racial` int(11) DEFAULT 0,
  `Climb_Feats` int(11) DEFAULT 0,
  `Climb_Misc` int(11) DEFAULT 0,
  `Craft_Ranks` int(11) DEFAULT 0,
  `Craft_Racial` int(11) DEFAULT 0,
  `Craft_Feats` int(11) DEFAULT 0,
  `Craft_Misc` int(11) DEFAULT 0,
  `Diplo_Ranks` int(11) DEFAULT 0,
  `Diplo_Racial` int(11) DEFAULT 0,
  `Diplo_Feats` int(11) DEFAULT 0,
  `Diplo_Misc` int(11) DEFAULT 0,
  `DsDev_Ranks` int(11) DEFAULT 0,
  `DsDev_Racial` int(11) DEFAULT 0,
  `DsDev_Feats` int(11) DEFAULT 0,
  `DsDev_Misc` int(11) DEFAULT 0,
  `Disgu_Ranks` int(11) DEFAULT 0,
  `Disgu_Racial` int(11) DEFAULT 0,
  `Disgu_Feats` int(11) DEFAULT 0,
  `Disgu_Misc` int(11) DEFAULT 0,
  `Escar_Ranks` int(11) DEFAULT 0,
  `Escar_Racial` int(11) DEFAULT 0,
  `Escar_Feats` int(11) DEFAULT 0,
  `Escar_Misc` int(11) DEFAULT 0,
  `Fly_Ranks` int(11) DEFAULT 0,
  `Fly_Racial` int(11) DEFAULT 0,
  `Fly_Feats` int(11) DEFAULT 0,
  `Fly_Misc` int(11) DEFAULT 0,
  `Hanim_Ranks` int(11) DEFAULT 0,
  `Hanim_Racial` int(11) DEFAULT 0,
  `Hanim_Feats` int(11) DEFAULT 0,
  `Hanim_Misc` int(11) DEFAULT 0,
  `Heal_Ranks` int(11) DEFAULT 0,
  `Heal_Racial` int(11) DEFAULT 0,
  `Heal_Feats` int(11) DEFAULT 0,
  `Heal_Misc` int(11) DEFAULT 0,
  `Intim_Ranks` int(11) DEFAULT 0,
  `Intim_Racial` int(11) DEFAULT 0,
  `Intim_Feats` int(11) DEFAULT 0,
  `Intim_Misc` int(11) DEFAULT 0,
  `Karca_Ranks` int(11) DEFAULT 0,
  `Karca_Racial` int(11) DEFAULT 0,
  `Karca_Feats` int(11) DEFAULT 0,
  `Karca_Misc` int(11) DEFAULT 0,
  `Kdung_Ranks` int(11) DEFAULT 0,
  `Kdung_Racial` int(11) DEFAULT 0,
  `Kdung_Feats` int(11) DEFAULT 0,
  `Kdung_Misc` int(11) DEFAULT 0,
  `Kengi_Ranks` int(11) DEFAULT 0,
  `Kengi_Racial` int(11) DEFAULT 0,
  `Kengi_Feats` int(11) DEFAULT 0,
  `Kengi_Misc` int(11) DEFAULT 0,
  `Kgeog_Ranks` int(11) DEFAULT 0,
  `Kgeog_Racial` int(11) DEFAULT 0,
  `Kgeog_Feats` int(11) DEFAULT 0,
  `Kgeog_Misc` int(11) DEFAULT 0,
  `Khist_Ranks` int(11) DEFAULT 0,
  `Khist_Racial` int(11) DEFAULT 0,
  `Khist_Feats` int(11) DEFAULT 0,
  `Khist_Misc` int(11) DEFAULT 0,
  `Kloca_Ranks` int(11) DEFAULT 0,
  `Kloca_Racial` int(11) DEFAULT 0,
  `Kloca_Feats` int(11) DEFAULT 0,
  `Kloca_Misc` int(11) DEFAULT 0,
  `Knatu_Ranks` int(11) DEFAULT 0,
  `Knatu_Racial` int(11) DEFAULT 0,
  `Knatu_Feats` int(11) DEFAULT 0,
  `Knatu_Misc` int(11) DEFAULT 0,
  `Knobi_Ranks` int(11) DEFAULT 0,
  `Knobi_Racial` int(11) DEFAULT 0,
  `Knobi_Feats` int(11) DEFAULT 0,
  `Knobi_Misc` int(11) DEFAULT 0,
  `Kplan_Ranks` int(11) DEFAULT 0,
  `Kplan_Racial` int(11) DEFAULT 0,
  `Kplan_Feats` int(11) DEFAULT 0,
  `Kplan_Misc` int(11) DEFAULT 0,
  `Kreli_Ranks` int(11) DEFAULT 0,
  `Kreli_Racial` int(11) DEFAULT 0,
  `Kreli_Feats` int(11) DEFAULT 0,
  `Kreli_Misc` int(11) DEFAULT 0,
  `Lingu_Ranks` int(11) DEFAULT 0,
  `Lingu_Racial` int(11) DEFAULT 0,
  `Lingu_Feats` int(11) DEFAULT 0,
  `Lingu_Misc` int(11) DEFAULT 0,
  `Perce_Ranks` int(11) DEFAULT 0,
  `Perce_Racial` int(11) DEFAULT 0,
  `Perce_Feats` int(11) DEFAULT 0,
  `Perce_Misc` int(11) DEFAULT 0,
  `Perfo_Ranks` int(11) DEFAULT 0,
  `Perfo_Racial` int(11) DEFAULT 0,
  `Perfo_Feats` int(11) DEFAULT 0,
  `Perfo_Misc` int(11) DEFAULT 0,
  `Profe_Ranks` int(11) DEFAULT 0,
  `Profe_Racial` int(11) DEFAULT 0,
  `Profe_Feats` int(11) DEFAULT 0,
  `Profe_Misc` int(11) DEFAULT 0,
  `Ride_Ranks` int(11) DEFAULT 0,
  `Ride_Racial` int(11) DEFAULT 0,
  `Ride_Feats` int(11) DEFAULT 0,
  `Ride_Misc` int(11) DEFAULT 0,
  `Senmo_Ranks` int(11) DEFAULT 0,
  `Senmo_Racial` int(11) DEFAULT 0,
  `Senmo_Feats` int(11) DEFAULT 0,
  `Senmo_Misc` int(11) DEFAULT 0,
  `SOH_Ranks` int(11) DEFAULT 0,
  `SOH_Racial` int(11) DEFAULT 0,
  `SOH_Feats` int(11) DEFAULT 0,
  `SOH_Misc` int(11) DEFAULT 0,
  `Spcft_Ranks` int(11) DEFAULT 0,
  `Spcft_Racial` int(11) DEFAULT 0,
  `Spcft_Feats` int(11) DEFAULT 0,
  `Spcft_Misc` int(11) DEFAULT 0,
  `Stlth_Ranks` int(11) DEFAULT 0,
  `Stlth_Racial` int(11) DEFAULT 0,
  `Stlth_Feats` int(11) DEFAULT 0,
  `Stlth_Misc` int(11) DEFAULT 0,
  `Survi_Ranks` int(11) DEFAULT 0,
  `Survi_Racial` int(11) DEFAULT 0,
  `Survi_Feats` int(11) DEFAULT 0,
  `Survi_Misc` int(11) DEFAULT 0,
  `Swim_Ranks` int(11) DEFAULT 0,
  `Swim_Racial` int(11) DEFAULT 0,
  `Swim_Feats` int(11) DEFAULT 0,
  `Swim_Misc` int(11) DEFAULT 0,
  `Umdev_Ranks` int(11) DEFAULT 0,
  `Umdev_Racial` int(11) DEFAULT 0,
  `Umdev_Feats` int(11) DEFAULT 0,
  `Umdev_Misc` int(11) DEFAULT 0,
  `Last_Update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`Character_ID`, `Character_Name`, `Class_ID`, `Race_ID`, `Str_Base`, `Dex_Base`, `Con_Base`, `Int_Base`, `Wis_Base`, `Cha_Base`, `Acrob_Ranks`, `Acrob_Racial`, `Acrob_Feats`, `Acrob_Misc`, `Appra_Ranks`, `Appra_Racial`, `Appra_Feats`, `Appra_Misc`, `Bluff_Ranks`, `Bluff_Racial`, `Bluff_Feats`, `Bluff_Misc`, `Climb_Ranks`, `Climb_Racial`, `Climb_Feats`, `Climb_Misc`, `Craft_Ranks`, `Craft_Racial`, `Craft_Feats`, `Craft_Misc`, `Diplo_Ranks`, `Diplo_Racial`, `Diplo_Feats`, `Diplo_Misc`, `DsDev_Ranks`, `DsDev_Racial`, `DsDev_Feats`, `DsDev_Misc`, `Disgu_Ranks`, `Disgu_Racial`, `Disgu_Feats`, `Disgu_Misc`, `Escar_Ranks`, `Escar_Racial`, `Escar_Feats`, `Escar_Misc`, `Fly_Ranks`, `Fly_Racial`, `Fly_Feats`, `Fly_Misc`, `Hanim_Ranks`, `Hanim_Racial`, `Hanim_Feats`, `Hanim_Misc`, `Heal_Ranks`, `Heal_Racial`, `Heal_Feats`, `Heal_Misc`, `Intim_Ranks`, `Intim_Racial`, `Intim_Feats`, `Intim_Misc`, `Karca_Ranks`, `Karca_Racial`, `Karca_Feats`, `Karca_Misc`, `Kdung_Ranks`, `Kdung_Racial`, `Kdung_Feats`, `Kdung_Misc`, `Kengi_Ranks`, `Kengi_Racial`, `Kengi_Feats`, `Kengi_Misc`, `Kgeog_Ranks`, `Kgeog_Racial`, `Kgeog_Feats`, `Kgeog_Misc`, `Khist_Ranks`, `Khist_Racial`, `Khist_Feats`, `Khist_Misc`, `Kloca_Ranks`, `Kloca_Racial`, `Kloca_Feats`, `Kloca_Misc`, `Knatu_Ranks`, `Knatu_Racial`, `Knatu_Feats`, `Knatu_Misc`, `Knobi_Ranks`, `Knobi_Racial`, `Knobi_Feats`, `Knobi_Misc`, `Kplan_Ranks`, `Kplan_Racial`, `Kplan_Feats`, `Kplan_Misc`, `Kreli_Ranks`, `Kreli_Racial`, `Kreli_Feats`, `Kreli_Misc`, `Lingu_Ranks`, `Lingu_Racial`, `Lingu_Feats`, `Lingu_Misc`, `Perce_Ranks`, `Perce_Racial`, `Perce_Feats`, `Perce_Misc`, `Perfo_Ranks`, `Perfo_Racial`, `Perfo_Feats`, `Perfo_Misc`, `Profe_Ranks`, `Profe_Racial`, `Profe_Feats`, `Profe_Misc`, `Ride_Ranks`, `Ride_Racial`, `Ride_Feats`, `Ride_Misc`, `Senmo_Ranks`, `Senmo_Racial`, `Senmo_Feats`, `Senmo_Misc`, `SOH_Ranks`, `SOH_Racial`, `SOH_Feats`, `SOH_Misc`, `Spcft_Ranks`, `Spcft_Racial`, `Spcft_Feats`, `Spcft_Misc`, `Stlth_Ranks`, `Stlth_Racial`, `Stlth_Feats`, `Stlth_Misc`, `Survi_Ranks`, `Survi_Racial`, `Survi_Feats`, `Survi_Misc`, `Swim_Ranks`, `Swim_Racial`, `Swim_Feats`, `Swim_Misc`, `Umdev_Ranks`, `Umdev_Racial`, `Umdev_Feats`, `Umdev_Misc`, `Last_Update`, `Notes`) VALUES
(1, 'Conan\'s', 1, 7, 14, 13, 15, 10, 12, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-26 09:13:05', 'This is a note for notes sake!'),
(4, 'Bob', 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', NULL),
(6, 'Ales', 2, 5, 10, 10, 10, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', NULL),
(7, 'Snails', 2, 2, 10, 10, 10, 14, 7, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', NULL),
(10, 'Leeroy', 1, 1, 10, 10, 10, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', ''),
(11, 'Kelly', 1, 1, 10, 10, 10, 10, 10, 10, 1, 2, 3, 4, 1, 2, 3, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', NULL),
(25, 'Ed\'s Pacifist Ethicist', 6, 1, 1, 1, 1, 1, 99, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-04-19 20:06:04', 'Not sure how a pacifist ethicist dwarf monk can be helpful here... but what the hell... just experimenting...');

-- --------------------------------------------------------

--
-- Table structure for table `character_skills`
--

CREATE TABLE `character_skills` (
  `C_S_ID` int(11) NOT NULL,
  `Character_ID` int(11) NOT NULL,
  `Skill_ID` int(11) NOT NULL,
  `Mod_ID` int(11) NOT NULL,
  `Skill_Mod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_ID` int(11) NOT NULL,
  `Class_Name` varchar(20) DEFAULT NULL,
  `Die_ID` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_ID`, `Class_Name`, `Die_ID`) VALUES
(1, 'Barbarian', 5),
(2, 'Bard', 3),
(3, 'Cleric', 3),
(4, 'Druid', 3),
(5, 'Fighter', 4),
(6, 'Monk', 3),
(7, 'Paladin', 4),
(8, 'Ranger', 4),
(9, 'Rogue', 3),
(10, 'Sorcerer', 2),
(11, 'Wizard', 2);

-- --------------------------------------------------------

--
-- Table structure for table `classes_skills`
--

CREATE TABLE `classes_skills` (
  `C_S_ID` int(11) NOT NULL,
  `Class_ID` int(11) NOT NULL,
  `Skill_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes_skills`
--

INSERT INTO `classes_skills` (`C_S_ID`, `Class_ID`, `Skill_ID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 5),
(4, 1, 11),
(5, 1, 13),
(6, 1, 20),
(7, 1, 25),
(8, 1, 28),
(9, 1, 33),
(10, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `dice`
--

CREATE TABLE `dice` (
  `Die_ID` int(11) NOT NULL,
  `Die_Sides` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dice`
--

INSERT INTO `dice` (`Die_ID`, `Die_Sides`) VALUES
(1, 4),
(2, 6),
(3, 8),
(4, 10),
(5, 12),
(6, 20),
(7, 100);

-- --------------------------------------------------------

--
-- Table structure for table `feats`
--

CREATE TABLE `feats` (
  `Feat_ID` int(11) NOT NULL,
  `Character_ID` int(11) NOT NULL,
  `Feat_Name` varchar(255) NOT NULL,
  `Feat_Desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feats`
--

INSERT INTO `feats` (`Feat_ID`, `Character_ID`, `Feat_Name`, `Feat_Desc`) VALUES
(1, 1, 'Simple Weapon Proficiency', 'You are trained in the use of basic weapons.\r\n\r\nBenefit: You make attack rolls with simple weapons without penalty.\r\n\r\nNormal: When using a weapon with which you are not proficient, you take a –4 penalty on attack rolls.\r\n\r\nSpecial: All characters except for druids, monks, and wizards are automatically proficient with all simple weapons. They need not select this feat.'),
(8, 10, 'Hail Mary', 'You cannot be intimidated or stopped when provoking attacks of opportunity'),
(9, 10, 'Exotic Weapon Proficiency (Comically Large Axe)', 'You are capable of wielding one unique weapon type');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Inventory_ID` int(11) NOT NULL,
  `Character_ID` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Item_Desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Inventory_ID`, `Character_ID`, `Item_Name`, `Item_Desc`) VALUES
(20, 1, 'Greatsword', 'Cost: 50 gp\r\nWeight: 8 lbs.\r\nDamage: 1d10 (small), 2d6 (medium) \r\nCritical: 19-20/x2 \r\nType: slashing\r\nCategory: two-handed\r\nProficiency: martial\r\nWeapon Group: heavy blades\r\n\r\nThis immense two-handed sword is about 5 feet in length. A greatsword may have a dulled lower blade that can be gripped.');

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `Race_ID` int(11) NOT NULL,
  `Race_Name` varchar(20) NOT NULL,
  `Str_Mod` int(11) DEFAULT 0,
  `Dex_Mod` int(11) DEFAULT 0,
  `Con_Mod` int(11) DEFAULT 0,
  `Int_Mod` int(11) DEFAULT 0,
  `Wis_Mod` int(11) DEFAULT 0,
  `Cha_Mod` int(11) DEFAULT 0,
  `Wildcard_Mod` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`Race_ID`, `Race_Name`, `Str_Mod`, `Dex_Mod`, `Con_Mod`, `Int_Mod`, `Wis_Mod`, `Cha_Mod`, `Wildcard_Mod`) VALUES
(1, 'Dwarf', 0, 0, 2, 0, 2, -2, b'0'),
(2, 'Elf', 0, 2, -2, 2, 0, 0, b'0'),
(3, 'Gnome', -2, 0, 2, 0, 0, 2, b'0'),
(4, 'Half-Elf', 0, 0, 0, 0, 0, 0, b'1'),
(5, 'Halfling', -2, 2, 0, 0, 0, 2, b'0'),
(6, 'Half-Orc', 0, 0, 0, 0, 0, 0, b'1'),
(7, 'Human', 0, 0, 0, 0, 0, 0, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `Skill_ID` int(11) NOT NULL,
  `Skill_Name` varchar(50) DEFAULT NULL,
  `Ability_ID` int(11) DEFAULT 0,
  `Is_Untrained` bit(1) DEFAULT b'0',
  `Armored_Penalty` bit(1) DEFAULT b'0',
  `Short_Name` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`Skill_ID`, `Skill_Name`, `Ability_ID`, `Is_Untrained`, `Armored_Penalty`, `Short_Name`) VALUES
(1, 'Acrobatics', 2, b'1', b'1', 'Acrob'),
(2, 'Appraise', 4, b'1', b'0', 'Appra'),
(3, 'Bluff', 6, b'1', b'0', 'Bluff'),
(4, 'Climb', 1, b'1', b'1', 'Climb'),
(5, 'Craft', 4, b'1', b'0', 'Craft'),
(6, 'Diplomacy', 6, b'1', b'0', 'Diplo'),
(7, 'Disable Device', 2, b'0', b'1', 'DsDev'),
(8, 'Disguise', 6, b'1', b'0', 'Disgu'),
(9, 'Escape Artist', 2, b'1', b'1', 'Escar'),
(10, 'Fly', 2, b'1', b'1', 'Fly'),
(11, 'Handle Animal', 6, b'0', b'0', 'Hanim'),
(12, 'Heal', 5, b'1', b'0', 'Heal'),
(13, 'Intimidate', 6, b'1', b'0', 'Intim'),
(14, 'Knowledge (arcana)', 4, b'0', b'0', 'Karca'),
(15, 'Knowledge (dungeoneering)', 4, b'0', b'0', 'Kdung'),
(16, 'Knowledge (engineering)', 4, b'0', b'0', 'Kengi'),
(17, 'Knowledge (geography)', 4, b'0', b'0', 'Kgeog'),
(18, 'Knowledge (history)', 4, b'0', b'0', 'Khist'),
(19, 'Knowledge (local)', 4, b'0', b'0', 'Kloca'),
(20, 'Knowledge (nature)', 4, b'0', b'0', 'Knatu'),
(21, 'Knowledge (nobility)', 4, b'0', b'0', 'Knobi'),
(22, 'Knowledge (planes)', 4, b'0', b'0', 'Kplan'),
(23, 'Knowledge (religion)', 4, b'0', b'0', 'Kreli'),
(24, 'Linguistics', 4, b'0', b'0', 'Lingu'),
(25, 'Perception', 5, b'1', b'0', 'Perce'),
(26, 'Perform', 6, b'1', b'0', 'Perfo'),
(27, 'Profession', 5, b'0', b'0', 'Profe'),
(28, 'Ride', 2, b'1', b'1', 'Ride'),
(29, 'Sense Motive', 5, b'1', b'0', 'Senmo'),
(30, 'Sleight of Hand', 2, b'0', b'1', 'SOH'),
(31, 'Spellcraft', 4, b'0', b'0', 'Spcft'),
(32, 'Stealth', 2, b'1', b'1', 'Stlth'),
(33, 'Survival', 4, b'1', b'0', 'Survi'),
(34, 'Swim', 1, b'1', b'1', 'Swim'),
(35, 'Use Magic Device', 6, b'0', b'0', 'Umdev');

-- --------------------------------------------------------

--
-- Table structure for table `skill_mods`
--

CREATE TABLE `skill_mods` (
  `Mod_ID` int(11) NOT NULL,
  `Mod_Name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill_mods`
--

INSERT INTO `skill_mods` (`Mod_ID`, `Mod_Name`) VALUES
(1, 'Ranks'),
(2, 'Racial'),
(3, 'Feats'),
(4, 'Misc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`Ability_ID`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`Character_ID`),
  ADD KEY `FK_Character_Class` (`Class_ID`),
  ADD KEY `FK_Character_Race` (`Race_ID`);

--
-- Indexes for table `character_skills`
--
ALTER TABLE `character_skills`
  ADD PRIMARY KEY (`C_S_ID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_ID`),
  ADD KEY `FK_Class_Die` (`Die_ID`);

--
-- Indexes for table `classes_skills`
--
ALTER TABLE `classes_skills`
  ADD PRIMARY KEY (`C_S_ID`),
  ADD KEY `FK_CS_Classes` (`Class_ID`),
  ADD KEY `FK_CS_Skills` (`Skill_ID`);

--
-- Indexes for table `dice`
--
ALTER TABLE `dice`
  ADD PRIMARY KEY (`Die_ID`);

--
-- Indexes for table `feats`
--
ALTER TABLE `feats`
  ADD PRIMARY KEY (`Feat_ID`),
  ADD KEY `Character_ID` (`Character_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Inventory_ID`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`Race_ID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`Skill_ID`);

--
-- Indexes for table `skill_mods`
--
ALTER TABLE `skill_mods`
  ADD PRIMARY KEY (`Mod_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `Ability_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `Character_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `character_skills`
--
ALTER TABLE `character_skills`
  MODIFY `C_S_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classes_skills`
--
ALTER TABLE `classes_skills`
  MODIFY `C_S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dice`
--
ALTER TABLE `dice`
  MODIFY `Die_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feats`
--
ALTER TABLE `feats`
  MODIFY `Feat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Inventory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `Race_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `Skill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `skill_mods`
--
ALTER TABLE `skill_mods`
  MODIFY `Mod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `FK_Character_Class` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
  ADD CONSTRAINT `FK_Character_Race` FOREIGN KEY (`Race_ID`) REFERENCES `races` (`Race_ID`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `FK_Class_Die` FOREIGN KEY (`Die_ID`) REFERENCES `dice` (`Die_ID`);

--
-- Constraints for table `classes_skills`
--
ALTER TABLE `classes_skills`
  ADD CONSTRAINT `FK_CS_Classes` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
  ADD CONSTRAINT `FK_CS_Skills` FOREIGN KEY (`Skill_ID`) REFERENCES `skills` (`Skill_ID`);

--
-- Constraints for table `feats`
--
ALTER TABLE `feats`
  ADD CONSTRAINT `FK_Feat_Character` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);


--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_Inv_Character` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
