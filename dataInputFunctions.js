/*
jscript script to deal handle the data input events

*/

// vegInput
var imgname = "";
var theHeading = "";
var theLabel ="";

function loadList(){
    $("#lookupdiv").load("IBIS_animalia-tablestripped.html");
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
    if (theHeading == "Species"){
			checkDuplicate();
    }
}

function clsbx(){
    $("#optionsDsplay").slideUp('fast');
}
       
function checkDuplicate(){ 
    var matchList = "";
    var dupItems = "";
    var dupItemsL = "";
    var matchedDiv = "";
    var speciesval= $('#Species').val();
    var catvalue = $('#thecatid').val();
    $.ajax({
	url : '../../cgi-bin/IBIScheckdup.php3',
	type : "get",
	async : "false",
	data :{species : speciesval, catval : catvalue},
	success : function(data){
	    var testregexp = /nomatch/;
	    if (testregexp.test(data)){
	    
	    }else {
				var dataList = data.split("::");
				for (i=0; i<dataList.length; i++){
		    	if (dataList[i]==""){
						continue;
		    	}
		    	dupItems = dataList[0]; 
		    	dupItemsL = dupItems.split(":");
		    	matchList += '<li id="matchItem" onclick="submitDupForm()">' + dupItemsL[0] +':'+ dupItemsL[1] + '</li>';
	       }
	       alert(matchList);
	       $('#specid').val(dupItemsL[1]);
	       matchedDiv = "<div id=\"matches\"><p>Possible duplicate species found.Maybe you want to edit this existing record instead</p><ul>" + matchList + "</ul></div>";
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
    document.VegDupEditForm.submit(); // 	needs to be abstracted
    document.AnimDupEditForm.submit();
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
        
function doSubmit(){
var catvalue = $('#thecatid').val();
    var apicValue = checkPics();
    if (apicValue == ""){
			alert("dude you must add at least one picture... and dont forget the tag");
			exit;
    }
//cleanupData();
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
