-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 04:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `character_manager`
--

DROP DATABASE IF EXISTS `character_manager`;

CREATE DATABASE IF NOT EXISTS `character_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `character_manager`;

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
    `Ability_ID` int(11) NOT NULL,
    `Ability_Name` varchar(12) NOT NULL,
    `Ability_Short` char(3) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `abilities`
--

INSERT INTO
    `abilities` (
        `Ability_ID`,
        `Ability_Name`,
        `Ability_Short`
    )
VALUES (1, 'Strength', 'STR'),
    (2, 'Dexterity', 'DEX'),
    (3, 'Constitution', 'CON'),
    (4, 'Intelligence', 'INT'),
    (5, 'Wisdom', 'WIS'),
    (6, 'Charisma', 'CHA');

-- --------------------------------------------------------

--
-- Table structure for table `alignments`
--

CREATE TABLE `alignments` (
    `Alignment_ID` int(11) NOT NULL,
    `Alignment_Name` varchar(16) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `alignments`
--

INSERT INTO
    `alignments` (
        `Alignment_ID`,
        `Alignment_Name`
    )
VALUES (1, 'Lawful Good'),
    (2, 'Neutral Good'),
    (3, 'Chaotic Good'),
    (4, 'Lawful Neutral'),
    (5, 'True Neutral'),
    (6, 'Chaotic Neutral'),
    (7, 'Lawful Evil'),
    (8, 'Neutral Evil'),
    (9, 'Chaotic Evil');

-- --------------------------------------------------------

--
-- Table structure for table `armor`
--

CREATE TABLE `armor` (
    `Armor_ID` int(11) NOT NULL,
    `Character_ID` int(11) NOT NULL,
    `Armor_Name` varchar(255) NOT NULL,
    `Armor_Type` int(3) NOT NULL,
    `Max_Speed` int(11) DEFAULT NULL,
    `Max_Dex` int(11) DEFAULT NULL,
    `Armor_ACP` int(11) DEFAULT NULL,
    `Armor_Weight` int(11) DEFAULT NULL,
    `Armor_AC` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
    `Character_ID` int(11) NOT NULL,
    `Character_Name` varchar(100) DEFAULT NULL,
    `Class_ID` int(11) NOT NULL DEFAULT 1,
    `Race_ID` int(11) NOT NULL DEFAULT 1,
    `Alignment_ID` int(11) NOT NULL DEFAULT 5,
    `Str_Base` int(11) DEFAULT 0,
    `Dex_Base` int(11) DEFAULT 0,
    `Con_Base` int(11) DEFAULT 0,
    `Int_Base` int(11) DEFAULT 0,
    `Wis_Base` int(11) DEFAULT 0,
    `Cha_Base` int(11) DEFAULT 0,
    `Experience_Points` int(10) UNSIGNED NOT NULL DEFAULT 0,
    `Character_Level` int(11) NOT NULL DEFAULT 1,
    `Gender` varchar(16) DEFAULT NULL,
    `Max_HP` int(10) UNSIGNED NOT NULL DEFAULT 0,
    `Current_HP` int(11) NOT NULL DEFAULT 0,
    `Notes` text DEFAULT NULL,
    `Last_Update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO
    `characters` (
        `Character_ID`,
        `Character_Name`,
        `Class_ID`,
        `Race_ID`,
        `Alignment_ID`,
        `Str_Base`,
        `Dex_Base`,
        `Con_Base`,
        `Int_Base`,
        `Wis_Base`,
        `Cha_Base`,
        `Experience_Points`,
        `Character_Level`,
        `Gender`,
        `Max_HP`,
        `Current_HP`,
        `Notes`,
        `Last_Update`
    )
