/*
jscript script to deal handle the data input events

*/

// vegInput
var imgname = "";
var theHeading = "";
var theLabel ="";

function loadList(){
    $("#lookupdiv").load("IBISanimalsRefMini.html");
    $("#lookupdiv").css("display", "block");
    $("#lookupList").css("display", "none");
    $("#lookupHide").css("display", "inline");
}

function hideList(){
    $("#lookupdiv").css("display","none");
    $("#lookupHide").css("display", "none");
    $("#lookupList").css("display", "inline");
}
	  			 
function addTag(){
    var tagslist = $('#mediatagsinput').val();
    var newtag = imgname +" : "+ tagslist;
    var listitem = "<input type=\"text\" name=\"imgtag[]\" class=\"listitemC littleDD\" value=\""+newtag+"\" ></input><br />";
    $('#tagslist').append(listitem);
}
        
function showOps(that){
    imgname = that.title;
    imgname = imgname.replace(/%20/g, ' ');
    var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="mediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /\><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
    $('#optionsDsplay').html(opttext);
    $("#optionsDsplay").slideDown('fast');
}
        
function sendedit(){
    var editval = $("#outputBox").val();
    var errmssg = checkWords(editval);
    if (errmssg){
			alert("This is a family website\n"+errmssg);
			$('#'+theHeading).val("");
			theLabel.style.backgroundColor = "red";
			$("#outputBox").val("Bad Word User");
    }else{
			$('#'+theHeading).val(editval);
			theLabel.style.backgroundColor = "pink";
			$("#outputBox").val("");
    }
    if (theHeading == "Species" || theHeading == "Name"){
			checkDuplicate();
    }
}

function clsbx(){
    $("#optionsDsplay").slideUp('fast');
}
       
function checkDuplicate(){ 
	var setval = $('#Kingdom').val();
    var matchList = "";
    var dupItems = "";
    var dupItemsL = "";
    var matchedDiv = "";
    var speciesval= "";
    var catvalue = $('#thecatid').val();
    if (setval == "Animalia"){
    	speciesval= $('#Species').val();
    	category = "Animals";
    	thecat = "animals";
    }
    if (setval == "Plantae"){
    	speciesval= $('#Species').val();
    	category = "Vegetables";
    	thecat = "vegetables";
    } 
    if (setval == "Minerals"){
    	speciesval= $('#Name').val();
    	category = "Minerals";
    	thecat = "minerals";
    }
    
    $.ajax({
	url : '../../cgi-bin/IBIScheckdup.php3',
	type : "get",
	async : "false",
	data :{species : speciesval, catval : catvalue, group : category},
	success : function(data){
	    var testregexp = /nomatch/;
	    if (testregexp.test(data)){
	    	
	    }else {
				var dataList = data.split("::");
				for (i=0; i<dataList.length; i++){
		    	if (dataList[i]==""){
						continue;
		    	}
		    	dupItems = dataList[i]; 
		    	dupItemsL = dupItems.split(":");
		    	genref = dupItemsL[1];
		    	specref = dupItemsL[2];
		    	recID = dupItemsL[0];
		    	conRef = dupItemsL[4];
		    	localN = dupItemsL[3];
		  matchList += "<li><a href=\"../../cgi-bin/IBISeditStuff.php3?thecat="+thecat+"&specref="+genref+"&genref="+specref+"\">"+specref +" "+ genref +"</a><span id=\"lcN\">  "+localN+"</span> </li>";
		    }
		  	       
	       $('#specid').val(dupItemsL[1]);
	       
	       matchedDiv = "<div id=\"matDiv\">Possible duplicate entry.</br>Maybe you want to edit the existing record instead</br><ul id=\"matlist\">"+matchList+"</ul><input type=\"button\" class=\"buttonclass\" value=\"Enter anyway \" onclick=\"closeDiag()\"></div>";
		       $('#messageDiv').html(matchedDiv);
	   }
		}
	})
	
}

function checkWords(content){
    var swearWrd = "";
    var wordexp = "";
    var messg = "";
    var swearList = new Array("fuck", "shit", "asshole", "bitch", "cunt", "shithead", "asscrack", "bullshit", "damnit");
    var comment = content;
    //alert(comment);
    for (i = 0; i < swearList.length; i++){
	 swearWrd = swearList[i];
	 wordexp = new RegExp(swearWrd);
	//alert(wordexp);
		if (wordexp.test(comment)){
		    messg = "words like " + swearWrd + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading";
		//	alert("words like " + swearWrd + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading" );
		    return messg;
		    break;
		}
	}
}	

function submitDupForm(){
    document.dplForm.submit(); // 	needs to be abstracted
   }
     
function loadcontent(that){
    theHeading = $(that).text();
    theLabel = that;
    $('.thisareaLabel').css("color" ,"black");
    theLabel.style.color = "lightgreen";
     //theLabel.color = "red";
    var theContent = $('#'+theHeading).val();
    $("#outputBox").val(theContent);
}
 
function checkPics() {
    var picValue = $('#imgDisplay').html();
    return picValue;
}

function closeDiag(){
	$('#matDiv').hide();
}
function reallySubmit(){
var catvalue = $('#thecatid').val();
	if (catvalue == "Vegetables"){
		document.VegForm.submit(); 
		}
     else if (catvalue == "Animals"){
     document.AnimForm.submit();
     }
     else if (catvalue == "Minerals"){
      document.MinForm.submit();
     }

}        
function hidethis(){
$('#messD').hide();
}
function doSubmit(){

    var apicValue = checkPics();
    if (apicValue == ""){
			//alert("dude you must add at least one picture... and dont forget the tag");
			var messgDiv = "<div id=\"messD\" class=\"dialogC\"><p>Entries without an attached image are saved to the Lost And Found</br>and will not be available through the Data Index.</p><input type=\"button\" class=\"buttonclass\" value=\"Don't worry about it.\" onclick=\"reallySubmit()\"/><input type=\"button\" class=\"buttonclass\" value=\"Oops.\" onclick=\"hidethis()\"/></div>";
    $('#messageDiv').html(messgDiv);
    }else{
    reallySubmit();
    }
//cleanupData();
	
    
}
