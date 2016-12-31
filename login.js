function showLogin(){
    $("#loginLink").addClass("loginshow");
    $("#login").css("display", "block");
}

function do_logout(){
  $("#greetingDiv").text("");
  $("#loginhead").css("display", "block");
  $("#logouthead").css("display", "none");
  $("#regPic").css("display","none");
 // $("#registerBlock").removeClass("locked").addClass("adminC");
  $("#registerBlock").html("<a href=\"IBIS_Registration.html\" class=\"littleDD linksclass\">Register as a contributer</a>");
  sessionStorage.userRef = "";
}

function submitDetails(){
    $("#login").css("display", "none");
    $("#loginhead").text("one moment please...");
    var value1 = $("#uname").val();
    var value2 = $("#uemail").val();
    $.ajax({
	    url : '../../cgi-bin/login.php3',
	    type : "get",
	    async : "false",
	    data : {uName : value1, uEmail : value2},
	    success : function(data) {
	//  alert(data);
	      var testregexp = /no match/;
	      if (testregexp.test(data)) {
	        $("#errorDiv").text("Your details were not found on the server");
	        showLogin();
	      }
	      else {
	        var thedata = data.split(" : ");
	        $("#greetingDiv").text("Hello " + thedata[0]);
	        sessionStorage.userRef = thedata[1] + " : " + thedata[2] + " : " + thedata[3];
	        imgsrc = '<img id = "regPic" src="'+ thedata[4] + '" width="" height="" >';
	        //alert(imgsrc);
	        if (sessionStorage.userRef){
	          var sessref = sessionStorage.userRef;
	          $("#regpic").html(imgsrc);
	          $("#greetingDiv").text("Hello " + thedata[0]);
	          $("#registerBlock").addClass("locked");
	          $("#registerBlock a").removeAttr("href")  ;
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

