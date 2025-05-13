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
CBAC        2025-05-06      Completed inclusion of all 11 core classes class skills
CBAC        2025-05-07      Successful draft of new query for getting class skills
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
    PRIMARY KEY (
        Character_ID,
        Skill_ID,
        Modifier_ID
    )
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

DROP TABLE IF EXISTS `classes_skills`;

CREATE TABLE `classes_skills` (
    Class_ID INT NOT NULL,
    Skill_ID INT NOT NULL,
    PRIMARY KEY (Class_ID, Skill_ID),
    FOREIGN KEY (Class_ID) REFERENCES `classes` (Class_ID),
    FOREIGN KEY (Skill_ID) REFERENCES `skills` (Skill_ID)
);

INSERT INTO
    `classes_skills` (Class_ID, Skill_ID)
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

SELECT classes_skills.`Class_ID`, GROUP_CONCAT(
        skills.`Short_Name`
        ORDER BY skills.`Skill_ID` SEPARATOR ', '
    ) AS Skill_IDs
FROM classes_skills, skills
WHERE
    classes_skills.`Skill_ID` = skills.`Skill_ID`
GROUP BY
    `Class_ID`;

ALTER TABLE `skills`
ADD FOREIGN KEY (Ability_ID) REFERENCES `abilities` (Ability_ID);
