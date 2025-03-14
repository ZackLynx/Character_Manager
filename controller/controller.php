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
        'Character_Name' => get_val_from_postget('character-name', ''),
        'Class_ID' => get_val_from_postget('character-class', 0),
        'Race_ID' => get_val_from_postget('character-race', 0),
        'Str_Base' => get_val_from_postget('str-stat', -1),
        'Dex_Base' => get_val_from_postget('dex-stat', -1),
        'Con_Base' => get_val_from_postget('con-stat', -1),
        'Int_Base' => get_val_from_postget('int-stat', -1),
        'Wis_Base' => get_val_from_postget('wis-stat', -1),
        'Cha_Base' => get_val_from_postget('cha-stat', -1)
    ];

    if (add_character($values)) {
        $records = get_characters();
        include './view/table_list.php';
    } else {
        $user_message = '';
    }

}

// Edit a character
elseif ($action == 'edit-character') {
    $character_ID = get_val_from_postget('character_id', NULL);
    $record = get_character_by_id($character_ID); // used by table_update.php
    //echo count($record);
    //echo $record['Class_ID'];
    include './view/table_update.php';
}

// Save the changes made
elseif ($action == 'save-changes') {
    $changes = [
        'Character_ID' => get_val_from_postget('character-id', NULL),
        'Character_Name' => get_val_from_postget('character-name', ''),
        'Class_ID' => get_val_from_postget('character-class', 0),
        'Race_ID' => get_val_from_postget('character-race', 0),
        'Str_Base' => get_val_from_postget('str-stat', get_val_from_postget('old-str', -1)),
        'Dex_Base' => get_val_from_postget('dex-stat', get_val_from_postget('old-dex', -1)),
        'Con_Base' => get_val_from_postget('con-stat', get_val_from_postget('old-con', -1)),
        'Int_Base' => get_val_from_postget('int-stat', get_val_from_postget('old-int', -1)),
        'Wis_Base' => get_val_from_postget('wis-stat', get_val_from_postget('old-wis', -1)),
        'Cha_Base' => get_val_from_postget('cha-stat', get_val_from_postget('old-cha', -1))
    ];

    $user_message = '';
    $has_error = false;

    // Check character name
    if ($changes['Character_Name'] === '') {
        $user_message .= '<p>Character name cannot be blank.</p>';
        $has_error = true;
    }

    // Check class
    if ($changes['Class_ID'] > 11 || $changes['Class_ID'] < 1) {
        $user_message .= '<p>An invalid Class value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check race
    if ($changes['Race_ID'] > 7 || $changes['Race_ID'] < 1) {
        $user_message .= '<p>An invalid Race value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check strength
    if ($changes['Str_Base'] < 0 || $changes['Str_Base'] > 99) {
        $user_message .= '<p>please enter a STRENGTH score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check dexterity
    if ($changes['Dex_Base'] < 0 || $changes['Dex_Base'] > 99) {
        $user_message .= '<p>please enter a DEXTERITY score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check constitution
    if ($changes['Con_Base'] < 0 || $changes['Con_Base'] > 99) {
        $user_message .= '<p>please enter a CONSTITUTION score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check intelegence
    if ($changes['Int_Base'] < 0 || $changes['Int_Base'] > 99) {
        $user_message .= '<p>please enter a INTELLIGENCE score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check wisdom
    if ($changes['Wis_Base'] < 0 || $changes['Wis_Base'] > 99) {
        $user_message .= '<p>please enter a WISDOM score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check charisma
    if ($changes['Cha_Base'] < 0 || $changes['Cha_Base'] > 99) {
        $user_message .= '<p>please enter a CHARISMA score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    if (!$has_error && update_character($changes, $changes['Character_ID'])) { // It works!
        $records = get_characters();
        include './view/table_list.php';
    }

    // CRIT FAIL!
    elseif ($user_message === '') {
        $user_message .= '<p>Something went horribly wrong. Please contact the webmaster!</p>';
        include './view/table_update.php';
    }
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
        $user_message = 'Character';
    }
    $records = get_characters();
    include './view/table_list.php';
}
?>

