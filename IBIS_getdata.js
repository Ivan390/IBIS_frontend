/*
 This is not finished yet
*/

var xmlDoc = "";
var dataSet = "";
var apc = [];

if (window.XMLHttpRequest) {
  var xmlhttp = new XMLHttpRequest();
}else {
  alert("this shit is not happening boy");
}
  
function getVegIndex(){
  var headingGenus =  xmlDoc.getElementsByTagName("genus")[0].childNodes[0].nodeValue;
  var headingSpecies = xmlDoc.getElementsByTagName("species")[0].childNodes[0].nodeValue;
  var heading = '<span class="important">' + headingGenus + '</span>' + '<span class="important itals">' + headingSpecies + '</span>'; 
  document.getElementById("plant_heading").innerHTML = heading;
  document.getElementById("genus").innerHTML = headingGenus;
  document.getElementById("species_name").innerHTML = headingSpecies;
  document.getElementById("phylum").innerHTML = xmlDoc.getElementsByTagName("phylum")[0].childNodes[0].nodeValue;
  document.getElementById("class").innerHTML = xmlDoc.getElementsByTagName("class")[0].childNodes[0].nodeValue;
  document.getElementById("order").innerHTML = xmlDoc.getElementsByTagName("order")[0].childNodes[0].nodeValue;
  document.getElementById("family_name").innerHTML = xmlDoc.getElementsByTagName("family")[0].childNodes[0].nodeValue;
  document.getElementById("local_names").innerHTML = xmlDoc.getElementsByTagName("common_Names")[0].childNodes[0].nodeValue;
  document.getElementById("name_notes").innerHTML = xmlDoc.getElementsByTagName("name_Notes")[0].childNodes[0].nodeValue;
  document.getElementById("description").innerHTML = xmlDoc.getElementsByTagName("description")[0].childNodes[0].nodeValue;
  document.getElementById("eco_role").innerHTML = xmlDoc.getElementsByTagName("ecology")[0].childNodes[0].nodeValue;
  document.getElementById("distrib_notes").innerHTML = xmlDoc.getElementsByTagName("distrib_Notes")[0].childNodes[0].nodeValue;
  document.getElementById("uses").innerHTML = xmlDoc.getElementsByTagName("uses")[0].childNodes[0].nodeValue;
  document.getElementById("growing").innerHTML = xmlDoc.getElementsByTagName("growing")[0].childNodes[0].nodeValue;
  var xmlimages = xmlDoc.getElementsByTagName("picPath")[0].childNodes[0].nodeValue;
  var imagelist =xmlimages.split(" ");
  var pics = [];
  for (var i = 0; i < imagelist.length-1; i++) {
    if ( imagelist[i] == ""){
      continue;
    }
    pics.push('<div name="imgdiv' + i + '" class="genImage" ><img class="specimage listimage" src="' + imagelist[i] + '"/></div>');
  }
  document.getElementById("pic_list").innerHTML = (pics.join(''));
}

function getAnimIndex(){
  var headingGenus =  xmlDoc.getElementsByTagName("genus")[0].childNodes[0].nodeValue;
  var headingSpecies = xmlDoc.getElementsByTagName("species")[0].childNodes[0].nodeValue;
  var heading = '<span class="important">' + headingGenus + '</span>' + '<span class="important itals">' + headingSpecies + '</span>'; 
  document.getElementById("animal_heading").innerHTML = heading;
  document.getElementById("genus").innerHTML = headingGenus;
  document.getElementById("species_name").innerHTML = headingSpecies;
  document.getElementById("phylum").innerHTML = xmlDoc.getElementsByTagName("phylum")[0].childNodes[0].nodeValue;
  document.getElementById("subPhylum").innerHTML = xmlDoc.getElementsByTagName("subPhylum")[0].childNodes[0].nodeValue;
  document.getElementById("class").innerHTML = xmlDoc.getElementsByTagName("class")[0].childNodes[0].nodeValue;
  document.getElementById("subClass").innerHTML = xmlDoc.getElementsByTagName("subClass")[0].childNodes[0].nodeValue;
  document.getElementById("order").innerHTML = xmlDoc.getElementsByTagName("order")[0].childNodes[0].nodeValue;
  document.getElementById("family_name").innerHTML = xmlDoc.getElementsByTagName("family")[0].childNodes[0].nodeValue;
  document.getElementById("genus").innerHTML = xmlDoc.getElementsByTagName("genus")[0].childNodes[0].nodeValue;
  document.getElementById("species_name").innerHTML = xmlDoc.getElementsByTagName("species")[0].childNodes[0].nodeValue;
  document.getElementById("local_names").innerHTML = xmlDoc.getElementsByTagName("common_Names")[0].childNodes[0].nodeValue;
  document.getElementById("name_notes").innerHTML = xmlDoc.getElementsByTagName("name_Notes")[0].childNodes[0].nodeValue;
  document.getElementById("description").innerHTML = xmlDoc.getElementsByTagName("description")[0].childNodes[0].nodeValue;
  document.getElementById("size").innerHTML = xmlDoc.getElementsByTagName("size")[0].childNodes[0].nodeValue;
  document.getElementById("habitat").innerHTML = xmlDoc.getElementsByTagName("habitat")[0].childNodes[0].nodeValue;
  document.getElementById("habits").innerHTML = xmlDoc.getElementsByTagName("habits")[0].childNodes[0].nodeValue;
  
  var xmlimages = xmlDoc.getElementsByTagName("picPath")[0].childNodes[0].nodeValue;
  var imagelist =xmlimages.split(" ");
  var pics = [];
  for (var i = 0; i <= imagelist.length-1; i++) {
    if ( imagelist[i] == ""){
      continue;
    }
    pics.push('<div name="imgdiv' + i + '" class="genImage" ><img class="specimage listimage" src="' + imagelist[i] + '"/></div>');
  }
  document.getElementById("pic_list").innerHTML = (pics.join(''));
 }
	      
