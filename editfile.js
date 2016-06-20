/*editfile javascript*/

/*
This needs to add some functionality to the page before it gets loaded
namely
the values in the picturepaths area should firstly be not visible
    then those values must be used to populate img tags
a plus sign button that when clicked,
    displays an upload element to add more images
an area to add a comment on the changes that were made (must be filled in before submission is allowed)
*/
/*
Mon 24 Aug 2015 21:14:41 
need to add image tag input for new images
and make current imagetags available for editing
*/
$("#data_entry").css("display","none");
$("#PicPathcontent").css("display","none");
$("#pictures").css("display","none");
$("#distrib_Map").css("display","none");
$("#contributer_ID").css("display","none");
$("#picPath").css("display","none");
$("#refNumber").css("display","none");
var piclist = [];
var pics = [];
var picpaths = document.getElementById("PicPath").value;
piclist = picpaths.split(" ");
for (var i = 0; i <= piclist.length-1; i++) {
    if ( piclist[i] == ""){
      continue;
    }
    pics.push('<img class="specimage listimage" src="' + piclist[i] + '" width="150px" height="150px"/></div>');
  }
  $("#editform").append('<div id="addimages" class="littleDD">Add Images<br /><img src="" alt="plussign"/><input name="pictures" type="file" multiple /></div>');
  $("#currImages").append(pics);
  document.getElementById("currImages").innerHTML = (pics.join(''));
  $("#editform").append('<div id="commentBlock" class="littleDD"><label id="editcommentL" class="thisareaLabel littleDD">Please add a comment describing your edits here</label></br><textarea id="editcommentC" name="editcommentC" class="thisarea bigDD"></textarea></br></div>');

var theHeading = "";
var theElement = "";
    function dosubmit(){
        var theEditCom = document.getElementById("editcommentC").value;
        if (theEditCom == ""){
        alert("Please leave a comment describing the edits you made in the box provided, it is important,...really.");
        document.getElementById("editcommentC").style.backgroundColor = "pink";
	document.getElementById("editcommentC").style.color = "black";
        }else{
        document.getElementById("userref").value = sessionStorage.userRef;
        document.getElementById("browserDate").value = document.getElementById("dateBlock").innerHTML;
        document.getElementById("browserTime").value = document.getElementById("timeBlock").innerHTML;
        document.editForm.submit();
        }
        }
    function sendedit(){
        document.getElementById(theHeading).value = document.getElementById("outputBox").value;
        theElement.style.backgroundColor = "pink";
        }
    function loadcontent(that){
        theHeading = that.innerHTML;
        theElement = that;
        $(".thisareaLabel").css("color", "black");
        that.style.color = "green";
        var theContent = document.getElementById(theHeading).value;
        var theBlock = document.getElementById("outputBox");
        theBlock.value = theContent;
        }
