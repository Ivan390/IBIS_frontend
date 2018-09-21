<?php
include ("gdfunctions.php3");
$fileList ="";
$newName ="";
$tagItem ="";
$justTag ="";
$numfile = 0;
$typea = "";
$Imgmessage = "yes";
$hasimage = "";
$thumbDir = "https://ivanadams95.000webhostapp.com/ibis/Data/Images/thumbails/";
//$oName = $_POST['imgCheck'];
$stmt = $mysqli->prepare("SELECT count(MediaID) FROM Media WHERE filename LIKE '%$prefix%'") or die ("cannot create statement.");
if ($stmt->execute()){
  $stmt->bind_result($numFile) or die ("cannot bind parameters.");
  $stmt->fetch();
  $stmt->close();
  $filecount = count($_FILES['file']['name']); // get the number of uploaded files and there should be at least one image
  $tags = htmlentities(quotemeta(array_key_exists('imgtag',$_POST)?$_POST['imgtag']: 0));
  if (count($tags) > 0){
	$tagCount = count($tags); // if tags are uploaded get how many
  } else {
  		$tagCount = 0;
  } // if no tags uploaded set the counter to 0
  for ($i = 0; $i < $filecount; $i++){ // iterate over the uploaded files; this is the loop that will deal with each file
    $numFile++;
    $justname = $_FILES['file']['name']; // get the uploaded file name
    $tmpFilePath = $_FILES['file']['tmp_name']; // get the temp file name
    $extn = substr($justname, -4); // get the extension from the original file
    for ($c = 0; $c <= $tagCount; $c++){ // iterate over the tags if any are uploaded
      $tagstring = trim(array_key_exists('imgtag',$_POST)?$_POST['imgtag']: null); // get the tag
      if (strstr( $tagstring, $justname )){ // see if the tag contains the uploaded filename
      	$newName = $prefix.$numFile.$extn; // construct the new filename ** this shouldn't be here
		$tagItem = explode(" : ", $tagstring); // if the tag contains the filename explode it
		$justTag = $tagItem[1]; // get just the tag part of the uploaded tag
	  } 
    }
    $newName = $prefix.$numFile.$extn; // construct the new filename
    $uploadfile = $uploaddir.$newName ; // construct the server upload path
    $thumbFile = $thumbDir.$newName;
    if ( move_uploaded_file("$tmpFilePath", "$uploadfile") ) { // test the file upload, following code runs only on upload success
      	$Imgmessage = "File upload was successful <br>";
				sizeBoth();
      	$fileList .= "$newName:"; // add the new filename to the list of uploaded files
      	$stmt2 = $mysqli->prepare("INSERT INTO Media ( MediaID, type, filename, tags, uploadDate, contribRef, uploaderType, serverpath, thumbpath ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )"); // write the new media file to the Media table
      	$stmt2->bind_param('sssssssss', $MediaID, $Type, $filename, $tags, $uploadDate, $contribRef, $uploaderType, $servPath, $thumbPath) or die ("cannot bind parameters.");
      	if ($extn == "jpg" || $extn == "png" || $extn == "gif"){
      		$typea = "image";
      	}
      	$MediaID = 0;
      	$Type = $typea;
      	$filename = $newName;
      	$tags = $justTag; //***This need to be evaluated....done
     	$uploadDate = date('Y-m-d H:i:s');
     	$contribRef = trim(array_key_exists('contributer_ID',$_POST)?$_POST['contributer_ID']: null);
      	$uploaderType = "c";
      	$servPath = $uploadfile;
      	$thumbPath = $thumbFile;
      	$stmt2->execute();
       	if ($stmt2->affected_rows == -1){
					$Imgmessage = "IBIS Media Upload failed <br>";
      	}else{
					$Imgmessage = "IBIS Media upload succesful<br>";
      	}
      	$stmt2->close();
    } else { // end of file upload check, following code runs on upload error
       	$Imgmessage = "Media upload failed <br>";
       //	$Imgmessage = "$justname files though";
    }
  } // end of processing file, loop for next file, 
}else { // end of data connection check, if this test fails none of the above run
  $dataError =  "Statement did not execute <br>";
}
?>
