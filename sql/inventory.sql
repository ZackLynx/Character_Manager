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
-----------------------------------------------------------------------------------------------
*/

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
    Inventory_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Item_Name VARCHAR(255) NOT NULL,
    Item_Desc TEXT
);

ALTER TABLE `inventory` ADD CONSTRAINT `FK_Inv_Character` 
FOREIGN KEY (`Character_ID`) REFERENCES `characters` (`Character_ID`);
