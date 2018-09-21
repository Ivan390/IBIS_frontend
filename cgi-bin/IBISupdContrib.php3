<?php
if ($_FILES['file']){
	include ("IBISvars.inc");
	if (!$guest_acc){
		print "the include file was not included <br>";
	}
	$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
	if ($mysqli->connect_error){
		die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
	}
	$contID = trim($_POST['contID']); 
	$cleanname = str_replace("$space", "$underscore", $name);
	$securityA = trim($_POST['secA']);
	$username = trim($_POST['userN']);
	$prefix = "reg";
	$uploadDate =  date('Y-m-d H:i:s');
	$messg = "";
	$email = trim($_POST['email']);
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if(!$tmpFilePath){$fileList = $_POST['medRef'];}else {
			include ("IBIScollectFunctions.php3");
	}
			
	$space = ' ';
	$undescore = '_';
	$role = "c";
	$email = $_POST['email']; 
	$fileList = str_replace(":","",$fileList); 
	$mediaRef = $fileList;
	$regDate = $uploadDate;
	$securityQ = $_POST['secQ'];
	$passwd = trim($_POST['pssWD']);
	$stmt3 = $mysqli->prepare("UPDATE Contributers SET role='$role' , email='$email' , mediaRef='$mediaRef' , regDate='$regDate' , securityQ='$securityQ' , securityA='$securityA' , userName='$username' , passwrd='$passwd' WHERE ContribID='$contID'") or die ("cant prepare statement 3".$mysqli->error);
	$stmt3->execute();
	if ($stmt3->affected_rows == -1){
		$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><span id=\"messSpan\">Something went wrong please check your connection</span>";
		}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><span id=\"messSpan\">Data upload successful<br />Your updated details will be activated the next time you log in.</span>";
		}
	$stmt3->close();
	$htmlhead = '<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="content-type" content="text/xml; charset=utf8" />
  		<title>IBIS Registration Confirmation</title>
		<script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>
		 <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
		<script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"></script>
		<script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"> </script>

    <link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
  		<link rel="stylesheet"
        type="text/css"
        href="http://192.168.43.132/ibis/IBIS_maincss.css"
      />
	</head>
 	<body id="TheBody" onload="starttime()">
		<div id="allContainer" class="container">
		<div class="row">
      		<div id="dateTime">
					  <div id="dateBlock">The Date</div>
					  <div id="timeBlock">The Time</div>       
			  	</div>
      		<div id="logo_image_holder">
					  <img id="logo_image" src="http://192.168.43.132/ibis/images/Logo1_smaller.png"/>
					</div>
      </div>';
	$pgbuts ='<br /><div id="pgButtons">
		<a href="http://192.168.43.132/ibis/IBISmain.html">Back to Main</a>
			<a href="../../cgi-bin/IBISprofile.php3?userN='.$contID.'">Back to Profile</a>
		</div>
		<div id="respons">'.$message.'<span>
		
		</span></div>
 			';
	$htmlFoot ='</div></div></body></html>';
	print "$message". "$pgbuts";
}else{
	print "no upload variable found";
}

?>
