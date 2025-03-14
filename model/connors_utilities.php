<?php
/*
-----------------------------------------------------------------------------------------------
Name:		connors_utilities.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-08
Language:	PHP
Purpose:	This file is a living document meant to be used across multiple projects.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-08		Original Version
CBAC        2025-03-11      Added early semicolon_check function.
CBAC        2025-03-13      Added early prepare_string function.
-----------------------------------------------------------------------------------------------
*/

/**
 * looks for a semicolon `;` within a string. Reports error if the input is not a string.
 * 
 * TODO: figure out a way to effectively detect if a valid semicolon is properly within string
 * quotations. This will be necessary for entering long strings into the database.
 * @param string $val
 * @return bool `true` if a semicolon is present, `false` otherwise.
 */
function semicolon_check($val)
{
    try {
        return str_contains($val, ';');
    } catch (Exception $e) {
        $error_message = $e;
        include '../errors/error.php';
        exit();
    }
}

/**
 * Prepares a string for use as a value to be used in a SQL query.
 * @param string $str the String to
 * @return string|null The value of `$str` if valid, `null` otherwise.
 */
function prepare_string($str)
{
    if (isset($str) && is_string($str)) {
        $str = trim($str);  // First trim the ends
        if (empty($str)) {
            return NULL;
        }
        // TODO: improve this function to handle special characters.
        return $str;
    }
    return NULL; // If the value is bad, return null.
}

?>

