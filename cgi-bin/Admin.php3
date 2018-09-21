<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title> Search Form</title>
    <script type="text/javascript" src="/ibis/jquery-2.1.1.min.js"> </script>
    <script src="/ibis/js/bootstrap.js"></script>
    <script type="text/javascript" src="/ibis/Gmain.js"></script>
		<script type="text/javascript" src="/ibis/dateshorts.js"></script>
		<link href="/ibis/css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet"
  	      type="text/css"
  	      href="/ibis/Badmin.css"
      /> 
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)" href="/ibis/Sindex.css" /> 
  </head> 
  <body onload=initForm() >
  	<div id="SFallContainer" class="container">
      <div class="row">
      	<div id="dateTime">
	        <div id="dateBlock">The Date</div>
	        <div id="timeBlock">The Time</div>       
	      </div>
	      <div id="logo_image_holder">
	        <img id="logo_image" src="/ibis/images/Logo1_fullsizetransp.png"  />
	      </div> 
      </div>
      <div class="row">
       	<div id=pgButtons>
					<a id="backButton" href="/ibis/IBISmain.html" class="linkC">Back to Main</a>
		    </div>
      </div>
      <div id="subcontainer">
      <label class="labelclass Heading"  >Messages</label>
      	<div id="messages">
				  
				  <?php
				  	include ("IBISvars.inc");
				  	$retlist = "";
				  	$messgs = "";
					 	if (!$guest_acc){
								print "the include file was not included <br>";
					 	}
							$mysqli = new mysqli('localhost', "author", "silverfish95", 'IBIS');
					 	if ($mysqli->connect_error){
								die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
						}
						$stmnt1 = $mysqli->prepare("select AuthNoteID, noteText, senderEmail, noteDate from AuthNotes")	or die ("cannot create statement.");
						if ($stmnt1->execute()){
  						$stmnt1->bind_result($noteid, $notetext, $uemail, $notedate ) or die ("cannot bind parameters.");
  						while ($stmnt1->fetch()){
  	 					$strpart = substr($notetext, 0, 10);
  	 					$strpart = $strpart . "...";
  	 					
  	 					$retlist .= '
  	 					<tr>
  	 						<td class="hiddentext" id="'.$noteid.'"><td>
  	 						<td>'.$notedate.'</td>
  	 						<td>'.$strpart.'<span class="hiddentext fulltext">'.$notetext.'</span></td>
  	 						<td>'.$uemail.'</td>
  	 					</tr>'; 
    				}
					}else {
						print $mysqli->error;
					}
					$stmnt1->close(); 
  						
  					$messgs = '<table class="table table-striped">'.$retlist.'</table>';
				  	print "$messgs";
				  ?>
      	</div>
      	<div id="sql">
      	<label class="labelclass" >this is where i will run arbitrary SQL statements?</label>
      	<span id="op" class="container"></span>
      	<span id="fields" class="container"></span>
      	<span id="tables" class="container"></span>
      	<span id="condition" class="container"></span>
      	<span id=""></span>
      	</div>
      </div>
      
  	</div>
  </body>
</html>
