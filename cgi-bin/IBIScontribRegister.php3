<?php
				$fileList ="";
				$message = "";
				$usrMessg = "";
				include ("IBISvars.inc");

				if (!$guest_acc){
			    	print "the include file was not included <br>";
				}
				$mysqli = new mysqli('localhost', "$guest_acc", "$guest_pass", 'IBIS');
				if ($mysqli->connect_error){
    			die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
  			}
				$filecount = count($_FILES['file']['name']);
				$name = htmlentities(quotemeta(trim($_POST['name']))); 
				$cleanname = str_replace("$space", "$underscore", $name);
				$securityA = htmlentities(quotemeta(trim($_POST['secA'])));
				$username = getUserName("$cleanname", "$securityA");
				$prefix = "reg";
  			$email = trim($_POST['email']);
	  		$stmt6 = $mysqli->prepare("SELECT count(ContribID) FROM Contributers WHERE email='$email'");
  			$stmt6->execute();
			  $stmt6->bind_result($emailCount);
				$stmt6->fetch();
				$stmt6->close();
				if ($emailCount > 0){
					$reason= "this email  <div class=Important>". $email . "</div> is allready registered</br>record not added.";
					$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><span id=\"messSpan\">$reason</span>";
					$message = "$reason <br />$message";
					exit;
				}else{
				
				include ("IBIScollectFunctions.php3");
    		$stmt3 = $mysqli->prepare("INSERT INTO Contributers ( ContribID, role, name, lastname, email, mediaRef, regDate, securityQ, securityA, userName, passwrd ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die ("cannot create statement.");
    				$stmt3->bind_param('sssssssssss', $ContribID, $role, $cleanname, $lastname, $email, $mediaRef, $regDate,$securityQ, $securityA, $username, $passwd) or die ("cannot bind parameters.");
				    $contribID = "";
				    $space = ' ';
    				$undescore = '_';
    				$role = "c";
				    $lastname = htmlentities($_POST['lastname']);
    				$email = htmlentities($_POST['email']);
    				$fileList = str_replace(":","",$fileList); 
				    $mediaRef = $fileList;
				    $regDate = $uploadDate;
				    $securityQ = $_POST['secQ'];
				    $passwd = crypt($name,$username);
				    $usrMessg = "Your user name is <div class=Important>". $username ."</div></br>Your email is <div class=Important>". $email ."</div></br>";
    				
    				$stmt3->execute();
    				if ($stmt3->affected_rows == -1){
     					$reason = "Database error";
     					$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/notokeydoke.png\"><br /><div id=\"messSpan\">$reason</div>";
    				}else{
			$message = "<img id=\"sucCheck\" src=\"http://192.168.43.132/ibis/images/okeydoke.png\"><div id=\"messSpan\">Data upload successful</div>";
		}
    					$stmt3->close();
  					}
  
				function getUserName($inName, $secA){
					$nameArray = str_split($inName);
					$secCount = strlen($secA);
					$letVal = 0;
					foreach ($nameArray as $letter){
						$letVal =+ ord($letter);
					}
					$rcode = ceil(($secCount * $letVal)/ ($secCount / 10)); 
					$theUserName = "$inName" . "$rcode";
					return $theUserName;
				}
				print "<span id=\"closeBut\" onclick=\"closethis()\">X</span><div>$message</div><br />$usrMessg";
?>

