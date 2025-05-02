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
CBAC        2025-04-11      Renamed $user_message to $system_message.
CBAC        2025-04-13      Added 'Last Modified' column to table view.
CBAC        2025-04-25      Added button for going to the feature testing page.
CBAC        2025-04-30      Changed skill auto-population over to new system.
CBAC        2025-05-01      
-----------------------------------------------------------------------------------------------
TODO: Implement PHP Sessions for result messages.
-----------------------------------------------------------------------------------------------
*/

// if (session_status() == PHP_SESSION_ACTIVE) {
//     echo "<p>Session ID: " . session_id() . "</p>";
// }

if (isset($system_message) && !empty($system_message)) {
    echo $system_message;
} else {
    echo '<p class=\'system-message\' >Please select a character.</p>';
}

?>
<div class="add-button">
    <form action="." method="post">
        <input type="hidden" name="action" value="test">
        <input type="submit" value="Test a new system">
    </form>
</div>

<div class="add-button">
    <form action="." method="post">
        <input type="hidden" name="action" value="add-character">
        <input type="submit" value="Add a Character">
    </form>
</div>

<table class="character-table">
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
        <th>
            Last Modified
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
            <td>
                <?php echo $record['Last_Update'] ?>
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
