<?php
include ("IBISvars.inc");
if (!$guest_acc){
  print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
  die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  }
$email = trim($_POST['name1']);

$stmnt1 = $mysqli->prepare("select securityQ from Contributers where email = '$email'") or die ($mysqli->error);
if ($stmnt1->execute()){
  $stmnt1->bind_result($secQ) or die ("cannot bind parameters.");
  $stmnt1->fetch();
  $stmnt1->close();
  } else {
  $messg = "Database error";
  }
  if (!$secQ){
  $messg = "<br /><span id=\"response\">Your email was not found in this database</span>";
  }else {
  	if ($secQ == "favColor"){$optText = "What is your favourite colour?";}
		if ($secQ == "favFood"){$optText = "What is your favourite food?";}
		if ($secQ == "uncName"){$optText = "What is the name of your favourite uncle?";}
	  if ($secQ == "petName"){$optText = "What is the name of your favourite pet?";}
  $messg = "<span id=\"response\"><br /><label class=\"labelclass\">Your security question was</label><br /><label class=\"labelclass\">$optText</label><br /><input type=\"text\" id=\"secInput\" class=\"inputclass\" placeholder=\"Enter your answer here\" /><input type=\"button\" value=\"Send Answer\" onclick=\"sendA()\" id=\"sendAbut\" /></span>";
  }
  print $messg;
?>
