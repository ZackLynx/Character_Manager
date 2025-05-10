/**
 * Takes the PHP session cookie string and splits the data into key-value pairs.
 * @returns {Object} a key-value data object of all cookies in the session.
 */
function getCookiePairs() {
    var cookieArray = document.cookie.split('; ');
    var cookieObject = {};
    for (const element of cookieArray) {
        var row = element.split('=');
        var key = row[0];
        var value = row[1];
        cookieObject[key] = value;
    }
    return cookieObject;
}

// Get the tasty cookies
var cookies = getCookiePairs();

// document.writeln("PHPSESSID=");
// document.writeln(cookies.PHPSESSID);

document.writeln("CLASS_SKILLS=");
// get the class skills table
var classSkills = decodeURIComponent(cookies.CLASS_SKILLS);

// make the JSON workable
var csJSON = JSON.parse(classSkills);

// split the string value of the pair into an array
var arr = csJSON[1].split(', ');

// check if the skill is a class skill
console.log(arr.includes('Acrob'));
document.writeln(csJSON[1]);

// var testArr = [];
// testArr['Something'] = "hot";

// document.writeln(testArr['Something']);

// document.writeln(document.cookie + "<br>The Array:<br>");
// document.writeln(getCookiePairs().length);
