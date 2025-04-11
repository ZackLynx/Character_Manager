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
CBAC        2025-03-27      First paragraph now specifies the name of the character to be
                            deleted.
CBAC        2025-04-11      Renamed $user_message to $system_message
-----------------------------------------------------------------------------------------------
*/
?>

<main>
    <p>
        You are trying to delete &quot;<?php echo $character_name; ?>&quot;
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
