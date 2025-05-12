/*
-----------------------------------------------------------------------------------------------
Name:       characters_changes_may.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-05-01
Language:   SQL
System:     MySQL 8.2.12
Purpose:    This contains query's to modify the `characters` table in preparation of semester 
finals.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-05-01      Original Version with dropped skills columns and added a character
level value
CBAC        2025-05-04      adding Size_ID to Races.
CBAC        2025-05-11      Adding alignment for `characters`.
CBAC        2025-05-12      Added Health Points and Experience Points for `characters`.
-----------------------------------------------------------------------------------------------
*/

ALTER TABLE `characters`
DROP COLUMN `Acrob_Ranks`,
DROP COLUMN `Acrob_Racial`,
DROP COLUMN `Acrob_Feats`,
DROP COLUMN `Acrob_Misc`,
DROP COLUMN `Appra_Ranks`,
DROP COLUMN `Appra_Racial`,
DROP COLUMN `Appra_Feats`,
DROP COLUMN `Appra_Misc`,
DROP COLUMN `Bluff_Ranks`,
DROP COLUMN `Bluff_Racial`,
DROP COLUMN `Bluff_Feats`,
DROP COLUMN `Bluff_Misc`,
DROP COLUMN `Climb_Ranks`,
DROP COLUMN `Climb_Racial`,
DROP COLUMN `Climb_Feats`,
DROP COLUMN `Climb_Misc`,
DROP COLUMN `Craft_Ranks`,
DROP COLUMN `Craft_Racial`,
DROP COLUMN `Craft_Feats`,
DROP COLUMN `Craft_Misc`,
DROP COLUMN `Diplo_Ranks`,
DROP COLUMN `Diplo_Racial`,
DROP COLUMN `Diplo_Feats`,
DROP COLUMN `Diplo_Misc`,
DROP COLUMN `DsDev_Ranks`,
DROP COLUMN `DsDev_Racial`,
DROP COLUMN `DsDev_Feats`,
DROP COLUMN `DsDev_Misc`,
DROP COLUMN `Disgu_Ranks`,
DROP COLUMN `Disgu_Racial`,
DROP COLUMN `Disgu_Feats`,
DROP COLUMN `Disgu_Misc`,
DROP COLUMN `Escar_Ranks`,
DROP COLUMN `Escar_Racial`,
DROP COLUMN `Escar_Feats`,
DROP COLUMN `Escar_Misc`,
DROP COLUMN `Fly_Ranks`,
DROP COLUMN `Fly_Racial`,
DROP COLUMN `Fly_Feats`,
DROP COLUMN `Fly_Misc`,
DROP COLUMN `Hanim_Ranks`,
DROP COLUMN `Hanim_Racial`,
DROP COLUMN `Hanim_Feats`,
DROP COLUMN `Hanim_Misc`,
DROP COLUMN `Heal_Ranks`,
DROP COLUMN `Heal_Racial`,
DROP COLUMN `Heal_Feats`,
DROP COLUMN `Heal_Misc`,
DROP COLUMN `Intim_Ranks`,
DROP COLUMN `Intim_Racial`,
DROP COLUMN `Intim_Feats`,
DROP COLUMN `Intim_Misc`,
DROP COLUMN `Karca_Ranks`,
DROP COLUMN `Karca_Racial`,
DROP COLUMN `Karca_Feats`,
DROP COLUMN `Karca_Misc`,
DROP COLUMN `Kdung_Ranks`,
DROP COLUMN `Kdung_Racial`,
DROP COLUMN `Kdung_Feats`,
DROP COLUMN `Kdung_Misc`,
DROP COLUMN `Kengi_Ranks`,
DROP COLUMN `Kengi_Racial`,
DROP COLUMN `Kengi_Feats`,
DROP COLUMN `Kengi_Misc`,
DROP COLUMN `Kgeog_Ranks`,
DROP COLUMN `Kgeog_Racial`,
DROP COLUMN `Kgeog_Feats`,
DROP COLUMN `Kgeog_Misc`,
DROP COLUMN `Khist_Ranks`,
DROP COLUMN `Khist_Racial`,
DROP COLUMN `Khist_Feats`,
DROP COLUMN `Khist_Misc`,
DROP COLUMN `Kloca_Ranks`,
DROP COLUMN `Kloca_Racial`,
DROP COLUMN `Kloca_Feats`,
DROP COLUMN `Kloca_Misc`,
DROP COLUMN `Knatu_Ranks`,
DROP COLUMN `Knatu_Racial`,
DROP COLUMN `Knatu_Feats`,
DROP COLUMN `Knatu_Misc`,
DROP COLUMN `Knobi_Ranks`,
DROP COLUMN `Knobi_Racial`,
DROP COLUMN `Knobi_Feats`,
DROP COLUMN `Knobi_Misc`,
DROP COLUMN `Kplan_Ranks`,
DROP COLUMN `Kplan_Racial`,
DROP COLUMN `Kplan_Feats`,
DROP COLUMN `Kplan_Misc`,
DROP COLUMN `Kreli_Ranks`,
DROP COLUMN `Kreli_Racial`,
DROP COLUMN `Kreli_Feats`,
DROP COLUMN `Kreli_Misc`,
DROP COLUMN `Lingu_Ranks`,
DROP COLUMN `Lingu_Racial`,
DROP COLUMN `Lingu_Feats`,
DROP COLUMN `Lingu_Misc`,
DROP COLUMN `Perce_Ranks`,
DROP COLUMN `Perce_Racial`,
DROP COLUMN `Perce_Feats`,
DROP COLUMN `Perce_Misc`,
DROP COLUMN `Perfo_Ranks`,
DROP COLUMN `Perfo_Racial`,
DROP COLUMN `Perfo_Feats`,
DROP COLUMN `Perfo_Misc`,
DROP COLUMN `Profe_Ranks`,
DROP COLUMN `Profe_Racial`,
DROP COLUMN `Profe_Feats`,
DROP COLUMN `Profe_Misc`,
DROP COLUMN `Ride_Ranks`,
DROP COLUMN `Ride_Racial`,
DROP COLUMN `Ride_Feats`,
DROP COLUMN `Ride_Misc`,
DROP COLUMN `Senmo_Ranks`,
DROP COLUMN `Senmo_Racial`,
DROP COLUMN `Senmo_Feats`,
DROP COLUMN `Senmo_Misc`,
DROP COLUMN `SOH_Ranks`,
DROP COLUMN `SOH_Racial`,
DROP COLUMN `SOH_Feats`,
DROP COLUMN `SOH_Misc`,
DROP COLUMN `Spcft_Ranks`,
DROP COLUMN `Spcft_Racial`,
DROP COLUMN `Spcft_Feats`,
DROP COLUMN `Spcft_Misc`,
DROP COLUMN `Stlth_Ranks`,
DROP COLUMN `Stlth_Racial`,
DROP COLUMN `Stlth_Feats`,
DROP COLUMN `Stlth_Misc`,
DROP COLUMN `Survi_Ranks`,
DROP COLUMN `Survi_Racial`,
DROP COLUMN `Survi_Feats`,
DROP COLUMN `Survi_Misc`,
DROP COLUMN `Swim_Ranks`,
DROP COLUMN `Swim_Racial`,
DROP COLUMN `Swim_Feats`,
DROP COLUMN `Swim_Misc`,
DROP COLUMN `Umdev_Ranks`,
DROP COLUMN `Umdev_Racial`,
DROP COLUMN `Umdev_Feats`,
DROP COLUMN `Umdev_Misc`;

