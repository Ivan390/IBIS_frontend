var xmlDoc = "";
var dataSet = "";

var counter = 0;
if (window.XMLHttpRequest) {
  xmlhttp = new XMLHttpRequest();
}
else {
  alert("this shit is not happening boy");
}

function getGuestIndex(){
  xmlhttp.open("GET","Data/Tables/GuestbookXML.xml","",false);
  xmlhttp.send(null);
  xmlDoc = xmlhttp.responseXML;
  dataSet = xmlDoc.getElementsByTagName("guest");
  getAllPics();
}

function getAllPics(){
  var theimages = [];
  var apc = [];
  var allimages = xmlDoc.getElementsByTagName("picRefs");
  
  for (var j = 0; j < allimages.length; j++ ){
    
    var thisimage = allimages[j].childNodes[0].nodeValue;
    theimages.push(thisimage);
  }
  var strimages = theimages.join("");
  
  var allpics =strimages.split(" ");
  for (q = 0; q < allpics.length; q++){
    if ( allpics[q] == " "){
      continue;
    }
    var sourceName = allpics[q];
    var repltext = '/IBIS_Files_new/';
    var replloc = sourceName.lastIndexOf("w");
    replloc = replloc + 2;
    sourceName = sourceName.substr(replloc);
    apc.push('<div id="gImages"><img class="listimage" src="' + sourceName + '" title="' + sourceName +'"  onclick="populateInfo(this)" />')
  }
  document.getElementById("catPicsList").innerHTML = (apc.join(''));
  
}
function populateInfo(that){
  
  var datalength = dataSet.length;
  var counter = 0;
  while (counter < datalength){
    var taglist = "";
    var flName = that.src;
    var shortflName = flName.lastIndexOf("/");
    flName = flName.substr(shortflName);
    if ( counter != null ){
      taglist = xmlDoc.getElementsByTagName("picRefs")[counter].childNodes[0].nodeValue;
      
      if ( taglist.indexOf( flName )>= 0){
	  document.getElementById("commenttag").innerHTML = xmlDoc.getElementsByTagName("comment")[counter].childNodes[0].nodeValue;
	  document.getElementById("prevGuestName").innerHTML = xmlDoc.getElementsByTagName("name")[counter].childNodes[0].nodeValue;
      }
      
    }
    counter++;
    
  }
}



getGuestIndex();