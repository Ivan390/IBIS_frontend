<?php
include ("IBISvars.inc");
include ("gdfunctions.php3");
if (!$guest_acc){
 	print "the include file was not included <br>";
}
 $mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}
$prefix = "";
$justname = $_FILES['picture']['name'];
$tmpFilePath = $_FILES['picture']['tmp_name'];
$tagstring = $_POST['imgtag'];
if ($tagstring == "animal"){
	$prefix = "anim";
} 
if ($tagstring == "vegetable"){
	$prefix = "veg";
}
if ($tagstring == "mineral"){
	$prefix = "min";
} 
$MAEmetricPair = "";
$metricList =  "";
$psnmetricList = "";
$filePair = "";
$imgList = "";
$metList = "";
$extn = substr($justname, -4);
$extn = "$extn";
$stmt = $mysqli->prepare("SELECT count(MediaID) FROM Media WHERE filename LIKE '%$prefix%'") or die ("cannot create statement.");
if ($stmt->execute()){
	$stmt->bind_result($numFile) or die ("cannot bind parameters.");
	$stmt->fetch();
	$stmt->close();
}
$numFile = $numFile + 4;
$newName = $prefix.$numFile.$extn;
$uploaddir = "/var/www/html/ibis/Data/Images/temp/";			
$uploadfile = $uploaddir.$newName;
$tmpFilePath = $_FILES['picture']['tmp_name'];
if ( move_uploaded_file("$tmpFilePath", "$uploadfile") ) {
	sizeMain();
}
$stmt3 = $mysqli->prepare("SELECT filename, serverpath from Media where filename like '$prefix%'"); 
$stmt3->bind_result($fileName, $serverPath);
$stmt3->execute();
while ($stmt3->fetch()){
	$filePair .= "$fileName:$serverPath::";
}	  
$pairArray = explode("::", $filePair);
$fC = 0;
$errtext = "No such file";
foreach ($pairArray as $pairSet) {
	$thisPair = explode(":", $pairSet);
	if ($thisPair[0] == ""){
		continue;
	}
	$theFName = $thisPair[0];
	$theSPath = $thisPair[1];
	$fC = $fC + 1;
	$RMSEmetric =  `/usr/bin/compare -metric MSE $uploadfile $theSPath null: 2>&1`;
	$metricList = "MSE Avg: $RMSEmetric \n";
	if (strstr($RMSEmetric,$errtext)){
		continue;
	}
	if ($RMSEmetric < 6000){
		$imgList .= "<img class=\"imgthumb\" src=\"$theSPath\" title=\"$theFName\n$metricList\" height=\"200px\" width=\"200px\" onclick=\"getNames(this)\"/>";
		$metList .= "<li>$theFName : $metricList</li>";
	}
}
$imgList = str_replace("$imagesdroot", "$imageshroot", $imgList);
$imgList = str_replace("$imagesNotebookroot", "$imageshroot", $imgList);
$imgList = str_replace("$imagesfroot", "$imageshroot", $imgList);
$uploadfile = str_replace("$imagesNotebookroot", "$imageshroot", $uploadfile);
$origF =  "<img class=\"imgthumb\" src=\"$uploadfile\" title=\"uploaded file\"/>";
$imgDiv = "<div id=\"imgDiv\">$imgList</div>";
$htmlH = '<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width"/>
	<title>
		Image Match Result
	</title>
	<script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>	<script type="text/javascript" src="http://192.168.43.132/ibis/Gmain.js"></script>
	<script type="text/javascript">
	   	function closeThis(){
	   		close();
	   	}
	</script>
	<link rel="stylesheet"
		type="text/css"
		href="/ibis/imgmatch.css"
  	/>
  	<link rel="stylesheet" 
   		type="text/css" 
   		media="only screen and (max-width: 580px)" 
   		href="http://192.168.43.132/ibis/smallerDevice.css" />
 	</head>
 	<body><input type="text" value="'.$tagstring.'" style="display:none" id="catval">';
	$htmlF = '<div id="listDiv"></div><input type="button" class="linkC" onclick="closeThis()" value="Dismiss"/></body></html>';
print "$htmlH \n$origF  $listDiv $imgDiv \n$htmlF ";
/*	
AE
absolute error count, number of different pixels (-fuzz effected)
FUZZ
mean color distance
MAE
mean absolute error (normalized), average channel error distance
MEPP
mean error per pixel (normalized mean error, normalized peak error)
MSE
mean error squared, average of the channel error squared
NCC
normalized cross correlation
PAE
peak absolute (normalized peak absolute)
PHASH
perceptual hash for the sRGB and HCLp colorspaces. Specify an alternative colorspace with -define phash:colorspaces=colorspace,colorspace,...
PSNR
peak signal to noise ratio
RMSE
root mean squared (normalized root mean squared)
******There apppears to be of these scripts damnit which one is the right one AAAAAAAAAAAAAAAARGH :-()***************

*/ 
?>
