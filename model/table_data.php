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
                            Add and Modify character queries now use bindValue().
CBAC        2025-04-25      First run of CRUD functions for Inventory system. 
CBAC        2025-04-26      Updated Delete_character to remove inventory attached to character.
                            Inventory CRUD functions completed and tested.
CBAC        2025-04-27      First CRUD functions for Skills rework.
CBAC        2025-04-28      Exploring new CRUD approach with `REPLACE INTO` keywords.
                            Added prune_characters_columns() for later use, DO NOT EXECUTE THIS
                            FUNCTION YET!
CBAC        2025-05-02      Skills now delete when a character is deleted.
CBAC        2025-05-07      Skills
-----------------------------------------------------------------------------------------------
*/

/////////////////
/* DATA FIELDS */
/////////////////

/**
 * An array of all the columns in the `characters` table.
 */
$old_columns = [
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
    'Gender',
    'Character_Level',
    'Experience_Points',
    'Alignment_ID',
    'Max_HP',
    'Current_HP',
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

function get_characters_all_data()
{
    global $db;
    $query = 'SELECT * FROM `characters`;';
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

        // using the same order of the columns entered, arrange the data for SQL.
        // foreach ($columns as $column) {
        //     if ($column == end($columns)) {
        //         $query .= is_numeric($values[$column]) ? $values[$column] : '\'' . $values[$column] . '\'';
        //     } else {
        //         $query .= is_numeric($values[$column]) ? $values[$column] . ', ' : '\'' . $values[$column] . '\', ';
        //     }
        // }

        // NEW VALUE BIND METHOD
        foreach ($columns as $column) {
            if ($column == end($columns)) {
                $query .= ':' . $column;
            } else {
                $query .= ':' . $column . ', ';
            }
        }

        $query .= ');';

        //echo $query;

        $statement = $db->prepare($query);

        // NEW VALUE BIND METHOD
        foreach ($columns as $column) {
            $statement->bindValue(':' . $column, $values[$column]);
        }

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
                $query .= $column . ' = :' . $column;
                // $query .= is_numeric($values[$column]) ? $values[$column] : '\'' . addslashes($values[$column]) . '\'';
            } else {
                $query .= $column . ' = :' . $column . ', ';
                // $query .= is_numeric($values[$column]) ? $values[$column] . ', ' : '\'' . addslashes($values[$column]) . '\', ';
            }
        }

        $query .= ' WHERE character_ID = :id;';
        // echo $query;

        $statement = $db->prepare($query);
        foreach ($columns as $column) {
            $statement->bindValue(':' . $column, $values[$column]);
        }
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
        $query = 'DELETE FROM `feats` WHERE Character_ID = :id;
                  DELETE FROM `inventory` WHERE Character_ID = :id;
                  DELETE FROM `characters` WHERE Character_ID = :id;
                  DELETE FROM `character_skills` WHERE Character_ID = :id;';
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

/* SKILLS */

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
    $query = 'SELECT classes_skills.`Class_ID`, GROUP_CONCAT(skills.`Short_Name` ORDER BY skills.`Skill_ID` SEPARATOR \', \') AS Skill_IDs
              FROM classes_skills, skills
              WHERE classes_skills.`Skill_ID` = skills.`Skill_ID`
              GROUP BY `Class_ID`;';
    $statement = $db->prepare($query);
    $statement->execute();
    $class_skills = $statement->fetchAll();
    $statement->closeCursor();
    return $class_skills;
}

/**
 * Gets all of the feats tied to a single character.
 * @param int $character_id The ID of the character whose feats are being pulled.
 * @return array All the feats posessed by the character.
 */
function get_feats($character_id)
{
    global $db;
    $query = 'SELECT * FROM `feats` WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $feats = ($statement->rowCount() > 0) ? $statement->fetchAll() : [];
    $statement->closeCursor();
    return $feats;
}

/* FEATS */

/**
 * Adds a single feat to a character.
 * @param int $character_id The primary key of the character.
 * @param string $name The name of the feat.
 * @param string $desc The description of the feat.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function add_feat($character_id, $name, $desc)
{
    global $db;
    $query = 'INSERT INTO `feats` (Character_ID, Feat_Name, Feat_Desc) VALUES (:id, :feat_name, :feat_desc);
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->bindValue(':feat_name', $name);
    $statement->bindValue('feat_desc', $desc);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

/**
 * Edits the info of a specific feat owned by a specific character.
 * @param int $character_id The primary key of the character.
 * @param int $feat_id The primary key of the feat.
 * @param string $name The name of the feat.
 * @param string $desc The description of the feat.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function modify_feat($character_id, $feat_id, $name, $desc)
{
    global $db;
    $query = 'UPDATE `feats` SET Feat_Name = :feat_name, Feat_Desc = :feat_desc WHERE Feat_ID = :feat_id;
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :character_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':character_id', $character_id);
    $statement->bindValue(':feat_id', $feat_id);
    $statement->bindValue(':feat_name', $name);
    $statement->bindValue(':feat_desc', $desc);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

/**
 * Removes one or more feats from a character.
 * @param int $character_id The primary key of the character.
 * @param string $feat_IDs a string of numbers containing the `Feat_ID` of each feat, delimited by a `,` comma.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function delete_feats($character_id, $feat_IDs)
{
    global $db;
    $query = 'DELETE FROM `feats` WHERE Feat_ID IN (' . $feat_IDs . ');
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

/* INVENTORY */

