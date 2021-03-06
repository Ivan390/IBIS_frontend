function showLogin(){
    $("#loginLink").addClass("loginshow");
    $("#login").css("display", "block");
    $("#uname").val("");
    $("#uemail").val("");
}

function do_logout(){
	if (!sessionStorage.userRef){
		var oldSes = readCookie("IBIS_session");
		sessionStorage.userRef = oldSes;
	}
	var uID = sessionStorage.userRef.split("::");
	var logID = uID[6];
  $("#greetingDiv").text("");
  $("#loginhead").css("display", "block");
  $("#logouthead").css("display", "none");
  $("#regPic").css("display","none");
	$("#adminBlock").hide();
 	var loCount = 0;
 	$.ajax({
		url : "../../cgi-bin/IBISLogout.php3",
		type : "POST",
		data : {name1 : logID},
		success : function(data){
		if (data !== ""){
			loCount = readCookie("loCount");
			if (isNaN(loCount)){
			 loCount = 0;
			}
			loCount = parseInt(loCount) + 1;
			writeCookie("loCount=", loCount, 365);
		}
			alert("Goodbye" + uID[1] );
		}
	});
  $("#adminBlock").html("<div id=\"registerBlock\" class=\"littleDD linksclass adminC \">\
			    <a href=\"IBISregistration.html\" class=\"littleDD linksclass\">Register as a contributer</a>\
			  </div>\
			  <div id=\"guestBook\" class=\"littleDD linksclass\">\
			    <a href=\"../../cgi-bin/IBISnewGuest.php3\" class=\"littleDD linksclass\">The GuestBook</a>\
			  </div>");
	$("#adminBlock").fadeIn();
  sessionStorage.userRef = "";
  eraseCookie("IBIS_session=");
}

function submitDetails(){
    $("#login").css("display", "none");
    $("#loginhead").text("one moment please...");
    var value1 = $("#uname").val();
    var value2 = $("#uemail").val();
    $.ajax({
	    url : '../../cgi-bin/IBISlogin.php3',
	    type : "get",
	    async : "false",
	    data : {uName : value1, uEmail : value2},
	    success : function(data) {
	      var testregexp = /no match/;
	      if (testregexp.test(data)) {
	        $("#errorDiv").html("<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><span id=\"messSpan\">Your details were not found on the server</br>Check your spelling</span>");
	        $('#errorDiv').show();
	        showLogin();
	      }
	      else {
	        var thedata = data.split("::");
	        sessionStorage.userRef = thedata[0] + " :: " + thedata[1] + " :: " +thedata[2] + " :: " + thedata[3] + " :: " + thedata[4]+" :: "+thedata[5]+" :: "+thedata[6];
	        imgsrc = '<img id = "regPic" src="'+ thedata[5] + '" width="" height="" >';
	        $("#greetingDiv").text("Hello " + thedata[1]);
	        if (sessionStorage.userRef){
	          var sessref = sessionStorage.userRef;
	          $("#adminBlock").hide();
	          $("#adminBlock").html("<div id=\"welcBlock\" style=\"\>\
	      	<div id=\"regholder\">\
	    		<div id=\"regpic\"></div>\
	    		<div id=\"greetingDiv\"></div>\
	    		<div id=\"\"><a href=\"../../cgi-bin/IBISprofile.php3/?userN="+thedata[0]+"\">Go to your profile?</a></br></div></div></div>");
	   				$("#regpic").html(imgsrc);
	          $("#greetingDiv").text("Hello " + thedata[1]);
	          $("#adminBlock").fadeIn();
			      writeCookie("IBIS_session=", sessref, 1);
	       		if(readCookie("IBIS_session")){
	       			//alert("Cookie was not set");
	       		}else {
	       			//	alert("cookie was set");
	       		}
	        }
	        $("#errorDiv").text("");
	        cancelLogin();
	        $("#loginhead").css("display", "none");
	        $("#logouthead").css("display", "block");
	      } 
	    }
    });
}

function input_checker(){
    //check inputs for valid data
    var userName = $("#uname").val();
    var userEmail = $("#uemail").val();
    if (userName == "" || userEmail == ""){
      alert("missing values");
      showLogin();
    }if (userName.length < 3 || userEmail.length < 4 ){
      alert("You have entered too few characters");
      showLogin();
    }else {
      submitDetails();
    }
}

function cancelLogin() {
  $("#loginLink").removeClass("loginshow");
  $("#login").css("display", "none");
  $("#loginhead").text("Login");
  $("#errorDiv").text(" ");
  $('#errorDiv').hide();
}

function checkNav(){
	if (navigator.cookieEnabled){
		if (sessionStorage.userRef ){
			//alert("session ref exists will do nothing");
		}else {
			//alert("session ref is not set, should check cookies here");
			if(readCookie("IBIS_session")){
				var messg= "<p>A previous unclosed session has been detected</br>click on Continue to continue with that session or Cancel to start a new one<div id=\"errButtons\" ><input type=\"button\" value=\"Continue\" onclick=\"contSes()\" /><input type=\"button\" value=\"Cancel\" onclick=\"newSes()\" /></div></p>";
				$('#errorDiv').html(messg);
				$('#errorDiv').show();
		 }else {
     }
		}
	  }else {
			alert ("cookies appear to not be enabled");
   	}	
 }
 
function contSes(){
	$('#errorDiv').hide();
	var oldSes = readCookie("IBIS_session");
	sessionStorage.userRef = oldSes;
	checkStorage();
}

function newSes(){
$('#errorDiv').hide();
	cancelLogin();
	do_logout();
}

