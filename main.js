/* main.js*/

function checkStorage(){
	  if (sessionStorage.userRef) {
	  $("#adminBlock").hide();
	  var sesRef = sessionStorage.userRef.split(" :: ");
	   $("#adminBlock").html("<div id=\"regholder\"><div id=\"regpic\"></div><div id=\"greetingDiv\"></div><div id=\"greetA\" ><label id=\"proLab\" class=\"label-info\" onclick=\"goPro("+sesRef[0]+")\" >Your profile page</label></div></div>");
	  imgsrc = '<img id = "regPic" src="'+ sesRef[5] + '" width="" height="" >';
	  $("#regpic").html(imgsrc);
	   if (sesRef[1] == "Author"){
	   	var authlist = '<li onclick="authVerify()" class="inputclass" ><span id="authDiv" class="linksclass" onclick="authVerify()" >Administration</span></li>';
	   $("#linkslistL").append(authlist);
	   $("#authDiv").show();
	   }
	   $("#dicDiv").hide();
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
			    <a href=\"cgi-bin/IBISnewGuest.php\" class=\"littleDD linksclass\">GuestBook</a>\
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
	showDisc();
 
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

function showDisc(){
var disText = '<span id="cls" onclick="closeDic()" class="linkC">X</span><span class="labelclass">---Disclaimer---</span><br /><br />\
Hi, My name is Ivan D Adams.<br />\
I wrote the IBIS as an exercise to practice HTML, CSS, JavaScript, PHP, MySQL and git. \
It has grown into a sort of functional kludge and I have many ideas for extending and refining it.\
This system as it is, is meant to be a sort of pokedex for nature where you can quickly get information on natural stuff.<br />\
I only had Firefox on a LAMP stack to work on so I have no idea what these interfaces are going to look like if you are not using a relatively recent version of Firefox or similar browser.<br />\
Besides that, you will need to have JavaScript and Cookies enabled on your browser for everything to work right.<br />\
I have placed it on the internet to see if it might be usefull to the world. <br />\
To that effect I humbly request your constructive criticism and ideas for improvement.<br />\
You may leave a note in the Guest Book facility, which will be visible to anyone accessing that utility, or you may leave a private message to the author from the Eco Links list.<br />\
You may also register as a Contributer, which will allow you to add and edit entries in the database.<br />\
We don\'t have strict security protocols, heck you don\'t even have to submit a legitimate email address when you register. However submiting a fake address will sort of cramp effective communication.<br />\
There are some checks for inappropriate language and conduct however, so if you register and submit nonsense your account will summarily be deactivated. \
';

	if(!readCookie("discCookie") ){
		$("#dicDiv").html(disText);
		$("#dicDiv").fadeIn();
		writeCookie("discCookie=", "yes", 1);
		$("#loginLink").hide();
	} 
	else {
		$("#dicDiv").hide();
	}
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
	url : "cgi-bin/IBIScomments.php",
	method : "POST",
	data : {name1 : mssgContent, name2 : uemail },
	success : function(data) {
		$("#errorDiv").html(data);
		$("#errorDiv").show();
		$("#errorDiv").fadeOut(4000);
	} 
});
}
