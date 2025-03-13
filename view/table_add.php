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
-----------------------------------------------------------------------------------------------
*/
?>

<form action="." method="post">
    <label for="character-name">Character Name</label>
    <input type="text" name="character-name" id="character-name">

    <br>

    <label for="character-class">Class</label>
    <select name="character-class" id="character-class">
        <option value="1">Barbarian</option>
        <option value="2">Bard</option>
        <option value="3">Cleric</option>
        <option value="4">Druid</option>
        <option value="5">Fighter</option>
        <option value="6">Monk</option>
        <option value="7">Paladin</option>
        <option value="8">Ranger</option>
        <option value="9">Rogue</option>
        <option value="10">Sorcerer</option>
        <option value="11">Wizard</option>
    </select>

    <br>

    <label for="character-race">Race</label>
    <select name="character-race" id="character-race">
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
    <input type="number" name="str-stat" id="str-stat">
    <br>
    <label for="dex-stat">DEX</label>
    <input type="number" name="dex-stat" id="dex-stat">
    <br>
    <label for="con-stat">CON</label>
    <input type="number" name="con-stat" id="con-stat">
    <br>
    <label for="int-stat">INT</label>
    <input type="number" name="int-stat" id="int-stat">
    <br>
    <label for="wis-stat">WIS</label>
    <input type="number" name="wis-stat" id="wis-stat">
    <br>
    <label for="cha-stat">CHA</label>
    <input type="number" name="cha-stat" id="cha-stat">

    <br>

    <input type="hidden" name="action" value="submit-character">
    <input type="submit" value="SAVE NEW CHARACTER">
</form>
