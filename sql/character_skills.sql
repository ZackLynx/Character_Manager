/*
-----------------------------------------------------------------------------------------------
Name:       character_skills.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-04-22
Language:   SQL
System:     MySQL 8.2.12
Purpose:    Creates and populates a table with the non-zero values of skills.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-04-22      Original Version
-----------------------------------------------------------------------------------------------
*/

DROP TABLE IF EXISTS `character_skills`;

CREATE TABLE `character_skills` (
    C_S_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Skill_ID INT NOT NULL, /* Skills Table */
    Mod_ID INT NOT NULL, /* skill_mods table */
    Skill_Mod INT
);

DROP TABLE IF EXISTS `skill_mods`;

CREATE TABLE `skill_mods` (
    Mod_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Mod_Name text(11) NOT NULL
);

INSERT INTO `skill_mods` (Mod_Name) VALUES 
    ('Ranks'), ('Racial'), ('Feats'), ('Misc');

