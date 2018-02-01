/* main.js*/

function checkStorage(){
	  if (sessionStorage.userRef) {
	  $("#adminBlock").hide();
	  var sesRef = sessionStorage.userRef.split(" :: ");
	   $("#adminBlock").html("<div id=\"welcBlock\" style=\"\>\
	      	<div id=\"regholder\">\
	    		<div id=\"regpic\"></div>\
	    		<div id=\"greetingDiv\"></div>\
	    		<div id=\"\"><a href=\"../../cgi-bin/IBISprofile.php3/?userN="+sesRef[0]+"\">Go to your profile page</a></br></div>\
	   		</div></div>");
	  imgsrc = '<img id = "regPic" src="'+ sesRef[5] + '" width="" height="" >';
	  $("#regpic").html(imgsrc);
	  $("#greetingDiv").text("Hello " + sesRef[1]);
	  $("#adminBlock").show();
	  $("#loginhead").css("display", "none");
	  $("#logouthead").css("display", "block");
	  $("#registerBlock").addClass("locked");
	  }else {
        $("#loginhead").css("display", "block");
	    $("#logouthead").css("display", "none");
	    $("#adminBlock").html("<div id=\"registerBlock\" class=\"littleDD linksclass adminC \">\
			    <a href=\"IBISregistration.html\" class=\"littleDD linksclass\">Register as a contributer</a>\
			  	</div>\
			  	<div id=\"guestBook\" class=\"littleDD linksclass\">\
			    <a href=\"../../cgi-bin/IBISnewGuest.php3\" class=\"littleDD linksclass\">The GuestBook</a>\
			  	</div>");
	  }
}
function initForm() {
  $("#dateBlock").html(new Date().shortFormat());
  starttime();
  picswaps();
  checkStorage();
	checkNav();
}

