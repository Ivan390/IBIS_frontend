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
  xmlhttp.open("GET","/IBIS_Files_new/Data/Tables/GuestbookXML.xml","",false);
  xmlhttp.send(null);
  xmlDoc = xmlhttp.responseXML;
  dataSet = xmlDoc.getElementsByTagName("guest");
  getAllPics();
}

function getAllPics(){
  var theimages = [];
  var apc = [];
  var allimages = xmlDoc.getElementsByTagName("picRefs");
  for (var j = 0; (j <= allimages.length-1); j++ ){
    var thisimage = allimages[j].childNodes[0].nodeValue;
    var listofpics = thisimage.split(" ");
    theimages.push(thisimage);
  }
  theimages = theimages.join("");
  theimages =theimages.split(" ");
  for (q = 0; q <= (theimages.length-1); q++){
    if ( theimages[q] == ""){
      continue;
    }
    var sourceName = theimages[q];
    apc.push('<img class="listimage" src="' + sourceName + '" title="' + sourceName +'" onclick="populateInfo(this)"/>')
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

function submitThis(){
  document.guestBook.submit();
}
getGuestIndex();