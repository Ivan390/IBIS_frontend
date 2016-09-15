
	var theSrc = "";
	var theTag = "";
	var imgDelList = "";
	var tagList = "";
	var imgname = "";
function handleFileSelect(evt) {
		var files = evt.target.files; 
		$("#optionsDsplay").slideUp('fast');
		$('#imgDisplay').html("");
		  $('#newtagslist').val("");
		for (var i = 0, f; f = files[i]; i++) {
	  	if (!f.type.match('image.*')) {
	 	 	continue;
	 	}
	 	if (i > 5){
	 	 alert("Select up to 6 media files");
	 	 continue;
	 	}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
	  return function(e) {
		$('#imgDisplay').append('<img class="thumbpic" src="'+ e.target.result + '" title="'+ escape(theFile.name)+ '" onclick="showOps(this)" /\>');
	  };
	})(f);
	reader.readAsDataURL(f);
      }
      $('#newtagslist').html("");
    }
    
function showImgOpts(that){
	 theSrc = that.src;
	 theTag = that.title;
	
	var editImageDiv = '<div id="editImageDiv"><label>Edit Image Tags</label><br><textarea id="editTag">' + theTag + '</textarea><br><input type="hidden" id="srcVal" value="'+ theSrc +'"><input type="checkbox" id="chkbx1" name="chkbox1" value="Delete"  class="checkC" />Remove this image<br><input type="button" id="editTagsBtn" class="buttonclass" value="submit edit" onclick="markDel()" /></div>'  ;
$('#oldTags').html(editImageDiv);
}

function markDel(){
 var thisFSrc = $('#srcVal').val();
 var chkBx = $('#chkbx1');
 var messg = "";
 var filepart = 'http://127.0.0.1/ibis/Data/Images/';//http://localhost/ibis/Data/Images/
 var localFpart = 'http://127.0.0.1/ibis/Data/Images/';//http://127.0.0.1/ibis/Data/Images/
 thisSrc = thisFSrc.replace(filepart, "");
 thisSrc = thisFSrc.replace(localFpart, "");
 alert(thisSrc);
 if ($('#chkbx1').prop('checked')) {

 //if (chkBx.checked == true){
 var imgDelList = thisSrc + ":";
  var oldlist = $('#imgDeletelist').val();
  var newList = oldlist + imgDelList;
  $('#imgDeletelist').val(newList);
  var imgList = document.images;
  var imgCount = imgList.length;
  for (i = 0; i < imgCount; i++){
  	if (imgList[i].src == thisFSrc){
  		imgList[i].src = "";
  		imgList[i].title = "";
  		
  	}
  }
 }else {
 var thisTag = $('#editTag').val();
 tagList += thisSrc + ":" + thisTag + "::";
 $('#editedtagslist').html(tagList);
  var imgList = document.images;
  var imgCount = imgList.length;
  for (i = 0; i < imgCount; i++){
  	if (imgList[i].src == thisFSrc){
  		 imgList[i].title = thisTag;
  		 
  	}
  }
 }
}

function addTag(){
	var tag = $('#mediatagsinput').val();
	var tagpair = imgname +" : "+ tag + "::";
	//var existingtags = " ";
	var existingtags = $('#newtagslist').val();
	if (existingtags.search(imgname) == -1){
	var pretags = $('#newtagslist').val();
	var newlist = tagpair + pretags;
	//	var listitem = "<input type=\"text\" name=\"imgtag\" class=\"listitemC\" value=\""+newtag+"\" ></input><br />";
  $('#newtagslist').val(newlist);
	}else{
		alert("an entry for that allready exists" );
			}

}
function showOps(that){
		   	  imgname = that.title;
		   	  $("#optionsDsplay").slideDown('fast');
		   	  var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="AmediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /><br><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
		  		$('#optionsDsplay').html(opttext);
}

function doSubmit(){
document.EditsForm.submit();
}
