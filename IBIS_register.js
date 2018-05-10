/*
 need to make sure input values are valid for their type and
 restricted in length
 
*/
function showAgreement(){
	$(".requiredf").hide();
	$("#secQ").hide();
	$("#detail_fs").css("background-color", "gray");
	var Adiv = "<div id=\"agree\"><p>Hi<br>If you are here then you must want to register to contribute this project. In that case, there are some things you should know. Firstly this is a personal project I compiled because I had trouble remembering the names of stuff. It is meant to be usefull<span><input type=\"checkbox\" id=\"Acheck\" onchange=\"enableForm()\"><label>I agree</label><span><\p><\div>";
	$("#imgDisplay").css("background-color", "white");
	$("#imgDisplay").html(Adiv);
}

function enableForm(){
	$(".requiredf").show();
	$("#detail_fs").css("background-color", "white");
	$("#agree").css("background-color", "white");
	$("#agree").remove();
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
    document.registerForm.submit();
  }
}
////-> submit registration to server and receive results into floating dialog
function handleSubmition(){

} 


function checkWords(that){
		var content = $(that).val();
    var swearWrd = "";
    var wordexp = "";
    var messg = "";
    var empty = "";
    var swearList = new Array("fuck", "shit", "ass", "bitch", "cunt", "bullshit", "damnit", "poes", "naai" );
    var comment = content;
    //alert(comment);
    for (i = 0; i < swearList.length; i++){
	 		swearWrd = swearList[i];
	 		wordexp = new RegExp(swearWrd);
   		if (wordexp.test(comment)){
		    messg = "words like " + comment + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading";
		   	alert(messg);
		   $(that).val(empty); 
			}
		}
}	
