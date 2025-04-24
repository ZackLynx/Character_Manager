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
CBAC        2025-04-24      Added function for adding new items.
-----------------------------------------------------------------------------------------------
*/


///////////
/* FEATS */
///////////
var featCount = document.getElementById("num-of-feats").value ?? 0;

/**
 * Used to uniquely identify each feat entry in the DOM. This value will increment up like an
 * Auto ID in a DB. 
 * 
 * To avoid behavior anomalies, **DO NOT SUBTRACT IT!**
 */
var featInc = document.getElementById("num-of-feats").value ?? 0;

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
    feat_ID.name = featNum + "_ID";
    feat_ID.id = featNum + "_ID";
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
    featName.setAttribute("required", "");

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.className = "feat-delete-button";
    deleteButton.innerText = "Delete Feat";
    deleteButton.addEventListener("click", function () {
        if (confirm("Delete this feat? (This action cannot be undone)")) {
            document.getElementById("num-of-feats").setAttribute("value", --featCount);
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
    document.getElementById("num-of-feats").setAttribute("value", ++featCount);
}

///////////
/* ITEMS */
///////////
var itemCount = document.getElementById("num-of-items").value ?? 0;

/**
 * Like with feats, used to uniquely identify each item entry in the DOM. This value will increment up 
 * like an Auto ID in a DB. 
 * 
 * To avoid behavior anomalies, **DO NOT SUBTRACT IT!**
 */
var itemInc = document.getElementById("num-of-items").value ?? 0;

/**
 * Creates a block of HTML code that contains the fields for entering an item into a
 * character_sheet.
 */
function addItem() {
    itemNum = "item_" + itemInc;

    // Div container for item.
    itemDiv = document.createElement("div");
    itemDiv.setAttribute("id", itemNum);
    itemDiv.setAttribute("class", "item-box");

    // Item ID hidden field for PHP to use.
    var item_ID = document.createElement("input");
    item_ID.setAttribute("hidden", "hidden");
    item_ID.name = itemNum + "_ID";
    item_ID.id = itemNum + "_ID";
    item_ID.setAttribute('value', 0);

    // Item Name
    var itemNameLabel = document.createElement("label");
    itemNameLabel.setAttribute("for", itemNum + "_name");
    itemNameLabel.innerText = "Item Name: ";
    itemNameLabel.setAttribute("class", "item-label");

    var itemName = document.createElement("input");
    itemName.type = "text";
    itemName.name = itemNum + "_name";
    // itemName.placeholder = itemInc;
    itemName.id = itemName.name;
    itemName.setAttribute("class", "item-field");
    itemName.setAttribute("required", "");

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.className = "item-delete-button";
    deleteButton.innerText = "Delete Item";
    deleteButton.addEventListener("click", function () {
        if (confirm("Delete this item? (This action cannot be undone)")) {
            document.getElementById("num-of-items").setAttribute("value", --itemCount);
            // remove the items <div>
            var itemDiv = deleteButton.parentElement;
            itemDiv.remove();
        }
    });

    // Item Description
    var itemDescLabel = document.createElement("label");
    itemDescLabel.setAttribute("for", itemNum + "_desc");
    itemDescLabel.innerText = "Description:"
    itemDescLabel.setAttribute("Class", "item-label");

    var itemDesc = document.createElement("textarea");
    itemDesc.type = "text";
    itemDesc.name = itemNum + "_desc";
    itemDesc.id = itemDesc.name;
    itemDesc.setAttribute("class", "item-field item_desc");

    //Add to DOM
    newDiv = document.getElementById("inventory-list").appendChild(itemDiv);
    newDiv.appendChild(item_ID);
    newDiv.appendChild(itemNameLabel);
    newDiv.appendChild(itemName);
    newDiv.appendChild(deleteButton);
    newDiv.appendChild(document.createElement("br"));
    newDiv.appendChild(itemDescLabel);
    newDiv.appendChild(document.createElement("br"));
    newDiv.appendChild(itemDesc);

    itemInc++;
    document.getElementById("num-of-items").setAttribute("value", ++itemCount);
}

//////////////////////////////////
/* For Existing Feats and Items */
//////////////////////////////////

// add "deleteButton" functionality to PHP generated delete feat buttons.
var feat_buttons = document.getElementsByClassName("feat-delete-button");
Array.from(feat_buttons).forEach(button => {
    button.addEventListener("click", function (event) {
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

            document.getElementById("num-of-feats").setAttribute("value", --featCount);
            // remove the feats <div>
            var featDiv = event.currentTarget.parentElement;
            featDiv.remove();
        }
    });
});

var item_buttons = document.getElementsByClassName("item-delete-button");
Array.from(item_buttons).forEach(button => {
    button.addEventListener("click", function (event) {
        if (confirm("Delete this item? (This action cannot be undone)")) {
            if (event.currentTarget.value > 0) {
                var arr = document.getElementById('items-to-delete');
                if (arr.value.length === 0) {
                    arr.setAttribute("value", event.currentTarget.value);
                } else {
                    arr.setAttribute("value", arr.value + "," + event.currentTarget.value);
                }
            }

            document.getElementById("num-of-items").setAttribute("value", --itemCount);
            var itemDiv = event.currentTarget.parentElement;
            itemDiv.remove();
        }
    })
});

var featButton = document.getElementById('add-feat-button');
featButton.addEventListener('click', addFeat);

var itemButton = document.getElementById('add-item-button');
itemButton.addEventListener('click', addItem);
