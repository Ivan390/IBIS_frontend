
document.getElementById('mediaPic').addEventListener('change', handleFileSelect, false);
	var theSrc = "";
	var theTag = "";
	var imgDelList = "";
	var tagList = "";
	var imgname = "";
function handleFileSelect(evt) {
		var files = evt.target.files; 
		$("#optionsDsplay").slideUp('fast');
		document.getElementById('imgDisplay').innerHTML = " ";
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
	  	var span = document.createElement('span');
	  	span.innerHTML = "";
			span.innerHTML = ['<img class="thumbpic" src="', e.target.result, '" title="', escape(theFile.name), '" onclick="showOps(this);" /\>'].join('');
			
	   document.getElementById('imgDisplay').insertBefore(span, null);
	  };
	})(f);
	reader.readAsDataURL(f);
      }
      document.getElementById('newtagslist').innerHTML= "";
    }
    
function showImgOpts(that){
	 theSrc = that.src;
	 theTag = that.title;
	
	var editImageDiv = '<div id="editImageDiv"><label>Edit Image Tags</label><br><textarea id="editTag">' + theTag + '</textarea><br><input type="hidden" id="srcVal" value="'+ theSrc +'"><input type="checkbox" id="chkbx1" name="chkbox1" value="Delete"  class="checkC" />Remove this image<br><input type="button" id="editTagsBtn" class="buttonclass" value="submit edit" onclick="markDel()" /></div>'  ;
$('#oldTags').html(editImageDiv);
}

function markDel(){
 var thisFSrc = document.getElementById('srcVal').value;
 var chkBx = document.getElementById('chkbx1');
 var messg = "";
 var filepart = 'http://127.0.0.1/IBIS_Files_new/Data/Images/';
 thisSrc = thisFSrc.replace(filepart, "");
 if (chkBx.checked == true){
  imgDelList += thisSrc + ":";
  document.getElementById('imgDeletelist').innerHTML = imgDelList;
  var imgList = document.images;
  var imgCount = imgList.length;
  for (i = 0; i < imgCount; i++){
  	if (imgList[i].src == thisFSrc){
  		imgList[i].src = "";
  		imgList[i].title = "";
  		
  	}
  }
 }else {
 var thisTag = document.getElementById('editTag').value;
 tagList += thisSrc + ":" + thisTag + "::";
 document.getElementById('editedtagslist').innerHTML = tagList;
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
	var tagslist = $('#mediatagsinput').val();
	var newtag = imgname +" : "+ tagslist;
	//var existingtags = " ";
	var existingtags = document.getElementById('newtagslist').innerHTML;
	if (existingtags.search(imgname) == -1){
		var listitem = "<input type=\"text\"name=\"imgtag[]\" class=\"listitemC\" value=\""+newtag+"\" ></input><br />";
  $('#newtagslist').append(listitem);
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
