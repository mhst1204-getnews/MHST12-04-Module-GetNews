
function getBrowserType() {
var detect = navigator.userAgent.toLowerCase();
var browser;
var doCheckIt = function (bString) {
place = detect.indexOf(bString) + 1;
return place;
};
if (doCheckIt('konqueror')) { browser = "konqueror"; }
else if (doCheckIt('safari')) { browser = "safari"; }
else if (doCheckIt('omniweb')) { browser = "omniweb"; }
else if (doCheckIt('opera')) { browser = "opera"; }
else if (doCheckIt('webtv')) { browser = "webtv"; }
else if (doCheckIt('icab')) { browser = "icab"; }
else if (doCheckIt('msie')) { browser = "msie"; }
else if (doCheckIt('firefox')) { browser = "firefox"; }
else if (!doCheckIt('compatible')) { browser = "nn"; }
return browser;
}
function strTrim(str) {
var i,j;
i = 0;
j = str.length-1;
str = str.split("");
while(i < str.length) {
if(str[i]==" ") {
str[i] = "";
} else {
break;
}
i++;
}
while(j > 0) {
if(str[j]== " ") {
str[j]="";
} else {
break;
}
j--;
}
return str.join("");
}
function igEncodeHTML(igHTML) {
var regExLT = /</g;
var regExGT = />/g;
igHTML = igHTML.replace(regExLT, "&lt;");
igHTML = igHTML.replace(regExGT, "&gt;");
return igHTML;
}
function doCleanUp(sTxt) {
sTxt = sTxt.replace(/(\r\n|\r|\n)/g, "\n");
var arrTxt = sTxt.split("\n");
for(i=0; i<arrTxt.length; i++) {
if(arrTxt[i].substr((arrTxt[i].length-1), 1)==" ") {
arrTxt[i] = arrTxt[i].substr(0, (arrTxt[i].length-1));
}
if(arrTxt[i].substr((arrTxt[i].length-1), 1)==" ") {
arrTxt[i] = arrTxt[i].substr(0, (arrTxt[i].length-1));
}
}
sTxt = arrTxt.join("\n");
}