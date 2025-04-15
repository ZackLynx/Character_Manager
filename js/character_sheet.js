/*
-----------------------------------------------------------------------------------------------
Name:		skills_autocalc.js
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-30
Language:	JavaScript
Purpose:	This script handles the automatic calculation for skill bonus totals

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-30		Original Version 
-----------------------------------------------------------------------------------------------
*/
console.log("Hello, World!");

// FEATS
/** 
 * This value will increment up like an Auto ID in a DB.
 * 
 * DO NOT SUBTRACT IT!
 */
var featNum = 0;

/**
 * Adds new form input elements with unique names to the DOM.
 * 
 * Auto increments `featNum`.
 */
function addFeat() {
    //Feat Name
    var featNameLabel = document.createElement("label");
    featNameLabel.setAttribute("for", "feat_name_")
    var featName = document.createElement("input");
    featName.type = "text";
    featName.name = "feat_name_";
    featName.placeholder = featNum;

    // Feat Description
    var featDesc = document.createElement("input");
    featDesc.type = "text";
    featDesc.name = "feat_desc_"
    featNum++;

    // Delete button

    //Add to DOM
    document.getElementById("feat-list").appendChild(featName);
    document.getElementById("feat-list").appendChild(featDesc);
}

/**
 * Removes a feat div and its children safely from the DOM.
 * @param {number} i 
 */
function removeFeat(i) {
    // Remove EventListener from button

    // Clear children

    // remove div element
}

var addFeatButton = document.getElementById("add-feat");
addFeatButton.addEventListener("click", addFeat());

//execute whenever a value changes.
