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
    Inv_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Character_ID INT NOT NULL,
    Inv_Name VARCHAR(11),
    Inv_Desc TEXT
);
