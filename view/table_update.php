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
-----------------------------------------------------------------------------------------------
*/


?>


<form action="." method="post">
    <input type="hidden" name="character-id" value="<?php echo $character_ID ?>">
    <input type="hidden" name="old-name" value="<?php echo $record['Character_Name']; ?>">

    <label for="character-name">Character Name</label>
    <input type="text" name="character-name" id="character-name" placeholder="<?php
    echo $record['Character_Name'];
    ?>">

    <br>

    <label for="character-class">Class</label>
    <select name="character-class" id="character-class">
        <option value="1" <?php echo ($record['Class_ID'] == 1) ? 'selected' : ''; ?>>Barbarian</option>
        <option value="2" <?php echo ($record['Class_ID'] == 2) ? 'selected' : ''; ?>>Bard</option>
        <option value="3" <?php echo ($record['Class_ID'] == 3) ? 'selected' : ''; ?>>Cleric</option>
        <option value="4" <?php echo ($record['Class_ID'] == 4) ? 'selected' : ''; ?>>Druid</option>
        <option value="5" <?php echo ($record['Class_ID'] == 5) ? 'selected' : ''; ?>>Fighter</option>
        <option value="6" <?php echo ($record['Class_ID'] == 6) ? 'selected' : ''; ?>>Monk</option>
        <option value="7" <?php echo ($record['Class_ID'] == 7) ? 'selected' : ''; ?>>Paladin</option>
        <option value="8" <?php echo ($record['Class_ID'] == 8) ? 'selected' : ''; ?>>Ranger</option>
        <option value="9" <?php echo ($record['Class_ID'] == 9) ? 'selected' : ''; ?>>Rogue</option>
        <option value="10" <?php echo ($record['Class_ID'] == 10) ? 'selected' : ''; ?>>Sorcerer</option>
        <option value="11" <?php echo ($record['Class_ID'] == 11) ? 'selected' : ''; ?>>Wizard</option>
    </select>

    <br>

    <label for="character-race">Race</label>
    <select name="character-race" id="character-race">
        <option value="1" <?php echo ($record['Race_ID'] == 1) ? 'selected' : ''; ?>>Dwarf</option>
        <option value="2" <?php echo ($record['Race_ID'] == 2) ? 'selected' : ''; ?>>Elf</option>
        <option value="3" <?php echo ($record['Race_ID'] == 3) ? 'selected' : ''; ?>>Gnome</option>
        <option value="4" <?php echo ($record['Race_ID'] == 4) ? 'selected' : ''; ?>>Half-Elf</option>
        <option value="5" <?php echo ($record['Race_ID'] == 5) ? 'selected' : ''; ?>>Halfling</option>
        <option value="6" <?php echo ($record['Race_ID'] == 6) ? 'selected' : ''; ?>>Half-orc</option>
        <option value="7" <?php echo ($record['Race_ID'] == 7) ? 'selected' : ''; ?>>Human</option>
    </select>

    <br>
    <input type="hidden" name="old-str" value="<?php echo $record['Str_Base'] ?>">
    <input type="hidden" name="old-dex" value="<?php echo $record['Dex_Base'] ?>">
    <input type="hidden" name="old-con" value="<?php echo $record['Con_Base'] ?>">
    <input type="hidden" name="old-int" value="<?php echo $record['Int_Base'] ?>">
    <input type="hidden" name="old-wis" value="<?php echo $record['Wis_Base'] ?>">
    <input type="hidden" name="old-cha" value="<?php echo $record['Cha_Base'] ?>">

    <label for="str-stat">STR</label>
    <input type="number" name="str-stat" id="str-stat" placeholder="<?php echo $record['Str_Base']; ?>">
    <br>
    <label for="dex-stat">DEX</label>
    <input type="number" name="dex-stat" id="dex-stat" placeholder="<?php echo $record['Dex_Base']; ?>">
    <br>
    <label for="con-stat">CON</label>
    <input type="number" name="con-stat" id="con-stat" placeholder="<?php echo $record['Con_Base']; ?>">
    <br>
    <label for="int-stat">INT</label>
    <input type="number" name="int-stat" id="int-stat" placeholder="<?php echo $record['Int_Base']; ?>">
    <br>
    <label for="wis-stat">WIS</label>
    <input type="number" name="wis-stat" id="wis-stat" placeholder="<?php echo $record['Wis_Base']; ?>">
    <br>
    <label for="cha-stat">CHA</label>
    <input type="number" name="cha-stat" id="cha-stat" placeholder="<?php echo $record['Cha_Base']; ?>">

    <br>

    <input type="hidden" name="action" value="save-changes">
    <input type="submit" value="SAVE CHANGES">
</form>
