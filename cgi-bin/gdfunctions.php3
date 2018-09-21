<?php
function sizeBoth(){
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
		imagecopyresampled($thumbDest, $srcImg, 0, 0, 0, 0, $thumbW, $thumbH, $srcW, $srcH);
		imagecopyresampled($dest, $srcImg, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
		imagejpeg($thumbDest, $thumbFile, 100);
		imagejpeg($dest, $uploadfile, 100);
}

function sizeMain(){
	global $uploadfile, $thumbFile;
	$srcImg = imagecreatefromjpeg($uploadfile);
		$srcSize = getimagesize($uploadfile);
		$srcW = $srcSize[0];
		$srcH = $srcSize[1];
		$newW = 400;
		$newH = 300;
		$dest = imagecreatetruecolor($newW, $newH);
		imagecopyresampled($dest, $srcImg, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
		imagejpeg($dest, $uploadfile, 100);
}


?>
