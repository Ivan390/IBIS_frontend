<?php
include ("IBISvars.inc");
if (!$guest_acc){
  print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
  die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  }
$secA = trim($_POST['name1']);
$email = trim($_POST['name2']);
$stmnt1 = $mysqli->prepare("select userName, securityQ, securityA from Contributers where email = '$email'") or die ($mysqli->error);
if ($stmnt1->execute()){
  $stmnt1->bind_result($usrName, $secQ, $seca) or die ("cannot bind parameters.");
  $stmnt1->fetch();
  $stmnt1->close();
  } else {
  $messg = "<label onclick=\"closethis()\" class=\"linkC\">X</label>Database error";
  }
  if ($secA == $seca){
  	$messg = "<span id=\"UPresponse\"><label onclick=\"closethis()\" class=\"linkC\">X</label><label class=\"labelclass\">Your user name is <br />$usrName</label></span>";
   }else {
  	 $messg = "<span id=\"Uresponse\"><label onclick=\"closethis()\" class=\"linkC\">X</label ><label class=\"labelclass\">Incorrect Answer<br />Check your spelling or leave a message for the author containing the email address you used when you registered</label></span>";
  
  }
  print $messg;
?>
