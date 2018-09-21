<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title> Search Form</title>
    <script type="text/javascript" src="http://192.168.43.132/ibis/jquery-2.1.1.min.js"> </script>
    <script src="http://192.168.43.132/ibis/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://192.168.43.132/ibis/Gmain.js"></script>
	<script type="text/javascript" src="http://192.168.43.132/ibis/dateshorts.js"></script>
	<link href="http://192.168.43.132/ibis/css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet"
        type="text/css"
        href="http://192.168.43.132/ibis/Bindex.css"
      /> 
	<link rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)" href="http://192.168.43.132/ibis/Sindex.css" /> 
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
      	<div id="catHeading" class="cathead">
	        <?php
	        	$pageHead = ucfirst($_POST['catValue']);
	        	echo "$pageHead";
	        ?> Index
	      </div>
      </div>
        <div class="row">
        	<div id=pgButtons>
						<a id="backButton" href="/ibis/IBISmain.html" class="linkC">Back to Main</a>
			    </div>
        </div>
	      <div id="mess"></div>
	      
	      <form name="infoForm" action="../cgi-bin/IBISgetDetails.php3" method="POST" enctype="multipart/form-data" class="hiddentext">
	        <input type="text" id="genusRef" name="genusRef" class="" value="" />
	        <input type="text" id="speciesRef" name="speciesRef" class="" value="" />
	        <input type="text" id="recID" name="recID" value="" />
	        <input type=text id="catVal" name="catVal" class="" value=
			    <?php
			      $htmlheading = ($_POST['catValue']);
			      echo "$htmlheading"; 
			    ?>
	        />
          </form>
          <div id="hiddenParams" class="hiddentext">
          <input type="text" id="ddl3Selectval" value="">
          <input type="text" id="ddl3Inputval" value="">
          </div>
	      <div id=subContain class="container" >
	      <div id="hitCnt"></div>
	       <div id="theCategory">
	        <div id="theCategoryHeading"></div>
	        
	        <div id="catPicsList" class="catCont" > </div>
	        <div id="picTag" class="imgtag" ></div>
	      </div>
	      <div id="tablecont">
	      <table id=findOptions class="table-condensed">
				<tr>
					<td><span id="DDLOption" ></span></td>
					<td><div class="selectholder"><select id="DDL2" class="form-control" value="" placeholder="select sub category" onchange="hideKeywordStuff()" onfocus="hideKeywordStuff()"></select>
					<span class="helpT">Click to select a sub category here</span></div></td>
				</tr>
				<tr id="DDL3Option" onclick="clHits()">
					
				</tr>
				<tr>
					<td><div class="selectholder"><input type="text" id="ddl3Txt" name="ddl3Txt" onfocus="hideSelectStuff()" onchange="hideSelectStuff()" placeholder="type keyword here"><span class="helpT" >Type a keyword to search for here, then click the Keyword button</span></div></td>
				</tr>
				<tr>
				<td><input type="button" id="option2btn" class="btn btn-info btn-lg" onClick="getSelectInfo()" value="Selection"></td></tr>
				<tr><td><input type="button" id="option3btn" class="btn btn-info btn-lg" onClick="getkeyword()" value="Keyword"></td>		
				</tr>
			</table>
	      </div>
	     
	     <div id=infoSet class=infoset></div>
	     <div id=optSet></div>
	     
	   </div>
	   <div id="GBlock"><span id="Ghead" onclick="showAlpha()" >Glossary</span>
	   	<ul id="alphList" class="list-inline" style="display : none;" >
	   		<li class="Gselect" onclick="readGloss(this)">A</li>
					<li class="Gselect" onclick="readGloss(this)">B</li>
					<li class="Gselect" onclick="readGloss(this)">C</li>
					<li class="Gselect" onclick="readGloss(this)">D</li>
					<li class="Gselect" onclick="readGloss(this)">E</li>
					<li class="Gselect" onclick="readGloss(this)">F</li>
					<li class="Gselect" onclick="readGloss(this)">G</li>
					<li class="Gselect" onclick="readGloss(this)">H</li>
					<li class="Gselect" onclick="readGloss(this)">I</li>
					<li class="Gselect" onclick="readGloss(this)">J</li>
					<li class="Gselect" onclick="readGloss(this)">K</li>
					<li class="Gselect" onclick="readGloss(this)">L</li>
					<li class="Gselect" onclick="readGloss(this)">M</li>
					<li class="Gselect" onclick="readGloss(this)">N</li>
					<li class="Gselect" onclick="readGloss(this)">O</li>
					<li class="Gselect" onclick="readGloss(this)">P</li>
					<li class="Gselect" onclick="readGloss(this)">Q</li>
					<li class="Gselect" onclick="readGloss(this)">R</li>
					<li class="Gselect" onclick="readGloss(this)">S</li>
					<li class="Gselect" onclick="readGloss(this)">T</li>
					<li class="Gselect" onclick="readGloss(this)">U</li>
					<li class="Gselect" onclick="readGloss(this)">V</li>
					<li class="Gselect" onclick="readGloss(this)">W</li>
					<li class="Gselect" onclick="readGloss(this)">X</li>
					<li class="Gselect" onclick="readGloss(this)">Y</li>
					<li class="Gselect" onclick="readGloss(this)">Z</li>
	   	</ul>
					<p class=" Gbutton" onclick="closeGl()" style="display : none;">close it</p>
					<div id="retBlock" onclick="" style="display : none;"></div>
	   			<div id="defBlock" onclick="closethis(this)" style="display : none;"></div>
	 			</div>
    </div>
    <script>
    $("#option3btn").prop("disabled", false);
	$("#option2btn").prop("disabled", false);
		var DDL1Text = "";
		var DDL3select = "";
        var thiscatVal = $("#catVal").val();
   		if (thiscatVal == "vegetables"){
   DDL1Text = '\
   <div class="selectholder"><select id="DDL1Veg" class="form-control formE" onClick="populateDDL2()" onChange="populateDDL2()" placeholder="select category">\
   	<option class="listItem " >Family</option>\
   	<option class="listItem " value="genus">Genus</option>\
   	<option class="listItem " value="species">Species</option>\
   </select>\
   <span class="helpT"> Click to select category</span></div>';
DDL3select='\
<td>\
	<div class="selectholder"><select id="DDL3dd" class="form-control formE" placeholder="select keyword here">\
		<option value="descrip">Description</option>\
		<option value="ecology">Ecology</option>\
		<option value="distrib">Distribution</option>\
		<option value="uses">Uses</option>\
		<option value="growing">Growing</option>\
		<option value="nameNotes">Name Notes</option>\
		<option value="localNames">Local Names</option>\
		<option value="category">Category</option>\
	</select>\
	<span class="helpT">Click to select the heading to search the keyword in</span></div>\
</td>';
   
  		}
  		if (thiscatVal == "animals"){
   	DDL1Text = '\
   	<div class="selectholder"><select id="DDL1Veg" class="form-control formE" onClick="populateDDL2()" onChange="populateDDL2()">\
   		<option class="listItem " >Class</option>\
   		<option class="listItem " >Order</option>\
   		<option class="listItem " >Family</option>\
   		<option class="listItem" value="genus">Genus</option>\
   		<option class="listItem " value="species">Species</option>\
   	</select>\
  	<span class="helpT"> Click to select category</span></div>';
   DDL3select='\
  <td>\
		 <div class="selectholder"><select id="DDL3dd" class="form-control formE">\
		 	<option value="descrip">Description</option>\
		 	<option value="ecology">Ecology</option>\
		 	<option value="distrib">Distribution</option>\
		 	<option value="habits">Habits</option>\
		 	<option value="status">Status</option>\
		 	<option value="nameNotes">Name Notes</option>\
		 	<option value="localNames">Local Names</option>\
		 </select>\
		 <span class="helpT">Click to select the heading to search the keyword in</span></div>\
  </td>';
  		}
  		if (thiscatVal == "minerals"){
   DDL1Text = '\
   <div class="selectholder"><select id="DDL1Min" class="form-control formE" onClick="populateDDL2()" onChange="populateDDL2()">\
   	<option class="listItem" value="Name" >Name</option>\
   	<option class="listItem " value="Mgroup">Group</option>\
   	<option class="listItem " value="chemForm">Chemical Formula</option>\
   </select>\
   <span class="helpT"> Click to select category</span></div>';
   DDL3select='\
   <td>\
   	<div class="selectholder"><select id="DDL3dd" class="form-control formE">\
   		<option value="uses">Uses</option>\
   		<option value="origin">Origin</option>\
   		<option value="notes">Notes</option>\
   		<option value="characteristics">Characteristics</option>\
   	</select>\
   	 <span class="helpT">Click to select the heading to search the keyword in</span>\
   </td>';
		}  		
