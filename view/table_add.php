<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_add.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	this is a form for adding a new character to the database.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version.
CBAC        2025-03-13      Corrected improper use of <label> elements.
CBAC        2025-03-26      Added cancel button.
CBAC        2025-03-27      Amended Character Name field to retain its previously entered value.
CBAC        2025-03-31      Added HTML min and max values to ability score input fields.
-----------------------------------------------------------------------------------------------
*/


// in the event that a value is bad and cannot be used by SQL, we need to hold onto already
// entered data.
$valMemory = [
    'Character_Name' => get_val_from_postget('character-name', ''),
    'Class_ID' => get_val_from_postget('character-class', 0),
    'Race_ID' => get_val_from_postget('character-race', 0),
    'Str_Base' => get_val_from_postget('str-stat', 10),
    'Dex_Base' => get_val_from_postget('dex-stat', 10),
    'Con_Base' => get_val_from_postget('con-stat', 10),
    'Int_Base' => get_val_from_postget('int-stat', 10),
    'Wis_Base' => get_val_from_postget('wis-stat', 10),
    'Cha_Base' => get_val_from_postget('cha-stat', 10)
];

if (isset($user_message)) {
    echo '<p>' . $user_message . '</p>';
}
?>

<form action="." method="post">
    <label for="character-name">Character Name</label>
    <input type="text" name="character-name" id="character-name" value="<?php echo $valMemory['Character_Name']; ?>">

    <br>

    <label for="character-class">Class</label>
    <select name="character-class" id="character-class">
        <option value="0" <?php echo ($valMemory['Class_ID'] == 0) ? 'selected' : ''; ?>>Select a Class</option>
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
        <option value="0" <?php echo ($valMemory['Race_ID'] == 0) ? 'selected' : ''; ?>>Select a Race</option>
        <option value="1" <?php echo ($valMemory['Race_ID'] == 1) ? 'selected' : ''; ?>>Dwarf</option>
        <option value="2" <?php echo ($valMemory['Race_ID'] == 2) ? 'selected' : ''; ?>>Elf</option>
        <option value="3" <?php echo ($valMemory['Race_ID'] == 3) ? 'selected' : ''; ?>>Gnome</option>
        <option value="4" <?php echo ($valMemory['Race_ID'] == 4) ? 'selected' : ''; ?>>Half-Elf</option>
        <option value="5" <?php echo ($valMemory['Race_ID'] == 5) ? 'selected' : ''; ?>>Halfling</option>
        <option value="6" <?php echo ($valMemory['Race_ID'] == 6) ? 'selected' : ''; ?>>Half-orc</option>
        <option value="7" <?php echo ($valMemory['Race_ID'] == 7) ? 'selected' : ''; ?>>Human</option>
    </select>

    <br>

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

    <br>

    <input type="hidden" name="action" value="submit-character">
    <input type="submit" value="SAVE NEW CHARACTER">
</form>
<form action="." method="post">
    <input type="hidden" name="action" value="view-characters">
    <input type="submit" value="Cancel">
</form>
