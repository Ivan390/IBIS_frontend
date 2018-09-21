<?php
include ("IBISvars.inc");
if (!$guest_acc){
	print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}
$buttons = '<div id="pgButtons" class="littleDD">
         <a href="/ibis/IBISmain.html" class="buttonclass littleDD">Back to Main Screen</a>
         <a href="/ibis/IBISnewMinerals.html" class="buttonclass littleDD">Enter another</a>
        </div>';
$message = "";
	$Imgmessage = "";
	$uploadDate = "";
if ($_POST['Akingdom'] == "Minerals"){
	$prefix = "min";
 	include ("IBIScollectFunctions.php3");
	$stmt3 = $mysqli->prepare("INSERT INTO Minerals (MineralID, name, Mgroup, crystalSys, habit, chemForm, hardness, density, cleavage, fracture, streak, lustre, fluorescence, notes, origin, characteristics, uses, mediaRefs, contribRef, uploadDate, distrib, origDate, hasImage) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")or die ("could not prepare statement 3 <br>");
	$stmt3->bind_param('sssssssssssssssssssssss', $minID, $Mname, $Mgroup, $crystalsys, $habit, $chemform, $hardness, $density, $cleavage, $fracture, $streak, $lustre, $fluorescence, $notes, $origin, $characteristics, $Muses, $Mediarefs, $McontribRef, $Muploaddate, $distrib, $origDate, $haspic );
	$minID = 0;
	$Mname = htmlentities(quotemeta(trim(array_key_exists('Mname',$_POST)?$_POST['Mname']: null))); 
	$Mgroup = htmlentities(quotemeta(trim(array_key_exists('Mname',$_POST)?$_POST['Mgroup']: null)));
	$crystalsys = htmlentities(quotemeta(trim(array_key_exists('crystSys',$_POST)?$_POST['crystSys']: null)));
	$habit = htmlentities(quotemeta(trim(array_key_exists('Mhabit',$_POST)?$_POST['Mhabit']: null)));
	$chemform = htmlentities(quotemeta(trim(array_key_exists('Mchemical_Formula',$_POST)?$_POST['Mchemical_Formula']: null)));
	$hardness = htmlentities(quotemeta(trim(array_key_exists('Mhardness',$_POST)?$_POST['Mhardness']: null)));
	$density = htmlentities(quotemeta(trim(array_key_exists('Mdensity',$_POST)?$_POST['Mdensity']: null)));
	$cleavage = htmlentities(quotemeta(trim(array_key_exists('Mcleavage',$_POST)?$_POST['Mcleavage']: null)));
	$fracture = htmlentities(quotemeta(trim(array_key_exists('Mfracture',$_POST)?$_POST['Mfracture']: null)));
	$streak = htmlentities(quotemeta(trim(array_key_exists('Mstreak',$_POST)?$_POST['Mstreak']: null)));
	$lustre = htmlentities(quotemeta(trim(array_key_exists('Mlustre',$_POST)?$_POST['Mlustre']: null)));
	$fluorescence = htmlentities(quotemeta(trim(array_key_exists('Mfluorescense',$_POST)?$_POST['Mfluorescense']: null)));
	$notes = htmlentities(quotemeta(trim(array_key_exists('Mnotes',$_POST)?$_POST['Mnotes']: null)));
	$origin = htmlentities(quotemeta(trim(array_key_exists('Morigin',$_POST)?$_POST['Morigin']: null)));
	$characteristics = htmlentities(quotemeta(trim(array_key_exists('Mcharacteristics',$_POST)?$_POST['Mcharacteristics']: null)));
	$Mediarefs = $fileList;
	if ($fileList == ""){
		$haspic = "no";
	}else{
		$haspic = "yes";
	} 
	$origDate = $uploadDate;
	$Muploaddate = date('Y-m-d H:i:s');;
	$McontribRef =  htmlentities(quotemeta(trim(array_key_exists('contributer_ID',$_POST)?$_POST['contributer_ID']: null)));
	$distrib = htmlentities(quotemeta(trim(array_key_exists('Mdistrib',$_POST)?$_POST['Mdistrib']: null)));
	$Muses = htmlentities(quotemeta(trim(array_key_exists('Muses',$_POST)?$_POST['Muses']: null)));
	$stmt3->execute();
	if ($stmt3->affected_rows == -1){
		$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><div id=\"messSpan\">Something went wrong please check your connection</div>";
	}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
		}
		$stmt3->close();		
	}
 $message = '<span id="closeBut" onclick="closethis()">X</span><div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div></div>';	
      
print "$message ";
?>
