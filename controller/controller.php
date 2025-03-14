<?php
/*
-----------------------------------------------------------------------------------------------
Name:		controller.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-11
Language:	PHP
Purpose:	This is the controller for the whole sight.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-11		Original Version 
-----------------------------------------------------------------------------------------------
*/

require './model/connors_utilities.php';
require './model/dbconnect.php';
require './model/table_data.php';

/**
 * First searches $_POST then $_GET for a given array key and returns a value if that key
 * exists
 * @param string $arr_val the array key to look for
 * @param mixed $default_val the value to be returned if the key could not be found
 * @return mixed the value of $default_val
 */
function get_val_from_postget($arr_val, $default_val)
{
    if (array_key_exists($arr_val, $_POST) && isset($_POST[$arr_val])) {
        return $_POST[$arr_val];
    } elseif (array_key_exists($arr_val, $_GET) && isset($_GET[$arr_val])) {
        return $_GET[$arr_val];
    }
    return $default_val;
}


// $arr = [
// 'Character_Name' => 'Arnold',
// 'Class_ID' => 1,
//     'Race_ID' => 1,
//     'Str_Base' => 8,
//     'Dex_Base' => 8,
//     'Con_Base' => 8,
//     'Int_Base' => 8,
//     'Wis_Base' => 8,
//     'Cha_Base' => 8
// ];
//
// update_character($arr, 1);
// add_character($arr);


$action = get_val_from_postget('action', 'view-characters');

// Read the characters table
if ($action == 'view-characters') {
    $records = get_characters();
    include './view/table_list.php';
}

// Add a character
elseif ($action == 'add-character') {
    include './view/table_add.php';
}

// Submit the new character
elseif ($action == 'submit-character') {

    $values = [
        'Character_Name' => get_val_from_postget('character-name', 'NAME'),
        'Class_ID' => get_val_from_postget('character-class', 5), // Human default
        'Race_ID' => get_val_from_postget('character-race', 7), // Fighter default
        'Str_Base' => get_val_from_postget('str-stat', 0),
        'Dex_Base' => get_val_from_postget('dex-stat', 0),
        'Con_Base' => get_val_from_postget('con-stat', 0),
        'Int_Base' => get_val_from_postget('int-stat', 0),
        'Wis_Base' => get_val_from_postget('wis-stat', 0),
        'Cha_Base' => get_val_from_postget('cha-stat', 0),
    ];
    $result = false;
    if (add_character($values)) {
        $result = true;
    }
    $records = get_characters();
    include './view/table_list.php';
}

// Edit a character
elseif ($action == 'edit-character') {
    $character_ID = get_val_from_postget('character_id', NULL);
    $record = get_character_by_id($character_ID);
    //echo count($record);
    //echo $record['Class_ID'];
    include './view/table_update.php';
}

// Save the changes made
elseif ($action == 'save-changes') {
    $changes = [
        'Character_ID' => get_val_from_postget('Character_ID', NULL),
        'Character_Name' => get_val_from_postget('Character_Name', 'NAME'),
        'Class_ID' => get_val_from_postget('Class_ID', 5), // Human default
        'Race_ID' => get_val_from_postget('Race_ID', 7), // Fighter default
        'Str_Base' => get_val_from_postget('Str_Base', 0),
        'Dex_Base' => get_val_from_postget('Dex_Base', 0),
        'Con_Base' => get_val_from_postget('Con_Base', 0),
        'Int_Base' => get_val_from_postget('Int_Base', 0),
        'Wis_Base' => get_val_from_postget('Wis_Base', 0),
        'Cha_Base' => get_val_from_postget('Cha_Base', 0),
    ];
    $result = false;
    if (update_character($changes, 1)) {
        $result = true;
    }
    $records = get_characters();
    include './view/table_list.php';
}

// Delete a character
elseif ($action == 'confirm-deletion') {
    /*
        To be Completed.
        First ask the user to confirm their choice to delete the character by entering the
        character name. If the character name matches, begin the process of deleting.
    */
    $character_id = $_POST['character_id'];
    include './view/table_delete.php';
} elseif ($action == 'delete-character') {
    /*
        The order of operations needs to be updated each time the database structure changes.
        Use recursive logic to remove records tied to the character record. Once there is no
        other data in the database that relies on the character to exist, Delete the character.
    */
    $result = false;
    if (
        delete_character(
            intval(
                get_val_from_postget(
                    'character_id',
                    NULL
                )
            )
        )
    ) {
        $result = true;
    }
    $records = get_characters();
    include './view/table_list.php';
}
?>