/**
 * Gets the items owned by a character
 * @param int $character_id The primary key of the character.
 * @return array a key/value array of items owned by the character.
 */
function get_inventory($character_id)
{
    global $db;
    $query = 'SELECT * FROM `inventory` WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $inventory = $statement->fetchAll();
    $statement->closeCursor();
    return $inventory;
}

/**
 * Adds a single item to a characters inventory.
 * @param int $character_id TThe primary key of the character.
 * @param string $item_name The name of the item.
 * @param string $item_desc A description of the item.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function add_inventory($character_id, $item_name, $item_desc)
{
    global $db;
    $query = 'INSERT INTO `inventory` (Character_ID, Item_Name, Item_Desc) VALUES (:id, :name, :desc);
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->bindValue(':name', $item_name);
    $statement->bindValue(':desc', $item_desc);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

/**
 * Alters the information of a single inventory item.
 * @param int $character_id The primary key of the character.
 * @param int $inventory_id The primary key of the item.
 * @param string $item_name The name of the item.
 * @param string $item_desc A description of the item.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function modify_inventory($character_id, $inventory_id, $item_name, $item_desc)
{
    global $db;
    $query = 'UPDATE `inventory` SET Item_Name = :item_name, Item_Desc = :item_desc WHERE Inventory_ID = :inventory_id;
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :character_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':character_id', $character_id);
    $statement->bindValue(':inventory_id', $inventory_id);
    $statement->bindValue(':item_name', $item_name);
    $statement->bindValue(':item_desc', $item_desc);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}


/**
 * Removes one or more items form a character.
 * @param int $character_id The primary key of the character
 * @param string $deleted_items a string of numbers containing the `Inventory_ID` of each item, delimited by a `,` comma.
 * @return int the number of rows effected. `0` if no records were entered.
 */
function delete_inventory($character_id, $deleted_items)
{
    global $db;
    $query = 'DELETE FROM `inventory` WHERE Inventory_ID IN (' . $deleted_items . ');
              UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $character_id);
    $statement->execute();
    $rows_affected = $statement->rowCount();
    $statement->closeCursor();
    return $rows_affected;
}

/////////////////////////////////
/* REFACTORED SKILLS FUNCTIONS */
/////////////////////////////////

/**
 * Summary of get_character_skills
 * @param mixed $character_id
 * @return array
 */
function get_character_skills($character_id)
{
    global $db;
    $query = 'SELECT Skill_ID, Modifier_ID, Field_Value FROM `character_skills` WHERE Character_ID = :character_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':character_id', $character_id);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    // Each row represents one of 35 skills, each with 4 columns.
    $character_skills = [
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0]
    ];
    foreach ($results as $result) {
        // REMINDER: MySQL indices start at `1`, not `0`!
        $character_skills[$result['Skill_ID'] - 1][$result['Modifier_ID'] - 1] = $result['Field_Value'];
    }

    return $character_skills;
}

/**
 * Summary of get_skill_modifiers
 * @return array
 */
function get_skill_modifiers()
{
    global $db;
    $query = 'SELECT * FROM `skill_modifiers`;';
    $statement = $db->prepare($query);
    $statement->execute();
    $table = $statement->fetchAll();
    $statement->closeCursor();
    return $table;
}

/**
 * This function performs Create, Update, and Delete actions based on existing records and their values.
 * 
 * If the value provided is `0` then the record will be removed from the table.
 * 
 * Otherwise, the value will insert a new recoprd or modify an existing one in the table using the 
 * composite keys for `Character_ID`, `Skill_ID`, and `Modifier_ID`. 
 * @param int $character_id The primary key from the `characters` table.
 * @param int $skill_id The primary key from the `skills` table to denote which skill is represented
 * @param int $modifier_id The primary key from the `skill_modifiers` table to denote the column in the skills character sheet.
 * @param int $field_value The integer value recorded into the field of the character sheet.
 * @return int the number of records affected in the `characters_skills` table. `1` if the query executed successfully, `0` otherwise.
 */
