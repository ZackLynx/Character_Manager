/*
-----------------------------------------------------------------------------------------------
Name:		skills_autocalc.js
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-30
Language:	JavaScript
Purpose:	This script handles the automatic calculation for skill bonus totals, as well as
            all interactable behavior for adding feats and items.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-30		Original Version 
CBAC        2025-04-15      Renamed file from `skills_autocalc.js` to `character_sheet.js`,
                            Added first pass of functions for Feats.
-----------------------------------------------------------------------------------------------
*/
console.log("Hello, World!");

/* FEATS
    This section is for the creation and deletion of new and existing feats. To ensure expected
    output, the repopulation of feats in the DOM will be handled by this script.

    Th
*/

/** 
 * The number of feats attached to the characters sheet.
 */
var featCount = 0;

/**
 * Used to uniquely identify each feat entry in the DOM. This value will increment up like an
 * Auto ID in a DB. 
 * 
 * To avoid behavior anolamies, **DO NOT SUBTRACT IT!**
 */
var featInc = 0;


/**
 * Adds new form elements with unique names to the DOM. PHP will then make use of the $POST data
 * submitted by the user to add or modify the database.
 * 
 * Auto increments `featInc`.
 * @param {number} i The database index of the feat in the `feats` table, `0` if new.
 */
function addFeat(i) {
    featNum = "feat_" + featInc;

    // Div container for feat.
    featDiv = document.createElement("div");
    featDiv.setAttribute("id", featNum);

    // Feat ID hidden field for PHP to use.
    var feat_ID = document.createElement("input");
    feat_ID.setAttribute("hidden");
    feat_ID.name = "Feat_" + featInc + "_ID";
    feat_ID.value = i; // 0 if new, > 0 if existing.

    //Feat Name
    var featNameLabel = document.createElement("label");
    featNameLabel.setAttribute("for", featNum + "_name");

    var featName = document.createElement("input");
    featName.type = "text";
    featName.name = featNum + "_name";
    featName.placeholder = featInc;

    // Feat Description
    var featDescLabel = document.createElement("label");
    featDescLabel.setAttribute("for", featNum + "_desc");

    var featDesc = document.createElement("input");
    featDesc.type = "text";
    featDesc.name = featNum + "_desc" + featInc;
    featDesc.setAttribute("class", "feat_desc");
    featInc++;

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.addEventListener("click", removeFeat(featInc));

    //Add to DOM
    newDiv = document.getElementById("feat-list").appendChild(featDiv);
    newDiv.appendChild(feat_ID);
    newDiv.appendChild(featNameLabel);
    newDiv.appendChild(featName);
    newDiv.appendChild(featDescLabel);
    newDiv.appendChild(featDisc);
}

/**
 * Removes a feat div and its children safely from the DOM.
 * @param {number} i The number at the end of the feats div ID
 */
function removeFeat(i) {
    // Remove EventListener from deleteButton
    document.getElementById("feat_" + i).getElementsByTagName("button").removeEventListener("click", removeFeat())

    // Clear children


    // remove div element

    // Mark feat_ID for deletion if its from the database.
}

var addFeatButton = document.getElementById("add-feat");
addFeatButton.addEventListener("click", addFeat());

//execute whenever a value changes.
