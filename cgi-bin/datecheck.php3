<?php
$dateVar = strtotime($_POST['name1']);
$newD = date("Y-m-d", $dateVar);
print "$dateVar from php $newD";

?>


