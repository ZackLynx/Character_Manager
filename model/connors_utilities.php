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
 * Checks if the persons name contains a dash (-), apostrophe ('), or alphabetic character.
 * Currently limited to characters from the standard ASCII table.
 * @param string $name a persons name.
 * @return bool {true} if all characters are valid, {false} otherwise.
 */
function validate_characters($name) // TODO: Expand list of valid characters.
{
    // convert the string into an array.
    $name = trim($name);
    foreach (str_split($name) as $char) {
        // echo $char; // lets us check which characters it went through.
        $ascii_val = ord($char);
        // return false if the character is not within our valid ranges.
        if (
            ($ascii_val == 32) ||                       // space character
            ($ascii_val == 39 || $ascii_val == 45) ||   // ' , -
            ($ascii_val >= 65 && $ascii_val <= 90) ||   // A to Z
            ($ascii_val >= 97 && $ascii_val <= 122)     // a to z
        ) {
            continue;
        } else {
            return false;
        }
    } // if all characters are valid, return true.
    return true;
}

?>

