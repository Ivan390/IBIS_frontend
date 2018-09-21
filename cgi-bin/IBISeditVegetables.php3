<?php
include ("IBISvars.inc");
if (!$guest_acc){
	print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
}else {$connectMsg = "connection to IBIS okay</br>";}
if ($_POST['kingdom'] == "Plantae"){
	$prefix = "veg";
	include ("IBISeditFunctions.php3");
	$thisVID= htmlentities(quotemeta(trim(array_key_exists('VegetableID',$_POST)?$_POST['VegetableID']:null)));
  	$stmt3a = ("INSERT INTO VegetablesEdits (VegetableID, phylum, subPhylum, class, subClass, Vorder, subOrder, family, subFamily, genus, subGenus, species, subSpecies, localNames, nameNotes, descrip, ecology, distrib, uses, growing, category, status, uploadDate, mediaRefs, contribRef, editComnt, origDate ) select VegetableID, phylum, subPhylum, class, subClass, Vorder, subOrder, family, subFamily, genus, subGenus, species, subSpecies, localNames, nameNotes, descrip, ecology, distrib, uses, growing, category, status, uploadDate, mediaRefs, contribRef, editComnt, origDate from Vegetables where VegetableID='$thisVID';");
  	$st3aResult = $mysqli->query($stmt3a) or die ("could not copy to Edits table". $mysqli->error);
  	$stmt3b = ("delete from Vegetables where VegetableID='$thisVID'");
  	$st3bResult = $mysqli->query($stmt3b) or die ("could not  delete from Data table".$mysqli->error);
  	$dataMessg = "Data received....processing will follow <br>";
  	$stmt3 = $mysqli->prepare("INSERT INTO Vegetables (VegetableID, phylum, subPhylum, class, subClass, Vorder, subOrder, family, subFamily, genus, subGenus, species, subSpecies, localNames, nameNotes, descrip, ecology, distrib, uses, growing, category, status, uploadDate, mediaRefs, contribRef, editComnt, origDate ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die ("could not prepare statement 3 <br>");
	$stmt3->bind_param('sssssssssssssssssssssssssss', $VegetableID, $phylum, $subPhylum, $class, $subClass, $order, $suborder, $family, $subfamily, $genus, $subgenus, $species, $subspecies, $common_Names, $name_Notes, $description, $ecology, $distrib_Notes, $uses, $growing, $category, $status, $uploadDate, $mediaRefs,  $contributer_ID, $editComnt, $origDate );
	$VegetableEditID = 0;
	$VegetableID = htmlentities(quotemeta(trim(array_key_exists('VegetableID',$_POST)?$_POST['VegetableID']:null))); 
	$phylum = htmlentities(quotemeta(trim(array_key_exists('phylum',$_POST)?$_POST['phylum']:null))); 
	$subPhylum = htmlentities(quotemeta(trim(array_key_exists('subPhylum',$_POST)?$_POST['subPhylum']:null)));
	$class = htmlentities(quotemeta(trim(array_key_exists('class',$_POST)?$_POST['class']:null)));
	$subClass = htmlentities(quotemeta(trim(array_key_exists('subClass',$_POST)?$_POST['subClass']:null)));
	$order = htmlentities(quotemeta(trim(array_key_exists('Vorder',$_POST)?$_POST['Vorder']:null)));
	$suborder = htmlentities(quotemeta(trim(array_key_exists('subOrder',$_POST)?$_POST['subOrder']:null)));
	$family = htmlentities(quotemeta(trim(array_key_exists('family',$_POST)?$_POST['family']:null)));
	$subfamily = htmlentities(quotemeta(trim(array_key_exists('subFamily',$_POST)?$_POST['subFamily']:null)));
	$genus = htmlentities(quotemeta(trim(array_key_exists('genus',$_POST)?$_POST['genus']:null)));
	$subgenus = htmlentities(quotemeta(trim(array_key_exists('subGenus',$_POST)?$_POST['subGenus']:null)));
	$species = htmlentities(quotemeta(trim(array_key_exists('species',$_POST)?$_POST['species']:null)));
	$subspecies = htmlentities(quotemeta(trim(array_key_exists('subSpecies',$_POST)?$_POST['subSpecies']:null)));
	$common_Names = htmlentities(quotemeta(trim(array_key_exists('common_Names',$_POST)?$_POST['common_Names']:null)));
	$name_Notes = htmlentities(quotemeta(trim(array_key_exists('name_Notes',$_POST)?$_POST['name_Notes']:null)));
	$description = htmlentities(quotemeta(trim(array_key_exists('description',$_POST)?$_POST['description']:null)));
	$ecology = htmlentities(quotemeta(trim(array_key_exists('ecology',$_POST)?$_POST['ecology']:null)));
	$distrib_Notes = htmlentities(quotemeta(trim(array_key_exists('distrib_Notes',$_POST)?$_POST['distrib_Notes']:null)));
	$uses = htmlentities(quotemeta(trim(array_key_exists('uses',$_POST)?$_POST['uses']:null)));
	$growing = htmlentities(quotemeta(trim(array_key_exists('growing',$_POST)?$_POST['growing']:null)));
	$contributer_ID = htmlentities(quotemeta(trim(array_key_exists('contributer_ID',$_POST)?$_POST['contributer_ID']:null)));
	$origDate = htmlentities(quotemeta(trim(array_key_exists('origDate',$_POST)?$_POST['origDate']:null)));
	$uploadDate = date('Y-m-d H:i:s');
	$status = htmlentities(quotemeta(trim(array_key_exists('status',$_POST)?$_POST['status']:null)));
	$category = htmlentities(quotemeta(trim(array_key_exists('category',$_POST)?$_POST['category']:null)));
	$fileList = htmlentities(quotemeta(trim($fileList, "\s:");
	$fileList = str_replace("::",":",$fileList);
	$fileList = "$fileList:";
	$mediaRefs = $fileList;
	$editComnt = htmlentities(quotemeta(trim(array_key_exists('editComnt',$_POST)?$_POST['editComnt']:null)));
	$stmt3->execute();
	if ($stmt3->affected_rows == -1){
	$messg = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><div id=\"messSpan\">Something went wrong please check your connection</div>";
		}else{
			$messg = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
	}
	
	$stmt3->close();		
}

$htmlHead = '<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>
	    I B I S - Edit Result  
    </title>
    <script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>
    <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"></script>
		 <script type="text/javascript">
	 	$(document).ready(function(){
	 	 	$(\'#mediaPic\').change(handleFileSelect);	
	 		if (sessionStorage.userRef){
	 	 	 sessVar = sessionStorage.userRef;
	 	 	 sesA = sessVar.split("::");
	 	 	 conID = sesA[0];
	 	 	 $("#contrib_ID").val(conID);
	 	 	 }else {
	    alert("You should really not be on this page!")
	    document.location = "IBISmain.html";
	    }
	 	})
	 </script>
	 	<link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
		  <link rel="stylesheet"
	    type="text/css"
      href="http://192.168.43.132/ibis/editresult.css"
    >
   </head>
   <body name="VegInputBody" onload="starttime()" >
	   <div id="allContainer" class="container">
	   <div class="row">
		    	<div id="dateTime">
		 				<div id="dateBlock">The Date</div>
		 				<div id="timeBlock">The Time</div>
		 			</div>
		 				<div id="logo_image_holder">
							<img id="logo_image" src="http://192.168.43.132/ibis/images/Logo1_smaller.png"/>
						</div>
					
	 		</div>
      	<div id="Heading" class="row">
	        <span id="headingText">Edit Result</span>
        </div>
        <div id="pgButtons" class="row">
	        <a href="http://192.168.43.132/ibis/IBISmain.html" class="linkC "><img src="" alt="">Back to Main Screen</a>
	        <input type="button" class="linkC" onclick="sendData()" value="Goto Details"/>
        </div>
        <div id="detail_fs_min" class="littleDD" >'.$messg.'</div>
         <form name="infoForm" action="../../cgi-bin/IBISgetDetails.php3" method="POST" enctype="multipart/form-data" class="hiddentext">
	        <input type="text" id="genusRef" name="genusRef" class="" value="'.$genus.'" />
	        <input type="text" id="speciesRef" name="speciesRef" class="" value="'.$species.'" />
	        <input type="text" id="recID" name="recID" value="'.$VegetableID.'" />
	        <input type=text id="catVal" name="catVal" class="" value="vegetables" />
			    
          </form>
          <script type="text/javascript">
          	function sendData(){
          		document.infoForm.submit();
          	}
          </script>
          </body>
          </html>';
print "$htmlHead";
?>
