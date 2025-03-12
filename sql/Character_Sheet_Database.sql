/*
-----------------------------------------------------------------------------------------------
Name:       Character_Sheet_Database.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-03-07
Language:   SQL
System:     MySQL 8.2.12
Purpose:    This code generates the database for the Character Manager project. Any changes to
            the database design MUST be reflected here and logged in the change log below.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-03-07      Original Version
CBAC        2025-03-08      Added values for the `classes` and `skills` tables
-----------------------------------------------------------------------------------------------
*/

DROP DATABASE IF EXISTS `Character_Manager`;
CREATE DATABASE `Character_Manager`;
USE `Character_Manager`;

-- The Abilities table
CREATE Table `abilities` (
    `Ability_ID`        INT NOT NULL AUTO_INCREMENT,
    `Ability_Name`      VARCHAR(12) NOT NULL,
    `Ability_Short`     CHAR(3) NOT NULL,
    PRIMARY KEY (`Ability_ID`)
);

INSERT INTO `abilities`
    (`Ability_Name`,`Ability_Short`) 
VALUES
    ('Strength',              'STR'),
    ('Dexterity',             'DEX'),
    ('Constitution',          'CON'),
    ('Intelligence',          'INT'),
    ('Wisdom',                'WIS'),
    ('Charisma',              'CHA');

-- The Characters table
CREATE TABLE `characters` (
    `Character_ID`      INT NOT NULL AUTO_INCREMENT,
    `Character_Name`    VARCHAR(100),
    `Class_ID`          INT DEFAULT 1 NOT NULL, -- Link to `classes` table
    `Race_ID`           INT DEFAULT 1 NOT NULL, -- Link to `races` table
    `Str_Base`          INT DEFAULT 0,
    `Dex_Base`          INT DEFAULT 0,
    `Con_Base`          INT DEFAULT 0,
    `Int_Base`          INT DEFAULT 0,
    `Wis_Base`          INT DEFAULT 0,
    `Cha_Base`          INT DEFAULT 0,
    PRIMARY KEY (`Character_ID`)
);

-- Sample Character
INSERT INTO
    `characters` (
        `Character_Name`,
        `Class_ID`,
        `Race_ID`,
        `Str_Base`,
        `Dex_Base`,
        `Con_Base`,
        `Int_Base`,
        `Wis_Base`,
        `Cha_Base`
    )
VALUES (
        'Conan',
        1,
        7,
        14,
        13,
        15,
        10,
        12,
        8
    );

-- The Classes table
CREATE TABLE `classes` (
    `Class_ID`          INT NOT NULL AUTO_INCREMENT,
    `Class_Name`        VARCHAR(20),
    `Die_ID`            INT DEFAULT 1 NOT NULL, -- Link to `dice` table
    PRIMARY KEY (`Class_ID`)
);

-- Add core classes to Classes table
INSERT INTO
    `classes` (`Class_Name`, `Die_ID`)
VALUES ('Barbarian', 5),
    ('Bard', 3),
    ('Cleric', 3),
    ('Druid', 3),
    ('Fighter', 4),
    ('Monk', 3),
    ('Paladin', 4),
    ('Ranger', 4),
    ('Rogue', 3),
    ('Sorcerer', 2),
    ('Wizard', 2);

-- The Races table
CREATE TABLE `races` (
    `Race_ID`           INT NOT NULL AUTO_INCREMENT,
    `Race_Name`         VARCHAR(20) NOT NULL,
    `Str_Mod`           INT DEFAULT 0,
    `Dex_Mod`           INT DEFAULT 0,
    `Con_Mod`           INT DEFAULT 0,
    `Int_Mod`           INT DEFAULT 0,
    `Wis_Mod`           INT DEFAULT 0,
    `Cha_Mod`           INT DEFAULT 0,
    `Wildcard_Mod`      BIT(1) DEFAULT 0, -- using 1 bit for boolean
    PRIMARY KEY (`Race_ID`)
);

INSERT INTO `races` 
    (`Race_Name`, `Str_Mod`, `Dex_Mod`, `Con_Mod`, `Int_Mod`, `Wis_Mod`, `Cha_Mod`, `Wildcard_Mod`)
VALUES -- Core races
    ('Dwarf',             0,         0,         2,         0,         2,        -2,              0),
    ('Elf',               0,         2,        -2,         2,         0,         0,              0),
    ('Gnome',            -2,         0,         2,         0,         0,         2,              0),
    ('Half-Elf',          0,         0,         0,         0,         0,         0,              1),
    ('Halfling',         -2,         2,         0,         0,         0,         2,              0),
    ('Half-Orc',          0,         0,         0,         0,         0,         0,              1),
    ('Human',             0,         0,         0,         0,         0,         0,              1);

