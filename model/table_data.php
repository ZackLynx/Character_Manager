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
                            affected. Columns array added for reference and iteration.
CBAC        2025-04-13      Added Last_Update column for get_characters().
CBAC        2025-04-18      Implemented Feat CRUD functions.
CBAC        2025-04-19      Fixed bugs with Feat CRUD functions. added `Notes` to data array.
-----------------------------------------------------------------------------------------------
*/

/////////////////
/* DATA FIELDS */
/////////////////

/**
 * An array of all the columns in the `characters` table.
 */
$columns = [
    'Character_Name',
    'Class_ID',
    'Race_ID',
    'Str_Base',
    'Dex_Base',
    'Con_Base',
    'Int_Base',
    'Wis_Base',
    'Cha_Base',
    'Acrob_Ranks',
    'Acrob_Racial',
    'Acrob_Feats',
    'Acrob_Misc',
    'Appra_Ranks',
    'Appra_Racial',
    'Appra_Feats',
    'Appra_Misc',
    'Bluff_Ranks',
    'Bluff_Racial',
    'Bluff_Feats',
    'Bluff_Misc',
    'Climb_Ranks',
    'Climb_Racial',
    'Climb_Feats',
    'Climb_Misc',
    'Craft_Ranks',
    'Craft_Racial',
    'Craft_Feats',
    'Craft_Misc',
    'Diplo_Ranks',
    'Diplo_Racial',
    'Diplo_Feats',
    'Diplo_Misc',
    'DsDev_Ranks',
    'DsDev_Racial',
    'DsDev_Feats',
    'DsDev_Misc',
    'Disgu_Ranks',
    'Disgu_Racial',
    'Disgu_Feats',
    'Disgu_Misc',
    'Escar_Ranks',
    'Escar_Racial',
    'Escar_Feats',
    'Escar_Misc',
    'Fly_Ranks',
    'Fly_Racial',
    'Fly_Feats',
    'Fly_Misc',
    'Hanim_Ranks',
    'Hanim_Racial',
    'Hanim_Feats',
    'Hanim_Misc',
    'Heal_Ranks',
    'Heal_Racial',
    'Heal_Feats',
    'Heal_Misc',
    'Intim_Ranks',
    'Intim_Racial',
    'Intim_Feats',
    'Intim_Misc',
    'Karca_Ranks',
    'Karca_Racial',
    'Karca_Feats',
    'Karca_Misc',
    'Kdung_Ranks',
    'Kdung_Racial',
    'Kdung_Feats',
    'Kdung_Misc',
    'Kengi_Ranks',
    'Kengi_Racial',
    'Kengi_Feats',
    'Kengi_Misc',
    'Kgeog_Ranks',
    'Kgeog_Racial',
    'Kgeog_Feats',
    'Kgeog_Misc',
    'Khist_Ranks',
    'Khist_Racial',
    'Khist_Feats',
    'Khist_Misc',
    'Kloca_Ranks',
    'Kloca_Racial',
    'Kloca_Feats',
    'Kloca_Misc',
    'Knatu_Ranks',
    'Knatu_Racial',
    'Knatu_Feats',
    'Knatu_Misc',
    'Knobi_Ranks',
    'Knobi_Racial',
    'Knobi_Feats',
    'Knobi_Misc',
    'Kplan_Ranks',
    'Kplan_Racial',
    'Kplan_Feats',
    'Kplan_Misc',
    'Kreli_Ranks',
    'Kreli_Racial',
    'Kreli_Feats',
    'Kreli_Misc',
    'Lingu_Ranks',
    'Lingu_Racial',
    'Lingu_Feats',
    'Lingu_Misc',
    'Perce_Ranks',
    'Perce_Racial',
    'Perce_Feats',
    'Perce_Misc',
    'Perfo_Ranks',
    'Perfo_Racial',
    'Perfo_Feats',
    'Perfo_Misc',
    'Profe_Ranks',
    'Profe_Racial',
    'Profe_Feats',
    'Profe_Misc',
    'Ride_Ranks',
    'Ride_Racial',
    'Ride_Feats',
    'Ride_Misc',
    'Senmo_Ranks',
    'Senmo_Racial',
    'Senmo_Feats',
    'Senmo_Misc',
    'SOH_Ranks',
    'SOH_Racial',
    'SOH_Feats',
    'SOH_Misc',
    'Spcft_Ranks',
    'Spcft_Racial',
    'Spcft_Feats',
    'Spcft_Misc',
    'Stlth_Ranks',
    'Stlth_Racial',
    'Stlth_Feats',
    'Stlth_Misc',
    'Survi_Ranks',
    'Survi_Racial',
    'Survi_Feats',
    'Survi_Misc',
    'Swim_Ranks',
    'Swim_Racial',
    'Swim_Feats',
    'Swim_Misc',
    'Umdev_Ranks',
    'Umdev_Racial',
    'Umdev_Feats',
    'Umdev_Misc',
    'Notes'
];