$("#DDLOption").html(DDL1Text);
$("#DDL3Option").html(DDL3select);
   
function populateDDL2(){
	$("#catPicsList").html("");
	var catVal = $("#catVal").val();
  	if (catVal == "minerals"){
    	var DDL1Minvalue = $("#DDL1Min").val();
    	var  DDL1value = "";
	}else{
   		var DDL1Minvalue = "";
   		var DDL1value = $("#DDL1Veg").val();
  	}
    $.ajax({
    	url : '../cgi-bin/IBISindexCreator.php3',
    	type : "get",
      	async : "false",
     	data : {ddl1val : DDL1value, ddl1minval : DDL1Minvalue, catValtext: catVal },
     	success : function(data){
     	var testregexp = /no match/;
	    if (testregexp.test(data)) {
	   		alert("Okayyyy");
	    }else {
	        var theretval = "";
	        var thedata = data.split(":");
	        for (b = 0; b < thedata.length; b++){
	          if (!thedata[b] == ""){
	            theretval += "<option>" + thedata[b] + "</option>";
	          }
	        }
        	$("#DDL2").html(theretval);
        	$("#hitCnt").html("");
        	$("#infoSet").html("");
        	$("#specipicH").html("");
        	$('#DDL2').show();
        }
     }
    });
}
function getSelectInfo(){
  var catVal = $("#catVal").val();
  if (catVal == "minerals"){
    var DDL1Minvalue = $("#DDL1Min").val();
    DDL1value = "";
  }else{
  var DDL1value = $("#DDL1Veg").val();
    DDL1Minvalue = "";
  }
  var DDL2value = $("#DDL2").val();
    if (DDL2value == "") {
      alert("please select a catagory from the first list please");
      exit;
      }
	  $.ajax({
	      url : '../cgi-bin/IBISgetCatIndex.php3',
	      type : "get",
	      async : "false",
	      data : {ddl1val: DDL1value, ddl2val : DDL2value, ddl1minval : DDL1Minvalue, catValtext : catVal },
	      success : function(data){
	      var testregexp = /no match/;
  	      if (testregexp.test(data)) {
	        alert("Okayyyy");
       	  }else {
	      var valueList = "";
	      var theSet = "";
	      var thedata = data.split(";");
	      var rc = thedata.length - 1;
	      var retCnt = "<p>" + rc + " hits </p>";
	      for (b = 0; b < thedata.length; b++){
	        if (!thedata[b] == ""){
	          valueList = thedata[b].split(":");
	          if (catVal == "vegetables" || catVal == "animals"){
	         	binomial = "("+valueList[3]+"):"+valueList[2]+":"+valueList[1];
	         	
	          }
	          if (catVal == 'minerals') {
	          	binomial = "("+valueList[2]+"):"+valueList[1];
	          }
	          theSet += "<span class=\"linksclass\"><img src=" + valueList[0] + " title=" + binomial + " onClick=showSummarry(this)></span>"; 
	          }
	        }
	        $("#mess").hide();
	        $("#hitCnt").html(retCnt);
	        $("#hitCnt").show();
	        $("#catPicsList").html(theSet); 
	        $("#infoSet").html("");
	      } 
     	}
      });
}

