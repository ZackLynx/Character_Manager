<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_update.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This file is a form for updating the data of a record.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
-----------------------------------------------------------------------------------------------


<?php echo ($record['Class_ID'] == 1) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 2) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 3) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 4) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 5) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 6) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 7) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 8) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 9) ? 'selected' : ''; 
<?php echo ($record['Class_ID'] == 10) ? 'selected' : '';
<?php echo ($record['Class_ID'] == 11) ? 'selected' : '';



*/


?>


<form action="." method="post">
    <input type="hidden" name="character-id" value="<?php echo $character_ID ?>">

    <label for="character-name">Character Name</label>
    <input type="text" name="character-name">

    <br>

    <label for="character-class">Class</label>
    <select name="character-class">
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
    <select name="character-race">
        <option value="1">Dwarf</option>
        <option value="2">Elf</option>
        <option value="3">Gnome</option>
        <option value="4">Half-Elf</option>
        <option value="5">Halfling</option>
        <option value="6">Half-orc</option>
        <option value="7">Human</option>
    </select>

    <br>

    <label for="str-stat">STR</label>
    <input type="number" name="str-stat">
    <br>
    <label for="dex-stat">DEX</label>
    <input type="number" name="dex-stat">
    <br>
    <label for="con-stat">CON</label>
    <input type="number" name="con-stat">
    <br>
    <label for="int-stat">INT</label>
    <input type="number" name="int-stat">
    <br>
    <label for="wis-stat">WIS</label>
    <input type="number" name="wis-stat">
    <br>
    <label for="cha-stat">CHA</label>
    <input type="number" name="cha-stat">

    <br>

    <input type="hidden" name="action" value="submit-character">
    <input type="submit" value="SAVE CHANGES">
</form>
