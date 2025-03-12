<?php
/*
-----------------------------------------------------------------------------------------------
Name:		npc_sheet.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This page shows the stats of a non-player character. This document should be used
            as the basis for the player character sheet which will have more fields and display
            more data.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version.
CBAC        2025-03-10      renamed to `npc_sheet.php`
-----------------------------------------------------------------------------------------------
*/
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>INSERT TITLE HERE</title>
        <link rel="stylesheet" href="main.css">
    </head>

    <body>
        <div id="primary-info">
            <!-- name -->
            <!-- class -->
            <!-- level -->
            <!-- challenge rating -->
        </div>
        <div class="two-column">
            <div id="secondary-info">
                <!-- race -->
                <!-- allignment -->
                <!-- size -->
                <!-- gender -->
            </div>
            <div id="ability-scores">
                <!-- in row major order, display total, modifier, temp score, and temp modifier fields -->
                <div id="strength-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
                <div id="dexterity-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
                <div id="constitution-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
                <div id="intelligence-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
                <div id="wisdom-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
                <div id="charisma-scores">
                    <div class="total">
                    </div>
                    <div class="modifier">
                    </div>
                    <div class="temp-score">
                    </div>
                    <div class="temp-modifier">
                    </div>
                </div>
            </div>
            <div id="equipment">
            </div>
            <div id="skills">
            </div>
            <div id="inventory">
            </div>
            <div id="notes">
            </div>
        </div>
        <div id="health">

        </div>
        <div class="two-column">
            <div id="combat">
            </div>
            <div id="combat-maneuvers">
            </div>
            <div id="attacks">
            </div>
            <div id="defense">
            </div>
            <div id="saving-throws">
            </div>
            <div id="combat-abilities">
            </div>
            <div id="effects">
            </div>
        </div>
    </body>

</html>
