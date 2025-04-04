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
CBAC        2025-04-04      Legacy code removed, see `table_add_old.php`
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

    <?php include './view/npc_sheet.php'; ?>

    <input type="hidden" name="action" value="submit-character">
    <input type="submit" value="SAVE NEW CHARACTER">
</form>
<form action="." method="post">
    <input type="hidden" name="action" value="view-characters">
    <input type="submit" value="Cancel">
</form>
