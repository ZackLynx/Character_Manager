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
            created and controlled by players and the dungeon master.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version
CBAC        2025-03-12      Refactored all functions to focus only on the `characters` table.
CBAC        2025-03-14      Completed functional versions of all functions.
CBAC        2025-03-25      Amended get_characters to include the characters race.
CBAC        2025-04-02      Add, Update, and Delete methods now return the number of records
                            affected.
-----------------------------------------------------------------------------------------------
*/

/**
 * Gets a full list of all player characters in the `characters` table.
 * @return array an array of records.
 */
function get_characters()
{
    global $db;
    $query = 'SELECT characters.Character_ID, characters.Character_Name, races.Race_Name, classes.Class_Name
              FROM characters, races, classes
              WHERE characters.Class_ID = classes.Class_ID AND characters.Race_ID = races.Race_ID
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
 * @return array an array containing all fields from a single character.
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
 * @param array $values The records to be added.
 * @return int The number of rows affected by the query.
 */
function add_character($values)
{
    // TODO: Consider adding an additional layer of data integrity in this function.
    try {
        global $db;
        $query = 'INSERT INTO characters (
        Character_Name, 
        Class_ID, 
        Race_ID, 
        Str_Base, 
        Dex_Base, 
        Con_Base, 
        Int_Base, 
        Wis_Base, 
        Cha_Base) 
        VALUES (';

        end($values);
        $lastKey = key($values);
        reset($values);
        foreach ($values as $key => &$value) {
            if ($key === $lastKey) {
                $query .= is_numeric($value) ? $value : '\'' . $value . '\'';
            } else {
                $query .= is_numeric($value) ? $value . ', ' : '\'' . $value . '\', ';
            }
        }

        $query .= ');';

        //echo $query;

        $statement = $db->prepare($query);
        $statement->execute();
        $num_row_affected = $statement->rowCount(); // Will now return the number of rows affected. CBAC 2025-04-02
        $statement->closeCursor();
    } catch (Exception $error_message) {
        include './errors/error.php';
        return 0;
    }
    return $num_row_affected;
}

/**
 * Updates an existing character record in a table.
 * @param array $values the values to be updated.
 * @param int $id the primary key of the record or filters for multiple records.
 * @return int The number of rows affected by the query.
 */
function update_character($values, $id)
{
    try {
        global $db;
        $query = 'UPDATE characters SET ';
        end($values);
        $lastKey = key($values);
        reset($values);
        foreach ($values as $key => &$value) {
            if ($key === $lastKey) {
                $query .= $key . ' = ';
                $query .= is_numeric($value) ? $value : '\'' . $value . '\'';
            } else {
                $query .= $key . ' = ';
                $query .= is_numeric($value) ? $value . ', ' : '\'' . $value . '\', ';
            }
        }

        $query .= ' WHERE character_ID = :id;';

        //echo $query;

        $statement = $db->prepare($query);
        $statement->bindValue(':id', intval($values['Character_ID']), PDO::PARAM_INT);
        $statement->execute();
        $num_row_affected = $statement->rowCount(); // Will now return the number of rows affected. CBAC 2025-04-02
        $statement->closeCursor();
    } catch (Exception $error_message) {
        include './errors/error.php';
        return 0;
    }
    return $num_row_affected;
}

/**
 * Removes a character record from a table;
 * @param int $character_ID the record to be removed.
 * @return int The number of rows affected by the query.
 */
function delete_character($character_ID)
{
    try {
        global $db;
        $query = 'DELETE FROM characters WHERE Character_ID = ' . $character_ID . ';';
        $statement = $db->prepare($query);
        $statement->execute();
        $num_of_records = $statement->rowCount(); // Will now return the number of rows affected. CBAC 2025-04-02
        $statement->closeCursor();
    } catch (Exception $error_message) {
        include './errors/error.php';
        return 0;
    }
    return $num_of_records;
}


/////////////////////
/* UTILITY QUERIES */
/////////////////////

/**
 * supplies the list of skills used in the tabletop game.
 * @return array a list of skills from the `skills` table.
 */
function get_skills()
{
    global $db;
    $query = 'SELECT * FROM skills;';
    $statement = $db->prepare($query);
    $statement->execute();
    $skill_list = $statement->fetchAll();
    $statement->closeCursor();
    return $skill_list;
}

/**
 * Summary of get_class_skills
 * @return array
 */
function get_class_skills()
{
    global $db;
    $query = 'SELECT * FROM classes_skills;';
    $statement = $db->prepare($query);
    $statement->execute();
    $class_skills = $statement->fetchAll();
    $statement->closeCursor();
    return $class_skills;
}

?>

