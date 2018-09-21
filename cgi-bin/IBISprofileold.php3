<?php
$htmlHead = '<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
      <title> Details</title>
      <script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>      <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
      <script type="text/javascript" src="http://192.168.43.132/ibis/Gmain.js"></script>
	    <script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"></script>
      <link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
      <link href="http://192.168.43.132/ibis/jquery.dm-uploader.min.css" rel="stylesheet">
      <link rel="stylesheet"
        type="text/css"
        href="http://192.168.43.132/ibis/IBIS_maincss.css"
    />
    <link rel="stylesheet" 
    	type="text/css" 
    	media="only screen and (max-width: 480px)" 
    	href="http://192.168.43.132/ibis/Sprof.css" 
    	/>
      <script type="text/javascript">
			$(document).ready(function(){
		      	$("#mediaPic").change(handleFileSelect);	
		  		if (sessionStorage.userRef){
		        	sessVar = sessionStorage.userRef;
			 		sesA = sessVar.split("::");
			  		conID = sesA[0];
			  		$(\'#contrib_ID\').val(conID);
		  		}else {
					alert("You should really not be on this page!")
					document.location = "IBISmain.html";
		  		}
        	}); 
        
			
			function updateDetails(){
				
			}
       </script>
    </head> 
    <body onload=initForm()>
	    <div id="DETallContainer" class="ac container">
        <div class="row">
		    	<div id="dateTime">
		 				<div id="dateBlock">The Date</div>
		 				<div id="timeBlock">The Time</div>
		 				<div id="logo_image_holder">
							<img id="logo_image" src="http://192.168.43.132/ibis/images/Logo1_smaller.png"/>
						</div>
					
		    </div>  
		    </div> 
		    <div id="pgButtons" class="row">
		     	<a href="http://192.168.43.132/ibis/IBISmain.html" class="linkC">Main</a>
        </div>';

$htmlClose = '</body><html>';	
$userName = $_POST['userN'];
if (!$userName){
$userName = $_GET['userN'];
 }
$userName = trim($userName);
include ("IBISvars.inc");
if (!$guest_acc){
	print("some thing went wrong. IBISvars missing");
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS' );
if ($mysqli->connect_error){
	die('Connect Error ('.$mysqli->connect_errno.')' ."Database connect error, check your connection or try again later");
}

$stmnt1 = $mysqli->prepare("select name, lastname, userName, Media.serverpath, regDate, email from Contributers, Media where Contributers.ContribID = \"$userName\" and Contributers.mediaRef = Media.filename") or die ("could not prepare statement " . $mysqli->error);
$stmnt1->bind_result($fName, $lName, $username, $mediapath, $regDate, $emailA );     
$stmnt1->execute();
$stmnt1->fetch() ;
$stmnt1->close();
$Qtotal = 0;
$stmnt2 = $mysqli->prepare("select sum(Vegetables.score) from Vegetables where contribRef = \"$userName\" union select sum(Animals.score)  from Animals where contribRef = \"$userName\" union select sum(Minerals.score) from Minerals where contribRef = \"$userName\"") or die ("could not prepare statement " . $mysqli->error); 
$stmnt2->bind_result($Qresult);
$stmnt2->execute();
while ($stmnt2->fetch()){
	$Qtotal = $Qtotal + $Qresult;
}
$stmnt2->close();
$contribScore = $Qtotal;
$mediapath = str_replace("$imagesfroot", "$imageshroot", $mediapath);
$mediapath = str_replace("$imagesdroot", "$imageshroot", $mediapath);
$mediapath = str_replace("$imagesNotebookroot","$imageshroot", $mediapath);
$adminDiv = "<div id=\"adminDiv\"><input type=\"button\" value=\"Edit your details\" onclick=\"loadRegWin()\" /><input type=\"button\" value=\"Dismiss\" onclick=\"closeRegWin()\" style=\"display:none;\" id=\"closewin\" /></div>";
$infoDiv = "<div id=\"informDiv\">
<span id=\"nameSpan\">$fName $lName </span></br><span id=\"imageSpan\"><img src=\"$mediapath\" class=\"optImage\"/></span><p>Your current score is</p><span id=\"scoreSpan\">$contribScore</span><input type=\"text\" name=\"userName\" value=\"$userName\" class=\"hiddentext\" id=\"userRef\"/>";

$edUserDiv = '<div id="edUser" class="hiddentext">

</div>';

print("$htmlHead $infoDiv $adminDiv $htmlClose");
?>