/**
 * Gets a full list of all player characters in the `characters` table.
 * @return array an array of records.
 */
function get_characters()
{
    global $db;
    $query = 'SELECT characters.Character_ID, characters.Character_Name, races.Race_Name, classes.Class_Name, Last_Update
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
        global $columns;
        // $query = 'INSERT INTO characters (Character_Name, Class_ID, Race_ID, Str_Base, Dex_Base, Con_Base, Int_Base, Wis_Base, Cha_Base) VALUES (';

        // NEW CODE

        $query = 'INSERT INTO characters (';
        /*
        SQL does not offer us the option to pick all fields with a wildcard like SELECT does.
        As a work-around, we'll use an array to store the names of all the columns.
        */
        foreach ($columns as $column) {
            if ($column == end($columns)) {
                $query .= $column . ') VALUES (';
            } else {
                $query .= $column . ', ';
            }
        }

        // END NEW CODE

        // using the same order of the columns entered, arrange the data for SQL.
        foreach ($columns as $column) {
            if ($column == end($columns)) {
                $query .= is_numeric($values[$column]) ? $values[$column] : '\'' . $values[$column] . '\'';
            } else {
                $query .= is_numeric($values[$column]) ? $values[$column] . ', ' : '\'' . $values[$column] . '\', ';
            }
        }

        $query .= ');';

        // echo $query;

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
 * @return mixed The number of rows affected by the query.
 */
function update_character($values, $id)
{
    try {
        global $db;
        global $columns;

        $query = 'UPDATE characters SET ';
        end($values);
        $lastKey = key($values);
        reset($values);
        foreach ($columns as $column) {
            if ($column == end($columns)) {
                $query .= $column . ' = ';
                $query .= is_numeric($values[$column]) ? $values[$column] : '\'' . addslashes($values[$column]) . '\'';
            } else {
                $query .= $column . ' = ';
                $query .= is_numeric($values[$column]) ? $values[$column] . ', ' : '\'' . addslashes($values[$column]) . '\', ';
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
    // return $query;
}

/**
 * Removes a character record and any feats belonging to that character from their respective tables.
 * @param int $character_ID the record to be removed.
 * @return int The number of rows affected by the query.
 */
function delete_character($character_ID)
{
    try {
        global $db;
        // Feats
        $query = 'DELETE FROM feats WHERE Character_ID = :id;
                  DELETE FROM characters WHERE Character_ID = :id;';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $character_ID);
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
 * Gets a list denoting the class skills for each class from the `classes_skills` table.
 * @return array the list denoting which skills are class skills
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

/**
 * Summary of get_feats
 * @param int $character_id The ID of the character whose feats are being pulled.
 * @return array All the feats posessed by the character.
 */
function get_feats($character_id)
{
    global $db;
    $query = 'SELECT * FROM feats WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $feats = ($statement->rowCount() > 0) ? $statement->fetchAll() : [];
    $statement->closeCursor();
    return $feats;
}


function add_feat($character_id, $name, $desc)
{
    global $db;
    $query = 'INSERT INTO feats (Character_ID, Feat_Name, Feat_Desc) VALUES (:id, :feat_name, :feat_desc);
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->bindValue(':feat_name', $name);
    $statement->bindValue('feat_desc', $desc);
    $statement->execute();
    $result = $statement->rowCount();
    $statement->closeCursor();
    return $result;
}


function modify_feat($character_id, $feat_id, $name, $desc)
{
    global $db;
    $query = 'UPDATE feats SET Feat_Name = :feat_name, Feat_Desc = :feat_desc WHERE Feat_ID = :id;
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :character_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $feat_id);
    $statement->bindValue(':feat_name', $name);
    $statement->bindValue(':feat_desc', $desc);
    $statement->bindValue(':character_id', $character_id);
    $statement->execute();
    $result = $statement->rowCount();
    $statement->closeCursor();
    return $result;
}


function delete_feats($character_id, $feat_IDs)
{
    global $db;
    $query = 'DELETE FROM feats WHERE Feat_ID IN (' . implode($feat_IDs) . ');
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

?>

