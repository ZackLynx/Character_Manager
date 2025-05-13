/*
-----------------------------------------------------------------------------------------------
Name:       character_manager_may_third.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-05-03
Language:   SQL
System:     MySQL 8.2.12
Purpose:    This is a backup of the database used for week 14. it includes the full revision of
            the Skills system as well as a new table for character size.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-05-03      Original Version
-----------------------------------------------------------------------------------------------
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
DROP DATABASE IF EXISTS `character_manager`;
CREATE DATABASE IF NOT EXISTS `character_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `character_manager`;

CREATE TABLE `abilities` (
  `Ability_ID` int(11) NOT NULL,
  `Ability_Name` varchar(12) NOT NULL,
  `Ability_Short` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `abilities` (`Ability_ID`, `Ability_Name`, `Ability_Short`) VALUES
(1, 'Strength', 'STR'),
(2, 'Dexterity', 'DEX'),
(3, 'Constitution', 'CON'),
(4, 'Intelligence', 'INT'),
(5, 'Wisdom', 'WIS'),
(6, 'Charisma', 'CHA');

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
  `Last_Update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Notes` text DEFAULT NULL,
  `Character_Level` int(11) NOT NULL DEFAULT 1,
  `Size_ID` int(11) NOT NULL DEFAULT 5,
  `Gender` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `characters` (`Character_ID`, `Character_Name`, `Class_ID`, `Race_ID`, `Str_Base`, `Dex_Base`, `Con_Base`, `Int_Base`, `Wis_Base`, `Cha_Base`, `Last_Update`, `Notes`, `Character_Level`, `Size_ID`, `Gender`) VALUES
(1, 'Conan\'s', 1, 7, 14, 13, 15, 10, 12, 9, '2025-05-02 21:41:50', 'This is a note for notes sake!', 1, 5, NULL),
(4, 'Bob', 4, 3, 0, 0, 0, 0, 0, 0, '2025-04-19 09:10:03', NULL, 1, 5, NULL),
(6, 'Ales', 2, 5, 10, 10, 10, 10, 10, 10, '2025-04-19 09:10:03', NULL, 1, 5, NULL),
(7, 'Snails', 2, 2, 10, 10, 10, 14, 7, 10, '2025-04-19 09:10:03', NULL, 1, 5, NULL),
(10, 'Leeroy', 1, 1, 10, 10, 10, 10, 10, 10, '2025-04-19 09:10:03', '', 1, 5, NULL),
(11, 'Kelly', 1, 1, 10, 10, 10, 10, 10, 10, '2025-05-02 00:59:16', '', 1, 5, NULL),
(25, 'Ed\'s Pacifist Ethicist', 6, 1, 1, 1, 1, 1, 99, 0, '2025-04-19 20:06:04', 'Not sure how a pacifist ethicist dwarf monk can be helpful here... but what the hell... just experimenting...', 1, 5, NULL),
(27, 'Jose', 3, 7, 10, 10, 10, 10, 10, 10, '2025-04-26 10:49:42', 'Some notes!;', 1, 5, NULL),
(30, 'Balthazar', 7, 2, 10, 10, 10, 10, 10, 10, '2025-05-02 21:56:58', '', 1, 5, NULL);

CREATE TABLE `character_skills` (
  `Character_ID` int(11) NOT NULL,
  `Skill_ID` int(11) NOT NULL,
  `Modifier_ID` int(11) NOT NULL,
  `Field_Value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `character_skills` (`Character_ID`, `Skill_ID`, `Modifier_ID`, `Field_Value`) VALUES
(1, 1, 1, 2),
(1, 1, 4, 1),
(11, 1, 1, 1),
(11, 1, 2, 2),
(11, 1, 3, 3),
(11, 1, 4, 4),
(11, 2, 1, 1),
(11, 2, 2, 2),
(11, 2, 3, 3),
(11, 2, 4, 4),
(25, 1, 1, 6),
(30, 1, 1, 6);

CREATE TABLE `classes` (
  `Class_ID` int(11) NOT NULL,
  `Class_Name` varchar(20) DEFAULT NULL,
  `Die_ID` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `classes_skills` (
  `C_S_ID` int(11) NOT NULL,
  `Class_ID` int(11) NOT NULL,
  `Skill_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `dice` (
  `Die_ID` int(11) NOT NULL,
  `Die_Sides` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dice` (`Die_ID`, `Die_Sides`) VALUES
(1, 4),
(2, 6),
(3, 8),
(4, 10),
(5, 12),
(6, 20),
(7, 100);

CREATE TABLE `feats` (
  `Feat_ID` int(11) NOT NULL,
  `Character_ID` int(11) NOT NULL,
  `Feat_Name` varchar(255) NOT NULL,
  `Feat_Desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `feats` (`Feat_ID`, `Character_ID`, `Feat_Name`, `Feat_Desc`) VALUES
(1, 1, 'Simple Weapon Proficiency', 'You are trained in the use of basic weapons.\r\n\r\nBenefit: You make attack rolls with simple weapons without penalty.\r\n\r\nNormal: When using a weapon with which you are not proficient, you take a –4 penalty on attack rolls.\r\n\r\nSpecial: All characters except for druids, monks, and wizards are automatically proficient with all simple weapons. They need not select this feat.'),
(8, 10, 'Hail Mary', 'You cannot be intimidated or stopped when provoking attacks of opportunity'),
(9, 10, 'Exotic Weapon Proficiency (Comically Large Axe)', 'You are capable of wielding one unique weapon type');

CREATE TABLE `inventory` (
  `Inventory_ID` int(11) NOT NULL,
  `Character_ID` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Item_Desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inventory` (`Inventory_ID`, `Character_ID`, `Item_Name`, `Item_Desc`) VALUES
(21, 27, 'Item Test', 'This is only a test.'),
(22, 1, 'Potion', 'Heals 1d4 HP');

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

INSERT INTO `races` (`Race_ID`, `Race_Name`, `Str_Mod`, `Dex_Mod`, `Con_Mod`, `Int_Mod`, `Wis_Mod`, `Cha_Mod`, `Wildcard_Mod`) VALUES
(1, 'Dwarf', 0, 0, 2, 0, 2, -2, b'0'),
(2, 'Elf', 0, 2, -2, 2, 0, 0, b'0'),
(3, 'Gnome', -2, 0, 2, 0, 0, 2, b'0'),
(4, 'Half-Elf', 0, 0, 0, 0, 0, 0, b'1'),
(5, 'Halfling', -2, 2, 0, 0, 0, 2, b'0'),
(6, 'Half-Orc', 0, 0, 0, 0, 0, 0, b'1'),
(7, 'Human', 0, 0, 0, 0, 0, 0, b'1');

CREATE TABLE `sizes` (
  `Size_ID` int(11) NOT NULL,
  `Size_Name` varchar(20) NOT NULL,
  `Size_Modifier` int(11) NOT NULL,
  `Special_Size_Mod` int(11) NOT NULL,
  `Fly_Modifier` int(11) NOT NULL,
  `Stealth_Modifier` int(11) NOT NULL,
  `Space` float NOT NULL,
  `Natural_Reach` int(11) NOT NULL,
  `Typical_height_Length` varchar(16) NOT NULL,
  `Typical_Weight` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sizes` (`Size_ID`, `Size_Name`, `Size_Modifier`, `Special_Size_Mod`, `Fly_Modifier`, `Stealth_Modifier`, `Space`, `Natural_Reach`, `Typical_height_Length`, `Typical_Weight`) VALUES
(1, 'Fine', 8, -8, 8, 16, 0.5, 0, '6\" or less', '1/8lb. or less'),
(2, 'Diminutive', 4, -4, 6, 12, 1, 0, '6\" to 1 ft.', '1/8 lb. - 1 lb.'),
(3, 'Tiny', 2, -2, 4, 8, 2.5, 0, '1\' to 2 ft.', '1-8 lbs.'),
(4, 'Small', 1, -1, 2, 4, 5, 5, '2\' to 4 ft.', '8-60 lbs.'),
(5, 'Medium', 0, 0, 0, 0, 5, 5, '4\' to 8 ft.', '60-500 lbs.'),
(6, 'Large (tall)', -1, 1, -2, -4, 10, 10, '8\' to 16 ft.', '500-4000 lbs.'),
(7, 'Large (long)', -1, 1, -2, -4, 10, 5, '8\' to 16 ft.', '500-4000 lbs.'),
(8, 'Huge (tall)', -2, 2, -4, -8, 15, 15, '16\' to 32 ft.', '2-16 tons'),
(9, 'Huge (long)', -2, 2, -4, -8, 15, 10, '16\' to 32 ft.', '2-16 tons'),
(10, 'Gargantuan (tall)', -4, 4, -6, -12, 20, 20, '32\' to 64 ft.', '16-125 tons'),
(11, 'Gargantuan (long)', -4, 4, -6, -12, 20, 15, '32\' to 64 ft.', '16-125 tons'),
(12, 'Colossal (tall)', -8, 8, -8, -16, 30, 30, '64 ft. or more', '125 tons or more'),
(13, 'Colossal (long)', -8, 8, -8, -16, 30, 20, '64 ft. or more', '125 tons or more');

CREATE TABLE `skills` (
  `Skill_ID` int(11) NOT NULL,
  `Skill_Name` varchar(50) DEFAULT NULL,
  `Ability_ID` int(11) DEFAULT 0,
  `Is_Untrained` bit(1) DEFAULT b'0',
  `Armored_Penalty` bit(1) DEFAULT b'0',
  `Short_Name` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `skill_modifiers` (
  `Modifier_ID` int(11) NOT NULL,
  `Mod_Name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `skill_modifiers` (`Modifier_ID`, `Mod_Name`) VALUES
(1, 'Ranks'),
(2, 'Racial'),
(3, 'Feats'),
(4, 'Misc');


ALTER TABLE `abilities`
  ADD PRIMARY KEY (`Ability_ID`);

ALTER TABLE `characters`
  ADD PRIMARY KEY (`Character_ID`),
  ADD KEY `FK_Character_Class` (`Class_ID`),
  ADD KEY `FK_Character_Race` (`Race_ID`);

ALTER TABLE `character_skills`
  ADD PRIMARY KEY (`Character_ID`,`Skill_ID`,`Modifier_ID`),
  ADD KEY `FK_CS_Skill_ID` (`Skill_ID`),
  ADD KEY `FK_CS_Modifier_ID` (`Modifier_ID`);

ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_ID`),
  ADD KEY `FK_Class_Die` (`Die_ID`);

ALTER TABLE `classes_skills`
  ADD PRIMARY KEY (`C_S_ID`),
  ADD KEY `FK_CS_Classes` (`Class_ID`),
  ADD KEY `FK_CS_Skills` (`Skill_ID`);

ALTER TABLE `dice`
  ADD PRIMARY KEY (`Die_ID`);

ALTER TABLE `feats`
  ADD PRIMARY KEY (`Feat_ID`),
  ADD KEY `Character_ID` (`Character_ID`);

ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Inventory_ID`),
  ADD KEY `FK_Inv_Character` (`Character_ID`);

ALTER TABLE `races`
  ADD PRIMARY KEY (`Race_ID`);

ALTER TABLE `sizes`
  ADD PRIMARY KEY (`Size_ID`);

ALTER TABLE `skills`
  ADD PRIMARY KEY (`Skill_ID`);

ALTER TABLE `skill_modifiers`
  ADD PRIMARY KEY (`Modifier_ID`);


ALTER TABLE `abilities`
  MODIFY `Ability_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `characters`
  MODIFY `Character_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `classes`
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `classes_skills`
  MODIFY `C_S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `dice`
  MODIFY `Die_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `feats`
  MODIFY `Feat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `inventory`
  MODIFY `Inventory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `races`
  MODIFY `Race_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `sizes`
  MODIFY `Size_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `skills`
  MODIFY `Skill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

ALTER TABLE `skill_modifiers`
  MODIFY `Modifier_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `characters`
  ADD CONSTRAINT `FK_Character_Class` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
  ADD CONSTRAINT `FK_Character_Race` FOREIGN KEY (`Race_ID`) REFERENCES `races` (`Race_ID`);

ALTER TABLE `character_skills`
  ADD CONSTRAINT `FK_CS_Character_ID` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`),
  ADD CONSTRAINT `FK_CS_Modifier_ID` FOREIGN KEY (`Modifier_ID`) REFERENCES `skill_modifiers` (`Modifier_ID`),
  ADD CONSTRAINT `FK_CS_Skill_ID` FOREIGN KEY (`Skill_ID`) REFERENCES `skills` (`Skill_ID`);

ALTER TABLE `classes`
  ADD CONSTRAINT `FK_Class_Die` FOREIGN KEY (`Die_ID`) REFERENCES `dice` (`Die_ID`);

ALTER TABLE `classes_skills`
  ADD CONSTRAINT `FK_CS_Classes` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
  ADD CONSTRAINT `FK_CS_Skills` FOREIGN KEY (`Skill_ID`) REFERENCES `skills` (`Skill_ID`);

ALTER TABLE `feats`
  ADD CONSTRAINT `FK_Feat_Character` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);

ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_Inv_Character` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