ALTER TABLE `characters`
ADD COLUMN IF NOT EXISTS `Character_Level` INT NOT NULL DEFAULT 1,
ADD COLUMN IF NOT EXISTS `Size_ID` INT NOT NULL DEFAULT 5, -- Medium
ADD COLUMN IF NOT EXISTS `Gender` VARCHAR(16);

DROP TABLE IF EXISTS `sizes`;

CREATE TABLE `sizes` (
    `Size_ID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Size_Name` VARCHAR(20) NOT NULL,
    `Size_Modifier` INT NOT NULL,
    `Special_Size_Mod` INT NOT NULL,
    `Fly_Modifier` INT NOT NULL,
    `Stealth_Modifier` INT NOT NULL,
    `Space` FLOAT NOT NULL,
    `Natural_Reach` INT NOT NULL,
    `Typical_height_Length` VARCHAR(16) NOT NULL,
    `Typical_Weight` VARCHAR(16) NOT NULL
);

INSERT INTO `sizes` (`Size_Name`, `Size_Modifier`, `Special_Size_Mod`, `Fly_Modifier`, `Stealth_Modifier`, `Space`, `Natural_Reach`, `Typical_height_Length`, `Typical_Weight`)
VALUES 
    ('Fine',                8,      -8,     8,      16,     .5,          0,      '6\" or less',      '1/8lb. or less'),
    ('Diminutive',          4,      -4,     6,      12,     1,           0,      '6\" to 1 ft.',     '1/8 lb. - 1 lb.'),
    ('Tiny',                2,      -2,     4,      8,      2.5,         0,      '1\' to 2 ft.',     '1-8 lbs.'),
    ('Small',               1,      -1,     2,      4,      5,           5,      '2\' to 4 ft.',     '8-60 lbs.'),
    ('Medium',              0,      0,      0,      0,      5,           5,      '4\' to 8 ft.',     '60-500 lbs.'),
    ('Large (tall)',        -1,     1,      -2,     -4,     10,          10,     '8\' to 16 ft.',    '500-4000 lbs.'),
    ('Large (long)',        -1,     1,      -2,     -4,     10,          5,      '8\' to 16 ft.',    '500-4000 lbs.'),
    ('Huge (tall)',         -2,     2,      -4,     -8,     15,          15,     '16\' to 32 ft.',   '2-16 tons'),
    ('Huge (long)',         -2,     2,      -4,     -8,     15,          10,     '16\' to 32 ft.',   '2-16 tons'),
    ('Gargantuan (tall)',   -4,     4,      -6,     -12,    20,          20,     '32\' to 64 ft.',   '16-125 tons'),
    ('Gargantuan (long)',   -4,     4,      -6,     -12,    20,          15,     '32\' to 64 ft.',   '16-125 tons'),
    ('Colossal (tall)',     -8,     8,      -8,     -16,    30,          30,     '64 ft. or more',   '125 tons or more'),
    ('Colossal (long)',     -8,     8,      -8,     -16,    30,          20,     '64 ft. or more',   '125 tons or more');

