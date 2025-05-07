var featInc = 0;

/**
 * Creates a block of HTML code that contains the fields for entering a feat into a
 * character sheet.
 * 
 * @param {Number} i The Feat_ID of the feat in the `feats` database. `0` otherwise.
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
    // featName.placeholder = featInc;
    featName.id = featName.name;
    featName.setAttribute("Class", "feat-field");

    // Delete button
    var deleteButton = document.createElement("button");
    deleteButton.setAttribute("Class", "delete-button");
    deleteButton.innerText = "Delete Feat";
    deleteButton.addEventListener("click", function () {
        // If feat_ID > 0
        if (feat_ID.value > 0) {
            // Mark for deletion

        }

        // remove the feats <div>
        var featDiv = deleteButton.parentElement;
        featDiv.remove();
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
}

var cookies = document.cookie.split(';');
document.writeln('<p>');
document.writeln(decodeURIComponent(cookies));
document.writeln('</p>');



// Real time repeat with math
var microphone = document.getElementById('wurds');
microphone.addEventListener('input', function (event) {
    var output = document.getElementById('echo');
    output.innerHTML = event.target.value * 2;
})

addFeat(2);
