/* main.js*/

function checkStorage(){
	  if (sessionStorage.userRef) {
	  $("#adminBlock").hide();
	  var sesRef = sessionStorage.userRef.split(" :: ");
	   $("#adminBlock").html("<div id=\"regholder\"><div id=\"regpic\"></div><div id=\"greetingDiv\"></div><div id=\"greetA\" ><label id=\"proLab\" class=\"label-info\" onclick=\"goPro("+sesRef[0]+")\" >Your profile page</label></div></div>");
	  imgsrc = '<img id = "regPic" src="'+ sesRef[5] + '" width="" height="" >';
	  $("#regpic").html(imgsrc);
	  $("#greetingDiv").text(sesRef[1]);
	  $("#adminBlock").show();
	  $("#loginhead").css("display", "none");
	  $("#logouthead").css("display", "block");
	  $("#registerBlock").addClass("locked");
	  if (sesRef[1] == "Author"){
	  	$("#authDiv").show();
	  
	  }
	  }else {
        $("#loginhead").css("display", "block");
	    $("#logouthead").css("display", "none");
	    $("#adminBlock").html("<span id=\"register\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"IBISregistration.html\" class=\"linksclass\">Register</a>\
			  	</span>\
			  	<span id=\"guestbook\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"../../cgi-bin/IBISnewGuest.php3\" class=\"littleDD linksclass\">GuestBook</a>\
			    </span>");	  }
}
function goPro(refNum) {
	$("#usrRef").val(refNum);
	document.proForm.submit();
	
}

function initForm() {
  $("#dateBlock").html(new Date().shortFormat());
  starttime();
  picswaps();
  $("#authDiv").hide();
  checkStorage();
	checkNav();
 
}

function showMssgDialog(){
var mssgDlg = '<span id="mssgDlg"><label onclick="closethis()" class="linkC">X</label><br />\
<textarea id="mssgContent" placeholder="Enter your message here"></textarea><br />\
<input type="text" value="" class="inputclass" id="Uemail" placeholder="Enter your email here" /> <br />\
<input type="button" class="buttonclass" value="Send It" onclick="sendMssg()"></span>';
$("#errorDiv").html(mssgDlg);
$("#errorDiv").show();
$("#mssgContent").focus();
}

function sendMssg(){
var mssgContent = $("#mssgContent").val();
	if (mssgContent == ""){
		alert("Can't send empty message");
		e.preventDefault();
	}
var uemail = $("#Uemail").val();
$("#errorDiv").hide();
$.ajax({
	url : "../../cgi-bin/IBIScomments.php3",
	method : "POST",
	data : {name1 : mssgContent, name2 : uemail },
	success : function(data) {
		$("#errorDiv").html(data);
		$("#errorDiv").show();
		$("#errorDiv").fadeOut(4000);
	} 
});
}