function getMinIndex(){
  document.getElementById("name").innerHTML = xmlDoc.getElementsByTagName("name")[0].childNodes[0].nodeValue;
  document.getElementById("cFormula").innerHTML = xmlDoc.getElementsByTagName("chemical_Formula")[0].childNodes[0].nodeValue;    
  document.getElementById("group").innerHTML = xmlDoc.getElementsByTagName("group")[0].childNodes[0].nodeValue;
  document.getElementById("c_system").innerHTML = xmlDoc.getElementsByTagName("crystal_System")[0].childNodes[0].nodeValue;
  document.getElementById("habit").innerHTML = xmlDoc.getElementsByTagName("habit")[0].childNodes[0].nodeValue;
  document.getElementById("cFormula").innerHTML = xmlDoc.getElementsByTagName("chemical_Formula")[0].childNodes[0].nodeValue;
  document.getElementById("hardness").innerHTML = xmlDoc.getElementsByTagName("hardness")[0].childNodes[0].nodeValue;
  document.getElementById("density").innerHTML = xmlDoc.getElementsByTagName("density")[0].childNodes[0].nodeValue;
  document.getElementById("cleavage").innerHTML = xmlDoc.getElementsByTagName("cleavage")[0].childNodes[0].nodeValue;
  document.getElementById("fracture").innerHTML = xmlDoc.getElementsByTagName("fracture")[0].childNodes[0].nodeValue;
  document.getElementById("streak").innerHTML = xmlDoc.getElementsByTagName("streak")[0].childNodes[0].nodeValue;
  document.getElementById("lustre").innerHTML = xmlDoc.getElementsByTagName("lustre")[0].childNodes[0].nodeValue;
  document.getElementById("fluorescense").innerHTML = xmlDoc.getElementsByTagName("fluorescense")[0].childNodes[0].nodeValue;
  document.getElementById("Notes").innerHTML = xmlDoc.getElementsByTagName("notes")[0].childNodes[0].nodeValue;
  document.getElementById("origin").innerHTML = xmlDoc.getElementsByTagName("origin")[0].childNodes[0].nodeValue;
  document.getElementById("characteristics").innerHTML = xmlDoc.getElementsByTagName("characteristics")[0].childNodes[0].nodeValue;
  document.getElementById("uses").innerHTML = xmlDoc.getElementsByTagName("uses")[0].childNodes[0].nodeValue;
  var xmlimages = xmlDoc.getElementsByTagName("picPath")[0].childNodes[0].nodeValue;
  var imagelist =xmlimages.split(" ");
  var pics = [];
  for (var i = 0; i <= imagelist.length-1; i++) {
    if ( imagelist[i] == ""){
      continue;
    }
    pics.push('<div name="imgdiv' + i + '" class="genImage" ><img class="specimage listimage" src="' + imagelist[i] + '"/></div>');
  }
  document.getElementById("pic_list").innerHTML = (pics.join(''));
} 

function clickblock(that){
    var theText = that.nextSibling.nextSibling.innerHTML;
    var theBlock = document.getElementById("outputBlock");
    theBlock.innerHTML = theText;
  }

var categoryName = document.getElementById("catVal").innerHTML;
var xmlDataFile = document.getElementById("data_file").innerHTML;
xmlhttp.open("GET",xmlDataFile,"",false);
xmlhttp.send(null);
xmlDoc = xmlhttp.responseXML;
dataSet = xmlDoc.getElementsByTagName("data_entry");

if (categoryName == "vegetables"){
  getVegIndex();
  
}if (categoryName == "animals"){
  getAnimIndex();
}
if (categoryName == "minerals"){
  getMinIndex();
}
