<! DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/xml; charset=utf-8" />
<meta name="viewport" content="width=device-width" />	
<title>
  Enter Vegetable LookUp Terms
</title>
<script type="text/javascript" src="jquery-1.11.3.js"> </script>
<script type="text/javascript" src="Gmain.js"> </script>
<script type="text/javascript" src="dateshorts.js"> </script>
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
  href="IBIS_maincss.css"
/>
<link rel="stylesheet"
  type="text/css"
  href="vegGloss.css "
/>
<link rel="stylesheet" 
			type="text/css" 
			media="only screen and (max-width: 480px)" 
			href="Src_smaller.css" 
    	/>	
</head>
<body id="GlBody" onload="initForm()">
  <div id="dateTime">
  <div id="dateBlock">The Date</div>
  <div id="timeBlock">The Time</div>       
  </div>
  <div id="logo_image_holder">
    <img id="logo_image" src="./images/Logo1_fullsizetransp.png"/>
  </div>
  <div id="glHeading">Glossary Input</div>
  <div id=pgButtons>
  <a id="backButton" href="/ibis/IBISmain.html" class="buttonclass littleDD">Back to Main Page </a>
  	<input type="button" class="buttClass" value="Submit" onclick="submitForm()"/>
  	
  </div>
  
  
  <div id=allContainer class="ac">
  	
    <input type="button" class="buttClass" value="Add an item" onclick="addAnotherItem()"/>
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
