function showLogin(){
    $("#loginLink").addClass("loginshow");
    $("#login").css("display", "block");
    $("#uname").val("");
    $("#uemail").val("");
}

function do_logout(){
  $("#greetingDiv").text("");
  $("#loginhead").css("display", "block");
  $("#logouthead").css("display", "none");
  $("#regPic").css("display","none");
 // $("#registerBlock").removeClass("locked").addClass("adminC");
 $("#adminBlock").hide();
  $("#adminBlock").html("<div id=\"registerBlock\" class=\"littleDD linksclass adminC \">\
			    <a href=\"IBISregistration.html\" class=\"littleDD linksclass\">Register as a contributer</a>\
			  </div>\
			  <div id=\"guestBook\" class=\"littleDD linksclass\">\
			    <a href=\"../../cgi-bin/IBISnewGuest.php3\" class=\"littleDD linksclass\">The GuestBook</a>\
			  </div>");
	$("#adminBlock").fadeIn();
  sessionStorage.userRef = "";
  
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
	//  alert(data);
	      var testregexp = /no match/;
	      if (testregexp.test(data)) {
	        $("#errorDiv").html("<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><span id=\"messSpan\">Your details were not found on the server</span>\"");
	        showLogin();
	      }
	      else {
	        var thedata = data.split(":");
	        sessionStorage.userRef = thedata[0] + " : " + thedata[1] + " : " +thedata[2] + " : " + thedata[3] + " : " + thedata[4]+" : "+thedata[5];
	        imgsrc = '<img id = "regPic" src="'+ thedata[5] + '" width="" height="" >';
	        //alert(imgsrc);
	        $("#greetingDiv").text("Hello " + thedata[1]);
	        if (sessionStorage.userRef){
	          var sessref = sessionStorage.userRef;
	          $("#adminBlock").hide();
	          $("#adminBlock").html("<div id=\"welcBlock\" style=\"\>\
	      	<div id=\"regholder\">\
	    		<div id=\"regpic\"></div>\
	    		<div id=\"greetingDiv\"></div>\
	    		<div id=\"\"><a href=\"../../cgi-bin/IBISprofile.php3/?userN="+thedata[0]+"\">Go to your profile page</a></br></div>\
	   		</div></div>");
	   		$("#regpic").html(imgsrc);
	          $("#greetingDiv").text("Hello " + thedata[1]);
	          $("#adminBlock").fadeIn();
	         // $("#registerBlock a").removeAttr("href")  ;
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
}