VALUES (
        1,
        'Conan\'s',
        1,
        7,
        6,
        14,
        13,
        15,
        10,
        12,
        9,
        44,
        3,
        'Male',
        30,
        16,
        'This is a note for notes sake!',
        '2025-05-13 00:50:31'
    ),
    (
        4,
        'Bob',
        4,
        3,
        5,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        1,
        '',
        0,
        0,
        '',
        '2025-05-13 00:50:35'
    ),
    (
        6,
        'Ales',
        2,
        5,
        5,
        10,
        10,
        10,
        10,
        10,
        10,
        0,
        1,
        NULL,
        0,
        0,
        NULL,
        '2025-05-07 20:48:47'
    ),
    (
        7,
        'Snails',
        2,
        2,
        5,
        10,
        10,
        10,
        14,
        7,
        10,
        0,
        1,
        NULL,
        0,
        0,
        NULL,
        '2025-05-07 20:48:47'
    ),
    (
        10,
        'Leeroy',
        1,
        1,
        5,
        10,
        10,
        10,
        10,
        10,
        10,
        0,
        1,
        NULL,
        0,
        0,
        '',
        '2025-05-07 20:48:47'
    ),
    (
        11,
        'Kelly',
        1,
        1,
        5,
        10,
        10,
        10,
        10,
        10,
        10,
        0,
        1,
        NULL,
        0,
        0,
        '',
        '2025-05-07 20:48:48'
    ),
    (
        25,
        'Ed\'s Pacifist Ethicist',
        6,
        1,
        5,
        1,
        1,
        1,
        1,
        99,
        0,
        0,
        1,
        NULL,
        0,
        0,
        'Not sure how a pacifist ethicist dwarf monk can be helpful here... but what the hell... just experimenting...',
        '2025-05-07 20:48:48'
    ),
    (
        27,
        'Jose',
        3,
        7,
        5,
        10,
        10,
        10,
        10,
        10,
        10,
        0,
        1,
        NULL,
        0,
        0,
        'Some notes!;',
        '2025-05-07 20:48:48'
    ),
    (
        30,
        'Balthazar',
        7,
        2,
        5,
        10,
        10,
        10,
        10,
        10,
        10,
        0,
        1,
        NULL,
        0,
        0,
        '',
        '2025-05-07 20:48:48'
    ),
    (
        31,
        'New Guy',
        8,
        4,
        9,
        10,
        10,
        10,
        10,
        10,
        10,
        66,
        2,
        'Male',
        8,
        5,
        '',
        '2025-05-13 01:47:39'
    );

-- --------------------------------------------------------

--
-- Table structure for table `character_skills`
--

