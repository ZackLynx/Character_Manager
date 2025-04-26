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
-----------------------------------------------------------------------------------------------
Still To Do:
Dynamically assign this variable based on the characters ability scores.
Make this field dynamic with the class selected via JavaScript.
*/

/**
 * The following variables MUST be initiallized before this page is included:
 * @param array $valMemory A full record from the `characters` table
 * @param array $skill_list A 2-dimensional array containing the data from the `skills` table.
 */

$abilities = ['STR', 'DEX', 'CON', 'INT', 'WIS', 'CHA'];

foreach ($_POST as $key => $value) {
    echo '' . $key . ' => ' . $value . '<br>';
}

if (isset($character_items)) {
    foreach ($character_items as $item) {
        foreach ($item as $key => $value) {
            echo '' . $key . ' => ' . $value . '<br>';
        }
    }
}

?>

<input type="hidden" name="Character_ID" value="<?php echo $valMemory['Character_ID'] ?? 0; ?>" required>

<div id="primary-info">
    <div class="box">
        <div>
            <label for="Character_Name">Character Name</label>
            <input type="text" name="Character_Name" id="Character_Name" placeholder="<?php
            echo $valMemory['Character_Name']; ?>" value="<?php echo $valMemory['Character_Name']; ?>" required>
        </div>
        <div>
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
    </div>
    <!-- level -->
</div>
<div class="two-column">
    <div id="secondary-info">
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
        <!-- allignment -->
        <!-- size -->
        <!-- gender -->
    </div>
    <div id="ability-scores">
        <!-- in row major order, display total, modifier, temp score, and temp modifier fields -->
        <!-- Replace with table -->
        <div id="strength-scores">
            <div class="total">
                <label for="Str_Base">STR</label>
                <input type="number" name="Str_Base" id="Str_Base" value="<?php echo $valMemory['Str_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <div id="dexterity-scores">
            <div class="total">
                <label for="Dex_Base">DEX</label>
                <input type="number" name="Dex_Base" id="Dex_Base" value="<?php echo $valMemory['Dex_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <div id="constitution-scores">
            <div class="total">
                <label for="Con_Base">CON</label>
                <input type="number" name="Con_Base" id="Con_Base" value="<?php echo $valMemory['Con_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <div id="intelligence-scores">
            <div class="total">
                <label for="Int_Base">INT</label>
                <input type="number" name="Int_Base" id="Int_Base" value="<?php echo $valMemory['Int_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <div id="wisdom-scores">
            <div class="total">
                <label for="Wis_Base">WIS</label>
                <input type="number" name="Wis_Base" id="Wis_Base" value="<?php echo $valMemory['Wis_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <div id="charisma-scores">
            <div class="total">
                <label for="Cha_Base">CHA</label>
                <input type="number" name="Cha_Base" id="Cha_Base" value="<?php echo $valMemory['Cha_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
        <table hidden>
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
                <td class="ablity-label">
                    STR
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="ablity-label">
                    DEX
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="ablity-label">
                    CON
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="ablity-label">
                    INT
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="ablity-label">
                    WIS
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="ablity-label">
                    CHA
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
        </table>
    </div>
    <div id="equipment">
    </div>

    <!-- Skills -->
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
            <?php foreach ($skill_list as $skill): ?>
                <tr>
                    <td class="skill-name"><?php echo $skill['Skill_Name']; ?></td>
                    <td class="is-untrained"><?php echo $skill['Is_Untrained'] === 1 ? '&FilledSmallSquare;' : '' ?></td>
                    <td class="skill-total">&pm;##</td>
                    <td class="ability-mod"><?php echo $abilities[$skill['Ability_ID'] - 1]; ?></td><!-- TODO: Dynamically assign this variable based on the characters ability scores. -->
                    <td class="is-class-skill">bool</td><!-- TODO: Make this field dynamic with the class selected via JavaScript. -->
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Ranks" value="<?php echo $valMemory[$skill['Short_Name'] . '_Ranks']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Racial" value="<?php echo $valMemory[$skill['Short_Name'] . '_Racial']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Feats" value="<?php echo $valMemory[$skill['Short_Name'] . '_Feats']; ?>" required></td>
                    <td class="skill-input"><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Misc" value="<?php echo $valMemory[$skill['Short_Name'] . '_Misc']; ?>" required></td>
                    <td class="skill-acp"></td><!-- To Be Implemented -->
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div id="feats-block">
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

    <div id="inventory">
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

    <div id="notes-block">
        <label for="Notes">Notes</label>
        <br>
        <textarea name="Notes" id="Notes"><?php echo $valMemory['Notes']; ?></textarea>
    </div>
</div>
<div id="health">
</div>
<div class="two-column">
    <div id="combat">
    </div>
    <div id="combat-maneuvers">
    </div>
    <div id="attacks">
    </div>
    <div id="defense">
    </div>
    <div id="saving-throws">
    </div>
    <div id="combat-abilities">
    </div>
    <div id="effects">
    </div>
</div>

<script src="./js/character_sheet.js">

</script>
