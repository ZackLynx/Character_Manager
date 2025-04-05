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
CBAC        2025-03-31      Migrated core functionality of `table_update.php` to here.
-----------------------------------------------------------------------------------------------
Still To Do:
Dynamically assign this variable based on the characters ability scores.
Make this field dynamic with the class selected via JavaScript.
*/

/**
 * Before including this file, initialize the following variables:
 * @param array $valMemory A full record from the `characters` table
 * @param array $skill_list A 2-dimensional array containing the data from the `skills` table.
 */

$abilities = ['STR', 'DEX', 'CON', 'INT', 'WIS', 'CHA'];
?>


<!-- Reserved for data redundancy -->

<?php if (get_val_from_postget('action', NULL) === 'edit-character') { ?>
    <input type="hidden" name="character-id" value="<?php echo $valMemory['Character_ID']; ?>" required>
<?php } ?>


<input type="hidden" name="old-name" value="<?php echo $valMemory['Character_Name']; ?>" required>
<!-- Old scores -->
<input type="hidden" name="old-str" value="<?php echo $valMemory['Str_Base'] ?>">
<input type="hidden" name="old-dex" value="<?php echo $valMemory['Dex_Base'] ?>">
<input type="hidden" name="old-con" value="<?php echo $valMemory['Con_Base'] ?>">
<input type="hidden" name="old-int" value="<?php echo $valMemory['Int_Base'] ?>">
<input type="hidden" name="old-wis" value="<?php echo $valMemory['Wis_Base'] ?>">
<input type="hidden" name="old-cha" value="<?php echo $valMemory['Cha_Base'] ?>">

<div id="primary-info">
    <label for="character-name">Character Name</label>
    <input type="text" name="character-name" id="character-name" placeholder="<?php
    echo $valMemory['Character_Name']; ?>" value="<?php echo $valMemory['Character_Name']; ?>" required>
    <label for="character-class">Class</label>
    <select name="character-class" id="character-class">
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
    <!-- level -->
    <!-- challenge rating -->
</div>
<div class="two-column">
    <div id="secondary-info">
        <label for="character-race">Race</label>
        <select name="character-race" id="character-race">
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
        <div id="strength-scores">
            <div class="total">
                <label for="str-stat">STR</label>
                <input type="number" name="str-stat" id="str-stat" value="<?php echo $valMemory['Str_Base']; ?>" min="0" max="99">
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
                <label for="dex-stat">DEX</label>
                <input type="number" name="dex-stat" id="dex-stat" value="<?php echo $valMemory['Dex_Base']; ?>" min="0" max="99">
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
                <label for="con-stat">CON</label>
                <input type="number" name="con-stat" id="con-stat" value="<?php echo $valMemory['Con_Base']; ?>" min="0" max="99">
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
                <label for="int-stat">INT</label>
                <input type="number" name="int-stat" id="int-stat" value="<?php echo $valMemory['Int_Base']; ?>" min="0" max="99">
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
                <label for="wis-stat">WIS</label>
                <input type="number" name="wis-stat" id="wis-stat" value="<?php echo $valMemory['Wis_Base']; ?>" min="0" max="99">
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
                <label for="cha-stat">CHA</label>
                <input type="number" name="cha-stat" id="cha-stat" value="<?php echo $valMemory['Cha_Base']; ?>" min="0" max="99">
            </div>
            <div class="modifier">
            </div>
            <div class="temp-score">
            </div>
            <div class="temp-modifier">
            </div>
        </div>
    </div>
    <div id="equipment">
    </div>

    <div id="skills">
        <table class="skills-list">
            <tr>
                <th>Skill Name</th>
                <th>Untrained</th>
                <th>Skill Bonus</th>
                <th>Ability</th>
                <th>Class Skill</th>
                <th>Ranks</th>
                <th>Racial</th>
                <th>Feats</th>
                <th>Misc</th>
                <th>ACP</th>
            </tr>
            <?php foreach ($skill_list as $skill): ?>
                <tr>
                    <td><?php echo $skill['Skill_Name']; ?></td>
                    <td><?php echo $skill['Is_Untrained'] === 1 ? '&#x2B24;' : '' ?></td>
                    <td>calculated total</td>
                    <td><?php echo $abilities[$skill['Ability_ID'] - 1]; ?></td><!-- TODO: Dynamically assign this variable based on the characters ability scores. -->
                    <td>bool</td><!-- TODO: Make this field dynamic with the class selected via JavaScript. -->
                    <td><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Ranks" value="<?php echo $valMemory[$skill['Short_Name'] . '_Ranks']; ?>"></td>
                    <td><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Racial" value="<?php echo $valMemory[$skill['Short_Name'] . '_Racial']; ?>"></td>
                    <td><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Feats" value="<?php echo $valMemory[$skill['Short_Name'] . '_Feats']; ?>"></td>
                    <td><input type="number" class="skill-fields" name="<?php echo $skill['Short_Name']; ?>_Misc" value="<?php echo $valMemory[$skill['Short_Name'] . '_Misc']; ?>"></td>
                    <td></td><!-- To Be Implemented -->
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <div id="inventory">
    </div>
    <div id="notes">
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
