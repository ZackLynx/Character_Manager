<?php
/*
-----------------------------------------------------------------------------------------------
Name:		dbconnect.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This file handles the connection between the client and the server.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
-----------------------------------------------------------------------------------------------
*/

// Credentials
$dsn = 'mysql:host=localhost;dbname=Character_Manager';
$username = 'SCC';
$password = 'SCC';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include '../errors/database_error.php';
    exit();
}
?>

