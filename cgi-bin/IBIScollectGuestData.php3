<?php
$fileMessg ="no errors";
$fileError ="no errors";
$dataMessg ="no errors";
$dataError ="no errors";
$prefix = "guest";
$fileList ="";
$newName = "";
$thumbDir = "https://ivanadams95.000webhostapp.com/ibis/Data/Images/thumbails/";
include ("IBISvars.inc");

if (!$guest_acc){
	print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$guest_acc", "$guest_pass", 'IBIS');
if ($mysqli->connect_error){
   	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}

	 		include ("IBIScollectFunctions.php3");
		//	print "Data received....processing will follow <br>";
		$stmt3 = $mysqli->prepare("INSERT INTO Guestbook (Gcomment, entryDate, mediaRefs, Gname ) VALUES (?,?,?,?)") or die ( $mysqli->error);
		$stmt3->bind_param('ssss', $Gcomment, $entryDate, $mediaRefs, $gname);
		$gname = htmlentities(quotemeta(array_key_exists('gname',$_POST)?$_POST['gname']: null));
		$Gcomment = htmlentities(quotemeta(array_key_exists('Gcomment',$_POST)?$_POST['Gcomment']: null));
		$entryDate = $uploadDate; //date('Y-m-d H:i:s');
		$mediaRefs = $filename;
		$stmt3->execute();
		if ($stmt3->affected_rows == -1){
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><div id=\"messSpan\">Something went wrong please check your connection</div>";
		}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
		}
		$stmt3->close();		
			
$message = '<span id="closeBut" onclick="closethis()">X</span><div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div></div>';	
      
print "$message ";
?>



