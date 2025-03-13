<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_delete.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This is basically a prompt asking if the user is sure they want to delete a record.
            It may help to show what it is that is about to be deleted.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
-----------------------------------------------------------------------------------------------
*/
?>

<main>
    <p>
        You are trying to delete record: <?php echo $character_id; ?>
    </p>
    <p>
        Are you sure?
    </p>
    <span>
        <form action="." method="post">
            <input type="hidden" name="character_id" value= "<?php echo $character_id; ?>">
            <input type="hidden" name="action" value="delete-character">
            <input type="submit" value="Yes">
        </form>
        <form action="." method="post">
            <input type="hidden" name="action" value="view-characters">
            <input type="submit" value="No">
        </form>
    </span>
</main>
