/*
 need to make sure input values are valid for their type and
 restricted in length
 
*/
function showAgreement(){
	$(".requiredf").hide();
	$("#pgButtons").hide();
	$("#secQ").hide();
	$("#detail_fs").css("background-color", "gray");
	var Adiv = "<div id=\"agree\"><p>Hi<br>If you are here then you must want to register to contribute to this project. In that case, there are some things you should know. Firstly this is a personal project I compiled because I had trouble remembering the names of stuff. It is meant to be usefull.<br /><span><input type=\"checkbox\" id=\"Acheck\" onchange=\"enableForm()\"><label>Yes</label></span><br /><span><input type=\"checkbox\" id=\"Rcheck\" onchange=\"closeThis()\"><label>  No</label></span></p></div>";
	//$("#agreement").css("background-color", "white");
	$("#agreement").html(Adiv);
}
function closeThis(){
	document.location = "IBISmain.html";
}
function enableForm(){
	$(".requiredf").show();
	$("#detail_fs").css("background-color", "white");
	$("#pgButtons").fadeIn();
	$("#agreement").fadeOut();
}
function submitRegistration(){
  var fName = $("#fName").val();
  var secA = $("#secA").val();
  
  if (fName.length > 10){
  alert("please keep your name less than 10 characters" );
    exit();
  }if( secA.length > 20){
    alert("please keep your security answer to less than 20 characters" );
    exit();
  }else{
    sendit();
  }
}


function checkWords(that){
		var content = $(that).val();
    var swearWrd = "";
    var wordexp = "";
    var messg = "";
    var empty = "";
    var swearList = new Array(" fuck ", " shit ", " ass ", " bitch ", " cunt ", " bullshit ", " damnit ", " poes ", " naai " );
    var comment = content;
    //alert(comment);
    for (i = 0; i < swearList.length; i++){
	 		swearWrd = swearList[i];
	 		wordexp = new RegExp(swearWrd);
   		if (wordexp.test(comment)){
		    messg = "words like " + comment + " are not allowed in this database!\nPlease clean up your language.\nNo entry was recorded for this heading";
		   	alert(messg);
		   $(that).val(empty); 
			}
		}
}	
