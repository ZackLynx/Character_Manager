<?php
/*
-----------------------------------------------------------------------------------------------
Name:		npc_sheet.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This page shows the stats of a non-player character. This document should be used
            as the basis for the player character sheet which will have more fields and display
            more data.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version.
CBAC        2025-03-10      renamed to `npc_sheet.php`
CBAC        2025-03-30      Beginning work on Skills section
CBAC        2025-03-31      Migrated common form elements to here.
CBAC        2025-04-04      Renamed fields to be consistent with `characters` table column
                            names.
CBAC        2025-04-08      Character_ID field is now always present and only used when
                            updating a character
CBAC        2025-04-11      Beginning the <div> grouping of sheet elements.
CBAC        2025-04-17      Added PHP auto-population of Feats from database.
CBAC        2025-04-19      Fixed numerous bugs with Feats. added `Notes` functionality.
CBAC        2025-04-26      Item system implemented.
CBAC        2025-04-30      Added Character level field
CBAC        2025-05-02      New skills system fully implemented on this page.
CBAC        2025-05-03      placeholder fields for armor and weapons added, php and JavaScript
                            not yet implemented.
CBAC        2025-05-04      Small chances to skill fields for new real-time calculation script.
CBAC        2025-05-08      Tabs fully implemented. Skills are the default view
CBAC        2025-05-10      Class Skill column areas now have ID's for Javascript to work with.
-----------------------------------------------------------------------------------------------
Still To Do:
Dynamically assign this variable based on the characters ability scores.
Make this field dynamic with the class selected via JavaScript.
*/

/**
 * The following variables MUST be initiallized before this page is included:
 * @param array $valMemory A full record from the `characters` table
 * @param array $skill_list A table containing the data from the `skills` table.
 * @param array $character_skills A table containing all skills with non-zero values.
 */

$abilities = ['STR', 'DEX', 'CON', 'INT', 'WIS', 'CHA'];

// foreach ($_POST as $key => $value) {
//     echo '' . $key . ' => ' . $value . '<br>';
// }


?>

<input type="hidden" name="Character_ID" value="<?php echo $valMemory['Character_ID'] ?? 0; ?>" required>

