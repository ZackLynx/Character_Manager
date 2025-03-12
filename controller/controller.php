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

require '../model/connors_utilities.php';
require '../model/dbconnect.php';
require '../model/table_data.php';

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

$action = get_val_from_postget('action', 'view_characters');

// Read the characters table
if ($action == 'view_characters') {
    $records = view_list(`*`, `characters`);
    include '../view/table_list.php';
}

// Add a character
elseif ($action == 'add_character') {
    include '../view/table_add.php';
}

// edit a characters
elseif ($action == 'edit_character') {
    $character_ID = intval(get_val_from_postget('Character_ID', NULL));
    $record = view_list(
        `*`,
        `character`,
        '`Character_ID` = $character_ID'
    );
    include '../view/character_sheet.php';
}

// Delete a character
elseif ($action == 'confirm_deletion') {
    /*
        To be Completed.
        First ask the user to confirm their choice to delete the character by entering the
        character name. If the character name matches, begin the process of deleting.
    */
    include '../view/table_delete.php';
} elseif ($action == 'delete_character') {
    /*
        The order of operations needs to be updated each time the database structure changes.
        Use recursive logic to remove records tied to the character record. Once there is no
        other data in the database that relies on the character to exist, Delete the character.
    */
}
