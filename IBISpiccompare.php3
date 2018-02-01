<!DOCTYPE html>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width"/>
        <title>
        Picture Compare
        </title>
        <script type="text/javascript" src="jquery-1.11.3.js"></script>
        <script type="text/javascript" src="Gmain.js"></script>
        <script type="text/javascript" src="/ibis/dateshorts.js"></script>
         <script type="text/javascript">
	 	$(document).ready(function(){
	 	 	$('#picture').change(handleFileSelect);
	 	 	})
	 	 	function getVal(){
	 	 		var selection = $('#optSelect').val();
	 	 		$('#imgTag').val(selection);
	 	 	}
	 	 	function submitThis(){
	 	 		document.picCompareF.submit();
	 	 		
	 	 	}
	 	 	function goBack(){
        		//document.location = "IBISutilities.html";
        		close();
        		}
	 	 	</script>
	 	 	<link rel="stylesheet"
        		type="text/css"
       		 	href="/ibis/imgmatch.css"
      		/>
      		<link rel="stylesheet" 
    	type="text/css" 
    	media="only screen and (max-width: 580px)" 
    	href="smallerDevice.css" />
     </head>
     <body onload="initForm()">
     <div id="compContainer">
     <div id="dateTime">
	      <div id="dateBlock">The Date</div>
	      <div id="timeBlock">The Time</div>       
	    </div>
	    <div id="logo_image_holder">
	      <img id="logo_image" src="./images/Logo1_fullsizetransp.png"/>
	    </div>
	    <span id="buttons">
	    <label class="" onclick="goBack()">Dismiss</label></span>
	    <span id="picHeading">Picture Match</span>
     	<div id="compSub">
     		 <form  name="picCompareF" action="../cgi-bin/picCompare2.php3" method="POST" enctype="multipart/form-data">
			   <input type="file" name="picture" id="picture"/>
			   <select id="optSelect" onchange="getVal()">
			   	<option id="option1">animal</option>
			   	<option id="option2">mineral</option>
			   	<option id="option3">vegetable</option>
			   </select>
			   <div id="messBlock"><p>This facility is slow and relatively inaccurate</br>Use at own risk</p></div>
			   <input type="text" name="imgtag" id="imgTag" style="display:none" value="animal" />
			   <input type="button" value="submit" onclick="submitThis()" id="submitB">
			   <span id="imageSpan"></span>
       </form>
    </div>
     	
     
     </div>
      
     </body>
</html>
