<?php
include ("IBISvars.inc");
$vercode = $_POST['name1'];
$vercode = trim($vercode);
$cryptVal = md5($vercode);
if ($cryptVal == $authCode){
	$mess = '<span id="accessBlock">
		<a href="../../cgi-bin/Admin.php3" class="linkC">You may pass</a><label onclick="closethis()" class="linkC">X</label>
	</span>';
}else {
	$mess = '<span id="accessBlock">
		<label  class="labelclass">wrong verification code. You are not worthy</label><label onclick="closethis()" class="linkC">X</label>
	</span>';
}
print "$mess";
?>
