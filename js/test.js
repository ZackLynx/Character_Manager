var featInc = 0;

/**
 * 
 * @param {Number} i 
 */
function addFeat(i) {
    featNum = "feat_" + featInc;

    // Div container for feat.
    featDiv = document.createElement("div");
    featDiv.setAttribute("id", featNum);
    featDiv.setAttribute("Class", "feat-box");

    // Feat ID hidden field for PHP to use.
    var feat_ID = document.createElement("input");
    feat_ID.setAttribute("hidden", "hidden");
    feat_ID.name = "Feat_" + featInc + "_ID";
    feat_ID.id = "Feat_" + featInc + "_ID";
    var value = (isNaN(i)) ? 0 : i; // 0 if brand new
    feat_ID.setAttribute('value', value);

    //Feat Name
    var featNameLabel = document.createElement("label");
    featNameLabel.setAttribute("for", featNum + "_name");
    featNameLabel.innerText = "Feat Name: ";
    featNameLabel.setAttribute("Class", "feat-label");

    var featName = document.createElement("input");
    featName.type = "text";
    featName.name = featNum + "_name";
    featName.placeholder = featInc;
    featName.id = featName.name;
    featName.setAttribute("Class", "feat-field");

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.setAttribute("Class", "delete-button");
    deleteButton.innerText = "Delete Feat";
    deleteButton.addEventListener("click", function () {
        var featDiv = deleteButton.parentElement;
        featDiv.remove();
    });

    // Feat Description
    var featDescLabel = document.createElement("label");
    featDescLabel.setAttribute("for", featNum + "_desc");
    featDescLabel.innerText = "Description: "
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
    newDiv.appendChild(featDesc);

    featInc++;
}

var button = document.getElementById('add-feat-button');
button.addEventListener('click', addFeat);

addFeat(2);
