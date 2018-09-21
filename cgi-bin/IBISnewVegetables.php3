<?php
include ("IBISvars.inc");
if (!$guest_acc){
	print "the include file was not included <br>";
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS');
if ($mysqli->connect_error){
	die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
   	$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><span id=\"messSpan\">Data upload successful</span>";
}
$buttons = '<div id="pgButtons" class="littleDD">
         <a href="/ibis/IBISmain.html" class="buttonclass littleDD">Back to Main Screen</a>
         <a href="/ibis/IBISnewVegetables.html" class="buttonclass littleDD">Enter Another</a>
	     </div>';
if ($_POST['Akingdom'] == "Plantae"){
	$prefix = "veg";
 	include ("IBIScollectFunctions.php3");
	$dataMessg = "Data received....processing will follow <br>";
	$stmt3 = $mysqli->prepare("INSERT INTO Vegetables (VegetableID, phylum, subPhylum, class, subClass, Vorder, subOrder, family, subFamily, genus, subGenus, species, subSpecies, localNames, nameNotes, descrip, ecology, distrib, uses, growing, category, status, uploadDate, mediaRefs, contribRef, origDate,hasImage ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die ("could not prepare statement 3 <br>");
	$stmt3->bind_param('sssssssssssssssssssssssssss', $VegetableID, $phylum, $subPhylum, $class, $subClass, $order, $suborder, $family, $subfamily, $genus, $subgenus, $species, $subspecies, $common_Names, $name_Notes, $description, $ecology, $distrib_Notes, $uses, $growing, $category, $tatus, $uploadDate, $mediaRefs,  $contributer_ID, $origDate,$haspic );
	$VegetableID = 0;
	$phylum = htmlentities(quotemeta(trim(array_key_exists('phylum',$_POST)?$_POST['phylum']: null))); 
	$subPhylum = htmlentities(quotemeta(trim(array_key_exists('subPhylum',$_POST)?$_POST['subPhylum']: null)));
	$class = htmlentities(quotemeta(trim(array_key_exists('Vclass',$_POST)?$_POST['class']: null)));
	$subClass = htmlentities(quotemeta(trim(array_key_exists('subClass',$_POST)?$_POST['subClass']: null)));
	$order = htmlentities(quotemeta(trim(array_key_exists('order',$_POST)?$_POST['order']: null)));
	$suborder = htmlentities(quotemeta(trim(array_key_exists('suborder',$_POST)?$_POST['suborder']: null)));
	$family = htmlentities(quotemeta(trim(array_key_exists('family',$_POST)?$_POST['family']: null)));
	$subfamily = htmlentities(quotemeta(trim(array_key_exists('subfamily',$_POST)?$_POST['subfamily']: null)));
	$genus = htmlentities(quotemeta(trim(array_key_exists('genus',$_POST)?$_POST['genus']: null)));
	$subgenus = htmlentities(quotemeta(trim(array_key_exists('subgenus',$_POST)?$_POST['subgenus']: null)));
	$species = htmlentities(quotemeta(trim(array_key_exists('species',$_POST)?$_POST['species']: null)));
	$subspecies = htmlentities(quotemeta(trim(array_key_exists('subspecies',$_POST)?$_POST['subspecies']: null)));
	$common_Names = htmlentities(quotemeta(trim(array_key_exists('common_Names',$_POST)?$_POST['common_Names']: null)));
	$name_Notes = htmlentities(quotemeta(trim(array_key_exists('name_Notes',$_POST)?$_POST['name_Notes']: null)));
	$description = htmlentities(quotemeta(trim(array_key_exists('description',$_POST)?$_POST['description']: null)));
	$ecology = htmlentities(quotemeta(trim(array_key_exists('ecology',$_POST)?$_POST['ecology']: null)));
	$distrib_Notes = htmlentities(quotemeta(trim(array_key_exists('distrib_Notes',$_POST)?$_POST['distrib_Notes']: null)));
	$uses = htmlentities(quotemeta(trim(array_key_exists('uses',$_POST)?$_POST['uses']: null)));
	$growing = htmlentities(quotemeta(trim(array_key_exists('growing',$_POST)?$_POST['growing']: null)));
	$contributer_ID = htmlentities(quotemeta(trim(array_key_exists('contributer_ID',$_POST)?$_POST['contributer_ID']: null)));
	$origDate = $uploadDate;
	$uploadDate = $uploadDate;
	$tatus = htmlentities(quotemeta(trim(array_key_exists('status',$_POST)?$_POST['status']: null)));
	$category = htmlentities(quotemeta(trim(array_key_exists('category',$_POST)?$_POST['category']: null)));
	$mediaRefs = $fileList;
	if ($fileList == ""){
		$haspic = "no";
	}else{
		$haspic = "yes";
	} 
	$stmt3->execute();
	if ($stmt3->affected_rows == -1){
		$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
	}	
$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
$stmt3->close();
}

$message = '<span id="closeBut" onclick="closethis()">X</span><div id="resultsDiv"><div id="dataM">'.$message.'</div><div id="fileM">'.$Imgmessage.'</div></div>';	
      
print "$message ";
?>
