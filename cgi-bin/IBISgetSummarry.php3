<?php 
include ("IBISvars.inc");
if (!$guest_acc){
 	print "the include file was not included <br>"; 
}
$mysqli = new mysqli('localhost', "$guest_acc", "$guest_pass", 'IBIS');
if ($mysqli->connect_error){
    die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}
$retlist4 = "";

function getSummarry() {
	global $mysqli, $retlist4;
	$stmtZ = "";
	$catVal = $_GET['catValtext'];
	$pictitle = $_GET['pictitle']; //  RecID:ddl3T:ddl3S;
	$binomial = explode(":", $pictitle);
	$RecID = trim($binomial[0]);
	$RecID = str_replace("(", "", $RecID);
	$RecID = str_replace(")", "", $RecID);
	$opField = $binomial[2];
/*	if (count($binomial) > 3){
		$Pspecies = $binomial[1];
	}else{
		$Pspecies = "";
	}*/
	if ($catVal == "vegetables"){ 
    	$stmtZ = "SELECT VegetableID, family, genus, species, localNames, $opField FROM Vegetables WHERE VegetableID = '$RecID'";
    	if ($stmt4 = $mysqli->prepare("$stmtZ")){
  		}else { 
    		print "error preparing stmt4 :". $mysqli->error;
  		}
  		if ($stmt4->execute()){
  		}else {
     		print "error executing stmt4 :". $mysqli->error;
  		}
   		$stmt4->bind_result($recID, $family, $genus, $species, $localnames, $OpField);
    	$stmt4->fetch() or die ($mysqli->error);
    	$retlist4 = "$catVal::$family::$genus::$species::$localnames::$recID::$OpField";
	}
  	if ($catVal == "minerals"){
    	$stmtZ = "select MineralID, name, Mgroup, crystalSys, chemForm, $opField from Minerals where MineralID= '$RecID'";
   	if ($stmt4 = $mysqli->prepare("$stmtZ")){
  	}else { 
    	print "error preparing stmt4 :". $mysqli->error;
  	}
  	if ($stmt4->execute()){
  	}else {
    	print "error executing stmt4 :". $mysqli->error;
  	}
   	$stmt4->bind_result($recID, $name, $mgroup, $crystalsys, $chemform, $OpField);
    $stmt4->fetch();
   	$retlist4 = "$catVal::$name::$mgroup::$crystalsys::$chemform::$recID::$OpField";
  	}
    if ($catVal == "animals"){ 
 	   $stmtZ = "SELECT AnimalID, family, genus, species, localNames, $opField FROM Animals WHERE AnimalID = '$RecID'";
 	   if ($stmt4 = $mysqli->prepare("$stmtZ")){
 		}else { 
    		print "error preparing stmt4 :". $mysqli->error;
  		}
  		if ($stmt4->execute()){
  		}else {
     		print "error executing stmt4 :". $mysqli->error;
  		}
   		$stmt4->bind_result($recID, $family, $genus, $species, $localnames, $OpField);
     	$stmt4->fetch() or die ($mysqli->error);
    	$retlist4 = "$catVal::$family::$genus::$species::$localnames::$recID::$OpField";
	}
	$retText = $retlist4."::". $binomial[1];
	print $retText;
}
getSummarry();
?>
