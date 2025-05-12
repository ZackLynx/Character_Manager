/*
-----------------------------------------------------------------------------------------------
Name:       inventory.sql
Author:     Connor Bryan Andrew Clawson
Date:       2025-04-23
Language:   SQL
System:     MySQL 8.2.12
Purpose:    This query creates the inventory table for tracking character inventories.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-04-23      Original Version
CBAC        2025-04-26      Table columns and Foreign key Constraints finalized.
CBAC        2025-05-11      Weapons, Armor, and Shields tables for later inclusion post-SCC.
-----------------------------------------------------------------------------------------------
*/

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
    Inventory_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Item_Name VARCHAR(255) NOT NULL,
    Item_Desc TEXT
);

ALTER TABLE `inventory`
ADD CONSTRAINT `FK_Inv_Character` FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);

DROP TABLE IF EXISTS `weapons`;

CREATE TABLE `weapons` (
    Wpn_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Wpn_Name VARCHAR(255) NOT NULL,
    Wpn_Type VARCHAR(255),
    Wpn_Range INT,
    Wpn_Atk_Bonus INT,
    Wpn_Die_Count INT,
    Die_ID INT,
    Crit_Range INT,
    Crit_Multi INT,
    Foreign Key (Character_ID) REFERENCES `characters` (Character_ID),
    Foreign Key (Die_ID) REFERENCES `dice` (Die_ID)
);

DROP TABLE IF EXISTS `armor`;

CREATE TABLE `armor` (
    Armor_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Armor_Name VARCHAR(255) NOT NULL,
    Armor_Type INT(3) NOT NULL,
    Max_Speed INT,
    Max_Dex INT,
    Armor_ACP INT,
    Armor_Weight INT,
    Armor_AC INT,
    Foreign Key (Character_ID) REFERENCES `characters` (Character_ID)
);

DROP TABLE IF EXISTS `shields`;

CREATE TABLE `shields` (
    Shield_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Shield_Name VARCHAR(255) NOT NULL,
    Shield_ACP INT,
    Shield_Weight INT,
    Shield_AC INT,
    Foreign Key (Character_ID) REFERENCES `characters` (Character_ID)
);
