<?php
	$uploaddir = "/var/www/html/testsite/images/gdtests/large/";
	$thumbDir = "/var/www/html/testsite/images/gdtests/small/";
	$upC = count($_FILES['picture']['name']);
	$newName = $_FILES['picture']['name'];
	$upText = $_POST['opt2'];
	$messg = "";
	$imgDet = "";
	//print "$newName file uploaded<br \>";
	
	$tmpFilePath = $_FILES['picture']['tmp_name'];
	$uploadfile = $uploaddir . $newName;
	//print "$uploadfile <br />";
	//$dstImg = $uploaddir . $newName;
	$thumbFile = $thumbDir.$newName;
	if (move_uploaded_file("$tmpFilePath", "$uploadfile")){
		//print "file uploaded <br />";
		$messg .= " File Uploaded<br />";
		sizeOriginal();
	}else {
	 $messg .= "file not uploaded<br />";
	}

function sizeOriginal(){
	global $uploadfile, $thumbFile;
	$srcImg = imagecreatefromjpeg($uploadfile);
		$srcSize = getimagesize($uploadfile);
		$srcW = $srcSize[0];
		$srcH = $srcSize[1];
		$newW = 400;
		$newH = 300;
		$thumbH = 120;
		$thumbW = 90;
		$thumbDest = imagecreatetruecolor($thumbW, $thumbH);
		$dest = imagecreatetruecolor($newW, $newH);
		 $imgDet .= "Width : $srcW <br />Height : $srcH<br />";
		imagecopyresampled($thumbDest, $srcImg, 0, 0, 0, 0, $thumbW, $thumbH, $srcW, $srcH);
		imagecopyresampled($dest, $srcImg, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
		imagejpeg($thumbDest, $thumbFile, 100);
		imagejpeg($dest, $uploadfile, 100);
}
//print "$messg : $imgDet";
?>


