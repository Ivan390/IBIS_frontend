var imgname = "";
var theHeading = "";
var theLabel ="";


function loadList(){
	$("#lookupdiv").load("IBIS_animalia-tablestripped.html");
  $("#lookupdiv").css("display", "block");
 // $("lookupdiv > #dateTime").css("display", "none");
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
	var listitem = "<input type=\"text\"name=\"imgtag[]\" class=\"listitemC littleDD\" value=\""+newtag+"\" ></input><br />";
  $('#infoDiv').hide();
  $('#tagslist').append(listitem);
}
  
function showOps(that){
	imgname = that.title;
	imgname = imgname.replace(/%20/g, ' ');
	var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="AmediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /\><input type="button" class="buttonclassAI" value="Add" onclick="addTag();" /><span id="clscnt" class="buttonclassAI" onclick="clsbx()">X</span>';
	$('#optionsDsplay').html(opttext);
	$("#optionsDsplay").slideDown('fast');
}

function clsbx(){
	$("#optionsDsplay").slideUp('fast');
}

function checkDuplicate(){ 
	var matchList = "";
  var dupItems = "";
  var dupItemsL = "";
  var matchedDiv = "";
   // alert("it is running the script");
 	var speciesval= $('#Species').val();
		var catvalue = 'Animals';
		$.ajax({
			url : '../../cgi-bin/checkdup.php3',
			type : "get",
			async : "false",
			data :{species : speciesval, catval : catvalue},
		success : function(data){
			var testregexp = /nomatch/;
			if (testregexp.test(data)){
				alert("no matching species found");
			}else {
				var dataList = data.split("::");
				for (i=0; i<dataList.length; i++){
					if (dataList[i]==""){
						continue;
					}
					dupItems = dataList[0]; //.split(":");
					dupItemsL = dupItems.split(":");
						//	alert(dataList[i]);
					matchList += '<li id="matchItem" onclick="submitDupForm()">' + dupItemsL[0] +':'+ dupItemsL[1] + '</li>';
				}
			// last error said that dataList.split is not a function????....because it was allready an array
				alert(matchList);
				$('#specid').val(dupItemsL[1]);
				matchedDiv = "<div id=\"matches\"><p>Possible duplicate species found.Maybe you want to edit this existing record instead</p><ul>" + matchList + "</ul></div>";
				$('#messageDiv').html(matchedDiv);
			}
		}
	})
}

        
function sendedit(){
  var editval = $("#outputBox").val();
  var errmssg = checkWords(editval);
  //alert("from sendedit\n"+errmssg);
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
 function checkWords(content){
	var swearList = new Array("fuck", "shit", "asshole", "bitch", "cunt", "shithead", "asscrack", "bullshit", "damnit");
	var comment = content;
	//alert(comment);
	for (i = 0; i < swearList.length; i++){
		var swearWrd = swearList[i];
		var wordexp = new RegExp(swearWrd);
//alert(wordexp);
		if (wordexp.test(comment)){
		var messg = "words like " + swearWrd + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading";
		//	alert("words like " + swearWrd + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading" );
		return messg;
			break;
		}
		}
	}		
	    
function loadcontent(that){
	theHeading = $(that).text();
	theLabel = that;
  $('.thisareaLabel').css("color" ,"black");
  theLabel.style.color = "lightgreen";
  //theLabel.color = "red";
  var theContent = $('#'+theHeading).val();
  checkWords(theContent);
  $("#outputBox").val(theContent);
}
function submitDupForm(){
	document.AnimDupEditForm.submit();
}

function doSubmit(){
		//cleanupData();
	document.AnimForm.submit();
}
