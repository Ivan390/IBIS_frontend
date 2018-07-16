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
	  }else {
        $("#loginhead").css("display", "block");
	    $("#logouthead").css("display", "none");
	    $("#adminBlock").html("<span id=\"register\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"IBISregistration.html\" class=\"linksclass\">Register</a>\
			  	</span>\
			  	<span id=\"guestbook\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"../../cgi-bin/IBISnewGuest.php3\" class=\"littleDD linksclass\">GuestBook</a>\
			  	</span>");
	  }
}
function goPro(refNum) {
	$("#usrRef").val(refNum);
	document.proForm.submit();
	
}

function initForm() {
  $("#dateBlock").html(new Date().shortFormat());
  starttime();
  picswaps();
  checkStorage();
	checkNav();
}

