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
CBAC        2025-03-14      Completed version 1 of CRUD actions with system messages for 
                            successful additions, edits, and deletions of characters.
CBAC        2025-04-04      Refactored the `submit-character` and `save-changes` actions to
                            include skills.
CBAC        2025-04-11      Renamed $user_message to $system_message
CBAC        2025-04-14      Added PHP session functionality.
-----------------------------------------------------------------------------------------------
TODO:   Implement PHP Sessions for result messages after skills are implemented.
        Deprecate the 'old' value fields in table_add and table_update.
        Add a "this site uses cookies" disclamer.
-----------------------------------------------------------------------------------------------
*/

require './model/connors_utilities.php';
require './model/dbconnect.php';
require './model/table_data.php';


/**
 * First searches `$_POST` then `$_GET` for a given array key and returns a value if that key
 * exists
 * @param string $arr_val the array key to look for
 * @param mixed $default_val the value to be returned if the key could not be found
 * @return mixed the value of from `$_POST` or `$_GET`, `$default_val` otherwise
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
    $skill_list = get_skills();
    include './view/table_add.php';
}

// Submit the new character
elseif ($action == 'submit-character') {

    //add_character($_POST);
    //foreach ($_POST as $key => $value) {
    //    echo '<p>' . $key . ' => ' . $value . '</p>';
    //}
    $values = [
        'Character_Name' => get_val_from_postget('Character_Name', ''),
        'Class_ID' => get_val_from_postget('Class_ID', 0),
        'Race_ID' => get_val_from_postget('Race_ID', 0),
        'Str_Base' => get_val_from_postget('Str_Base', -1),
        'Dex_Base' => get_val_from_postget('Dex_Base', -1),
        'Con_Base' => get_val_from_postget('Con_Base', -1),
        'Int_Base' => get_val_from_postget('Int_Base', -1),
        'Wis_Base' => get_val_from_postget('Wis_Base', -1),
        'Cha_Base' => get_val_from_postget('Cha_Base', -1)
    ];
    $values['Character_Name'] = trim($values['Character_Name']);

    // Process feats from POST and or GET.
    $feats = [];
    $total = get_val_from_postget('num-of-feats', 0);
    $i = 0;
    $j = 0;
    while ($i < $total) {
        if (isset($_POST['feat_' . $j . '_name'])) {
            $feat_name = get_val_from_postget('feat_' . $j . '_name', '');
            $feat_desc = get_val_from_postget('feat_' . $j . '_desc', '');
            array_push($feats, ['Feat_Name' => $feat_name, 'Feat_Desc' => $feat_desc]);
            $i++;
            $j++;
        } else {
            $j++;
        }
    }

    // include './view/test.php';

    $system_message = '';
    $has_error = false;

    // Check character name
    if (empty($values['Character_Name'])) {
        $system_message .= '<p class="system-message error">Character name cannot be blank.</p>';
        $has_error = true;
    }

    // Check for illegal characters
    if (!validate_characters($values['Character_Name'])) {
        $system_message .= '<p class="system-message error">Name may only contain letters, dashes, apostrophies, and spaces between names/words.</p>';
        $has_error = true;
    }

    // TODO: Improve countermeasures to combat SQL injection via string input fields

    // Check class
    if ($values['Class_ID'] > 11 || $values['Class_ID'] < 1) {
        $system_message .= '<p class="system-message error">An invalid Class value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check race
    if ($values['Race_ID'] > 7 || $values['Race_ID'] < 1) {
        $system_message .= '<p class="system-message error">An invalid Race value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check strength
    if ($values['Str_Base'] < 0 || $values['Str_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a STRENGTH score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check dexterity
    if ($values['Dex_Base'] < 0 || $values['Dex_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a DEXTERITY score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check constitution
    if ($values['Con_Base'] < 0 || $values['Con_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a CONSTITUTION score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check intelegence
    if ($values['Int_Base'] < 0 || $values['Int_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a INTELLIGENCE score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check wisdom
    if ($values['Wis_Base'] < 0 || $values['Wis_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a WISDOM score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check charisma
    if ($values['Cha_Base'] < 0 || $values['Cha_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a CHARISMA score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    foreach ($columns as $column) {
        if (empty(get_val_from_postget($column, ''))) {
            $system_message .= '<p class="system-message error">One or more values in the skills list is empty. please enter a whole number into each empty field.</p>';
            $has_error = true;
        }
        break;
    }

    // Check feat names for blanks
    foreach ($feats as $feat) {
        if (empty(trim($feat['Feat_Name']))) {
            $system_message .= '<p class="system-message error">One or more feats has a blank name. Please give these feats a name.</p>';
            $has_error = true;
        }
    }

    // It works!
    if (!$has_error && (add_character($_POST) > 0)) {
        $character_ID = $db->lastInsertId();



        $system_message = '<p class="system-message">Character added!</p>';
        $records = get_characters();
        header('Location: ./');
    }

    // Report input errors
    elseif ($has_error) {
        $skill_list = get_skills();
        include './view/table_add.php';
    }

    // CRIT FAIL!
    else {
        echo $system_message;
        $error_message = 'Something went wrong when trying to save your new character.';
        include './errors/error.php';
    }

}

// Edit a character
elseif ($action == 'edit-character') {
    $character_ID = get_val_from_postget('character_id', NULL);
    $old_record = get_character_by_id($character_ID); // used by table_update.php
    $skill_list = get_skills();
    //echo count($record);
    //echo $record['Class_ID'];
    $character_feats = get_feats($character_ID);
    include './view/table_update.php';
}

// Save the changes made
elseif ($action == 'save-changes') {
    $changes = [
        'Character_ID' => $_POST['Character_ID'],
        'Character_Name' => get_val_from_postget('Character_Name', ''),
        'Class_ID' => get_val_from_postget('Class_ID', 0),
        'Race_ID' => get_val_from_postget('Race_ID', 0),
        'Str_Base' => get_val_from_postget('Str_Base', -1),
        'Dex_Base' => get_val_from_postget('Dex_Base', -1),
        'Con_Base' => get_val_from_postget('Con_Base', -1),
        'Int_Base' => get_val_from_postget('Int_Base', -1),
        'Wis_Base' => get_val_from_postget('Wis_Base', -1),
        'Cha_Base' => get_val_from_postget('Cha_Base', -1)
    ];
    $changes['Character_Name'] = trim($changes['Character_Name']);
    $system_message = '';
    $has_error = false;

    // Check character name
    if (empty($changes['Character_Name'])) {
        $system_message .= '<p class="system-message error">Character name cannot be blank.</p>';
        $has_error = true;
    }

    // check for illegal characters
    if (!validate_characters($changes['Character_Name'])) {
        $system_message .= '<p class="system-message error">Name may only contain letters, dashes, apostrophies, and spaces between names/words.</p>';
        $has_error = true;
    }

    // TODO: Improve countermeasures to combat SQL injection via string input fields

    // Check class
    if ($changes['Class_ID'] > 11 || $changes['Class_ID'] < 1) {
        $system_message .= '<p class= class="system-message error">An invalid Class value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check race
    if ($changes['Race_ID'] > 7 || $changes['Race_ID'] < 1) {
        $system_message .= '<p class="system-message error">An invalid Race value was detected. Please try again.</p>';
        $has_error = true;
    }

    // Check strength
    if ($changes['Str_Base'] < 0 || $changes['Str_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a STRENGTH score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check dexterity
    if ($changes['Dex_Base'] < 0 || $changes['Dex_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a DEXTERITY score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check constitution
    if ($changes['Con_Base'] < 0 || $changes['Con_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a CONSTITUTION score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check intelegence
    if ($changes['Int_Base'] < 0 || $changes['Int_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a INTELLIGENCE score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check wisdom
    if ($changes['Wis_Base'] < 0 || $changes['Wis_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a WISDOM score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // Check charisma
    if ($changes['Cha_Base'] < 0 || $changes['Cha_Base'] > 99) {
        $system_message .= '<p class="system-message error">please enter a CHARISMA score between 0 and 99 (inclusive.)</p>';
        $has_error = true;
    }

    // It works!
    // 2025-04-09 - PHP now reports to the user if any changes to the record actually happened.
    if (!$has_error) { // Attempt the update
        if (update_character($_POST, $changes['Character_ID']) > 0) { // record updated
            $system_message = '<p class="system-message">Character updated!</p>'; // Refactor for session instead.
            $records = get_characters();
            header('Location: ./');
        } else { // no record updated, no changes.
            $system_message = '<p class="system-message error">You have not entered any changes.<br>If you would like to leave this character as is, please click on the cancel button.</p>';
            $old_record = get_character_by_id($changes['Character_ID']);
            $skill_list = get_skills();
            include './view/table_update.php';
        }
    }

    // Report input errors
    elseif ($has_error) {
        $old_record = get_character_by_id($changes['Character_ID']);
        $skill_list = get_skills();
        include './view/table_update.php';
    }

    // CRIT FAIL!
    else {
        $system_message .= '<p class="system-message error">Something went horribly wrong. Please contact the webmaster!</p>';

        $old_record = get_character_by_id($changes['Character_ID']);
        $skill_list = get_skills();
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
    $character_name = get_character_by_id($character_id)['Character_Name'];
    include './view/table_delete.php';
} elseif ($action == 'delete-character') {
    /*
        The order of operations needs to be updated each time the database structure changes.
        Use recursive logic to remove records tied to the character record. Once there is no
        other data in the database that relies on the character to exist, Delete the character.
    */
    $system_message = '';
    if (
        delete_character(
            intval(
                get_val_from_postget(
                    'character_id',
                    NULL
                )
            )
        ) > 0
    ) {
        $system_message = '<p class="system-message">Character Deleted!</p>';
    } else {
        $system_message = '<p class="system-message error">Sorry, That record does not seem to exist in our records.</p>';
    }
    $record = get_characters();
    header('Location: ./');
}
?>

