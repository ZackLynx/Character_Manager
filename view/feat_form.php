<?php
/*
-----------------------------------------------------------------------------------------------
Name:		feat_form.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-04-14
Language:	PHP
Purpose:	This form is for adding and modifying feats. The contents of this file may be moved
            into the character sheet itself.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-04-14		Original Version 
-----------------------------------------------------------------------------------------------
*/

?>
<div class="feat-box">

    <form action="." method="post">
        <input type="hidden" name="last-action" value="<?php echo $valMemory['last-action'] ?>">
        <input type="hidden" name="Character_ID" value="<?php echo $valMemory['Character_ID'] ?>">
        <input type="text" name="feat-name" id="feat-name" placeholder="Feat Name">
        <input type="text" name="feat-description" id="feat-description" placeholder="Enter the description of your feat here.">
        <button type="submit" value="Add Feat"></button>
    </form>
    <form action="." method="post">
        <input type="hidden" name="last-action" value="<?php echo $valMemory['last-action'] ?>">
        <input type="hidden" name="Character_ID" value="<?php echo $valMemory['Character_ID'] ?>">
        <input type="hidden" name="action" value="view-characters">
        <input type="submit" value="Cancel">
    </form>

</div>