ALTER TABLE `races` ADD COLUMN Size_ID INT NOT NULL DEFAULT 5;

ALTER TABLE `races`
ADD CONSTRAINT `FK_Race_Size` FOREIGN KEY (Size_ID) REFERENCES `sizes` (Size_ID);

-- Set Dwarves, Gnomes, and Halflings to small (4)
UPDATE `races`
SET
    Size_ID = 4
WHERE
    Race_ID = 1
    OR Race_ID = 3
    OR Race_ID = 5;

DROP TABLE IF EXISTS `alignments`;

CREATE TABLE `alignments` (
    Alignment_ID INT NOT NULL PRIMARY KEY,
    Alignment_Name VARCHAR(16)
)

INSERT INTO
    `alignments` (Alignment_ID, Alignment_Name)
VALUES (1, "Lawful Good"),
    (2, "Neutral Good"),
    (3, "Chaotic Good"),
    (4, "Lawful Neutral"),
    (5, "True Neutral"),
    (6, "Chaotic Neutral"),
    (7, "Lawful Evil"),
    (8, "Neutral Evil"),
    (9, "Chaotic Evil");

ALTER TABLE `characters`
ADD COLUMN Alignment_ID INT NOT NULL DEFAULT 5,
ADD COLUMN Max_HP INT UNSIGNED NOT NULL DEFAULT 0,
ADD COLUMN Current_HP INT NOT NULL DEFAULT 0,
ADD COLUMN Experience_Points INT UNSIGNED NOT NULL DEFAULT 0,
ADD Foreign Key FK_Character_Alignment (Alignment_ID) REFERENCES `alignments` (Alignment_ID);

ALTER TABLE `characters`
MODIFY COLUMN Last_Update TIMESTAMP NOT NULL AFTER Alignment_ID,
MODIFY COLUMN Experience_Points INT UNSIGNED NOT NULL DEFAULT 0 AFTER Cha_Base,
MODIFY COLUMN Alignment_ID INT NOT NULL DEFAULT 5 AFTER Race_ID,
MODIFY COLUMN Notes TEXT AFTER Current_HP;
