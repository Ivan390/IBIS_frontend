	var imgname = "";

function handleFileSelect(evt) {
		var files = evt.target.files; 
		$("#optionsDsplay").slideUp('fast');
		document.getElementById('GuestPic').innerHTML = " ";
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
			
	   document.getElementById('GuestPic').insertBefore(span, null);
	  };
	})(f);
	reader.readAsDataURL(f);
  }
}
    
function addTag(){
	var tagslist = $('#mediatagsinput').val();
	var newtag = imgname +" : "+ tagslist;
	//var existingtags = " ";
	var listitem = "<input type=\"text\"name=\"imgtag\" class=\"listitemC\" value=\""+newtag+"\" ></input><br />";
  $('#newtagslist').append(listitem);
}
function showOps(that){
		   	  imgname = that.title;
		   	  
		   	  var opttext = '<p class="labelclass">Add Tags for <br>' + imgname + '</p><input type="text" name="mediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /><br><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
		  		$('#optionsDsplay').html(opttext);
		  		$("#optionsDsplay").slideDown('fast');
}

function submitThis(){
	var swearList = new Array("fuck", "shit", "asshole", "bitch", "cunt", "shithead");
	var comment = document.getElementById('gcommnt').value;
	//alert(comment);
	for (i = 0; i < swearList.length; i++){
		var swearWrd = swearList[i];
		var wordexp = new RegExp(swearWrd);
//alert(wordexp);
		if (wordexp.test(comment)){
			alert("words like " + swearWrd + " are not allowed in this database!" );
			break;
		}else{
			document.guestBook.submit();

		}
	}		
	
      	}
      	
      	