function showSummarry(that){
 var thedata2 = "";
 var valueList2 = "";
 var valueList3 = "";
  var thiscatVal = $("#catVal").val();
  var ddl3T = $("#ddl3Txt").val();
  var ddl3S = $("#DDL3dd").val();
  var thisTitle = that.title;
  var picList = thisTitle.split(":");
  
  var picTitle = picList[0]+":"+ddl3T+":"+ddl3S;
 // alert(picTitle);
  var picsrc = that.src;
  $.ajax({
      url : '../cgi-bin/IBISgetSummarry.php3',
      type : "get",
      async : "false",
      data : {pictitle:picTitle, catValtext:thiscatVal},
      success : function(data){ // $catVal:$family:$genus:$species:$localnames:$recID:$OpField:$binomial[1]";
      var testregexp = /no match/;
	     if (testregexp.test(data)) {
	        alert("Okayyyy");
       }else { 
       // animals::Aonyx:capensis:Cape ClawlessOtter:animals::Pternistes:capensis:CapeFrancolin:
       var splitter = '::';
	     thedata2 = data.split(splitter);
	     if (thedata2[0] == "vegetables"|| thedata2[0] == "animals"){
	     	var optText = thedata2[6];
	     	var myRegbase = thedata2[7];
	     //	var myCap = myRegbase[0].toLocaleUpperCase();
	     	//myRegbase[0] = myCap[0];
	     	//alert(myCap+myRegbase);
	    	 var regRepl = "<span class=\"highlite\">"+myRegbase+"</span>";
	     	optText = optText.replace(myRegbase, regRepl);
	     	var optHead = ddl3S;
	    	if (optHead == "descrip"){
	     		optHead = "Description";
	     	}
	      if (optHead == "distrib"){
	     		optHead = "Distribution";
	      }
	     valueList2 = "<div id=speciePic> \
	       								<img src=\"" + picsrc + "\" title=\"" +thedata2[2]+ " :  "+thedata2[3]+ "\" width=\"200px\" height=\"200px\" />\
	       								</div>\
	       								<div id=sumDetails class=\"\">\
	       									<span class=\"headingC\">Family</span><br>\
	       									<span class=\"detailC\">" + thedata2[1] + "</span><br>\
	       									<span class=\"headingC\">Genus</span><br>\
	       									<span class=\"detailC\">" + thedata2[2] + "</span><br>\
	       									<span class=\"headingC\">Species</span><br>\
	       									<span class=\"detailC\">" + thedata2[3] + "</span><br> \
	       									<span class=\"headingC\">Local Names</span><br>\
	       									<span class=\"detailC localN\">" + thedata2[4] + "</span><br>\
	       									<div id=\"optionText\"><span class=\"headingC\">"+optHead+"</span><br>\
	       									<span class=\"detailC\">" + optText + "</span></div><br>\
	       									<input type=\"button\" value=\"Dismiss\" onclick=\"closeThis()\" class=\"buttonclass\" id=\"closeInfo\">\
	       									<input type=\"button\" id=\"getDetails\" class=\"buttonclass\" onclick=\"getDetails()\" value=\"More...\" />\
	       								</div>";
     // valueList3 = "";
     //var nxtVal = thedata[-1]+":"+thedata[-2];
    // alert(nxtVal);
   	        $("#speciesRef").val(thedata2[3]);
   	        $("#genusRef").val(thedata2[2]);
   	        $("#recID").val(thedata2[5]);

	     }
	     if (thedata2[0] == "minerals"){
	     	var chemForm = thedata2[4];
	     	var chemArray = chemForm.split("");
	     	chemForm = "";
	     	for (j = 0; j < chemArray.length; j++){
	      		if (!isNaN(chemArray[j])){
	        		chemArray[j] = "<sub>"+chemArray[j]+"</sub>";
	      		}
	      		chemForm += chemArray[j];
	     	}
	     valueList2 = "<div id=speciePic><img src=\"" + picsrc + "\" title=\"" +thedata2[2]+ " :  "+thedata2[3]+ "\" width=\"200px\" height=\"200px\" /></div><div id=sumDetails class=\"\"><span class=\"headingC\">Name</span><br><span class=\"detailC\">" + thedata2[1] + "</span><br><span class=\"headingC\">Group</span><br><span class=\"detailC\">" + thedata2[2] + "</span><br><span class=\"headingC\">Crystal System</span><br><span class=\"detailC\">" + thedata2[3] + "</span><br><span class=\"headingC\">Chemical Formula</span><br><span class=\"detailC\">" + chemForm + "</span><br><input type=\"button\" value=\"Dismiss\" onclick=\"closeThis()\" class=\"buttonclass\" id=\"closeInfo\"><input type=\"button\" id=\"getDetails\" class=\"buttonclass\" onclick=\"getDetails()\" value=\"More...\" /></div>";
	    $("#speciesRef").val(thedata2[1]);
     }
     $("#infoSet").html(valueList2); 
     $("#infoSet").fadeIn('slow'); 
     $("#speciesRef").val(thedata2[1]);
   	        $("#genusRef").val(thedata2[2]);
   	        $("#recID").val(thedata2[5]);

    } 
    }
  });
$('#getDetails').removeClass("hiddentext");
$("#tablecont").hide();
}
function hideKeywordStuff(){
	$("#option3btn").prop("disabled", true);
	$("#option2btn").prop("disabled", false);
}
function hideSelectStuff(){
	$("#option2btn").prop("disabled", true);
	$("#option3btn").prop("disabled", false);
}
function getDetails(){
   var infoIsSet = $("#infoSet").html();;
   if (infoIsSet == ""){
		alert("Please choose an item");
   }else{
	   	document.infoForm.submit();
   }
}

