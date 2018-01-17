/* Gmain.js*/

function initForm() {
  $('#dateBlock').html(new Date().shortFormat());
  starttime();
  $("#rateIsSent").val("no");
  $("#rtecmnt").css("display","none");
  $("#rateIsSent").css("display","none");
	var emptyStuffList = $(".FQNname");
	for (count=0; count < emptyStuffList.length; count++){
		if ($(emptyStuffList[count]).html()==""){
		  $(emptyStuffList[count]).html('noinfo');
		}
	}
 	if (sessionStorage.userRef){
		$("#editDetails").css("display", "inline");
	}else {
		$("#editDetails").css("display", "none");
	}
}
function handleFileSelect(evt) {
	var files = evt.target.files; 
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
				$('#imageSpan').html('<img class="thumbpic" src="'+ e.target.result + '" title="'+ escape(theFile.name)+ '" onclick="showOps(this)" /\>');
			};
		})(f);
		reader.readAsDataURL(f);
		}
		$('#newtagslist').html("");
}
 function show_oDD(that){
 	var theValue = that.parentNode.lastChild.innerHTML;
  $(".oDHClass").css("color","black");
  $("#oDDOutput").html(theValue);
  that.style.color = "green";
}

 function showRating(){
 var isSent = $("#rateIsSent").val();
 if (isSent == "yes"){
 	var ratetext = "<p>You can only vote once</p>";
 		$("#rtecmnt").html(ratetext);
 		$("#rtecmnt").fadeIn();
 		
 	}else {
 	$("#ratebut").css("display","none");
 	$("#ratingsBlock").slideDown("slow");
 	}
 	
 }
 	
 	
 	
 
 function cancelVote() {
 $("#ratingsBlock").slideUp();
 $("#ratebut").fadeIn();
 $("#commentBlock").fadeOut();
 }
 
 function submitVote(){
	var scoreA = document.getElementsByName("score");
	var rating = "";
	var recNumber = $("#recID").val();
	var conRef = $("#conRef").val();
	var theCat = $("#thecat").val();
	var curScore = $("#currScore").val();
	if (!curScore){
		curScore = 0;
	}
	//var curScore = 50;
	for (i=0;i<scoreA.length;i++){
		currentScore = scoreA[i];
		if(currentScore.checked){
		rating = currentScore.value;
		
		}
	}
	if (rating<3){
		$("#commentBlock").fadeIn();
	}else{
	$("#commentBlock").hide();
	}
	
	var newScore = eval("parseInt(curScore) + parseInt(rating)");
	var respScore = "";
	//alert(rating+"\n"+ recNumber+"\n"+conRef+"\n"+theCat+"\n"+ newScore);
	$.ajax({
		url : '../../cgi-bin/IBISvotes.php3',
		type : "post",
		data :{name1:rating,name2:recNumber,name3:conRef,name4:theCat},
		success : function(data){
		//alert(data);
		var response = data.split(":");
		respScore = response[1];
		var recID = response[0];
		$("#rcID").val(recID);
		$("#rateIsSent").val("yes");
		$("#currScore").html(respScore);
		}
	});
	$("#ratingsBlock").slideUp();
	$("#ratebut").val("rating sent");
 $("#ratebut").fadeIn();
	
}

function dismissNote(){
 $("#commentBlock").hide();
}

function updateDetails() {
/*
var theForm = $("#regPic").val();

$.ajax({
		url : '../../cgi-bin/IBISupdContrib.php3',
		type : "post",
		data :{name1:theForm},
		success : function(data){
		
		alert(data);
		}
	});

*/

}

function loadRegWin(){
	theUser = $("#userRef").val();
	var regWin = open('../../cgi-bin/IBISregDetails.php3/?userN='+theUser+'', 'RegWin', 'height=720, width=580');
	
}

function closeRegWin(){
	regWin.close;
	$('#closewin').hide();
}

function submitNote(){
	var conRef = $("#conRef").val();
	var noteCont = $("#edNotes").val();
	var rcid = $("#rcID").val();
	var sucText = "";
	
	$.ajax({
		url : "../../cgi-bin/IBIScomments.php3",
	type : "post",
	data : {name1:conRef,name2:noteCont,name3:rcid},
	success : function(data2){
		//alert(data2);
	//sucText = "<p>Youre comment has been saved</p>";
	}
	});
	$("#commentBlock").hide();
	$("#commentBlock").html("<p>Your comment has been saved</p>");
	$("#commentBlock").show();
}

function handleFileSelecting(that) {
  	 IC  = $('#ICval').val();
  	 var butVal = that.name;
  	 butVal = butVal[butVal.length-1];
		var files = that.files; 
		for (var i = 0, f; f = files[i]; i++) {
	  	if (!f.type.match('image.*')) {
	 	 	continue;
	 	}
	 	var reader = new FileReader();
		reader.onload = (function(theFile) {
	  return function(e) {
		$("#glosspic" + butVal).html('<img class="thumbpic" src="'+ e.target.result + '" title="'+ escape(theFile.name)+ '" width="" height="" /\>');	
		$("#picRef" + butVal).val(theFile.name);
	  };
	})(f);
	reader.readAsDataURL(f);
  }
}

function getNames(that){
	var thisName = that.title;
	var catvalue = $('#catval').val();
	var aname = thisName.split("\n");
	var justName = aname[0];
	var MetricD = aname[1];
	var picSrc = that.src;
	var theDetails = "";
	if (catvalue == "animal" || catvalue == "vegetable"){
		specLabel = "Species:";
		genLabel = "Genus:";
		comLabel = "Common Names:";
	}
	if (catvalue == "mineral"){
		specLabel = "Group:";
		genLabel = "Name:";
		comLabel = "Chemical Formula:";
	
	}
$.ajax({
	url : "../../cgi-bin/IBISgetNames.php3",
	type : "POST",
	data : {name1:justName, name2: catvalue},
	success : function(response){
		//alert(response);
		var responseL = response.split(":");
		var gen = responseL[0];
		var spec = responseL[1];
		var Cnames = responseL[2];
		theDetails = "<div id=\"detailsBlock\"><img src="+picSrc+" /></br><label class=\"labelC\">"+genLabel+" </label><label class=\"contentC\">"+gen+"</label></br><label class=\"labelC\">"+specLabel+" </label><label class=\"contentC\">"+spec+"</label></br><label class=\"labelC\">"+comLabel+" </label><label class=\"contentC\">"+Cnames+"</label></br><label class=\"labelC\">Metric: </label><label class=\"contentC\">"+MetricD+"</label></div>";
	$('#listDiv').html(theDetails);
	}
	
})


}
