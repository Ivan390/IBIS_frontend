<?php
include ("IBISvars.inc");
if (!$guest_acc){
	print("some thing went wrong. IBISvars missing");
}
$mysqli = new mysqli('localhost', "$contrib_acc", "$contrib_pass", 'IBIS' );
if ($mysqli->connect_error){
	die('Connect Error ('.$mysqli->connect_errno.')' ."Database connect error, check your connection or try again later");
}
$userR = $_GET['userN'];
$stmnt1 = $mysqli->prepare("select ContribID, name, lastname, email, securityQ, securityA, mediaRef,username,  passwrd,  serverpath from Contributers, Media where ContribID = \"$userR\" and Contributers.mediaRef = Media.filename");
$stmnt1->bind_result($contID, $fName, $Lname, $Email, $secQ, $secA, $medRef,$uName,$passWd, $imgP) or die ("could not bind data");
$stmnt1->execute();
$stmnt1->fetch();
$stmnt1->close();

$datapart ='
     <div id="allContainer">
      	<div id="lookupdiv" ></div>
		
     <div id="Heading">
	     <p id="regheadingText">Edit Login Details</p>
    </div>
	<div id="subContain">
		<form name="udateContrib" action="../../cgi-bin/IBISupdContrib.php3" method="POST" enctype="multipart/form-data">
			<fieldset id="edDetails" class="littleDD">
				<div id="personalDetails" class="littleDD">
					<p> 
						<label class="labelClass" class="requiredf" >Edit email address</label>
						<input type="text" name="email" class="inputClass littleDD requiredf" value="'.$Email.'" id="Uemail"/>
					</p>
				</div>
				<div id=imgDisplay1 class="">
					<label class="labelClass">Change your profile picture</label>
					<div class="row">
        <div class="col-md-6 col-sm-12">
					<div id="drag-and-drop-zone" class="dm-uploader p-5">
              <div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
                <input id="mediaPic" type="file" id="regPic" title="Click to add Files" onchange="handleFileSelect()" />
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

				</div>	
				<div id="securityInfo" class="bigDD">
					<p>
						<label class="labelClass ">Select a question and enter an answer in the space below.</label>
					</p>
					<p>
						<select id = "secQ" name="secQ" class="labelClass littleDD selectClass" >';
							$optList = ["favColor", "favFood", "uncName", "petName"];
							$listOpt = "";
							foreach ($optList as $optVal){
								if ($optVal == "favColor"){$optText = "What is your favourite colour?";}
								if ($optVal == "favFood"){$optText = "What is your favourite food?";}
								if ($optVal == "uncName"){$optText = "What is the name of your favourite uncle?";}
								if ($optVal == "petName"){$optText = "What is the name of your favourite pet?";}
								if ($optVal == $secQ){
									$listOpt .="<option value = \"$optVal\" selected=\"selected\">$optText</option>";
									continue;
								}	
								$listOpt .= "<option value = \"$optVal\">$optText</option>";
							}			
							$selList = $listOpt;			
							$restHTML="	</select></br>
								<input type=\"text\" name=\"secA\" id=\"secA\" class=\"labelClass littleDD\" value=\"$secA\" />
								</p>	
				</div>
				<input type=\"button\" value=\"Submit\" onclick=\"updateDetails()\" id=\"updBut\" />
				<input type=\"text\" id=\"pssWD\" name=\"pssWD\" class=\"hiddentext\" value=\"$passWd\" />
				<input type=\"text\" id=\"userName\" name=\"userN\" class=\"hiddentext\" value=\"$uName\" />
				<input type=\"text\" id=\"contID\" name=\"contID\" class=\"hiddentext\" value=\"$contID\"/>
				<input type=\"text\" id=\"medref\" name=\"medRef\" class=\"hiddentext\" value=\"$medRef\" />
				<input type=\"text\" id=\"kingdom\" name=\"kingdom\" value=\"Register\" class=\"hiddentext\" >
			</fieldset>";
			$endHTML = '<input type="button" id="regSubmit" value="Dismiss" onclick="clWin()">
			</form></div><div id="ajaxBox"></div>
    	<script type="text/javascript" src="http://192.168.43.132/ibis/jquery.dm-uploader.min.js"></script>
    	 <script type="text/javascript" src="http://192.168.43.132/ibis/profAsyncUpload.js"></script>
    	 <script type="text/javascript" src="http://192.168.43.132/ibis/demo-ui.js"></script>
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
    </script></body>
			<script type="text/javascript">
				function clWin(){
				$("#edUser").fadeOut();
			}
			function updateDetails(){
				sendit();
				$("#edUser").fadeOut();
				//alert("reload the page to see your new details");
				
			}
			function handleFileSelect() {
				var files = this.files; 
				for (var i = 0, f; f = files[i]; i++) {
					if (!f.type.match(\'image.*\')) {
					 	continue;
				 	}
				 	if (i > 5){
						alert("Select up to 6 media files");
						continue;
					}
					var reader = new FileReader();
					reader.onload = (function(theFile) {
						return function(e) {
							$(\'#imgDisplay1\').append(\'<img class="thumbpic" src="\'+ e.target.result + \'" title="\'+ escape(theFile.name)+ \'" onclick="showOps(this)" /\>\');
						};
					})(f);
					reader.readAsDataURL(f);
					}
			}
			</script>
	</html>';
print "$datapart"."$selList"."$restHTML"."$endHTML";
?>
