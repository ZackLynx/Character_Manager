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
 * Generates a temporary table containing records based on values passed through the parameters.
 * @param string $selection The fields to pull.
 * @param string $table the tables to pull records from.
 * @param string $filters any filters desired for the query.
 * @return array an array of records.
 */
function view_list($selection, $tables, $filters = NULL)
{
    global $db;
    $query = 'SELECT :selection FROM :tables';
    if (isset($filters)) {
        $query .= ' WHERE :filters';
    }
    $query .= ';';

    $statement = $db->prepare($query);
    $statement->bindValue(':selection', $selection);
    $statement->bindValue(':tables', $tables);
    $statement->bindValue(':filters', $filters);
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
function update_record($table, $values, $filters)
{
    global $db;
    $query = 'UPDATE :table SET :values WHERE :filters;';
    $statement = $db->prepare($query);
    $statement->bindValue(':table', $table);
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
function delete_record($tables, $filters)
{
    global $db;
    $query = 'DELETE FROM :tables WHERE :filters;';
    $statement = $db->prepare($query);
    $statement->bindValue(':tables', $tables);
    $statement->bindValue(':filters', $filters);
    $statement->execute();
    $statement->closeCursor();
}
?>

