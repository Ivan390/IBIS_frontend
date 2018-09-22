<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <title>
   I B I S - Glossary Input Page
  </title>
  <script type="text/javascript" src="jquery-2.1.1.min.js"></script>
   <script src="js/bootstrap.js"></script>
  <script type="text/javascript" src="Gmain.js"></script>
  <script type="text/javascript" src="dateshorts.js"></script>
  <script type="text/javascript" src="fileselect.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet"/>
   <link href="jquery.dm-uploader.min.css" rel="stylesheet">
<script type="text/javascript">
	$(document).ready(function(){
	     if (sessionStorage.userRef){
    		 $('#mediaPic').change(handleFileSelect);	
    		 $("#picmarker").val("no");
				$('#mediaPic').change(markPic);	
     	 	sessVar = sessionStorage.userRef;
	    	sesA = sessVar.split(":");
	    	conID = sesA[0];
	    	$('#contrib_ID').val(conID);
	    	$('#ICval').val(0);	
	  	}else {
	    	alert("You should really not be on this page!")
	    	document.location = "IBISmain.html";
	  	}
  	}) 
</script>
<link rel="stylesheet"
  type="text/css"
  href="Bgloss.css "
/>
<link rel="stylesheet" 
			type="text/css" 
			media="only screen and (max-width: 480px)" 
			href="Src_smaller.css" 
    	/>	
</head>
<body id="GlBody" onload="initForm()">
	<div id="mainContainer" class="container">
		<div id="dateTime">
			<div id="dateBlock">The Date</div>
			<div id="timeBlock">The Time</div>       
		</div>
  	<div id="logo_image_holder">
    	<img id="logo_image" src="./images/Logo1_fullsizetransp.png"/>
  	</div>
  	<div id="glHeading"><?php $title = $_GET['name1']; print "$title ";?>Glossary Input</div>
  	<div id=pgButtons>
			<ul  class="list-unstyled">
				<li class="listItem"><a href="IBISutilities.html" class="linkC"><img src="" alt="">Utilities</a></li>
				<li class="listItem"><a id="backButton" href="/ibis/IBISmain.html" class="linkC">Main </a></li>
				<li class="listItem"><input type="button" class="linkC" value="Submit" onclick="submitForm()"/></li>
			</ul>
  	</div>
  	<div id=subContainer class="container">
    	<div name="glossentry" id="glossEntry" >
				<input type="text" name="contributer_ID" id="contrib_ID" class="hiddentext" >
				<?php 
					print '<input type="text" name="category" class="hiddentext" id="catVal" value="'.$title.'" />'; 
				?>
				<div id="vegGlosItem" class="itemC">
				<form name="glForm" action="cgi-bin/IBISglossary.php" method="POST" enctype="multipart/form-data">
				<span id="textstuff">
						<label class="labelText">Term</label>
						<input type="text" name="item" class="inputText shortText" id="Item" placeholder="add term here"/>
						<label class="labelText">Definition</label>
						<textarea name="definition" class="inputText longText" id="Def" placeholder="add term definition here"></textarea>
					</span>
				</form>
					
					<div class="row">
        		<div class="col-md-6 col-sm-12">
							<div id="drag-and-drop-zone" class="dm-uploader p-5">
             	<div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
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
      	</div></br>
  			<div id="diagram0" class="hidden">
  				<label class="labelText" onclick="addCaption(this)">Caption</label></br>
					<input type="text" name="diagramCap" id="Dcap" placeholder="add diagram caption here"/>
					<div id=imgDisplay> </div> 
				</div>
				<input type="text" id="picRef" name="imgtag" value="" class="hiddentext" class="picRef">
				<input type="text" id="picmarker" class="hiddentext">
  		</div>
		</div>
  </div>
  <div id="ajaxBox"></div>
  <script src="jquery.dm-uploader.min.js"></script>
  <script type="text/javascript" src="glossAsyncUpload.js"></script>
  <script src="demo-ui.js"></script>
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
  <script type="text/javascript">
  function resetThis(){
  $("#ajaxBox").fadeOut();
  var thisstring = $("#catVal").val();
  docloc = "IBISvegGlossaryEntry.php?name1="+thisstring;
  document.location = docloc;
    
  }
  function markPic() {
  	$("#picmarker").val("yes")
  }
  function submitForm(){
   var picVal = $("#picmarker").val();
   if (picVal == "no" || !picVal){
   
  // alert("no value");
   var term = $("#Item").val();
   var def = $("#Def").val();
   var cat = $("#catVal").val();
   $.ajax({
   	url : "cgi-bin/IBISglossary.php",
   	method : "POST",
   	data : {
   		category : cat,
   		definition : def,
   		item : term
   	},
   	success : function(data){
   	$("#ajaxBox").html(data);
   	$("#ajaxBox").show();
   	} 
   });
   }else {
    	sendit();
   }
   
   // 
  }
 </script> 
</html>
