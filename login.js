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
	$("#authDiv").hide();
 	var loCount = 0;
 	$.ajax({
		url : "cgi-bin/IBISLogout.php",		type : "POST",		data : {name1 : logID},
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
  $("#adminBlock").html("<span id=\"register\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"IBISregistration.html\" class=\" linksclass\">Register</a>\
			  </span>\
			  <span id=\"guestbook\" class=\"col-xs-12 col-sm-12\">\
			    <a href=\"cgi-bin/IBISnewGuest.php\" class=\" linksclass\">GuestBook</a>\			  </span>");	$("#adminBlock").fadeIn();
  sessionStorage.userRef = "";
  eraseCookie("IBIS_session=");
}

function submitDetails(){
    $("#login").css("display", "none");
    $("#loginhead").text("one moment please...");
    var value1 = $("#uname").val();
    var value2 = $("#uemail").val();
    $.ajax({
	    url : 'cgi-bin/IBISlogin.php',	    type : "get",	    async : "false",
	    data : {uName : value1, uEmail : value2},
	    success : function(data) {
	      var testregexp = /no match/;
	      if (testregexp.test(data)) {
	        $("#errorDiv").html("<label onclick=\"closethis()\" class=\"linkC\">X</label><br /><img id=\"sucCheck\" src=\"images/notokeydoke.png\" /><span id=\"messSpan\">Your details were not found on the server</br>Check your spelling</span>");
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
	          $("#adminBlock").html("<div id=\"regholder\"><div id=\"regpic\"></div><div id=\"greetingDiv\"></div><div id=\"greetA\" ><label id=\"proLab\" class=\"label-info\" onclick=\"goPro("+thedata[0]+")\" >Your profile page</label></div></div>");
	   				$("#regpic").html(imgsrc);
	          $("#greetingDiv").text(thedata[1]);
	          if (thedata[1] == "Author"){
	          	
	          	var authlist = '<li onclick="authVerify()" class="inputclass" ><span id="authDiv" class="linksclass" onclick="authVerify()" >Administration</span></li>';
	          	$("#authDiv").show();
	          	$("#linkslistL").append(authlist);
	          }
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
function goPro(refNum) {
	$("#usrRef").val(refNum);
	document.proForm.submit();
	
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
function authVerify(){
	var authDialog = '<span id="authverify">\
	<label class="labelclass">Enter verification code</label>\
	<input id="verInput" type="text" />\
	<input type="button" id="verifyI" value="Send" class="inputClass buttonclass " onclick="sendCode()">\
	</span>';
	$("#errorDiv").html(authDialog);
	$("#errorDiv").show();
	$("#verInput").focus();
}
function sendCode(){
	var verCode = $("#verInput").val();
	$.ajax({
		url : "cgi-bin/verify.php",
		method : "POST",
		data : {name1:verCode},
		success : function(data){
		 $("#errorDiv").html(data);
		}
	});
	
}
function closethis() {
	$("#errorDiv").hide();
}

function getName(){
	var nameDlg = '<span id=remindDlg><label onclick="closethis()" class="linkC">X</label><br />\
	<input type="text" id="email" placeholder="Enter your email address here" width="100%"/>\
	<input type="button" value="Send It" id="sendBbut" class="buttonclass" onclick="getSecQ()">\
	</span>';
	$("#errorDiv").html(nameDlg);
	$("#errorDiv").show();
	$("#email").focus();
}

function getSecQ(){
	var Uemail = $("#email").val();
	//$("#response").html("");
	$.ajax({
		url : "cgi-bin/getsecQ.php",
		method : "POST",
		data : {name1 : Uemail},
		success : function(data){
		
		$("#errorDiv").append(data);
		$("#secInput").focus();
		}
	});
}
function sendA(){
var respAnswer = $("#secInput").val();
var Uemail = $("#email").val();
//$("#response").html("");
$.ajax({
	url : "cgi-bin/getuName.php",
	method : "POST",
		data : {name1 : respAnswer, name2 : Uemail},
		success : function(data){
		
		$("#errorDiv").html(data);
		}
});
}