<div id="primary-info">
    <!-- Content in primary info is always visible. -->
    <div>
        <div id="name">
            <label for="Character_Name">Character Name</label>
            <input type="text" name="Character_Name" id="Character_Name" placeholder="<?php
            echo $valMemory['Character_Name']; ?>" value="<?php echo $valMemory['Character_Name']; ?>" required>
        </div>
        <div id="race">
            <label for="Race_ID">Race</label>
            <select name="Race_ID" id="Race_ID">
                <?php if (
                    get_val_from_postget('action', NULL) === 'add-character' ||
                    get_val_from_postget('action', NULL) === 'submit-character'
                ) { ?>
                    <option value="0" <?php echo ($valMemory['Class_ID'] == 0) ? 'selected' : ''; ?>>Select a Race</option>
                <?php } ?>
                <option value="1" <?php echo ($valMemory['Race_ID'] == 1) ? 'selected' : ''; ?>>Dwarf</option>
                <option value="2" <?php echo ($valMemory['Race_ID'] == 2) ? 'selected' : ''; ?>>Elf</option>
                <option value="3" <?php echo ($valMemory['Race_ID'] == 3) ? 'selected' : ''; ?>>Gnome</option>
                <option value="4" <?php echo ($valMemory['Race_ID'] == 4) ? 'selected' : ''; ?>>Half-Elf</option>
                <option value="5" <?php echo ($valMemory['Race_ID'] == 5) ? 'selected' : ''; ?>>Halfling</option>
                <option value="6" <?php echo ($valMemory['Race_ID'] == 6) ? 'selected' : ''; ?>>Half-orc</option>
                <option value="7" <?php echo ($valMemory['Race_ID'] == 7) ? 'selected' : ''; ?>>Human</option>
            </select>
        </div>
        <div id="class">
            <label for="Class_ID">Class</label>
            <select name="Class_ID" id="Class_ID">
                <?php if (
                    get_val_from_postget('action', NULL) === 'add-character' ||
                    get_val_from_postget('action', NULL) === 'submit-character'
                ) { ?>
                    <option value="0" <?php echo ($valMemory['Class_ID'] == 0) ? 'selected' : ''; ?>>Select a Class</option>
                <?php } ?>
                <option value="1" <?php echo ($valMemory['Class_ID'] == 1) ? 'selected' : ''; ?>>Barbarian</option>
                <option value="2" <?php echo ($valMemory['Class_ID'] == 2) ? 'selected' : ''; ?>>Bard</option>
                <option value="3" <?php echo ($valMemory['Class_ID'] == 3) ? 'selected' : ''; ?>>Cleric</option>
                <option value="4" <?php echo ($valMemory['Class_ID'] == 4) ? 'selected' : ''; ?>>Druid</option>
                <option value="5" <?php echo ($valMemory['Class_ID'] == 5) ? 'selected' : ''; ?>>Fighter</option>
                <option value="6" <?php echo ($valMemory['Class_ID'] == 6) ? 'selected' : ''; ?>>Monk</option>
                <option value="7" <?php echo ($valMemory['Class_ID'] == 7) ? 'selected' : ''; ?>>Paladin</option>
                <option value="8" <?php echo ($valMemory['Class_ID'] == 8) ? 'selected' : ''; ?>>Ranger</option>
                <option value="9" <?php echo ($valMemory['Class_ID'] == 9) ? 'selected' : ''; ?>>Rogue</option>
                <option value="10" <?php echo ($valMemory['Class_ID'] == 10) ? 'selected' : ''; ?>>Sorcerer</option>
                <option value="11" <?php echo ($valMemory['Class_ID'] == 11) ? 'selected' : ''; ?>>Wizard</option>
            </select>
        </div>
        <div id="level">
            <label for="Character_Level">Level</label>
            <input type="number" name="Character_Level" id="Character_Level" min="1" max="20" value="<?php echo $valMemory['Character_Level'] ?? 1; ?>" required>
        </div>
        <br>
        <div class="alignment-box">
            <fieldset name="Alignment" id="Alignment">
                <legend>Alignment</legend>
                <p class="lawful-chaotic">
                    Lawful
                </p>
                <div>
                    <p class="good-evil">Good</p>
                    <input type="radio" class="alignment-button" name="alignment" id="lawful-good">
                    <input type="radio" class="alignment-button" name="alignment" id="neutral-good">
                    <input type="radio" class="alignment-button" name="alignment" id="chaotic-good">
                    <br>
                    <input type="radio" class="alignment-button" name="alignment" id="lawful-neutral">
                    <input type="radio" class="alignment-button" name="alignment" id="true-neutral">
                    <input type="radio" class="alignment-button" name="alignment" id="chaotic-neutral">
                    <br>
                    <input type="radio" class="alignment-button" name="alignment" id="lawful-evil">
                    <input type="radio" class="alignment-button" name="alignment" id="neutral-evil">
                    <input type="radio" class="alignment-button" name="alignment" id="chaotic-evil">
                    <p class="good-evil">Evil</p>
                </div>
                <p class="lawful-chaotic">
                    Chaotic
                </p>
            </fieldset>
        </div>
        <div>
            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender">
        </div>
        <div id="health">
            <label for="Current_HP" class="hp-left">Current HP</label>
            <input type="text" class="large-number" name="Current_HP" id="Current_HP">
            /
            <input type="text" class="large-number" name="Max_HP" id="Max_HP">
            <label for="Max_HP" class="hp-right">Max HP</label>
        </div>
    </div>
    <div id="ability-scores">
        <table class="ability-scores">
            <tr>
                <th>
                    <!-- This space intentionally left blank -->
                </th>
                <th>
                    Ability Score
                </th>
                <th>
                    Ability Modifier
                </th>
                <th>
                    Temp Score
                </th>
                <th>
                    Temp Modifier
                </th>
            </tr>
            <tr>
                <td class="ability-label">
                    STR
                </td>
                <td class="total">
                    <input type="number" name="Str_Base" id="Str_Base" value="<?php echo $valMemory['Str_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="str-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Str_Temp" id="Str_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
            <tr>
                <td class="ability-label">
                    DEX
                </td>
                <td>
                    <input type="number" name="Dex_Base" id="Dex_Base" value="<?php echo $valMemory['Dex_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="dex-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Dex_Temp" id="Dex_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
            <tr>
                <td class="ability-label">
                    CON
                </td>
                <td>
                    <input type="number" name="Con_Base" id="Con_Base" value="<?php echo $valMemory['Con_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="con-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Con_Temp" id="Con_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
            <tr>
                <td class="ability-label">
                    INT
                </td>
                <td>
                    <input type="number" name="Int_Base" id="Int_Base" value="<?php echo $valMemory['Int_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="int-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Int_Temp" id="Int_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
            <tr>
                <td class="ability-label">
                    WIS
                </td>
                <td>
                    <input type="number" name="Wis_Base" id="Wis_Base" value="<?php echo $valMemory['Wis_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="wis-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Wis_Temp" id="Wis_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
            <tr>
                <td class="ability-label">
                    CHA
                </td>
                <td>
                    <input type="number" name="Cha_Base" id="Cha_Base" value="<?php echo $valMemory['Cha_Base']; ?>" min="0" max="99" required>
                </td>
                <td class="modifier" id="cha-mod">
                    ##
                </td>
                <td class="temp-score">
                    <input type="number" name="Cha_Temp" id="Cha_Temp" min="0" max="99">
                </td>
                <td class="temp-modifier">

                </td>
            </tr>
        </table>
    </div>