-- The Skills table
CREATE TABLE `skills` (
    `Skill_ID`          INT NOT NULL AUTO_INCREMENT,
    `Skill_Name`        VARCHAR(50),
    `Ability_ID`        INT DEFAULT 0, -- Link to `abilities` table
    `Is_Untrained`      BIT(1) DEFAULT 0,
    `Armored_Penalty`   BIT(1) DEFAULT 0,
    PRIMARY KEY (`Skill_ID`)
);

INSERT INTO `skills` 
    (`Skill_Name`, `Ability_ID`, `Is_Untrained`, `Armored_Penalty`) 
VALUES
    ('Acrobatics',                  2, 1, 1),
    ('Appraise',                    4, 1, 0),
    ('Bluff',                       6, 1, 0),
    ('Climb',                       1, 1, 1),
    ('Craft',                       4, 1, 0), -- possible refactor coming.
    ('Diplomacy',                   6, 1, 0),
    ('Disable Device',              2, 0, 1),
    ('Disguise',                    6, 1, 0),
    ('Escape Artist',               2, 1, 1),
    ('Fly',                         2, 1, 1),
    ('Handle Animal',               6, 0, 0),
    ('Heal',                        5, 1, 0),
    ('Intimidate',                  6, 1, 0),
    ('Knowledge (arcana)',          4, 0, 0),
    ('Knowledge (dungeoneering)',   4, 0, 0), 
    ('Knowledge (engineering)',     4, 0, 0),
    ('Knowledge (geography)',       4, 0, 0),
    ('Knowledge (history)',         4, 0, 0),
    ('Knowledge (local)',           4, 0, 0),
    ('Knowledge (nature)',          4, 0, 0),
    ('Knowledge (nobility)',        4, 0, 0),
    ('Knowledge (planes)',          4, 0, 0),
    ('Knowledge (religion)',        4, 0, 0),
    ('Linguistics',                 4, 0, 0),
    ('Perception',                  5, 1, 0),
    ('Perform',                     6, 1, 0), -- possible refactor coming.
    ('Profession',                  5, 0, 0), -- possible refactor coming.
    ('Ride',                        2, 1, 1),
    ('Sense Motive',                5, 1, 0),
    ('Sleight of Hand',             2, 0, 1),
    ('Spellcraft',                  4, 0, 0),
    ('Stealth',                     2, 1, 1),
    ('Survival',                    4, 1, 0),
    ('Swim',                        1, 1, 1),
    ('Use Magic Device',            6, 0, 0);

-- The Dice table        
CREATE TABLE `dice` (
    `Die_ID`            INT NOT NULL AUTO_INCREMENT,
    `Die_Sides`         INT NOT NULL,
    PRIMARY KEY (`Die_ID`)
);

INSERT INTO `dice` (`Die_Sides`)
VALUES (4), (6), (8), (10), (12), (20), (100);

-- The Class Skills table
CREATE TABLE `classes_skills` (
    `C_S_ID`            INT NOT NULL AUTO_INCREMENT,
    `Class_ID`          INT NOT NULL, -- Link to `classes` table
    `Skill_ID`          INT NOT NULL, -- Link to `skills` table
    PRIMARY KEY (`C_S_ID`)
);

INSERT INTO `classes_skills` (`Class_ID`, `Skill_ID`)
VALUES
    -- CORE CLASSES. Barbarian
    (1, 1),
    (1, 4),
    (1, 5),
    (1, 11),
    (1, 13),
    (1, 20),
    (1, 25),
    (1, 28),
    (1, 33),
    (1, 34);

-- Foreign Key Constraints
-- Character class relations
ALTER TABLE `characters`
ADD CONSTRAINT `FK_Character_Class`
FOREIGN KEY (`Class_ID`) REFERENCES `Classes`(`Class_ID`);

-- Character race relations
ALTER TABLE `characters`
ADD CONSTRAINT `FK_Character_Race`
FOREIGN KEY (`Race_ID`) REFERENCES `Races`(`Race_ID`);

-- Class hit die relations
ALTER TABLE `classes`
ADD CONSTRAINT `FK_Class_Die`
FOREIGN KEY (`Die_ID`) REFERENCES `Dice`(`Die_ID`);

-- Class skills relations
ALTER TABLE `classes_skills`
ADD CONSTRAINT `FK_CS_Classes`
Foreign Key (`Class_ID`) REFERENCES `classes`(`Class_ID`);

ALTER TABLE `classes_skills`
ADD CONSTRAINT `FK_CS_Skills`
Foreign Key (`Skill_ID`) REFERENCES `skills`(`Skill_ID`);
