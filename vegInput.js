var imgname = "";
var theHeading = "";
var theLabel ="";
	  			 
function addTag(){
    var tagslist = $('#mediatagsinput').val();
    var newtag = imgname +" : "+ tagslist;
    var listitem = "<input type=\"text\" name=\"imgtag[]\" class=\"listitemC littleDD\" value=\""+newtag+"\" ></input><br />";
    $('#tagslist').append(listitem);
}
        
function showOps(that){
    imgname = that.title;
    imgname = imgname.replace(/%20/g, ' ');
    $("#optionsDsplay").slideDown('fast');
    var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="mediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /\><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
    $('#optionsDsplay').html(opttext);
}
        
function sendedit(){
    var editval = $("#outputBox").val();
    $('#'+theHeading).val(editval);
    theLabel.style.backgroundColor = "pink";
    $("#outputBox").val("");
    if (theHeading == "Species"){
	checkDuplicate();
    }
}
        
function checkDuplicate(){ 
    var matchList = "";
    var dupItems = "";
    var dupItemsL = "";
    var matchedDiv = "";
    var speciesval= $('#Species').val();
    var catvalue = 'Vegetables';
    $.ajax({
	url : 'cgi/IBIScheckdup.php3',	type : "get",
	async : "false",
	data :{species : speciesval, catval : catvalue},
	success : function(data){
	    var testregexp = /nomatch/;
	    if (testregexp.test(data)){
		//alert("no matching species found");
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

function submitDupForm(){
    document.VegDupEditForm.submit();
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
    var apicValue = checkPics();
    if (apicValue == ""){
	alert("dude you must add at least one picture... and dont forget the tag");
	 exit;
    }
//cleanupData();
    document.VegForm.submit();
}
