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


///////////
/* FEATS */
///////////
var featCount = 0;

/**
 * Used to uniquely identify each feat entry in the DOM. This value will increment up like an
 * Auto ID in a DB. 
 * 
 * To avoid behavior anomalies, **DO NOT SUBTRACT IT!**
 */
var featInc = document.getElementById("feats_imported").value ?? 0;



/**
 * Creates a block of HTML code that contains the fields for entering a feat into a
 * character sheet.
 */
function addFeat() {
    featNum = "feat_" + featInc;

    // Div container for feat.
    featDiv = document.createElement("div");
    featDiv.setAttribute("id", featNum);
    featDiv.setAttribute("class", "feat-box");

    // Feat ID hidden field for PHP to use.
    var feat_ID = document.createElement("input");
    feat_ID.setAttribute("hidden", "hidden");
    feat_ID.name = "Feat_" + featInc + "_ID";
    feat_ID.id = "Feat_" + featInc + "_ID";
    feat_ID.setAttribute('value', 0);

    //Feat Name
    var featNameLabel = document.createElement("label");
    featNameLabel.setAttribute("for", featNum + "_name");
    featNameLabel.innerText = "Feat Name: ";
    featNameLabel.setAttribute("class", "feat-label");

    var featName = document.createElement("input");
    featName.type = "text";
    featName.name = featNum + "_name";
    // featName.placeholder = featInc;
    featName.id = featName.name;
    featName.setAttribute("class", "feat-field");
    featName.setAttribute("hidden", "");

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.className = "delete-button";
    deleteButton.innerText = "Delete Feat";
    deleteButton.addEventListener("click", function () {
        if (confirm("Delete this feat? (This action cannot be undone)")) {
            featCount--;
            // remove the feats <div>
            var featDiv = deleteButton.parentElement;
            featDiv.remove();
        }
    });

    // Feat Description
    var featDescLabel = document.createElement("label");
    featDescLabel.setAttribute("for", featNum + "_desc");
    featDescLabel.innerText = "Description:"
    featDescLabel.setAttribute("Class", "feat-label");

    var featDesc = document.createElement("textarea");
    featDesc.type = "text";
    featDesc.name = featNum + "_desc";
    featDesc.id = featDesc.name;
    featDesc.setAttribute("class", "feat-field feat_desc");

    //Add to DOM
    newDiv = document.getElementById("feat-list").appendChild(featDiv);
    newDiv.appendChild(feat_ID);
    newDiv.appendChild(featNameLabel);
    newDiv.appendChild(featName);
    newDiv.appendChild(deleteButton);
    newDiv.appendChild(document.createElement("br"));
    newDiv.appendChild(featDescLabel);
    newDiv.appendChild(document.createElement("br"));
    newDiv.appendChild(featDesc);

    featInc++;
    featCount++;
}

// add "deleteButton" functionality to PHP generated delete feat buttons.
$buttons = document.getElementsByClassName("delete-button");
Array.from($buttons).forEach($button => {
    $button.addEventListener("click", function (event) {
        if (confirm("Delete this feat? (This action cannot be undone)")) {
            // If feat_ID > 0
            if (event.currentTarget.value > 0) {
                var arr = document.getElementById('feats-to-delete');
                if (arr.value.length === 0) {
                    arr.setAttribute("value", event.currentTarget.value);
                } else {
                    arr.setAttribute("value", arr.value + "," + event.currentTarget.value);
                }
            }

            featCount--;
            // remove the feats <div>
            var featDiv = event.currentTarget.parentElement;
            featDiv.remove();
        }
    });
});

var button = document.getElementById('add-feat-button');
button.addEventListener('click', addFeat);
