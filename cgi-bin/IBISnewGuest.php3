<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title> Guest Book</title>
    <script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>
    <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://192.168.43.132/ibis/Gmain.js"></script>
	<script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"></script>
	<link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="http://192.168.43.132/ibis/jquery.dm-uploader.min.css" rel="stylesheet">
		   <script type="text/javascript">
		 	$(document).ready(function(){
		 	 	$('#mediaPic').change(handleFileSelect);	
		 	})
		</script>
		<link rel="stylesheet"
		 	type="text/css"
		 	href="/ibis/guestcss.css"
	  	/>
		<link rel="stylesheet" 
			type="text/css" 
			media="only screen and (max-width: 480px)" 
			href="http://192.168.43.132/ibis/Sguest.css" 
		/>  
	</head>
	<body id="TheBody" onload="initForm(); clearInputs();">
  	<div id=allContainer class="container">
   		<div class="row">
     		<div id="dateTime">
	   	 		<div id="dateBlock">The Date</div>
	     		<div id="timeBlock">The Time</div>       
	   		</div>
	     	<div id="logo_image_holder">
	        <img id="logo_image" src="/ibis/images/Logo1_fullsizetransp.png"  />
	      </div> 
      	</div>
   			<div id=pgButtons>
     			<a id="backButton" href="/ibis/IBISmain.html" class="lnkC button btn-info">Back to Main </a>
     			<input id="submitButton" type="button" onclick="sendit()" class="linkC button btn-info" value="Submit"/>
    		</div> 
  			<div id="gTitle">Guest Book</div>
  			<div id="detailcont">
    			<div id="detail_fs" class="infoblock container">
     				<form name="guestBook" action="../cgi-bin/IBIScollectGuestData.php3" method="POST" enctype="multipart/form-data">
	  					<input type="text" name="kingdom" value="Guestbook" class="hiddentext"/>
	   					<p class="inputclass">
								<label class="labelClass">Your name.</label><br />
								<input type="text" id="Gname" name="gname" class="inputClass oneliner littleDD"  />
	  				</p>
	  				<p class="inputclass">
							<label class="labelClass">Tell us Something.</label><br />
							<textarea name="Gcomment" id="gcommnt" class="inputClass multiliner littleDD" ></textarea>
	  				</p>
						<div id="guestPic"></div>
							<label class="labelClass">Add a picture</label></br>
							<div class="row">
		      			<div class="col-md-6 col-sm-12">
									<div id="drag-and-drop-zone" class="dm-uploader p-5">
		      			    <div class="btn btn-primary btn-block mb-5">
		      		        <span>File Browser</span>
		      		        <input id="mediaPic" type="file" title='Click to add Files' />
		      			    </div>
		      			  </div>
		            </div>
		     		    <div class="col-md-6 col-sm-12">
		        			<div class="card h-100">
		        			  <div class="card-header">
		        			    File List
		        			  </div>
				       	  <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
		  		          <li class="text-muted text-center empty">No files uploaded.</li>
		  		        </ul>
		        		</div>
		      		</div>
		    		</div>
						<div id="optionsDsplay" class="nothiddentext"></div>
						<div id="GuestPic"></div>
						<div id="newtagslist" class="nothiddentext"></div>
					</div>
		    </form>
      			</div>
					<?php
   						include ("IBISvars.inc");
	 					if (!$guest_acc){
							print "the include file was not included <br>"; 
	 					}
						$mysqli = new mysqli('localhost', "$guest_acc", "$guest_pass", 'IBIS');
						if ($mysqli->connect_error){
							die('Connect Error ('. $mysqli->connect_errno . ')' .$mysqli->connect_error);
						}
   						$stmt = $mysqli->prepare("SELECT Gcomment, serverpath, entryDate, Gname FROM Media, Guestbook WHERE filename LIKE '%guest%' AND mediarefs=filename order by entryDate DESC") or die ("cannot create statement.");
    					$picList ="";
						if ($stmt->execute()){
							$stmt->bind_result($tag, $serverpath, $entryDate, $gname  ) or die ("cannot bind parameters.");
							$countMax = 3;
							while ($stmt->fetch()){
								$theDatelist = explode(" ", $entryDate);
								$justDate = $theDatelist[0];
								$tag = "\t$justDate \n $gname said $tag"; 	
								$fileName = str_replace("$imagesfroot", "$imageshroot", $serverpath);
								$fileName = str_replace("$imagesdroot", "$imageshroot", $fileName);
								$fileName = str_replace("$imagesNotebookroot", "$imageshroot", $fileName);
								$picList .= "$fileName:$tag::";
							}
						}
						$stmt->close();
   					?>
   					<input type="button" id="shwG" class="buttonClass hiddentext" onclick="showGuests()" value="Guests" />
      				<div id=guestArea class="" >
      					
   							<div id="hiddencatPicsList" class="specimage hiddentext"><?php print $picList; ?></div>
	 					 		<div id="guestImages">
	 					 		 	<input type="button" id="showguests" class="buttonClass" onclick="showGuests()" value="Guests" />
	 					 		 	<input type="button" id="hideguests" class="buttonClass" onclick="hideGuests()" value="X" />
	  							<div id="catPicsList" class="specimage">
	  								<table id="Gtable"></table>
	  							</div>
	  						</div>
    					</div>
  			</div>
		</div>
	</div>
	<script type="text/javascript" src="http://192.168.43.132/ibis/fileselecter.js"></script>
	<script type="text/javascript" src="http://192.168.43.132/ibis/guests.js"></script>
	 <div id="ajaxBox"></div>
    	<script src="http://192.168.43.132/ibis/jquery.dm-uploader.min.js"></script>
    	 <script type="text/javascript" src="http://192.168.43.132/ibis/guestAsyncUpload.js"></script>
    	 <script src="http://192.168.43.132/ibis/demo-ui.js"></script>
    	  <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>   
	</body> 
</html>
