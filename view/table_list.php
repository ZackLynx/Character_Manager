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
-----------------------------------------------------------------------------------------------
*/
?>


<table>
    <tr id="table-header">
        <th>
            Name
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
                <?php echo $record['Class_Name']; ?>
            </td>
            <td class="edit-button"> <!-- EDIT -->
                <form action="." method="post">
                    <input type="hidden" name="action" value="edit-character">
                    <input type="hidden" name="character_id" value="<?php echo $record['Character_ID'] ?>">
                    <input type="submit" value="Edit">
                </form>
            </td>
            <td class="delete-button"> <!-- DELETE -->

                <form action="." method="post">
                    <input type="hidden" name="action" value="confirm-deletion">
                    <input type="hidden" name="character_id" value="<?php echo $record['Character_ID'] ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php
    endforeach; ?>

</table>
