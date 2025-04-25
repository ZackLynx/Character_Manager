/*
-----------------------------------------------------------------------------------------------
Name:       inventory.sql
Author:     Connor Bryan Andrew Clawson
Date:       YYYY-MM-DD
Language:   SQL
System:     MySQL 8.2.12
Purpose:    This query creates the inventory table for tracking character inventories.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        YYYY-MM-DD      Original Version
-----------------------------------------------------------------------------------------------
*/

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
    Inventory_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Item_Name VARCHAR(255) NOT NULL,
    Item_Desc TEXT
);
