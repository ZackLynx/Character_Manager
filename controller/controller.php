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
CBAC        2025-04-18      Implemented functionality for Feat CRUD actions.
CBAC        2025-04-19      Fixed numerous bugs with Feat CRUD implementation.
CBAC        2025-04-24      Added a test-input action for analyzing POST data sent in test.php
CBAC        2025-04-25      Beginning implementation of Inventory system.
CBAC        2025-04-26      Inventory implementation completed.
CBAC        2025-04-27      added migrate-skills action for Skills rework
CBAC        2025-04-28      First successful test of skill values migration. Moved from if-else
                            branches to switch-case blocks for actions
CBAC        2025-05-02      Finished skills rework implementation
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

try {
    switch ($action) {
        case 'view-characters':
            $records = get_characters();
            include './view/table_list.php';
            break;

        case 'add-character':
            $skill_list = get_skills();
            include './view/table_add.php';
            break;

        case 'submit-character':

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
                'Cha_Base' => get_val_from_postget('Cha_Base', -1),
                'Character_Level' => get_val_from_postget('Character_Level', -1)
            ];
            $values['Character_Name'] = trim($values['Character_Name']);

            // Process feats from POST and or GET.
            $character_feats = [];
            $total = get_val_from_postget('num-of-feats', 0);
            $i = 0;
            $j = 0;
            while ($i < $total) {
                if (isset($_POST['feat_' . $j . '_name'])) {
                    $feat_name = get_val_from_postget('feat_' . $j . '_name', '');
                    $feat_desc = get_val_from_postget('feat_' . $j . '_desc', '');
                    array_push(
                        $character_feats,
                        ['Feat_Name' => $feat_name, 'Feat_Desc' => $feat_desc]
                    );
                    $i++;
                    $j++;
                } else {
                    $j++;
                }
            }

            // Process items from POST and or GET.
            $character_items = [];
            $total = get_val_from_postget('num-of-items', 0);
            $i = 0;
            $j = 0;
            while ($i < $total) {
                if (isset($_POST['item_' . $j . '_name'])) {
                    $item_name = get_val_from_postget('item_' . $j . '_name', '');
                    $item_desc = get_val_from_postget('item_' . $j . '_desc', '');
                    array_push(
                        $character_items,
                        ['Item_Name' => $item_name, 'Item_Desc' => $item_desc]
                    );
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
            foreach ($character_feats as $feat) {
                if (empty(trim($feat['Feat_Name']))) {
                    $system_message .= '<p class="system-message error">One or more feats has a blank name. Please give these feats a name.</p>';
                    $has_error = true;
                    break;
                }
            }

            // Check item names for blanks
            foreach ($character_items as $item) {
                if (empty(trim($item['Item_Name']))) {
                    $system_message .= '<p class="system-message error">One or more items has a blank name. Please give these items a name.</p>';
                    $has_error = true;
                    break;
                }
            }

            // It works!
            if (!$has_error && (add_character($_POST) > 0)) {

                $character_ID = $db->lastInsertId();

                // Process feats
                foreach ($character_feats as $feat) {
                    add_feat(
                        $character_ID,
                        trim($feat['Feat_Name']),
                        trim($feat['Feat_Desc'])
                    );
                }

                // Process items
                foreach ($character_items as $item) {
                    add_inventory(
                        $character_ID,
                        trim($item['Item_Name']),
                        trim($item['Item_Desc'])
                    );
                }

                // Add skills
                $skills_updated = 0;
                $skill_names = ["Acrob_Ranks", "Acrob_Racial", "Acrob_Feats", "Acrob_Misc", "Appra_Ranks", "Appra_Racial", "Appra_Feats", "Appra_Misc", "Bluff_Ranks", "Bluff_Racial", "Bluff_Feats", "Bluff_Misc", "Climb_Ranks", "Climb_Racial", "Climb_Feats", "Climb_Misc", "Craft_Ranks", "Craft_Racial", "Craft_Feats", "Craft_Misc", "Diplo_Ranks", "Diplo_Racial", "Diplo_Feats", "Diplo_Misc", "DsDev_Ranks", "DsDev_Racial", "DsDev_Feats", "DsDev_Misc", "Disgu_Ranks", "Disgu_Racial", "Disgu_Feats", "Disgu_Misc", "Escar_Ranks", "Escar_Racial", "Escar_Feats", "Escar_Misc", "Fly_Ranks", "Fly_Racial", "Fly_Feats", "Fly_Misc", "Hanim_Ranks", "Hanim_Racial", "Hanim_Feats", "Hanim_Misc", "Heal_Ranks", "Heal_Racial", "Heal_Feats", "Heal_Misc", "Intim_Ranks", "Intim_Racial", "Intim_Feats", "Intim_Misc", "Karca_Ranks", "Karca_Racial", "Karca_Feats", "Karca_Misc", "Kdung_Ranks", "Kdung_Racial", "Kdung_Feats", "Kdung_Misc", "Kengi_Ranks", "Kengi_Racial", "Kengi_Feats", "Kengi_Misc", "Kgeog_Ranks", "Kgeog_Racial", "Kgeog_Feats", "Kgeog_Misc", "Khist_Ranks", "Khist_Racial", "Khist_Feats", "Khist_Misc", "Kloca_Ranks", "Kloca_Racial", "Kloca_Feats", "Kloca_Misc", "Knatu_Ranks", "Knatu_Racial", "Knatu_Feats", "Knatu_Misc", "Knobi_Ranks", "Knobi_Racial", "Knobi_Feats", "Knobi_Misc", "Kplan_Ranks", "Kplan_Racial", "Kplan_Feats", "Kplan_Misc", "Kreli_Ranks", "Kreli_Racial", "Kreli_Feats", "Kreli_Misc", "Lingu_Ranks", "Lingu_Racial", "Lingu_Feats", "Lingu_Misc", "Perce_Ranks", "Perce_Racial", "Perce_Feats", "Perce_Misc", "Perfo_Ranks", "Perfo_Racial", "Perfo_Feats", "Perfo_Misc", "Profe_Ranks", "Profe_Racial", "Profe_Feats", "Profe_Misc", "Ride_Ranks", "Ride_Racial", "Ride_Feats", "Ride_Misc", "Senmo_Ranks", "Senmo_Racial", "Senmo_Feats", "Senmo_Misc", "SOH_Ranks", "SOH_Racial", "SOH_Feats", "SOH_Misc", "Spcft_Ranks", "Spcft_Racial", "Spcft_Feats", "Spcft_Misc", "Stlth_Ranks", "Stlth_Racial", "Stlth_Feats", "Stlth_Misc", "Survi_Ranks", "Survi_Racial", "Survi_Feats", "Survi_Misc", "Swim_Ranks", "Swim_Racial", "Swim_Feats", "Swim_Misc", "Umdev_Ranks", "Umdev_Racial", "Umdev_Feats", "Umdev_Misc"];

                $k = 0;
                for ($i = 1; $i <= 35; $i++) {
                    for ($j = 1; $j <= 4; $j++) {
                        $skills_updated += enter_skill_value($character_ID, $i, $j, $_POST[$skill_names[$k++]]);
                    }
                }

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
            break;

        case 'edit-character':
            $character_ID = get_val_from_postget('character_id', NULL);
            $old_record = get_character_by_id($character_ID); // used by table_update.php
            $skill_list = get_skills();
            $character_skills = get_character_skills($character_ID);
            $character_feats = get_feats($character_ID);
            $character_items = get_inventory($character_ID);
            include './view/table_update.php';
            break;

        case 'save-changes':
            // include './view/test.php';
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
                'Cha_Base' => get_val_from_postget('Cha_Base', -1),
                'Character_Level' => get_val_from_postget('Character_Level', -1)
            ];
            $changes['Character_Name'] = trim($changes['Character_Name']);

            // Process feats from POST and or GET.
            $character_feats = [];
            $existing_feats = [];   // Used if all entries
            $new_feats = [];        // are valid.

            $total = get_val_from_postget('num-of-feats', 0);
            $i = 0;
            $j = 0;
            while ($i < $total) {
                if (isset($_POST['feat_' . $j . '_name'])) {
                    $feat_id = get_val_from_postget('feat_' . $j . '_ID', 0);
                    $feat_name = get_val_from_postget('feat_' . $j . '_name', '');
                    $feat_desc = get_val_from_postget('feat_' . $j . '_desc', '');

                    array_push(
                        $character_feats,
                        ['Feat_ID' => $feat_id, 'Feat_Name' => $feat_name, 'Feat_Desc' => $feat_desc]
                    );

                    // New feats
                    if (intval($_POST['feat_' . $j . '_ID']) === 0) {
                        array_push(
                            $new_feats,
                            ['Feat_Name' => $feat_name, 'Feat_Desc' => $feat_desc]
                        );
                    }

                    // Modified feats
                    else {
                        array_push(
                            $existing_feats,
                            ['Feat_ID' => $feat_id, 'Feat_Name' => $feat_name, 'Feat_Desc' => $feat_desc]
                        );
                    }
                    $i++;
                    $j++;
                } else {
                    $j++;
                }
            }

            // Deleted feats
            $deleted_feats = get_val_from_postget('feats-to-delete', '');


            // Process items from POST and or GET.
            $character_items = [];
            $existing_items = [];   // Used if all entries
            $new_items = [];        // are valid.

            $total = get_val_from_postget('num-of-items', 0);
            $i = 0;
            $j = 0;
            while ($i < $total) {
                if (isset($_POST['item_' . $j . '_name'])) {
                    $item_id = get_val_from_postget('item_' . $j . '_ID', 0);
                    $item_name = get_val_from_postget('item_' . $j . '_name', '');
                    $item_desc = get_val_from_postget('item_' . $j . '_desc', '');

                    array_push(
                        $character_items,
                        ['Inventory_ID' => $item_id, 'Item_Name' => $item_name, 'Item_Desc' => $item_desc]
                    );

                    // New items
                    if (intval($_POST['item_' . $j . '_ID']) === 0) {
                        array_push(
                            $new_items,
                            ['Item_Name' => $item_name, 'Item_Desc' => $item_desc]
                        );
                    }

                    // Modified items
                    else {
                        array_push(
                            $existing_items,
                            ['Inventory_ID' => $item_id, 'Item_Name' => $item_name, 'Item_Desc' => $item_desc]
                        );
                    }
                    $i++;
                    $j++;
                } else {
                    $j++;
                }
            }

            // Deleted items
            $deleted_items = get_val_from_postget('items-to-delete', '');

            $system_message = '';
            $has_error = false;

            // Check character name
            if (empty($changes['Character_Name'])) {
                $system_message .= '<p class="system-message error">Character name cannot be blank.</p>';
                $has_error = true;
            }

            // check for illegal characters
            if (!validate_characters($changes['Character_Name'])) {
                $system_message .= '<p class="system-message error">Name may only contain letters, dashes, apostrophes, and spaces between names/words.</p>';
                $has_error = true;
            }

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

            // Check feat names for blanks
            foreach ($character_feats as $feat) {
                if (empty(trim($feat['Feat_Name']))) {
                    $system_message .= '<p class="system-message error">One or more feats has a blank name. Please give these feats a name.</p>';
                    $has_error = true;
                    break;
                }
            }

            // Check item names for blanks
            foreach ($character_items as $item) {
                if (empty(trim($item['Item_Name']))) {
                    $system_message .= '<p class="system-message error">One or more items has a blank name. Please give these items a name.</p>';
                    $has_error = true;
                    break;
                }
            }

            // It works!
            // 2025-04-09 - PHP now reports to the user if any changes to the record actually happened.
            if (!$has_error) { // Attempt the update
                // include './view/test.php';

                // Update feats
                $feats_updated = 0;
                if (sizeof($existing_feats) > 0) {
                    foreach ($existing_feats as $feat) {
                        $feats_updated += modify_feat(
                            $changes['Character_ID'],
                            $feat['Feat_ID'],
                            trim($feat['Feat_Name']),
                            trim($feat['Feat_Desc'])
                        );
                    }
                }

                // Update items
                $items_updated = 0;
                if (sizeof($existing_items) > 0) {
                    foreach ($existing_items as $item) {
                        $items_updated += modify_inventory(
                            $changes['Character_ID'],
                            $item['Inventory_ID'], // Came up undefined
                            trim($item['Item_Name']),
                            trim($item['Item_Desc'])
                        );
                    }
                }

                // Update Skills
                $skills_updated = 0;
                $skill_names = ["Acrob_Ranks", "Acrob_Racial", "Acrob_Feats", "Acrob_Misc", "Appra_Ranks", "Appra_Racial", "Appra_Feats", "Appra_Misc", "Bluff_Ranks", "Bluff_Racial", "Bluff_Feats", "Bluff_Misc", "Climb_Ranks", "Climb_Racial", "Climb_Feats", "Climb_Misc", "Craft_Ranks", "Craft_Racial", "Craft_Feats", "Craft_Misc", "Diplo_Ranks", "Diplo_Racial", "Diplo_Feats", "Diplo_Misc", "DsDev_Ranks", "DsDev_Racial", "DsDev_Feats", "DsDev_Misc", "Disgu_Ranks", "Disgu_Racial", "Disgu_Feats", "Disgu_Misc", "Escar_Ranks", "Escar_Racial", "Escar_Feats", "Escar_Misc", "Fly_Ranks", "Fly_Racial", "Fly_Feats", "Fly_Misc", "Hanim_Ranks", "Hanim_Racial", "Hanim_Feats", "Hanim_Misc", "Heal_Ranks", "Heal_Racial", "Heal_Feats", "Heal_Misc", "Intim_Ranks", "Intim_Racial", "Intim_Feats", "Intim_Misc", "Karca_Ranks", "Karca_Racial", "Karca_Feats", "Karca_Misc", "Kdung_Ranks", "Kdung_Racial", "Kdung_Feats", "Kdung_Misc", "Kengi_Ranks", "Kengi_Racial", "Kengi_Feats", "Kengi_Misc", "Kgeog_Ranks", "Kgeog_Racial", "Kgeog_Feats", "Kgeog_Misc", "Khist_Ranks", "Khist_Racial", "Khist_Feats", "Khist_Misc", "Kloca_Ranks", "Kloca_Racial", "Kloca_Feats", "Kloca_Misc", "Knatu_Ranks", "Knatu_Racial", "Knatu_Feats", "Knatu_Misc", "Knobi_Ranks", "Knobi_Racial", "Knobi_Feats", "Knobi_Misc", "Kplan_Ranks", "Kplan_Racial", "Kplan_Feats", "Kplan_Misc", "Kreli_Ranks", "Kreli_Racial", "Kreli_Feats", "Kreli_Misc", "Lingu_Ranks", "Lingu_Racial", "Lingu_Feats", "Lingu_Misc", "Perce_Ranks", "Perce_Racial", "Perce_Feats", "Perce_Misc", "Perfo_Ranks", "Perfo_Racial", "Perfo_Feats", "Perfo_Misc", "Profe_Ranks", "Profe_Racial", "Profe_Feats", "Profe_Misc", "Ride_Ranks", "Ride_Racial", "Ride_Feats", "Ride_Misc", "Senmo_Ranks", "Senmo_Racial", "Senmo_Feats", "Senmo_Misc", "SOH_Ranks", "SOH_Racial", "SOH_Feats", "SOH_Misc", "Spcft_Ranks", "Spcft_Racial", "Spcft_Feats", "Spcft_Misc", "Stlth_Ranks", "Stlth_Racial", "Stlth_Feats", "Stlth_Misc", "Survi_Ranks", "Survi_Racial", "Survi_Feats", "Survi_Misc", "Swim_Ranks", "Swim_Racial", "Swim_Feats", "Swim_Misc", "Umdev_Ranks", "Umdev_Racial", "Umdev_Feats", "Umdev_Misc"];

                $k = 0;
                for ($i = 1; $i <= 35; $i++) {
                    for ($j = 1; $j <= 4; $j++) {
                        $skills_updated += enter_skill_value($_POST['Character_ID'], $i, $j, $_POST[$skill_names[$k++]]);
                    }
                }

                if (
                    (update_character($_POST, $changes['Character_ID']) > 0) ||
                    (!empty($new_feats)) || $feats_updated || (!empty($deleted_feats)) ||
                    (!empty($new_items)) || $items_updated || (!empty($deleted_items)) ||
                    $skills_updated
                ) { // record updated

                    // Process feats
                    // New feats

                    foreach ($new_feats as $feat) {
                        add_feat($changes['Character_ID'], trim($feat['Feat_Name']), trim($feat['Feat_Desc']));
                    }

                    // Deleted Feats
                    if (!empty(trim($deleted_feats))) {
                        delete_feats($changes['Character_ID'], $deleted_feats);
                    }

                    //Process items
                    // New items
                    foreach ($new_items as $item) {
                        add_inventory(
                            $changes['Character_ID'],
                            trim($item['Item_Name']),
                            trim($item['Item_Desc'])
                        );
                    }

                    // Deleted items
                    if (!empty(trim($deleted_items))) {
                        delete_inventory($character_ID, $deleted_items);
                    }


                    // All done!
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
                $system_message .= '<p class="system-message error">Logic error encountered! Please let Connor know!</p>';

                $old_record = get_character_by_id($changes['Character_ID']);
                $skill_list = get_skills();
                include './view/table_update.php';
            }
            break;

        case 'confirm-deletion':
            $character_id = $_POST['character_id'];
            $character_name = get_character_by_id($character_id)['Character_Name'];
            include './view/table_delete.php';
            break;

        case 'delete-character':
            /*
                The order of operations needs to be updated each time the database structure changes.
                Use recursive logic to remove records tied to the character record. Once there is no
                other data in the database that relies on the character to exist, Delete the character.
            */
            $system_message = '';
            if (
                (delete_character(
                    intval(
                        get_val_from_postget(
                            'character_id',
                            NULL
                        )
                    )
                ) > 0)
            ) {
                $system_message = '<p class="system-message">Character Deleted!</p>';
            } else {
                $system_message = '<p class="system-message error">Sorry, That record does not seem to exist in our records.</p>';
            }
            $record = get_characters();
            header('Location: ./');
            break;

        case 'test':
            $character_items = get_inventory(1);
            $character_feats = get_feats(1);
            include './view/test.php';
            break;

        case 'test-input':
            // foreach ($_POST as $key => $value) {
            //     echo '' . $key . ' => ' . $value . '<br>';
            // }
            setcookie("class_skills", "BITCHES");
            foreach ($_COOKIE as $key => $value) {
                echo '' . $key . ' => ' . $value . ';<br>';

            }


            break;

        case 'migrate-skills':
            $skill_names = ["Acrob_Ranks", "Acrob_Racial", "Acrob_Feats", "Acrob_Misc", "Appra_Ranks", "Appra_Racial", "Appra_Feats", "Appra_Misc", "Bluff_Ranks", "Bluff_Racial", "Bluff_Feats", "Bluff_Misc", "Climb_Ranks", "Climb_Racial", "Climb_Feats", "Climb_Misc", "Craft_Ranks", "Craft_Racial", "Craft_Feats", "Craft_Misc", "Diplo_Ranks", "Diplo_Racial", "Diplo_Feats", "Diplo_Misc", "DsDev_Ranks", "DsDev_Racial", "DsDev_Feats", "DsDev_Misc", "Disgu_Ranks", "Disgu_Racial", "Disgu_Feats", "Disgu_Misc", "Escar_Ranks", "Escar_Racial", "Escar_Feats", "Escar_Misc", "Fly_Ranks", "Fly_Racial", "Fly_Feats", "Fly_Misc", "Hanim_Ranks", "Hanim_Racial", "Hanim_Feats", "Hanim_Misc", "Heal_Ranks", "Heal_Racial", "Heal_Feats", "Heal_Misc", "Intim_Ranks", "Intim_Racial", "Intim_Feats", "Intim_Misc", "Karca_Ranks", "Karca_Racial", "Karca_Feats", "Karca_Misc", "Kdung_Ranks", "Kdung_Racial", "Kdung_Feats", "Kdung_Misc", "Kengi_Ranks", "Kengi_Racial", "Kengi_Feats", "Kengi_Misc", "Kgeog_Ranks", "Kgeog_Racial", "Kgeog_Feats", "Kgeog_Misc", "Khist_Ranks", "Khist_Racial", "Khist_Feats", "Khist_Misc", "Kloca_Ranks", "Kloca_Racial", "Kloca_Feats", "Kloca_Misc", "Knatu_Ranks", "Knatu_Racial", "Knatu_Feats", "Knatu_Misc", "Knobi_Ranks", "Knobi_Racial", "Knobi_Feats", "Knobi_Misc", "Kplan_Ranks", "Kplan_Racial", "Kplan_Feats", "Kplan_Misc", "Kreli_Ranks", "Kreli_Racial", "Kreli_Feats", "Kreli_Misc", "Lingu_Ranks", "Lingu_Racial", "Lingu_Feats", "Lingu_Misc", "Perce_Ranks", "Perce_Racial", "Perce_Feats", "Perce_Misc", "Perfo_Ranks", "Perfo_Racial", "Perfo_Feats", "Perfo_Misc", "Profe_Ranks", "Profe_Racial", "Profe_Feats", "Profe_Misc", "Ride_Ranks", "Ride_Racial", "Ride_Feats", "Ride_Misc", "Senmo_Ranks", "Senmo_Racial", "Senmo_Feats", "Senmo_Misc", "SOH_Ranks", "SOH_Racial", "SOH_Feats", "SOH_Misc", "Spcft_Ranks", "Spcft_Racial", "Spcft_Feats", "Spcft_Misc", "Stlth_Ranks", "Stlth_Racial", "Stlth_Feats", "Stlth_Misc", "Survi_Ranks", "Survi_Racial", "Survi_Feats", "Survi_Misc", "Swim_Ranks", "Swim_Racial", "Swim_Feats", "Swim_Misc", "Umdev_Ranks", "Umdev_Racial", "Umdev_Feats", "Umdev_Misc"];

            // grab ALL the characters.
            $characters = get_characters_all_data();
            $game_skills = get_skills();
            $skill_fields = get_skill_modifiers();

            // There are 35 skills and 4 text entry fields, 140 fields per character.
            // character skills record: (character ID, Skill ID (row), Bonus Type (column), bonus value)
            foreach ($characters as $character_sheet) {
                $i = 0;
                foreach ($game_skills as $skill_id) {
                    foreach ($skill_fields as $modifier_id) {
                        echo "" . $character_sheet['Character_ID'] . ", "
                            . $skill_id['Skill_ID'] . ", "
                            . $modifier_id['Modifier_ID'] . ", "
                            . $character_sheet[$skill_names[$i]] . ", "
                            . $skill_names[$i] . "<br>";
                        enter_skill_value(
                            $character_sheet['Character_ID'],
                            $skill_id['Skill_ID'],
                            $modifier_id['Modifier_ID'],
                            $character_sheet[$skill_names[$i++]]
                        );
                    }
                }
            }
            echo 'Process Complete!';
            break;

    }

    // // Read the characters table
    // if ($action == 'view-characters') {
    //     $records = get_characters();
    //     include './view/table_list.php';
    // }

    // // Add a character
    // elseif ($action == 'add-character') {
    //     $skill_list = get_skills();
    //     include './view/table_add.php';
    // }

    // // Submit the new character
    // elseif ($action == 'submit-character') {


    // }

    // // Edit a character
    // elseif ($action == 'edit-character') {

    // }

    // // Save the changes made
    // elseif ($action == 'save-changes') {

    // }

    // // Delete a character
    // elseif ($action == 'confirm-deletion') {
    //     /*
    //         To be Completed.
    //         First ask the user to confirm their choice to delete the character by entering the
    //         character name. If the character name matches, begin the process of deleting.
    //     */

    // } elseif ($action == 'delete-character') {

    // }

    // // For debug purposes.
    // elseif ($action == 'test') {

    // } elseif ($action == 'test-input') {

    // } elseif ($action == 'migrate-skills') {

    // }
} catch (Exception $e) {
    $error_message = $e->getMessage();
    include './errors/error.php';
}
?>

