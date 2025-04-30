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
CBAC        2025-04-04      Legacy code removed, see `old_pages/table_update-old.php`
CBAC        2025-04-11      Renamed $user_message to $system_message
-----------------------------------------------------------------------------------------------
*/

/*
In the event that a value is bad and cannot be used by SQL, we need to hold onto already
entered data. The order of precedence should be most recently valid data entered then
previously saved data. Use data stored in database as a fall back if the first two fail.
*/

/**
 * The following variables MUST be initiallized before this page is included:
 * @param array $old_record a key-value array representing a record from the `characters` table.
 * @param array $skill_list A 2-dimensional array containing the data from the `skills` table.
 */

$valMemory = [];

foreach ($old_record as $key => $value) {
    $valMemory[$key] = get_val_from_postget($key, $value);
}

if (isset($system_message)) {
    echo '<p>' . $system_message . '</p>';
}
?>

<form action="." method="post">
    <?php include './view/character_sheet.php'; ?>
    <input type="hidden" name="last-action" value="edit-character">
    <input type="hidden" name="action" value="save-changes">
    <input type="submit" value="SAVE CHANGES">
</form>
<form action="." method="post">
    <input type="hidden" name="action" value="view-characters">
    <input type="submit" value="Cancel">
</form>
