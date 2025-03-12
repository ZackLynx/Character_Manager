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

<main>
    <table>
        <tr id="table-header">
            <th>ID</th>
            <th>
                Character Name
            </th>
        </tr>
        <?php
        foreach ($records as $record) { ?>
            <tr>
                <td>
                    <?php echo $record['Character_ID']; ?>
                </td>
                <td>
                    <?php echo $record['Character_Name']; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</main>
