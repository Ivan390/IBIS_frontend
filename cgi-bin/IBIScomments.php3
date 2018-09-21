<?php
$mssg = htmlentities(quotemeta($_POST['name1']));
$uemail = htmlentities(quotemeta($_POST['name2']));
$comID = 0;
$uploadDate = date('Y-m-d H:i:s');
$senderua = $_SERVER['HTTP_USER_AGENT'];
$senderRef = $_SERVER['REMOTE_ADDR'];
include ("IBISvars.inc");
 	if (!$guest_acc){
  		print "the include file was not included <br>";
 	}
  	$mysqli = new mysqli('localhost', "author", "silverfish95", 'IBIS');
 	if ($mysqli->connect_error){
    	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  	}
  	$stmnt1 = $mysqli->prepare("INSERT into AuthNotes (AuthNoteID, noteText, senderEmail, senderUA, noteDate, senderRef) VALUES (?,?,?,?,?,?)") or die ("cant prepare statement1". $mysqli->error);
  	$stmnt1->bind_param("ssssss",$comID,$mssg,$uemail,$senderua, $uploadDate,$senderRef ) or die ("could not bind parameters");
  	$stmnt1->execute();
  	$stmnt1->fetch();
  	$stmnt1->close();
  if ($stmnt1->affected_rows == -1){
  $messg = "record was not written";
  }else{
  $messg = "record was written successfully";
  }
 
  print "$messg";
?>
