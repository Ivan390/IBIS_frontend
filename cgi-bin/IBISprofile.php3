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
	    <script type="text/javascript" src="http://192.168.43.132/ibis/fileselect.js"></script>
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

$adminDiv = '<div id="adminDiv"><input type="button" value="Edit your details" onclick="loadRegWin()" />
</div><div id="edUser" class="">';

$infoDiv = '<div id="informDiv">
<span id="nameSpan">'.$fName.' '. $lName.' </span></br><span id="imageSpan"><img src="'.$mediapath.'" class="optImage"/></span><p>Your current score is</p><span id="scoreSpan">'.$contribScore.'</span><input type="text" name="userName" value="'.$userName.'" class="hiddentext" id="userRef"/>';

$stmnt3 = $mysqli->prepare("select ContribID, name, lastname, email, securityQ, securityA, mediaRef,username,  passwrd,  serverpath from Contributers, Media where ContribID = \"$userName\" and Contributers.mediaRef = Media.filename")or die ("could not prepare data ". $mysqli->error);
$stmnt3->bind_result($contID, $firstName, $Lastname, $Email, $secQ, $secA, $medRef,$uName,$passWd, $imgP) or die ("could not bind data ". $mysqli->error);
$stmnt3->execute()or die ("could not execute data ". $mysqli->error);
$stmnt3->fetch()or die ("could not fetch data ". $mysqli->error);
$stmnt3->close();
$datapart ='
<div id="allContainer">
	<div id="lookupdiv" ></div>
  <div id="Heading">
	  <p id="regheadingText">Edit Login Details</p>
	</div>
	<div id="subContain">
		<form name="udateContrib" action="../../cgi-bin/IBISupdContrib.php3" method="POST" enctype="multipart/form-data">
			<fieldset id="edDetails" class="littleDD">
				<div id="personalDetails" class="littleDD">
					<p> 
						<label class="labelClass" class="requiredf" >Edit email address</label>
						<input type="text" name="email" class="inputClass littleDD requiredf" value="'.$Email.'" id="Uemail"/>
					</p>
				</div>
				<div id=imgDisplay1 class="">
				<div id=imgDisplay class=""></div>
					<label class="labelClass">Change your profile picture</label>
					<div class="row">
        <div class="col-md-6 col-sm-12">
					<div id="drag-and-drop-zone" class="dm-uploader p-5">
              <div class="btn btn-primary btn-block mb-5">
                <span>File Browser</span>
                <input id="mediaPic" type="file"  title="Click to add Files" onchange="handleFileSelect()" />
            </div>
          </div>
          
        </div>
       
        <div class="col-md-6 col-sm-12">
          <div class="card h-100">
            <div class="card-header">
              File List
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
        </div>
      </div>

				</div>	
				<div id="securityInfo" class="bigDD">
					<p>
						<label class="labelClass ">Select a question and enter an answer in the space below.</label>
					</p>
					<p>
						<select id = "secQ" name="secQ" class="labelClass littleDD selectClass" >';
$optList = ["favColor", "favFood", "uncName", "petName"];
$listOpt = "";
foreach ($optList as $optVal){
	if ($optVal == "favColor"){$optText = "What is your favourite colour?";}
	if ($optVal == "favFood"){$optText = "What is your favourite food?";}
	if ($optVal == "uncName"){$optText = "What is the name of your favourite uncle?";}
	if ($optVal == "petName"){$optText = "What is the name of your favourite pet?";}
	if ($optVal == $secQ){
		$listOpt .="<option value = \"$optVal\" selected=\"selected\">$optText</option>";
		continue;
	}	
	$listOpt .= "<option value = \"$optVal\">$optText</option>";
}			
$selList = $listOpt;
$restHTML='	
	</select></br>
	<input type="text" name="secA" id="secA" class="labelClass littleDD" value="'.$secA.'" />
	</p>	
	</div><div id="regbuttons" class="row">
		<input type="button" value="Submit" onclick="updateDetails()" id="updBut" />
		<input type="button" value="X" onclick="closeRegWin()" id="closewin" class="linkC"/>
	</div>
	<input type="text" id="pssWD" name="pssWD" class="hiddentext" value="'.$passWd.'" />
	<input type="text" id="userName" name="userN" class="hiddentext" value="'.$uName.'" />
	<input type="text" id="contID" name="contID" class="hiddentext" value="'.$contID.'"/>
	<input type="text" id="medref" name="medRef" class="hiddentext" value="'.$medRef.'" />
	<input type="text" id="kingdom" name="kingdom" value="Register" class="hiddentext" >
</fieldset>
';
$endHTML = '</div>
			</form></div><div id="ajaxBox"></div>
    	<script type="text/javascript" src="http://192.168.43.132/ibis/jquery.dm-uploader.min.js"></script>
    	 <script type="text/javascript" src="http://192.168.43.132/ibis/profAsyncUpload.js"></script>
    	 <script type="text/javascript" src="http://192.168.43.132/ibis/demo-ui.js"></script>
    	  <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script></body>
			<script type="text/javascript">
				function clWin(){
				$("#edUser").fadeOut();
			}
			function updateDetails(){
				sendit();
				$("#edUser").fadeOut();
				//alert("reload the page to see your new details");
				
			}
		
			</script>
	</html>';						
$eduserDiv = "$datapart"."$selList"."$restHTML";
						
print("$htmlHead $infoDiv $adminDiv $eduserDiv $endHTML");
?>
