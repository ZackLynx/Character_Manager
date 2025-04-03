<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_list.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This file shows the user a list of records from the database and offers options for
            adding, editing, and removing records.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
CBAC        2025-03-14      Added a message space that shows up in response to a completed
                            action.'
CBAC        2025-03-25      Added another add-button to the bottom of the list. Ideal for when
                            the list grows long.
-----------------------------------------------------------------------------------------------
TODO: Implement PHP Sessions for result messages after skills are implemented.
-----------------------------------------------------------------------------------------------
*/

if (isset($user_message) && !empty($user_message)) {
    echo $user_message;
} else {
    echo '<p>Please select a character.</p>';
}

?>

<div class="add-button">
    <form action="." method="post">
        <input type="hidden" name="action" value="add-character">
        <input type="submit" value="Add a Character">
    </form>
</div>

<table>
    <tr id="table-header">
        <th>
            Name
        </th>
        <th>
            Race
        </th>
        <th>
            Class
        </th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    foreach ($records as $record): ?>
        <tr>
            <td>
                <?php echo $record['Character_Name']; ?>
            </td>
            <td>
                <?php echo $record['Race_Name']; ?>
            </td>
            <td>
                <?php echo $record['Class_Name']; ?>
            </td>
            <td> <!-- EDIT -->
                <form action="." method="post">
                    <input type="hidden" name="action" value="edit-character">
                    <input type="hidden" name="character_id" value="<?php echo $record['Character_ID'] ?>">
                    <input type="submit" alt="Edit character" title="Edit character" value="&#x1F4DD;">
                </form>
            </td>
            <td> <!-- DELETE -->
                <form action="." method="post">
                    <input type="hidden" name="action" value="confirm-deletion">
                    <input type="hidden" name="character_id" value="<?php echo $record['Character_ID'] ?>">
                    <input type="submit" alt="Delete character" title="Delete character" value="&#x26D4;">
                </form>
            </td>
        </tr>
        <?php
    endforeach; ?>
</table>

<div class="add-button">
    <form action="." method="post">
        <input type="hidden" name="action" value="add-character">
        <input type="submit" value="Add a Character">
    </form>
</div>
