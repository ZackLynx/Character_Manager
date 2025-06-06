<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_update.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This file is a form for updating the data of a character.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version.
CBAC        2025-03-13      Added value placeholders. Corrected improper use of <label>
                            elements.
CBAC        2025-03-26      Refactored logic for value carry-over between failed submission
                            attempts. Added cancel button.
CBAC        2025-03-31      Added HTML min and max values to ability score input fields.
CBAC        2025-04-04      This file is now deprecated.
-----------------------------------------------------------------------------------------------
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
        'Character_ID' => get_val_from_postget('character-id', $old_record['Character_ID']),
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

if (isset($system_message)) {
    echo '<p>' . $system_message . '</p>';
}
?>

<form action="." method="post">
    <!-- <input type="hidden" name="character-id" value="<?php echo $valMemory['Character_ID']; ?>">
    <input type="hidden" name="old-name" value="<?php echo $valMemory['Character_Name']; ?>">

    <label for="character-name">Character Name</label>
    <input type="text" name="character-name" id="character-name" placeholder="<?php
    echo $valMemory['Character_Name']; ?>" value="<?php echo $valMemory['Character_Name']; ?>">

    <br>

    <label for="character-class">Class</label>
    <select name="character-class" id="character-class">
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

    <br>

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

    <br>
    <input type="hidden" name="old-str" value="<?php echo $valMemory['Str_Base'] ?>">
    <input type="hidden" name="old-dex" value="<?php echo $valMemory['Dex_Base'] ?>">
    <input type="hidden" name="old-con" value="<?php echo $valMemory['Con_Base'] ?>">
    <input type="hidden" name="old-int" value="<?php echo $valMemory['Int_Base'] ?>">
    <input type="hidden" name="old-wis" value="<?php echo $valMemory['Wis_Base'] ?>">
    <input type="hidden" name="old-cha" value="<?php echo $valMemory['Cha_Base'] ?>">

    <label for="str-stat">STR</label>
    <input type="number" name="str-stat" id="str-stat" value="<?php echo $valMemory['Str_Base']; ?>" min="0" max="99">
    <br>
    <label for="dex-stat">DEX</label>
    <input type="number" name="dex-stat" id="dex-stat" value="<?php echo $valMemory['Dex_Base']; ?>" min="0" max="99">
    <br>
    <label for="con-stat">CON</label>
    <input type="number" name="con-stat" id="con-stat" value="<?php echo $valMemory['Con_Base']; ?>" min="0" max="99">
    <br>
    <label for="int-stat">INT</label>
    <input type="number" name="int-stat" id="int-stat" value="<?php echo $valMemory['Int_Base']; ?>" min="0" max="99">
    <br>
    <label for="wis-stat">WIS</label>
    <input type="number" name="wis-stat" id="wis-stat" value="<?php echo $valMemory['Wis_Base']; ?>" min="0" max="99">
    <br>
    <label for="cha-stat">CHA</label>
    <input type="number" name="cha-stat" id="cha-stat" value="<?php echo $valMemory['Cha_Base']; ?>" min="0" max="99">

    <br> -->

    <?php include './view/npc_sheet.php'; ?>

    <input type="hidden" name="action" value="save-changes">
    <input type="submit" value="SAVE CHANGES">
</form>
<form action="." method="post">
    <input type="hidden" name="action" value="view-characters">
    <input type="submit" value="Cancel">
</form>
