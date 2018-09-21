<?php
$messg = "";
$varMess = "";
	$var1 = htmlentities(quotemeta(array_key_exists('name1',$_POST)?$_POST['name1']: 0));
//	$var2 = htmlentities(quotemeta(array_key_exists('tstInput2',$_POST)?$_POST['tstInput2']: 0));
//	$filecount = count($_FILES['fileInput1']['name']);
	$cryptVal = md5($var1);
//	$varMess = "$cryptVal encrypted value";
	$encryptVal = 'a5164b7b7c2bc94b20d3ec3f8758d2b8'; //62a87d254670b9cff01de933f1e0f04c
	if ($cryptVal == $encryptVal){												//62a87d254670b9cff01de933f1e0f04c
		$messg = "values match";
	}else {
		$messg = "values don't match";
	}
	
	print "$messg";
	
	
?>
