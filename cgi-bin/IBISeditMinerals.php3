<?php
	include ("IBISvars.inc");
	if (!$guest_acc){
		print "the include file was not included <br>";
	}
	$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
  	if ($mysqli->connect_error){
   		die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  	}
	$MainBackButton = '
 	<div id="pgButtons" class="littleDD">
  		<a href="/ibis/IBISmain.html" class="buttonclass littleDD">Back to Main Screen</a>
  	</div>';
	print "$MainBackButton <br>";
	$fileMessg =""; 
	$fileError ="";
	$dataMessg ="";
	$dataError ="";
	if ($_POST['kingdom'] == "Minerals"){
		$prefix = "min";
		include ("IBISeditFunctions.php3");
		$thisMID= htmlentities(quotemeta(trim(array_key_exists('MineralID',$_POST)?$_POST['MineralID']:null)));
		$stmt3a = "INSERT INTO MineralsEdits (MineralID, name, Mgroup, crystalSys, habit, chemForm, hardness, density, cleavage, fracture, streak, lustre, fluorescence, notes, origin, characteristics, uses, mediaRefs, contribRef, uploadDate, distrib, editComnt, origDate)
	 select MineralID, name, Mgroup, crystalSys, habit, chemForm, hardness, density, cleavage, fracture, streak, lustre, fluorescence, notes, origin, characteristics, uses, mediaRefs, contribRef, uploadDate, distrib, editComnt, origDate from Minerals where MineralID='$thisMID';";
		$st3aResult = $mysqli->query($stmt3a) or die ("could not copy to Edits table". $mysqli->error);
		$stmt3b = ("delete from Minerals where MineralID='$thisMID'");
		$st3bResult = $mysqli->query($stmt3b) or die ("could not  delete from Data table".$mysqli->error);
	  $dataMessg = "Data received....processing will follow <br>";
		$stmt3 = $mysqli->prepare("INSERT INTO Minerals (MineralID, name, Mgroup, crystalSys, habit, chemForm, hardness, density, cleavage, fracture, streak, lustre, fluorescence, notes, origin, characteristics, uses, mediaRefs, contribRef, uploadDate, distrib, editComnt, origDate ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die ("could not prepare statement 3 <br>");
		$stmt3->bind_param('sssssssssssssssssssssss', $MineralID, $name, $Mgroup, $crystalSys, $habit, $chemForm, $hardness, $density, $cleavage, $fracture, $streak, $lustre, $fluorescence, $notes, $origin, $characteristics, $uses, $mediaRefs, $contribRef, $uploadDate,  $distribution, $editComnt, $origDate );
		$MineralID = htmlentities(quotemeta(trim(array_key_exists('MineralID',$_POST)?$_POST['MineralID']:null))); 
		$name = htmlentities(quotemeta(trim(array_key_exists('name',$_POST)?$_POST['name']:null))); 
		$Mgroup = htmlentities(quotemeta(trim(array_key_exists('Mgroup',$_POST)?$_POST['Mgroup']:null)));
		$crystalSys = htmlentities(quotemeta(trim(array_key_exists('crystalSys',$_POST)?$_POST['crystalSys']:null)));
		$habit = htmlentities(quotemeta(trim(array_key_exists('habit',$_POST)?$_POST['habit']:null)));
		$chemForm = htmlentities(quotemeta(trim(array_key_exists('chemForm',$_POST)?$_POST['chemForm']:null)));
		$hardness = htmlentities(quotemeta(trim(array_key_exists('hardness',$_POST)?$_POST['hardness']:null)));
		$density = htmlentities(quotemeta(trim(array_key_exists('density',$_POST)?$_POST['density']:null)));
		$cleavage = htmlentities(quotemeta(trim(array_key_exists('cleavage',$_POST)?$_POST['cleavage']:null)));
		$fracture = htmlentities(quotemeta(trim(array_key_exists('fracture',$_POST)?$_POST['fracture']:null)));
		$streak = htmlentities(quotemeta(trim(array_key_exists('streak',$_POST)?$_POST['streak']:null)));
		$lustre = htmlentities(quotemeta(trim(array_key_exists('lustre',$_POST)?$_POST['lustre']:null)));
		$fluorescence = htmlentities(quotemeta(trim(array_key_exists('fluorescence',$_POST)?$_POST['fluorescence']:null)));
		$notes = htmlentities(quotemeta(trim(array_key_exists('notes',$_POST)?$_POST['notes']:null)));
		$characteristics = htmlentities(quotemeta(trim(array_key_exists('characteristics',$_POST)?$_POST['characteristics']:null)));
		$uses = htmlentities(quotemeta(trim(array_key_exists('uses',$_POST)?$_POST['uses']:null)));
		$distribution = htmlentities(quotemeta(trim(array_key_exists('distribution',$_POST)?$_POST['distribution']:null)));
		$contributer_ID = htmlentities(quotemeta(trim(array_key_exists('contribRef',$_POST)?$_POST['contribRef']:null)));
		$origDate = htmlentities(quotemeta(trim(array_key_exists('origDate',$_POST)?$_POST['origDate']:null)));
		$fileList = htmlentities(quotemeta(trim($fileList, "\s:");
		$fileList = str_replace("::",":",$fileList);
		$fileList = "$fileList:";
		$mediaRefs = $fileList;
		$uploadDate = date('Y-m-d H:i:s');
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
	        <input type="text" id="recID" name="recID" value="'.$MineralID.'" />
	        <input type=text id="catVal" name="catVal" class="" value="minerals" />
			    
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
