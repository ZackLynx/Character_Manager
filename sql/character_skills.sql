/*
-----------------------------------------------------------------------------------------------
Name:       character_skills.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-04-22
Language:   SQL
System:     MySQL 8.2.12
Purpose:    Creates and populates a table with the non-zero values of skills. Avoid using
strings as keys as this could lead to performance issues.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-04-22      Original Version
CBAC        2025-04-26      Added Foreign Key constraints.
CBAC        2025-04-27      `character_skills` now uses a 3 key composite key.
-----------------------------------------------------------------------------------------------
*/

DROP TABLE IF EXISTS `character_skills`;
DROP TABLE IF EXISTS `skill_modifiers`;

CREATE TABLE `skill_modifiers` (
    Modifier_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Mod_Name text(11) NOT NULL
);

INSERT INTO
    `skill_modifiers` (Mod_Name)
VALUES ('Ranks'),
    ('Racial'),
    ('Feats'),
    ('Misc');

/* 
    Use PHP to populate this table.
    We will use Composite keys to uniquely identify a field and value.
*/
CREATE TABLE `character_skills` (
    Character_ID INT NOT NULL,
    Skill_ID INT NOT NULL,
    Modifier_ID INT NOT NULL,
    Field_Value INT,
    PRIMARY KEY (Character_ID, Skill_ID, Modifier_ID)
);

ALTER TABLE `character_skills`
ADD CONSTRAINT `FK_CS_Character_ID` FOREIGN KEY (Character_ID) REFERENCES `characters` (Character_ID);

ALTER TABLE `character_skills`
ADD CONSTRAINT `FK_CS_Skill_ID` FOREIGN KEY (Skill_ID) REFERENCES `skills` (Skill_ID);

ALTER TABLE `character_skills`
ADD CONSTRAINT `FK_CS_Modifier_ID` FOREIGN KEY (Modifier_ID) REFERENCES `skill_modifiers` (Modifier_ID);

/* The following is for testing. */
-- REPLACE INTO `character_skills` (Character_ID, Skill_ID, Modifier_ID, Field_Value)
-- VALUES (1, 1, 1, 1);
