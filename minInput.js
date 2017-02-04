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
    var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="mediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /\><br><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
    $('#optionsDsplay').html(opttext);
}
        
function sendedit(){
    var editval = $("#outputBox").val();
    $('#'+theHeading).val(editval);
    theLabel.style.backgroundColor = "pink";
    $("#outputBox").val("");
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
        
function doSubmit(){
    //cleanupData();
    document.MinForm.submit();
}
