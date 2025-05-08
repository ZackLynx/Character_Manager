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
CBAC        2025-05-04      Skill Bonus now shows the calculation of the skill fields.
CBAC        2025-05-08      Tabs tested and implemented.
-----------------------------------------------------------------------------------------------
*/

///////////////
/* ABILITIES */
///////////////

// On start

// STRENGTH
var strBase = document.getElementById('Str_Base');
var strMod = document.getElementById('str-mod')
strMod.innerHTML = Math.floor((strBase.value - 10) / 2);

strBase.addEventListener('input', function (event) {
    strMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('STR');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = strMod.innerText;
    }
    updateSkillMods();
});

// DEXTERITY
var dexBase = document.getElementById('Dex_Base');
var dexMod = document.getElementById('dex-mod');
dexMod.innerHTML = Math.floor((dexBase.value - 10) / 2);

dexBase.addEventListener('input', function (event) {
    dexMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('DEX');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = dexMod.innerText;
    }
    updateSkillMods();
});

// CONSTITUTION
var conBase = document.getElementById('Con_Base');
var conMod = document.getElementById('con-mod');
conMod.innerHTML = Math.floor((conBase.value - 10) / 2);

conBase.addEventListener('input', function (event) {
    conMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('CON');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = conMod.innerText;
    }
    updateSkillMods();
});

// INTELIGENCE
var intBase = document.getElementById('Int_Base');
var intMod = document.getElementById('int-mod');
intMod.innerHTML = Math.floor((intBase.value - 10) / 2);

intBase.addEventListener('input', function (event) {
    intMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('INT');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = intMod.innerText;
    }
    updateSkillMods();
});

// WISDOM
var wisBase = document.getElementById('Wis_Base');
var wisMod = document.getElementById('wis-mod');
wisMod.innerHTML = Math.floor((wisBase.value - 10) / 2);

wisBase.addEventListener('input', function (event) {
    wisMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('WIS');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = wisMod.innerText;
    }
    updateSkillMods();
});

// CHARISMA
var chaBase = document.getElementById('Cha_Base');
var chaMod = document.getElementById('cha-mod');
chaMod.innerHTML = Math.floor((chaBase.value - 10) / 2);

chaBase.addEventListener('input', function (event) {
    chaMod.innerHTML = Math.floor((event.target.value - 10) / 2);
    var modifiers = document.getElementsByClassName('CHA');
    for (i = 0; i < modifiers.length; i++) {
        modifiers[i].innerText = chaMod.innerText;
    }
    updateSkillMods();
});

//////////////////
/* Section Tabs */
//////////////////

var tabs = {
    'skills': document.getElementById('skills'),
    'feats': document.getElementById('feats'),
    'inventory': document.getElementById('inventory'),
    'combat': document.getElementById('combat'),
    'saving-throws': document.getElementById('saving-throws'),
    'effects': document.getElementById('effects'),
    'notes-block': document.getElementById('notes-block')
};

document.getElementById('button-skills').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'skills') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-feats').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'feats') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-inventory').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'inventory') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-combat').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'combat') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-saving-throws').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'saving-throws') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-effects').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'effects') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});

document.getElementById('button-notes-block').addEventListener('click', function () {
    Object.entries(tabs).forEach(([key, value]) => {
        if (key === 'notes-block') {
            value.removeAttribute('hidden', '');
        } else {
            value.setAttribute('hidden', '');
        }
    });
});



////////////
/* SKILLS */
////////////

function updateSkillMods() {
    var modifiers = document.getElementsByClassName('ability-mod');
    for (i = 0; i < modifiers.length; i++) {
        if (modifiers[i].classList.contains('STR')) {
            modifiers[i].innerText = strMod.innerText;
            continue;
        }
        else if (modifiers[i].classList.contains('DEX')) {
            modifiers[i].innerText = dexMod.innerText;
            continue;
        }
        else if (modifiers[i].classList.contains('CON')) {
            modifiers[i].innerText = conMod.innerText;
            continue;
        }
        else if (modifiers[i].classList.contains('INT')) {
            modifiers[i].innerText = intMod.innerText;
            continue;
        }
        else if (modifiers[i].classList.contains('WIS')) {
            modifiers[i].innerText = wisMod.innerText;
            continue;
        }
        else {
            modifiers[i].innerText = chaMod.innerText;
        }
    }

    const SKILL_FIELDS = [
        "Acrob", "Appra", "Bluff", "Climb", "Craft", "Diplo", "DsDev", "Disgu", "Escar",
        "Fly", "Hanim", "Heal", "Intim", "Karca", "Kdung", "Kengi", "Kgeog", "Khist",
        "Kloca", "Knatu", "Knobi", "Kplan", "Kreli", "Lingu", "Perce", "Perfo", "Profe",
        "Ride", "Senmo", "SOH", "Spcft", "Stlth", "Survi", "Swim", "Umdev"
    ];

    const SUB_FIELDS = ['_Ranks', '_Racial', '_Feats', '_Misc'];

    SKILL_FIELDS.forEach(skill_name => {
        // console.log(skill_name);
        SUB_FIELDS.forEach(field => {
            // Set initial value
            var classSkill = 3;
            var modifier = parseInt(document.getElementById(skill_name + "_Mod").innerHTML);
            var ranks = parseInt(document.getElementById(skill_name + SUB_FIELDS[0]).value);
            var racial = parseInt(document.getElementById(skill_name + SUB_FIELDS[1]).value);
            var feats = parseInt(document.getElementById(skill_name + SUB_FIELDS[2]).value);
            var misc = parseInt(document.getElementById(skill_name + SUB_FIELDS[3]).value);
            document.getElementById(skill_name + '_Total').innerText = ranks + racial + feats + misc + modifier + classSkill;

            // do it again on input
            document.getElementById(skill_name + field).addEventListener('input', function (event) {
                var classSkill = 3;
                var modifier = parseInt(document.getElementById(skill_name + "_Mod").innerHTML);
                var ranks = parseInt(document.getElementById(skill_name + SUB_FIELDS[0]).value);
                var racial = parseInt(document.getElementById(skill_name + SUB_FIELDS[1]).value);
                var feats = parseInt(document.getElementById(skill_name + SUB_FIELDS[2]).value);
                var misc = parseInt(document.getElementById(skill_name + SUB_FIELDS[3]).value);
                document.getElementById(skill_name + '_Total').innerText = ranks + racial + feats + misc + modifier + classSkill;
            });
        });
    });
}
// run this function at least once at startup
updateSkillMods();

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
    feat_ID.setAttribute("type", "hidden");
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
    item_ID.setAttribute("type", "hidden");
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
    });
});

var featButton = document.getElementById('add-feat-button');
featButton.addEventListener('click', addFeat);

var itemButton = document.getElementById('add-item-button');
itemButton.addEventListener('click', addItem);