function enter_skill_value($character_id, $skill_id, $modifier_id, $field_value)
{
    global $db;
    if ($field_value == 0) {
        $query = 'DELETE FROM `character_skills` 
                  WHERE Character_ID = :character_id 
                  AND Skill_ID = :skill_id 
                  AND Modifier_ID = :modifier_id;
                  UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :character_id;';
        $statement = $db->prepare($query);
        $statement->bindValue(':character_id', $character_id);
        $statement->bindValue(':skill_id', $skill_id);
        $statement->bindValue(':modifier_id', $modifier_id);
        $statement->execute();
        $rows_affected = $statement->rowCount();
        $statement->closeCursor();
        return $rows_affected;
    } else {
        // `REPLACE INTO` will `UPDATE` if a record exists or `INSERT INTO` if one does not 
        $query = 'REPLACE INTO `character_skills` 
                  (Character_ID, Skill_ID, Modifier_ID, Field_Value) 
                  VALUES (:character_id, :skill_id, :modifier_id, :field_value);
                  UPDATE characters SET Last_Update = NOW() WHERE Character_ID = :character_id;';
        $statement = $db->prepare($query);
        $statement->bindValue(':character_id', $character_id);
        $statement->bindValue(':skill_id', $skill_id);
        $statement->bindValue(':modifier_id', $modifier_id);
        $statement->bindValue(':field_value', $field_value);
        $statement->execute();
        $rows_affected = $statement->rowCount();
        $statement->closeCursor();
        return $rows_affected;
    }
}

/**
 * Removes all skill value columns from the `characters` table.
 * 
 * **WARNING: DO NOT EXECUTE UNTIL SKILL SYSTEM REFACTOR IS COMPLETE!**
 * @return void
 */
function prune_characters_columns()
{
    global $db;
    $query = 'ALTER TABLE `characters` 
              DROP COLUMN Acrob_Ranks, Acrob_Racial, Acrob_Feats, Acrob_Misc, Appra_Ranks, 
              Appra_Racial, Appra_Feats, Appra_Misc, Bluff_Ranks, Bluff_Racial, Bluff_Feats, 
              Bluff_Misc, Climb_Ranks, Climb_Racial, Climb_Feats, Climb_Misc, Craft_Ranks, 
              Craft_Racial, Craft_Feats, Craft_Misc, Diplo_Ranks, Diplo_Racial, Diplo_Feats, 
              Diplo_Misc, DsDev_Ranks, DsDev_Racial, DsDev_Feats, DsDev_Misc, Disgu_Ranks, 
              Disgu_Racial, Disgu_Feats, Disgu_Misc, Escar_Ranks, Escar_Racial, Escar_Feats, 
              Escar_Misc, Fly_Ranks, Fly_Racial, Fly_Feats, Fly_Misc, Hanim_Ranks, Hanim_Racial, 
              Hanim_Feats, Hanim_Misc, Heal_Ranks, Heal_Racial, Heal_Feats, Heal_Misc, Intim_Ranks, 
              Intim_Racial, Intim_Feats, Intim_Misc, Karca_Ranks, Karca_Racial, Karca_Feats, 
              Karca_Misc, Kdung_Ranks, Kdung_Racial, Kdung_Feats, Kdung_Misc, Kengi_Ranks, 
              Kengi_Racial, Kengi_Feats, Kengi_Misc, Kgeog_Ranks, Kgeog_Racial, Kgeog_Feats, 
              Kgeog_Misc, Khist_Ranks, Khist_Racial, Khist_Feats, Khist_Misc, Kloca_Ranks, 
              Kloca_Racial, Kloca_Feats, Kloca_Misc, Knatu_Ranks, Knatu_Racial, Knatu_Feats, 
              Knatu_Misc, Knobi_Ranks, Knobi_Racial, Knobi_Feats, Knobi_Misc, Kplan_Ranks, 
              Kplan_Racial, Kplan_Feats, Kplan_Misc, Kreli_Ranks, Kreli_Racial, Kreli_Feats, 
              Kreli_Misc, Lingu_Ranks, Lingu_Racial, Lingu_Feats, Lingu_Misc, Perce_Ranks, 
              Perce_Racial, Perce_Feats, Perce_Misc, Perfo_Ranks, Perfo_Racial, Perfo_Feats, 
              Perfo_Misc, Profe_Ranks, Profe_Racial, Profe_Feats, Profe_Misc, Ride_Ranks, 
              Ride_Racial, Ride_Feats, Ride_Misc, Senmo_Ranks, Senmo_Racial, Senmo_Feats, 
              Senmo_Misc, SOH_Ranks, SOH_Racial, SOH_Feats, SOH_Misc, Spcft_Ranks, Spcft_Racial, 
              Spcft_Feats, Spcft_Misc, Stlth_Ranks, Stlth_Racial, Stlth_Feats, Stlth_Misc, 
              Survi_Ranks, Survi_Racial, Survi_Feats, Survi_Misc, Swim_Ranks, Swim_Racial, 
              Swim_Feats, Swim_Misc, Umdev_Ranks, Umdev_Racial, Umdev_Feats, Umdev_Misc;
    ';
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}
?>

