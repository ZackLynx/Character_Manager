<?php
/*
-----------------------------------------------------------------------------------------------
Name:       database_error.php
Author:     Connor Bryan Andrew Clawson
Date:       2025-03-08
Language:   PHP
Purpose:    This file displays any errors that may occur when attempting to connect to the
            database

-----------------------------------------------------------------------------------------------
ChangeLog:
Who         When            What
----------- --------------- -------------------------------------------------------------------
CBAC        2025-03-08      Original Version 
-----------------------------------------------------------------------------------------------
*/

include '../view/header.php';
?>

<main>
    <h1>Database Error</h1>
    <p>
        An error was encountered when attempting to connect to the database.
    </p>
    <p>
        Please ensure the database has been installed and retry.
    </p>
    <p>
        Error message: <?php echo $error_message; ?>
    </p>
</main>

<?php include '../view/footer.php'; ?>

