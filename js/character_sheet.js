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
var featNum = 0;


/**
 * Adds new form elements with unique names to the DOM. PHP will then make use of the $POST data
 * submitted by the user to add or modify the database.
 * 
 * Auto increments `featNum`.
 */
function addFeat() {
    // Feat ID hidden field for PHP to use.
    var feat_ID = document.createElement("input");
    feat_ID.setAttribute("hidden");
    feat_ID.name = "Feat_ID";
    feat_ID.value = 0; // 0 if new, > 0 if existing.

    //Feat Name
    var featNameLabel = document.createElement("label");
    featNameLabel.setAttribute("for", "feat_name_")
    var featName = document.createElement("input");
    featName.type = "text";
    featName.name = "feat_name_";
    featName.placeholder = featNum;

    // Feat Description
    var featDesc = document.createElement("input");
    featDesc.type = "text" + featNum;
    featDesc.name = "feat_desc_" + featNum;
    featDesc.setAttribute("class", "feat-desc");
    featNum++;

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.addEventListener("click", removeFeat(featNum));

    //Add to DOM
    document.getElementById("feat-list").appendChild(featName);
    document.getElementById("feat-list").appendChild(featDesc);
}

/**
 * Removes a feat div and its children safely from the DOM.
 * @param {number} i 
 */
function removeFeat(i) {
    var button = getElementById
    // Remove EventListener from button

    // Clear children


    // remove div element

    // Mark feat_ID for deletion.
}

var addFeatButton = document.getElementById("add-feat");
addFeatButton.addEventListener("click", addFeat());

//execute whenever a value changes.
