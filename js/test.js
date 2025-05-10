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

var cookieArray = document.cookie.split('; ');
var cookieObject = {};
for (const element of cookieArray) {
    var row = element.split('=');
    var key = row[0];
    document.writeln(row[0]);
    var value = row[1];
    document.writeln(row[1]);
    cookieObject[key] = value;
}

document.writeln(cookieObject["PHPSESSID"]);

// var testArr = [];
// testArr['Something'] = "hot";

// document.writeln(testArr['Something']);

// document.writeln(document.cookie + "<br>The Array:<br>");
// document.writeln(getCookiePairs().length);
