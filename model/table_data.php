<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_data.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This is the model file for the project. All functions for database handling should
            be stored in this file.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
-----------------------------------------------------------------------------------------------
*/

/**
 * Gets a full list of all player characters in 
 * @param string $selection the columns in a string
 * @return array an array of records.
 */
function view_characters($selection = '*')
{
    global $db;
    $query = 'SELECT Character_ID, Character_Name FROM characters;';
    $statement = $db->prepare($query);
    $statement->execute();
    $records = $statement->fetchAll();
    $statement->closeCursor();
    return $records;
}

/**
 * Adds one or more records to a table.
 * @param string $table The table to add records to.
 * @param string $values The records to be added.
 * @return void
 */
function add_record($tables, $values)
{
    global $db;
    $query = 'INSERT INTO :tables VALUES :values;';
    $statement = $db->prepare($query);
    $statement->bindValue(':tables', $tables);
    $statement->bindValue(':values', $values);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Updates an existing record in a table.
 * @param string $table the table to be updated.
 * @param string $values the values to be updated.
 * @param string $filters the primary key of the record or filters for multiple records.
 * @return void
 */
function update_character($table, $values, $filters)
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
 * Removes a record from a table;
 * @param string $tables the tables to remove a record from.
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