</div>

<div id="tab-view">
    <div id="tabs">
        <button type="button" class="selected-tab" id="button-skills">Skills</button>
        <button type="button" id="button-feats">Feats</button>
        <button type="button" id="button-inventory">Inventory</button>
        <button type="button" id="button-combat">Combat</button>
        <button type="button" id="button-saving-throws">Saving Throws</button>
        <button type="button" id="button-effects">Status Effects</button>
        <button type="button" id="button-notes-block">Notes</button>
    </div>

    <div id="skills">
        <table class="skills-list">
            <tr>
                <th class="skill-header">Skill<br>Name</th>
                <th class="skill-header">Untrained</th>
                <th class="skill-header">Skill<br>Bonus</th>
                <th class="skill-header">Ability</th>
                <th class="skill-header">Class<br>Skill</th>
                <th class="skill-header">Ranks</th>
                <th class="skill-header">Racial</th>
                <th class="skill-header">Feats</th>
                <th class="skill-header">Misc</th>
                <th class="skill-header">ACP</th>
            </tr>
            <?php
            $i = 0;
            foreach ($skill_list as $skill): ?>
                <tr>
                    <td class="skill-name"><?php echo $skill['Skill_Name']; ?></td>
                    <td class="is-untrained"><?php echo $skill['Is_Untrained'] === 1 ? '&FilledSmallSquare;' : '' ?></td>
                    <td class="skill-total" id="<?php echo $skill['Short_Name']; ?>_Total">&pm;##</td>
                    <td class="ability-mod <?php echo $abilities[$skill['Ability_ID'] - 1]; ?>" id="<?php echo $skill['Short_Name']; ?>_Mod"><?php echo $abilities[$skill['Ability_ID'] - 1]; ?></td><!-- TODO: Dynamically assign this variable based on the characters ability scores. -->
                    <td class="is-class-skill" id="<?php echo $skill['Short_Name']; ?>_Class">bool</td><!-- TODO: Make this field dynamic with the class selected via JavaScript. -->
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Ranks" id="<?php echo $skill['Short_Name']; ?>_Ranks" value="<?php echo $character_skills[$i][0] ?? 0; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Racial" id="<?php echo $skill['Short_Name']; ?>_Racial" value="<?php echo $character_skills[$i][1] ?? 0; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Feats" id="<?php echo $skill['Short_Name']; ?>_Feats" value="<?php echo $character_skills[$i][2] ?? 0; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Misc" id="<?php echo $skill['Short_Name']; ?>_Misc" value="<?php echo $character_skills[$i][3] ?? 0; ?>" required></td>

                    <?php
                    /* OLD VERSION
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Ranks" value="<?php echo $valMemory[$skill['Short_Name'] . '_Ranks']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Racial" value="<?php echo $valMemory[$skill['Short_Name'] . '_Racial']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Feats" value="<?php echo $valMemory[$skill['Short_Name'] . '_Feats']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Misc" value="<?php echo $valMemory[$skill['Short_Name'] . '_Misc']; ?>" required></td>
                    */
                    if ($skill['Armored_Penalty'] == 1):
                        ?>
                        <td class="skill-acp" id="<?php echo $skill['Short_Name']; ?>_ACP">-##</td>
                    <?php else: ?>
                        <td class="no-acp"></td>
                    <?php endif; ?>
                </tr>
                <?php
                $i++;
            endforeach; ?>
        </table>
    </div>
    <div id="feats" hidden>
        <p>
            Feats
        </p>
        <div id="feat-list">
            <?php $featNum = 0;
            if (isset($character_feats)) {
                foreach ($character_feats as $feat): ?>
                    <div id="feat_<?php echo $featNum; ?>" class="feat-box">
                        <input type="hidden" name="feat_<?php echo $featNum; ?>_ID" id="feat_<?php echo $featNum; ?>_ID" value="<?php echo $feat['Feat_ID'] ?? 0; ?>">
                        <label for="feat_<?php echo $featNum; ?>_name" class="feat-label">Feat Name: </label>
                        <input type="text" name="feat_<?php echo $featNum; ?>_name" id="feat_<?php echo $featNum; ?>_name" class="feat-field" value="<?php echo $feat['Feat_Name']; ?>" required>
                        <button type="button" class="feat-delete-button" value="<?php echo $feat['Feat_ID'] ?? 0; ?>">Delete Feat</button>
                        <br>
                        <label for="feat_<?php echo $featNum; ?>_desc" class="feat-label">Description:</label>
                        <br>
                        <textarea name="feat_<?php echo $featNum; ?>_desc" id="feat_<?php echo $featNum; ?>_desc" class="feat-field feat_desc"><?php echo $feat['Feat_Desc']; ?></textarea>
                    </div>
                    <?php $featNum++;
                endforeach;
            } ?>
        </div>
        <div class="center-button">
            <button type="button" id="add-feat-button">Add A Feat</button>
        </div>
        <input type="text" name="num-of-feats" id="num-of-feats" value="<?php echo $featNum; ?>" hidden>
        <input type="text" name="feats-to-delete" id="feats-to-delete" hidden>
    </div>
    <div id="inventory" hidden>
        <p>
            Inventory
        </p>
        <div id="inventory-list">
            <?php $ItemNum = 0;
            if (isset($character_items)) {
                foreach ($character_items as $item): ?>
                    <div id="item_<?php echo $ItemNum; ?>" class="item-box">
                        <input type="hidden" name="item_<?php echo $ItemNum; ?>_ID" id="item_<?php echo $ItemNum; ?>_ID" value="<?php echo $item['Inventory_ID'] ?? 0; ?>">

                        <label for="item_<?php echo $ItemNum; ?>_name" class="item-label">Item Name: </label>
                        <input type="text" name="item_<?php echo $ItemNum; ?>_name" id="item_<?php echo $ItemNum; ?>_name" class="item-field" value="<?php echo $item['Item_Name']; ?>" required>

                        <button type="button" class="item-delete-button" value="<?php echo $item['Inventory_ID'] ?? 0; ?>">Delete item</button>
                        <br>
                        <label for="item_<?php echo $ItemNum; ?>_desc" class="item-label">Description:</label>
                        <br>
                        <textarea name="item_<?php echo $ItemNum; ?>_desc" id="item_<?php echo $ItemNum; ?>_desc" class="item-field item_desc"><?php echo $item['Item_Desc']; ?></textarea>
                    </div>
                    <?php $ItemNum++;
                endforeach;
            } ?>
        </div>
        <div class="center-button">
            <button type="button" id="add-item-button">Add An Item</button>
        </div>
        <input type="text" name="num-of-items" id="num-of-items" value="<?php echo $ItemNum; ?>" hidden>
        <input type="text" name="items-to-delete" id="items-to-delete" hidden>
    </div>
    <div id="combat" hidden>
        <p>TO BE IMPLEMENTED</p>
        <div id="attacks">
            <div id="weapon-primary">
                <label for="weapon-primary-name">Weapon Name</label>
                <input type="text" name="weapon-primary-name" id="weapon-primary-name" value="">
                <br>
                <label for="weapon-primary-type">Type</label>
                <input type="text" name="weapon-primary-type" id="weapon-primary-type" value="">
                <br>
                <label for="weapon-primary-range">Range</label>
                <input type="number" name="weapon-primary-range" id="weapon-primary-range" value="" min="0">
                <br>
                <label for="weapon-primary-attack-bonus">Attack Bonus</label>
                <input type="number" name="weapon-primary-attack-bonus" id="weapon-primary-attack-bonus" value="">
                <br>
                <label for="weapon-primary-damage">Damage</label>
                <input type="number" name="weapon-primary-damage" id="weapon-primary-damage" value="" min="1">
                <select name="weapon-primary-dice" id="weapon-primary-dice">
                    <option value="1">d4</option>
                    <option value="2">d6</option>
                    <option value="3">d8</option>
                    <option value="4">d10</option>
                    <option value="5">d12</option>
                    <option value="6">d20</option>
                </select>
                <br>
                <label for="weapon-primary-crit-range">Critical</label>
                <input type="number" name="weapon-primary-crit-range" id="weapon-primary-crit-range">
                x
                <input type="number" name="weapon-primary-crit-multiplier" id="weapon-primary-crit-multiplier" min="2">
            </div>
        </div>
        <div id="defense">
            <p>
                Armor
            </p>
            <div id="armor">
                <label for="armor-name">Name</label>
                <input type="text" name="armor-name" id="armor-name">
                <br>
                <label for="armor-type">Type</label>
                <select name="armor-type" id="armor-type">
                    <option value="1">Light</option>
                    <option value="2">Medium</option>
                    <option value="3">Heavy</option>
                </select>
                <br>
                <label for="max-speed">Max Speed</label>
                <input type="number" name="max-speed" id="max-speed">
                <br>
                <label for="max-dex">Max AC Dex</label>
                <input type="number" name="max-dex" id="max-dex">
                <br>
                <label for="armor-acp">Check Penalty</label>
                <input type="number" name="armor-acp" id="armor-acp">
                <br>
                <label for="armor-weight">Weight</label>
                <input type="number" name="armor-weight" id="armor-weight"> lb
                <br>
                <label for="armor-ac">Armor AC</label>
                <input type="number" name="armor-ac" id="armor-ac">
            </div>
            <p>
                Shield
            </p>
            <div id="shield">
                <label for="shield-name">Name</label>
                <input type="text" name="shield-name" id="shield-name">
                <br>
                <label for="shield-acp">Check Penalty</label>
                <input type="number" name="shield-acp" id="shield-acp">
                <br>
                <label for="shield-weight">Weight</label>
                <input type="number" name="shield-weight" id="shield-weight"> lb
                <br>
                <label for="shield-ac">Shield AC</label>
                <input type="number" name="shield-ac" id="shield-ac">
            </div>
        </div>

    </div>
    <div id="saving-throws" hidden>
        <p>
            COMING SOON!
        </p>
    </div>
    <div id="effects" hidden>
        <p>
            COMING SOON!
        </p>
    </div>
    <div id="notes-block" hidden>
        <label for="Notes">Notes</label>
        <br>
        <textarea name="Notes" id="Notes"><?php echo $valMemory['Notes']; ?></textarea>
    </div>
</div>

<script src="./js/character_sheet.js"></script>
