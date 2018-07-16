<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <title>
   I B I S - Glossary Input Page
  </title>
  <script type="text/javascript" src="jquery-1.11.3.js"></script>
   <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
  <script type="text/javascript" src="Gmain.js"></script>
  <script type="text/javascript" src="dateshorts.js"></script>
   <link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript">
	$(document).ready(function(){
	     if (sessionStorage.userRef){
    		$('.clickme').change(handleFileSelecting);
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
  		<li class="listItem"><a href="IBISutilities.html" class="button btn-large btn-info"><img src="" alt="">Utilities</a></li>
  		<li class="listItem"><a id="backButton" href="/ibis/IBISmain.html" class="button btn-large btn-info">Main </a></li>
  		<li class="listItem"><input type="button" class="button btn-large btn-info" value="Submit" onclick="submitForm()"/></li>
  	</ul>
  </div>
  <div id=subContainer class="container">
    <input type="button" class="button btn-large btn-info" value="Add an item" onclick="addAnotherItem()"/>
    <form name="glossentry" id="glossEntry" method="POST" enctype="multipart/form-data" action="../cgi-bin/IBISglossary.php3">
		<input type="text" id="ICval" name="ICVal" value="" class="hiddentext"/>
		<input type="text" name="contributer_ID" id="contrib_ID" class="hiddentext" >
			<?php 
				$catV = $_GET['name1']; 
				print '<input type="text" name="category" class="hiddentext" id="catVal" value="'.$catV.'" />'; 
			?>
    </form>
   <div id=mesText> </div>
  </div>
 </div> 
 </body>
  <script type="text/javascript">
  function addAnotherItem(){
    IC = $('#ICval').val() ;
    IC++;
    $('#ICval').val(IC);
    var addItem ='\
        	<div id="vegGlosItem'+ IC +'" class="itemC">\
			  	<label class="labelText">Term</label>\
			  	<input type="text" name="item'+ IC +'" class="inputText shortText" />\
			  	<label class="labelText">Definition</label>\
			  	<textarea name="definition'+ IC +'" class="inputText longText"></textarea>\
			  	<div id="imageDiv'+ IC +'">\
					<label class="labelC">Add a Diagram</label>\
					</br>\
					<input id="pictures" type ="file" name="pictures'+ IC +'" class="clickme" onchange="handleFileSelecting(this)"/></br>\
        			<div id="diagram0" class="hidden"> \
        				<label class="labelText" onclick="addCaption(this)">Caption</label></br>\
	  					<input type="text" name="diagramCap'+ IC +'"  />\
	  					<div id="glosspic'+ IC +'" class="glossP"></div>\
					</div>\
					<input type="text" id="picRef'+IC+'" name="picref'+IC+'" value="" class="hiddentext">\
      			</div>\
    		</div>';
    $('#glossEntry').append(addItem);
    //	alert("and it finishes the function");
  }
  function submitForm(){
    document.glossentry.submit();
  }
 </script> 
</html>