function closeThis(){
   	$("#infoSet").fadeOut('slow');
   	$("#tablecont").show();
}
   
function getkeyword(){
	var ddl3Slct = $('#DDL3dd').val();
	$("#ddl3Selectval").val(ddl3Slct);
	var ddl3Text = $('#ddl3Txt').val();
	$('#ddl3Inputval').val(ddl3Text);
	var catVal = $("#catVal").val();
  	$.ajax({
      url : '../cgi-bin/IBISkeywordIndex.php3',
      type : "get",
      async : "false",
      data : {ddl3dd: ddl3Slct, ddl3Txt : ddl3Text, catValtext : catVal },
      success : function(data){
      var testregexp = /nomatch/;
	  	if (testregexp.test(data)) {
	  		var nomatch = "<p>No matching Records</p>";
	  		$("#hitCnt").hide();
	  		$("#mess").html(nomatch);
	  		$("#mess").show();
	  		$("#catPicsList").html("");
      }else {
	      var valueList = "";
	      var theSet = "";
	      var thedata = data.split("::");
	      var rc = thedata.length -1;
	      var retCnt = "<p>" +rc+ " hits </p>";
	      for (b = 0; b < thedata.length; b++){
	        if (!thedata[b] == ""){
	          valueList = thedata[b].split(":");
	          if (catVal == "vegetables" || catVal == "animals"){
	         		binomial = "("+valueList[3]+"):"+valueList[2]+":"+valueList[1];
	          }
	          if (catVal == 'minerals') {
	          	binomial = "("+valueList[2]+"):"+valueList[1];
	          }
	          theSet += "<span class=\"linksclass\"><img src=" + valueList[0] + " title=" + binomial + " width=\"100px\" height=\"100px\" onClick=showSummarry(this)></span>"; 
	          }
	        }
			    $("#hitCnt").html(retCnt);
			    $("#hitCnt").show();
			    $("#mess").hide();
			    $("#catPicsList").html(theSet); 
			    $("#infoSet").html("");
			    $("#specipicH").html(""); 
	      } 
	     
    	 }
      });
	}		
	function clHits() {
		$("#hitCnt").html("");
		$("#DDL2").hide();
	
	}
	
    </script>
    </body>
</html>   
