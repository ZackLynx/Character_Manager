<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_data.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This is the model file for the project. All functions for database handling should
            be stored in this file.

            For this file, the term `Character` refers to a fictional character in a table top
            role playing game. the `characters` table in the database contains all characters
            created and controled by players and the dungeon master.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version
CBAC        2025-03-12      Refactored all functions to focus only on the `characters` table.
-----------------------------------------------------------------------------------------------
*/

/**
 * Gets a full list of all player characters in 
 * @param string $selection the columns in a string
 * @return array an array of records.
 */
function get_characters($selection = '*')
{
    global $db;
    $query = 'SELECT characters.Character_ID, characters.Character_Name, classes.Class_Name
              FROM characters, classes
              WHERE characters.Class_ID = classes.Class_ID
              ORDER BY characters.Character_ID ASC, characters.Class_ID ASC;';
    $statement = $db->prepare($query);
    $statement->execute();
    $records = $statement->fetchAll();
    $statement->closeCursor();
    return $records;
}

/**
 * Gets the full character data of a single character from the `characters` table.
 * @param int $id the `Character_ID` of the character.
 * @return array an array containing all fields from a single character
 */
function get_character_by_id($id)
{
    global $db;
    $query = 'SELECT * FROM characters WHERE characters.Character_ID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $character = $statement->fetch();
    $statement->closeCursor();
    return $character;
}


/**
 * Adds one or more records to a table.
 * @param string $table The table to add records to.
 * @param string $values The records to be added.
 * @return void
 */
function add_character($values)
{
    global $db;
    $query = 'INSERT INTO characters VALUES :values;';
    $statement = $db->prepare($query);
    $statement->bindValue(':values', $values);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Updates an existing character record in a table.
 * @param string $values the values to be updated.
 * @param string $filters the primary key of the record or filters for multiple records.
 * @return void
 */
function update_character($values, $filters)
{
    global $db;
    $query = 'UPDATE characters SET :values WHERE :filters;';
    $statement = $db->prepare($query);

    // ex: 'column_name = value,'. each value change is comma separated.
    $statement->bindValue(':values', $values); // TODO: make values take an array.
    $statement->bindValue(':filters', $filters); // TODO: make filters take an array.
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Removes a character record from a table;
 * @param string $filters the record or records to be removed.
 * @return void
 */
function delete_character($character_ID)
{
    global $db;
    $query = 'DELETE FROM characters WHERE Character_ID = :character_ID;';
    $statement = $db->prepare($query);
    $statement->bindValue(':character_ID', $character_ID);
    $statement->execute();
    $statement->closeCursor();
}
?>