CREATE TABLE `character_skills` (
    `Character_ID` int(11) NOT NULL,
    `Skill_ID` int(11) NOT NULL,
    `Modifier_ID` int(11) NOT NULL,
    `Field_Value` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `character_skills`
--

INSERT INTO
    `character_skills` (
        `Character_ID`,
        `Skill_ID`,
        `Modifier_ID`,
        `Field_Value`
    )
VALUES (1, 1, 1, 3),
    (1, 2, 1, 3),
    (1, 4, 1, 1),
    (1, 6, 1, 1),
    (1, 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
    `Class_ID` int(11) NOT NULL,
    `Class_Name` varchar(20) DEFAULT NULL,
    `Die_ID` int(11) NOT NULL DEFAULT 1
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO
    `classes` (
        `Class_ID`,
        `Class_Name`,
        `Die_ID`
    )
VALUES (1, 'Barbarian', 5),
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
    `Class_ID` int(11) NOT NULL,
    `Skill_ID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `classes_skills`
--

INSERT INTO
    `classes_skills` (`Class_ID`, `Skill_ID`)
VALUES (1, 1),
    (1, 4),
    (1, 5),
    (1, 11),
    (1, 13),
    (1, 20),
    (1, 25),
    (1, 28),
    (1, 33),
    (1, 34),
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 4),
    (2, 5),
    (2, 6),
    (2, 8),
    (2, 9),
    (2, 13),
    (2, 14),
    (2, 15),
    (2, 16),
    (2, 17),
    (2, 18),
    (2, 19),
    (2, 20),
    (2, 21),
    (2, 22),
    (2, 23),
    (2, 24),
    (2, 25),
    (2, 26),
    (2, 27),
    (2, 29),
    (2, 30),
    (2, 31),
    (2, 32),
    (2, 35),
    (3, 2),
    (3, 5),
    (3, 6),
    (3, 12),
    (3, 14),
    (3, 18),
    (3, 21),
    (3, 22),
    (3, 23),
    (3, 24),
    (3, 27),
    (3, 29),
    (3, 31),
    (4, 4),
    (4, 5),
    (4, 10),
    (4, 11),
    (4, 12),
    (4, 17),
    (4, 20),
    (4, 25),
    (4, 27),
    (4, 28),
    (4, 31),
    (4, 33),
    (4, 34),
    (5, 4),
    (5, 5),
    (5, 11),
    (5, 13),
    (5, 15),
    (5, 16),
    (5, 27),
    (5, 28),
    (5, 33),
    (5, 34),
    (6, 1),
    (6, 4),
    (6, 5),
    (6, 9),
    (6, 13),
    (6, 18),
    (6, 23),
    (6, 25),
    (6, 26),
    (6, 27),
    (6, 28),
    (6, 29),
    (6, 32),
    (6, 34),
    (7, 5),
    (7, 6),
    (7, 11),
    (7, 12),
    (7, 21),
    (7, 23),
    (7, 27),
    (7, 28),
    (7, 29),
    (7, 31),
    (8, 4),
    (8, 5),
    (8, 11),
    (8, 12),
    (8, 13),
    (8, 15),
    (8, 17),
    (8, 20),
    (8, 25),
    (8, 27),
    (8, 28),
    (8, 31),
    (8, 32),
    (8, 33),
    (8, 34),
    (9, 1),
    (9, 2),
    (9, 3),
    (9, 4),
    (9, 5),
    (9, 6),
    (9, 7),
    (9, 8),
    (9, 9),
    (9, 13),
    (9, 15),
    (9, 19),
    (9, 24),
    (9, 25),
    (9, 26),
    (9, 27),
    (9, 29),
    (9, 30),
    (9, 32),
    (9, 34),
    (9, 35),
    (10, 2),
    (10, 3),
    (10, 5),
    (10, 10),
    (10, 13),
    (10, 14),
    (10, 27),
    (10, 31),
    (10, 35),
    (11, 2),
    (11, 5),
    (11, 10),
    (11, 14),
    (11, 15),
    (11, 16),
    (11, 17),
    (11, 18),
    (11, 19),
    (11, 20),
    (11, 21),
    (11, 22),
    (11, 23),
    (11, 24),
    (11, 27),
    (11, 31);

-- --------------------------------------------------------

--
-- Table structure for table `dice`
--

CREATE TABLE `dice` (
    `Die_ID` int(11) NOT NULL,
    `Die_Sides` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `dice`
--

INSERT INTO
    `dice` (`Die_ID`, `Die_Sides`)
VALUES (1, 4),
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `feats`
--

INSERT INTO
    `feats` (
        `Feat_ID`,
        `Character_ID`,
        `Feat_Name`,
        `Feat_Desc`
    )
VALUES (
        1,
        1,
        'Simple Weapon Proficiency',
        'You are trained in the use of basic weapons.\r\n\r\nBenefit: You make attack rolls with simple weapons without penalty.\r\n\r\nNormal: When using a weapon with which you are not proficient, you take a –4 penalty on attack rolls.\r\n\r\nSpecial: All characters except for druids, monks, and wizards are automatically proficient with all simple weapons. They need not select this feat.'
    ),
    (
        8,
        10,
        'Hail Mary',
        'You cannot be intimidated or stopped when provoking attacks of opportunity'
    ),
    (
        9,
        10,
        'Exotic Weapon Proficiency (Comically Large Axe)',
        'You are capable of wielding one unique weapon type'
    );

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
    `Inventory_ID` int(11) NOT NULL,
    `Character_ID` int(11) NOT NULL,
    `Item_Name` varchar(255) NOT NULL,
    `Item_Desc` text DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO
    `inventory` (
        `Inventory_ID`,
        `Character_ID`,
        `Item_Name`,
        `Item_Desc`
    )
VALUES (
        21,
        27,
        'Item Test',
        'This is only a test.'
    ),
    (
        22,
        1,
        'Potion',
        'Heals 1d4 HP'
    );

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
    `Wildcard_Mod` bit(1) DEFAULT b'0',
    `Size_ID` int(11) NOT NULL DEFAULT 5
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO
    `races` (
        `Race_ID`,
        `Race_Name`,
        `Str_Mod`,
        `Dex_Mod`,
        `Con_Mod`,
        `Int_Mod`,
        `Wis_Mod`,
        `Cha_Mod`,
        `Wildcard_Mod`,
        `Size_ID`
    )
VALUES (
        1,
        'Dwarf',
        0,
        0,
        2,
        0,
        2,
        -2,
        b'0',
        4
    ),
    (
        2,
        'Elf',
        0,
        2,
        -2,
        2,
        0,
        0,
        b'0',
        5
    ),
    (
        3,
        'Gnome',
        -2,
        0,
        2,
        0,
        0,
        2,
        b'0',
        4
    ),
    (
        4,
        'Half-Elf',
        0,
        0,
        0,
        0,
        0,
        0,
        b'1',
        5
    ),
    (
        5,
        'Halfling',
        -2,
        2,
        0,
        0,
        0,
        2,
        b'0',
        4
    ),
    (
        6,
        'Half-Orc',
        0,
        0,
        0,
        0,
        0,
        0,
        b'1',
        5
    ),
    (
        7,
        'Human',
        0,
        0,
        0,
        0,
        0,
        0,
        b'1',
        5
    );

-- --------------------------------------------------------

--
-- Table structure for table `shields`
--

CREATE TABLE `shields` (
    `Shield_ID` int(11) NOT NULL,
    `Character_ID` int(11) NOT NULL,
    `Shield_Name` varchar(255) NOT NULL,
    `Shield_ACP` int(11) DEFAULT NULL,
    `Shield_Weight` int(11) DEFAULT NULL,
    `Shield_AC` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO
    `sizes` (
        `Size_ID`,
        `Size_Name`,
        `Size_Modifier`,
        `Special_Size_Mod`,
        `Fly_Modifier`,
        `Stealth_Modifier`,
        `Space`,
        `Natural_Reach`,
        `Typical_height_Length`,
        `Typical_Weight`
    )
VALUES (
        1,
        'Fine',
        8,
        -8,
        8,
        16,
        0.5,
        0,
        '6\" or less',
        '1/8lb. or less'
    ),
    (
        2,
        'Diminutive',
        4,
        -4,
        6,
        12,
        1,
        0,
        '6\" to 1 ft.',
        '1/8 lb. - 1 lb.'
    ),
    (
        3,
        'Tiny',
        2,
        -2,
        4,
        8,
        2.5,
        0,
        '1\' to 2 ft.',
        '1-8 lbs.'
    ),
    (
        4,
        'Small',
        1,
        -1,
        2,
        4,
        5,
        5,
        '2\' to 4 ft.',
        '8-60 lbs.'
    ),
    (
        5,
        'Medium',
        0,
        0,
        0,
        0,
        5,
        5,
        '4\' to 8 ft.',
        '60-500 lbs.'
    ),
    (
        6,
        'Large (tall)',
        -1,
        1,
        -2,
        -4,
        10,
        10,
        '8\' to 16 ft.',
        '500-4000 lbs.'
    ),
    (
        7,
        'Large (long)',
        -1,
        1,
        -2,
        -4,
        10,
        5,
        '8\' to 16 ft.',
        '500-4000 lbs.'
    ),
    (
        8,
        'Huge (tall)',
        -2,
        2,
        -4,
        -8,
        15,
        15,
        '16\' to 32 ft.',
        '2-16 tons'
    ),
    (
        9,
        'Huge (long)',
        -2,
        2,
        -4,
        -8,
        15,
        10,
        '16\' to 32 ft.',
        '2-16 tons'
    ),
    (
        10,
        'Gargantuan (tall)',
        -4,
        4,
        -6,
        -12,
        20,
        20,
        '32\' to 64 ft.',
        '16-125 tons'
    ),
    (
        11,
        'Gargantuan (long)',
        -4,
        4,
        -6,
        -12,
        20,
        15,
        '32\' to 64 ft.',
        '16-125 tons'
    ),
    (
        12,
        'Colossal (tall)',
        -8,
        8,
        -8,
        -16,
        30,
        30,
        '64 ft. or more',
        '125 tons or more'
    ),
    (
        13,
        'Colossal (long)',
        -8,
        8,
        -8,
        -16,
        30,
        20,
        '64 ft. or more',
        '125 tons or more'
    );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO
    `skills` (
        `Skill_ID`,
        `Skill_Name`,
        `Ability_ID`,
        `Is_Untrained`,
        `Armored_Penalty`,
        `Short_Name`
    )
VALUES (
        1,
        'Acrobatics',
        2,
        b'1',
        b'1',
        'Acrob'
    ),
    (
        2,
        'Appraise',
        4,
        b'1',
        b'0',
        'Appra'
    ),
    (
        3,
        'Bluff',
        6,
        b'1',
        b'0',
        'Bluff'
    ),
    (
        4,
        'Climb',
        1,
        b'1',
        b'1',
        'Climb'
    ),
    (
        5,
        'Craft',
        4,
        b'1',
        b'0',
        'Craft'
    ),
    (
        6,
        'Diplomacy',
        6,
        b'1',
        b'0',
        'Diplo'
    ),
    (
        7,
        'Disable Device',
        2,
        b'0',
        b'1',
        'DsDev'
    ),
    (
        8,
        'Disguise',
        6,
        b'1',
        b'0',
        'Disgu'
    ),
    (
        9,
        'Escape Artist',
        2,
        b'1',
        b'1',
        'Escar'
    ),
    (
        10,
        'Fly',
        2,
        b'1',
        b'1',
        'Fly'
    ),
    (
        11,
        'Handle Animal',
        6,
        b'0',
        b'0',
        'Hanim'
    ),
    (
        12,
        'Heal',
        5,
        b'1',
        b'0',
        'Heal'
    ),
    (
        13,
        'Intimidate',
        6,
        b'1',
        b'0',
        'Intim'
    ),
    (
        14,
        'Knowledge (arcana)',
        4,
        b'0',
        b'0',
        'Karca'
    ),
    (
        15,
        'Knowledge (dungeoneering)',
        4,
        b'0',
        b'0',
        'Kdung'
    ),
    (
        16,
        'Knowledge (engineering)',
        4,
        b'0',
        b'0',
        'Kengi'
    ),
    (
        17,
        'Knowledge (geography)',
        4,
        b'0',
        b'0',
        'Kgeog'
    ),
    (
        18,
        'Knowledge (history)',
        4,
        b'0',
        b'0',
        'Khist'
    ),
    (
        19,
        'Knowledge (local)',
        4,
        b'0',
        b'0',
        'Kloca'
    ),
    (
        20,
        'Knowledge (nature)',
        4,
        b'0',
        b'0',
        'Knatu'
    ),
    (
        21,
        'Knowledge (nobility)',
        4,
        b'0',
        b'0',
        'Knobi'
    ),
    (
        22,
        'Knowledge (planes)',
        4,
        b'0',
        b'0',
        'Kplan'
    ),
    (
        23,
        'Knowledge (religion)',
        4,
        b'0',
        b'0',
        'Kreli'
    ),
    (
        24,
        'Linguistics',
        4,
        b'0',
        b'0',
        'Lingu'
    ),
    (
        25,
        'Perception',
        5,
        b'1',
        b'0',
        'Perce'
    ),
    (
        26,
        'Perform',
        6,
        b'1',
        b'0',
        'Perfo'
    ),
    (
        27,
        'Profession',
        5,
        b'0',
        b'0',
        'Profe'
    ),
    (
        28,
        'Ride',
        2,
        b'1',
        b'1',
        'Ride'
    ),
    (
        29,
        'Sense Motive',
        5,
        b'1',
        b'0',
        'Senmo'
    ),
    (
        30,
        'Sleight of Hand',
        2,
        b'0',
        b'1',
        'SOH'
    ),
    (
        31,
        'Spellcraft',
        4,
        b'0',
        b'0',
        'Spcft'
    ),
    (
        32,
        'Stealth',
        2,
        b'1',
        b'1',
        'Stlth'
    ),
    (
        33,
        'Survival',
        4,
        b'1',
        b'0',
        'Survi'
    ),
    (
        34,
        'Swim',
        1,
        b'1',
        b'1',
        'Swim'
    ),
    (
        35,
        'Use Magic Device',
        6,
        b'0',
        b'0',
        'Umdev'
    );

-- --------------------------------------------------------

--
-- Table structure for table `skill_modifiers`
--

CREATE TABLE `skill_modifiers` (
    `Modifier_ID` int(11) NOT NULL,
    `Mod_Name` tinytext NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `skill_modifiers`
--

INSERT INTO
    `skill_modifiers` (`Modifier_ID`, `Mod_Name`)
VALUES (1, 'Ranks'),
    (2, 'Racial'),
    (3, 'Feats'),
    (4, 'Misc');

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE `weapons` (
    `Wpn_ID` int(11) NOT NULL,
    `Character_ID` int(11) NOT NULL,
    `Wpn_Name` varchar(255) NOT NULL,
    `Wpn_Type` varchar(255) DEFAULT NULL,
    `Wpn_Range` int(11) DEFAULT NULL,
    `Wpn_Atk_Bonus` int(11) DEFAULT NULL,
    `Wpn_Die_Count` int(11) DEFAULT NULL,
    `Die_ID` int(11) DEFAULT NULL,
    `Crit_Range` int(11) DEFAULT NULL,
    `Crit_Multi` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities` ADD PRIMARY KEY (`Ability_ID`);

--
-- Indexes for table `alignments`
--
ALTER TABLE `alignments` ADD PRIMARY KEY (`Alignment_ID`);

--
-- Indexes for table `armor`
--
ALTER TABLE `armor`
ADD PRIMARY KEY (`Armor_ID`),
ADD KEY `Character_ID` (`Character_ID`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
ADD PRIMARY KEY (`Character_ID`),
ADD KEY `FK_Character_Class` (`Class_ID`),
ADD KEY `FK_Character_Race` (`Race_ID`),
ADD KEY `FK_Character_Alignment` (`Alignment_ID`);

--
-- Indexes for table `character_skills`
--
ALTER TABLE `character_skills`
ADD PRIMARY KEY (
    `Character_ID`,
    `Skill_ID`,
    `Modifier_ID`
),
ADD KEY `FK_CS_Skill_ID` (`Skill_ID`),
ADD KEY `FK_CS_Modifier_ID` (`Modifier_ID`);

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
ADD PRIMARY KEY (`Class_ID`, `Skill_ID`),
ADD KEY `Skill_ID` (`Skill_ID`);

--
-- Indexes for table `dice`
--
ALTER TABLE `dice` ADD PRIMARY KEY (`Die_ID`);

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
ADD PRIMARY KEY (`Inventory_ID`),
ADD KEY `FK_Inv_Character` (`Character_ID`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
ADD PRIMARY KEY (`Race_ID`),
ADD KEY `FK_Race_Size` (`Size_ID`);

--
-- Indexes for table `shields`
--
ALTER TABLE `shields`
ADD PRIMARY KEY (`Shield_ID`),
ADD KEY `Character_ID` (`Character_ID`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes` ADD PRIMARY KEY (`Size_ID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
ADD PRIMARY KEY (`Skill_ID`),
ADD KEY `Ability_ID` (`Ability_ID`);

--
-- Indexes for table `skill_modifiers`
--
ALTER TABLE `skill_modifiers` ADD PRIMARY KEY (`Modifier_ID`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
ADD PRIMARY KEY (`Wpn_ID`),
ADD KEY `Character_ID` (`Character_ID`),
ADD KEY `Die_ID` (`Die_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
MODIFY `Ability_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `armor`
--
ALTER TABLE `armor`
MODIFY `Armor_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
MODIFY `Character_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 32;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 12;

--
-- AUTO_INCREMENT for table `dice`
--
ALTER TABLE `dice`
MODIFY `Die_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `feats`
--
ALTER TABLE `feats`
MODIFY `Feat_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `Inventory_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 25;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
MODIFY `Race_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `shields`
--
ALTER TABLE `shields`
MODIFY `Shield_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
MODIFY `Size_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
MODIFY `Skill_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 36;

--
-- AUTO_INCREMENT for table `skill_modifiers`
--
ALTER TABLE `skill_modifiers`
MODIFY `Modifier_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
MODIFY `Wpn_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armor`
--
ALTER TABLE `armor`
ADD CONSTRAINT `armor_ibfk_1` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
ADD CONSTRAINT `FK_Character_Alignment` FOREIGN KEY (`Alignment_ID`) REFERENCES `alignments` (`Alignment_ID`),
ADD CONSTRAINT `FK_Character_Class` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
ADD CONSTRAINT `FK_Character_Race` FOREIGN KEY (`Race_ID`) REFERENCES `races` (`Race_ID`);

--
-- Constraints for table `character_skills`
--
ALTER TABLE `character_skills`
ADD CONSTRAINT `FK_CS_Character_ID` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`),
ADD CONSTRAINT `FK_CS_Modifier_ID` FOREIGN KEY (`Modifier_ID`) REFERENCES `skill_modifiers` (`Modifier_ID`),
ADD CONSTRAINT `FK_CS_Skill_ID` FOREIGN KEY (`Skill_ID`) REFERENCES `skills` (`Skill_ID`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
ADD CONSTRAINT `FK_Class_Die` FOREIGN KEY (`Die_ID`) REFERENCES `dice` (`Die_ID`);

--
-- Constraints for table `classes_skills`
--
ALTER TABLE `classes_skills`
ADD CONSTRAINT `classes_skills_ibfk_1` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`),
ADD CONSTRAINT `classes_skills_ibfk_2` FOREIGN KEY (`Skill_ID`) REFERENCES `skills` (`Skill_ID`);

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

--
-- Constraints for table `races`
--
ALTER TABLE `races`
ADD CONSTRAINT `FK_Race_Size` FOREIGN KEY (`Size_ID`) REFERENCES `sizes` (`Size_ID`);

--
-- Constraints for table `shields`
--
ALTER TABLE `shields`
ADD CONSTRAINT `shields_ibfk_1` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`Ability_ID`) REFERENCES `abilities` (`Ability_ID`);

--
-- Constraints for table `weapons`
--
ALTER TABLE `weapons`
ADD CONSTRAINT `weapons_ibfk_1` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`),
ADD CONSTRAINT `weapons_ibfk_2` FOREIGN KEY (`Die_ID`) REFERENCES `dice` (`Die_ID`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
