<?php
include ("IBISvars.inc");
if (!$guest_acc){
  print "the include file was not included <br>";
}
$itemN = 0;
$numFile = 0;
$prefix = "gls";
$table = "";
$message = "";
$Imgmessage = "";
$theTag = "";
$uploadDate = date('Y-m-d H:i:s');
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
  die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}
$stmt = $mysqli->prepare("SELECT count(MediaID) FROM Media WHERE filename LIKE '%$prefix%'") or die ("cannot create statement.");
if ($stmt->execute()){
  $stmt->bind_result($numFile) or die ("cannot bind parameters.");
  $stmt->fetch();
  $stmt->close();
}
if ($_POST){
	$Maintable = htmlentities(quotemeta(trim($_POST['category'])));
	//$theTag = htmlentities(quotemeta(trim($_POST['imgtag'])));
	if($Maintable == "Animals"){
		$table = "animGlossary";
	}
	if($Maintable == "Minerals"){
		$table = "minGlossary";
	}
	if($Maintable == "Vegetables"){
		$table = "vegGlossary";
	}
		$item = htmlentities(quotemeta(trim($_POST['item'])));
		$def = htmlentities(quotemeta(trim($_POST["definition"])));
		$diagC = htmlentities(quotemeta(trim($_POST["imgtag"])));
		if ($_FILES == "" || !$_FILES){
		$theDGref = "no image";
		}else{
		include ("IBIScollectFunctions.php3");
		$theDGref = $fileList;
		}
		if ($def == ""){
			$def = "empty definition";
		}
		if ($item == ""){
			$item = "empty term";
		}

	$stmnt1 = $mysqli->prepare("INSERT INTO $table (glossID, item, definition, uploadDate, diagramref) VALUES (?,?,?,?,?)") or die ($mysqli->error);
	$stmnt1->bind_param('sssss',$theGloss, $theItem,$theDef,$uploadDate, $theDGref )or die ($mysqli->error);
	$theGloss = 0;
	$theItem = $item;
	$theDef = $def;
	
	$uploadDate = $uploadDate;
	$stmnt1->execute()or die ($mysqli->error);
	if ($stmnt1->affected_rows == -1){
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><div id=\"messSpan\">Something went wrong please check your connection</div>";
		}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
			$theDGref = str_replace(":", "", $theDGref);
		$theResult = $mysqli->prepare("update Media set tags='$diagC' where filename='$theDGref'") or die ("could not update Media table". $mysqli->error);
			$theResult->execute() or die ("could not execute tag update");

		}
		$stmnt1->close();	

	}
else{
$message ="files array not found";
}
	
$message = '<span id="closeBut" onclick="closethis()">X</span><div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div><input type="button" class="linkC" onclick="resetThis()" value="Add Another"></div>';	
      
print "$message ";
?>
