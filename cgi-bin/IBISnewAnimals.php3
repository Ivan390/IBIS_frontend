<?php
include ("IBISvars.inc");
	if (!$guest_acc){
		print "the include file was not included <br>";
	}
	$message = "";
	$Imgmessage = "";
	$uploadDate = "";
	$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
	if ($mysqli->connect_error){
   		die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  	}
	if ($_POST['Akingdom'] == "Animalia"){
	 	$prefix = "anim";
	 	$fileList ="";
	 	
	 	include ("IBIScollectFunctions.php3");
		$stmt3 = $mysqli->prepare("INSERT INTO Animals (AnimalID, phylum, subPhylum, class, subClass, Aorder, subOrder, family, subFamily, genus, subGenus, species, subSpecies, localNames, nameNotes, descrip, habits, ecology, distrib, status, uploadDate, mediaRefs, contribRef, origDate, hasImage, srcID, pgNum ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die ("could not prepare statement 3 <br>");
		$stmt3->bind_param('sssssssssssssssssssssssssss', $AnimalID, $Aphylum, $AsubPhylum, $Aclass, $AsubClass, $Aorder, $Asuborder, $Afamily, $Asubfamily, $Agenus, $Asubgenus, $Aspecies, $Asubspecies, $Acommon_Names, $Aname_Notes, $Adescription, $Ahabits, $Aecology, $Adistrib_Notes,  $Astatus, $AuploadDate, $AmediaRefs,  $Acontributer_ID, $origDate,$haspic, $pgnum, $SID );
		$AnimalID = 0;
		$Aphylum = htmlentities(quotemeta(trim(array_key_exists('Aphylum',$_POST)?$_POST['Aphylum']: null))); 
		
		$AsubPhylum = htmlentities(quotemeta(trim(array_key_exists('AsubPhylum',$_POST)?$_POST['AsubPhylum']: null)));
		$Aclass = htmlentities(quotemeta(trim(array_key_exists('Aclass',$_POST)?$_POST['Aclass']: null)));
		$AsubClass = htmlentities(quotemeta(trim(array_key_exists('AsubClass',$_POST)?$_POST['AsubClass']: null)));
		$Aorder = htmlentities(quotemeta(trim(array_key_exists('Aorder',$_POST)?$_POST['Aorder']: null)));
		
		$Asuborder = htmlentities(quotemeta(trim(array_key_exists('subOrder',$_POST)?$_POST['subOrder']: null)));
		$Afamily = htmlentities(quotemeta(trim(array_key_exists('Afamily',$_POST)?$_POST['Afamily']: null)));
		$Asubfamily = htmlentities(quotemeta(trim(array_key_exists('subFamily',$_POST)?$_POST['subFamily']: null)));
		$Agenus =  htmlentities(quotemeta(trim(array_key_exists('Agenus',$_POST)?$_POST['Agenus']: null)));
		$Asubgenus = htmlentities(quotemeta(trim(array_key_exists('subGenus',$_POST)?$_POST['subGenus']: null)));
		$Aspecies = htmlentities(quotemeta(trim(array_key_exists('Aspecies',$_POST)?$_POST['Aspecies']: null)));
		$Aspecies = strtolower($Aspecies);
		$Asubspecies = htmlentities(quotemeta(trim(array_key_exists('subSpecies',$_POST)?$_POST['subSpecies']: null)));
		$Acommon_Names = htmlentities(quotemeta(trim(array_key_exists('Acommon_Names',$_POST)?$_POST['Acommon_Names']: null)));
		$Aname_Notes = htmlentities(quotemeta(trim(array_key_exists('Aname_Notes',$_POST)?$_POST['Aname_Notes']: null)));
		$Adescription = htmlentities(quotemeta(trim(array_key_exists('Adescription',$_POST)?$_POST['Adescription']: null)));
		$Ahabits = htmlentities(quotemeta(trim(array_key_exists('Ahabits',$_POST)?$_POST['Ahabits']: null)));
		$Adistrib_Notes = htmlentities(quotemeta(trim(array_key_exists('Adistrib_Notes',$_POST)?$_POST['Adistrib_Notes']: null)));
		$Acontributer_ID = htmlentities(quotemeta(trim(array_key_exists('contributer_ID',$_POST)?$_POST['contributer_ID']: null)));
		$origDate = $uploadDate;
		$AuploadDate = $uploadDate;
		$Astatus = htmlentities(quotemeta(trim(array_key_exists('status',$_POST)?$_POST['status']: null)));
		$AmediaRefs = $fileList;
		if ($fileList == ""){
			$haspic = "no";
		}else{
			$haspic = "yes";
		}
		$SID = htmlentities(quotemeta(trim(array_key_exists('pgNumber', $_POST)?$_POST['pgNumber']: null)));
		$pgnum = htmlentities(quotemeta(trim(array_key_exists('reftit', $_POST)?$_POST['reftit']: null)));
		$stmt3->execute();
		if ($stmt3->affected_rows == -1){
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><div id=\"messSpan\">Something went wrong please check your connection</div>";
		}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
		}
		$stmt3->close();		
	}
	$buttons = '<div id="pgButtons" class="littleDD">
         			<a href="http://192.168.43.132/ibis/IBISmain.html" class="buttonclass ">Back to Main Screen</a>
         			<a href="http://192.168.43.132/ibis/IBISnewAnimals.html" class="buttonclass ">Enter another</a>
        		</div>';
$resultWinHead = '<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            I B I S - Uploads Form
        </title>
        <script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>			  <link rel="stylesheet"
  				type="text/css"
    			href="http://192.168.43.132/ibis/DataResult.css"
   			>
   			<link rel="stylesheet"
  				type="text/css"
    			href="http://192.168.43.132/ibis/IBIS_maincss.css"
   			>
   			</head>
    <body id="AllContainer" class="ac" >
    '.$buttons.'
		  <div id="subContainer">
		  <div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div>';
$resultWinFoot='</div>
		  </div>
    </body></html>';	
    $message = '<span id="closeBut" onclick="closethis()">X</span><div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div></div>';	
      
print "$message ";
?>
