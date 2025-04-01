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
*/

/**
 * This document uses the following variables from the parent PHP file:
 * @var int $character_ID the unique ID of the character.
 * @var array $old_record the full record of the character selected.
 */

/*
In the event that a value is bad and cannot be used by SQL, we need to hold onto already
entered data. The order of precedence should be most recently valid data entered then
previously saved data. Use data stored in database as a fall back if the first two fail.
*/

$valMemory = [];
if (isset($old_record) && is_array($old_record)) {
    $valMemory = [
        'Character_ID' => get_val_from_postget('character-id', $old_record['Character_ID']),
        'Character_Name' => get_val_from_postget('character-name', get_val_from_postget('old-name', $old_record['Character_Name'])),
        'Class_ID' => get_val_from_postget('character-class', get_val_from_postget('old-class', $old_record['Class_ID'])),
        'Race_ID' => get_val_from_postget('character-race', get_val_from_postget('old-race', $old_record['Race_ID'])),
        'Str_Base' => get_val_from_postget('str-stat', get_val_from_postget('old-str', $old_record['Str_Base'])),
        'Dex_Base' => get_val_from_postget('dex-stat', get_val_from_postget('old-dex', $old_record['Dex_Base'])),
        'Con_Base' => get_val_from_postget('con-stat', get_val_from_postget('old-con', $old_record['Con_Base'])),
        'Int_Base' => get_val_from_postget('int-stat', get_val_from_postget('old-int', $old_record['Int_Base'])),
        'Wis_Base' => get_val_from_postget('wis-stat', get_val_from_postget('old-wis', $old_record['Wis_Base'])),
        'Cha_Base' => get_val_from_postget('cha-stat', get_val_from_postget('old-cha', $old_record['Cha_Base']))
    ];

    // fill any empty fields with their previous values.
    if ($valMemory['Character_Name'] == '') {
        $valMemory['Character_Name'] = $old_record['Character_Name'];
    }

    // We'll also do checks on Class and Race in case of oddities.
    if ($valMemory['Class_ID'] == '') {
        $valMemory['Class_ID'] = $old_record['Class_ID'];
    }
    if ($valMemory['Race_ID'] == '') {
        $valMemory['Race_ID'] = $old_record['Race_ID'];
    }
    if ($valMemory['Str_Base'] == '') {
        $valMemory['Str_Base'] = $old_record['Str_Base'];
    }
    if ($valMemory['Dex_Base'] == '') {
        $valMemory['Dex_Base'] = $old_record['Dex_Base'];
    }
    if ($valMemory['Con_Base'] == '') {
        $valMemory['Con_Base'] = $old_record['Con_Base'];
    }
    if ($valMemory['Int_Base'] == '') {
        $valMemory['Int_Base'] = $old_record['Int_Base'];
    }
    if ($valMemory['Wis_Base'] == '') {
        $valMemory['Wis_Base'] = $old_record['Wis_Base'];
    }
    if ($valMemory['Cha_Base'] == '') {
        $valMemory['Cha_Base'] = $old_record['Cha_Base'];
    }
} else {
    /*
    This else block shouldn't be entered as long as $old_record functions as intended.
    leave this `else` block here for redundancy.
    */

    //echo "Grabbing from POST";
    $valMemory = [
        'Character_ID' => get_val_from_postget('character-id', $character_ID),
        'Character_Name' => get_val_from_postget('character-name', get_val_from_postget('old-name', '')),
        'Class_ID' => get_val_from_postget('character-class', 0),
        'Race_ID' => get_val_from_postget('character-race', 0),
        'Str_Base' => get_val_from_postget('str-stat', get_val_from_postget('old-str', 10)),
        'Dex_Base' => get_val_from_postget('dex-stat', get_val_from_postget('old-dex', 10)),
        'Con_Base' => get_val_from_postget('con-stat', get_val_from_postget('old-con', 10)),
        'Int_Base' => get_val_from_postget('int-stat', get_val_from_postget('old-int', 10)),
        'Wis_Base' => get_val_from_postget('wis-stat', get_val_from_postget('old-wis', 10)),
        'Cha_Base' => get_val_from_postget('cha-stat', get_val_from_postget('old-cha', 10))
    ];
}

if (isset($user_message)) {
    echo '<p>' . $user_message . '</p>';
}
?>


<!-- Reserved for data redundancy -->
<input type="hidden" name="character-id" value="<?php echo $valMemory['Character_ID']; ?>" required>
<input type="hidden" name="old-name" value="<?php echo $old_record['Character_Name']; ?>" required>
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
        <?php if (get_val_from_postget('action', NULL) === 'add-character') { ?>
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
                    <td>
                        <?php echo $skill['Skill_Name']; ?>
                    </td>
                    <td>
                        <?php echo $skill['Is_Untrained'] === 1 ? "yes" : "no" ?>
                    </td>
                    <td>
                        calculated total
                    </td>
                    <td>
                        DEX (+3)
                    </td>
                    <td>
                        bool
                    </td>

                    <!-- field name auto-populate idea: "Skill-Name" + "_ranks"/"_racial"/"_feats"/"_misc"-->
                    <td>
                        <input type="number" name="" id="">
                    </td>
                    <td>
                        <input type="number" name="" id="">
                    </td>
                    <td>
                        <input type="number" name="" id="">
                    </td>
                    <td>
                        <input type="number" name="" id="">
                    </td>
                    <td>
                        <input type="number" name="" id="armor_check_penalty">
                        <!-- based on armor -->
                    </td>
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
