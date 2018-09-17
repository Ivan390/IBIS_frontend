	/*
jscript script to deal handle the data input events

*/
function initForm() {
  $("#dateBlock").html(new Date().shortFormat());
  starttime();
  $('.inputC').val("");
}
// vegInput
var imgname = "";
var theHeading = "";
var theLabel ="";

function doRest(){
  var selVal = $('#refSelect').val();
  $('#tit').val(selVal);
  $('#pgDialog').show();
}

function closePgDialog(){
	$('#pgDialog').fadeOut();
	$('#pgNum').val("");
}

function addtToForm(){
	var reftit = $('#tit').val();
	var pgNum = $('#pgNum').val();
	$('#refTit').val(reftit);
	$('#pgnum').val(pgNum);
	$('#refLabel').css('background-color','pink');
	$('#pgLabel').css('background-color','pink');
	closePgDialog();

}
function loadList(){
    $("#lookupdiv").load("IBISanimalsRefMini.html");
    $("#lookupdiv").css("display", "block");
    $("#lookupList").css("display", "none");
    $("#lookupHide").css("display", "inline");
}

function hideList(){
    $("#lookupdiv").css("display","none");
    $("#lookupHide").css("display", "none");
    $("#lookupList").css("display", "inline");
}
  			 
function addTag(){
    var tagslist = $('#mediatagsinput').val();
    var newtag = imgname +" : "+ tagslist;
    var listitem = "<input type=\"text\" name=\"imgtag[]\" class=\"listitemC littleDD\" value=\""+newtag+"\" ></input><br />";
    $('#tagslist').append(listitem);
}
        
function showOps(that){
    imgname = that.title;
    imgname = imgname.replace(/%20/g, ' ');
    var opttext = '<p class="labelclass">Add Media Tags for <br>' + imgname + '</p><input type="text" name="mediaTagsInput" id="mediatagsinput" class="littleDD inputclass" /\><input type="button" class="buttonclass" value="Add" onclick="addTag();" />';
    $('#optionsDsplay').html(opttext);
    $("#optionsDsplay").slideDown('fast');
}
        
function sendedit(){
    var editval = $("#outputBox").val();
    var errmssg = checkWords(editval);
    if (errmssg){
			alert("This is a family website\n"+errmssg);
			$('#'+theHeading).val("");
			theLabel.style.backgroundColor = "red";
			$("#outputBox").val("Bad Word User");
    }else{
			$('#'+theHeading).val(editval);
			theLabel.style.backgroundColor = "pink";
			$("#outputBox").val("");
    }
    if (theHeading == "Species" || theHeading == "Name"){
			checkDuplicate();
    }
}

function clsbx(){
    $("#optionsDsplay").slideUp('fast');
}
       
function checkDuplicate(){ 
	var setval = $('#Kingdom').val();
    var matchList = "";
    var dupItems = "";
    var dupItemsL = "";
    var matchedDiv = "";
    var speciesval= "";
    var catvalue = $('#thecatid').val();
    if (setval == "Animalia"){
    	speciesval= $('#Species').val();
    	category = "Animals";
    	thecat = "animals";
    }
    if (setval == "Plantae"){
    	speciesval= $('#Species').val();
    	category = "Vegetables";
    	thecat = "vegetables";
    } 
    if (setval == "Minerals"){
    	speciesval= $('#Name').val();
    	category = "Minerals";
    	thecat = "minerals";
    }
    
    $.ajax({
			url : '../../cgi-bin/IBIScheckdup.php3',			type : "get",			async : "false",
			data :{species : speciesval, catval : catvalue, group : category},
			success : function(data){
			  var testregexp = /nomatch/;
			  if (testregexp.test(data)){
			  ///	
			  }else {
					var dataList = data.split("::");
					for (i=0; i<dataList.length; i++){
				  	if (dataList[i]==""){
							continue;
				  	}
				  	dupItems = dataList[i]; 
				  	dupItemsL = dupItems.split(":");
				  	genref = dupItemsL[1];
				  	specref = dupItemsL[2];
				  	recID = dupItemsL[0];
				  	conRef = dupItemsL[4];
				  	localN = dupItemsL[3];
				matchList += "<li><a href=\"../../cgi-bin/IBISeditStuff.php3?thecat="+thecat+"&specref="+genref+"&genref="+specref+"\">"+specref +" "+ genref +"</a><span id=\"lcN\">  "+localN+"</span> </li>";				  }					$('#specid').val(dupItemsL[1]);
			    matchedDiv = "<div id=\"matDiv\">Possible duplicate entry.</br>Maybe you want to edit the existing record instead</br><ul id=\"matlist\">"+matchList+"</ul><input type=\"button\" class=\"buttonclass\" value=\"Enter anyway \" onclick=\"closeDiag()\"></div>";
				  $('#messageDiv').html(matchedDiv);
			 }
			}
		})
}

function checkWords(content){
    var swearWrd = "";
    var wordexp = "";
    var messg = "";
    var swearList = new Array("fuck", "shit", "asshole", "bitch", "cunt", "shithead", "asscrack", "bullshit", "damnit", "poes", "naai" );
    var comment = content;
    //alert(comment);
    for (i = 0; i < swearList.length; i++){
	 		swearWrd = swearList[i];
	 		wordexp = new RegExp(swearWrd);
   		if (wordexp.test(comment)){
		    messg = "words like " + swearWrd + " are not allowed in this database!\nPlease clean up your fucking language.\nNo entry was recorded for this heading";
		   	return messg;
		    break;
			}
		}
}	

function submitDupForm(){
    document.dplForm.submit(); // 	needs to be abstracted
   }
     
function loadcontent(that){
    theHeading = $(that).text();
    theLabel = that;
    theHeading = theHeading.replace(' ', '_');
    $('.thisareaLabel').css("color" ,"black");
    theLabel.style.color = "lightgreen";
    var theContent = $('#'+theHeading).val();
    $("#outputBox").val(theContent);
    $("#outputBox").focus();
}
function closethis(){
$("#ajaxBox").fadeOut();
}
function checkPics() {
    var picValue = $('#imgDisplay').html();
    return picValue;
}

function closeDiag(){
	$('#matDiv').hide();
}

function reallySubmit(){
var catvalue = $('#thecatid').val();
	if (catvalue == "Vegetables"){
		var Akingdom = 'Plantae';
   var phylum = $("#Phylum").val();
		var Vclass = $("#Class").val();
		var subClass = $("#subClass").val();
		var order = $("#Order").val();
		var subOrder = $("#subOrder").val();
		var family = $("#Family").val();
		var subFamily = $("#subFamily").val();
		var genus = $("#Genus").val();
		var subGenus = $("#subGenus").val();
		var species = $("#Species").val();
		var subSpecies = $("#subSpecies").val();
		var common_Names = $("#Common_Names").val();
		var reftit = $("#refTit").val();
		var pgNumber = $("#pgnum").val();
		var name_Notes = $("#Name_Notes").val();
		var status = $("#Status").val();
		var description = $("#Description").val();
		var ecology = $("#Ecology").val();
		var habits = $("#Habits").val();
		var distrib_Notes = $("#Distrib_Notes").val();
		var img_Tags = $("#Image_Tags").val();
		var contributer_ID = $("#contrib_ID").val();
		var thecat = $("#thecatid").val();
		var uses = $("#Uses").val();
		var category = $("#Category").val();
		var growing = $("#Growing").val();
		var acclvl = $("#acclevel").val();
		$("#messD").hide();
	$.ajax({
		url : "../../cgi-bin/IBISnewVegetables.php3",
		method : "POST",
		data : {
		 		Akingdom: Akingdom,
        phylum: phylum,
        class : Vclass,
        subClass : subClass,
        order : order,
        subOrder: subOrder,
        family : family,
        subFamily : subFamily,
        genus : genus,
        subGenus : subGenus,
        species : species,
        subSpecies : subSpecies,
        common_Names : common_Names,
        reftit : reftit,
        pgNumber : pgNumber,
        name_Notes : name_Notes,
        status : status,
        description : description,
        ecology : ecology,
        habits : habits,
        distrib_Notes : distrib_Notes,
        imgtag : img_Tags,
        contributer_ID : contributer_ID,
        thecat :thecat,
        uses : uses,
        category : category,
        growing : growing,
        acclvl : acclvl 
		},
		success : function(data){
			$("#ajaxBox").html(data);
			$("#ajaxBox").show();
		}
	});
		}
    else if (catvalue == "Animals"){
    var Akingdom = 'Animalia';
   var Aphylum = $("#Phylum").val();
		var Aclass = $("#Class").val();
		var AsubClass = $("#subClass").val();
		var Aorder = $("#Order").val();
		var subOrder = $("#subOrder").val();
		var Afamily = $("#Family").val();
		var subFamily = $("#subFamily").val();
		var Agenus = $("#Genus").val();
		var subGenus = $("#subGenus").val();
		var Aspecies = $("#Species").val();
		var subSpecies = $("#subSpecies").val();
		var Acommon_Names = $("#Common_Names").val();
		var reftit = $("#refTit").val();
		var pgNumber = $("#pgnum").val();
		var Aname_Notes = $("#Name_Notes").val();
		var status = $("#Status").val();
		var Adescription = $("#Description").val();
		var Aecology = $("#Ecology").val();
		var Ahabits = $("#Habits").val();
		var Adistrib_Notes = $("#Distrib_Notes").val();
		var Aimg_Tags = $("#Image_Tags").val();
		var contributer_ID = $("#contrib_ID").val();
		var thecat = $("#thecatid").val();
$("#messD").hide();
		
	$.ajax({
		url : "../../cgi-bin/IBISnewAnimals.php3",
		method : "POST",
		data : {
		 	Akingdom: Akingdom,
        Aphylum: Aphylum,
        Aclass : Aclass,
        AsubClass : AsubClass,
        Aorder : Aorder,
        subOrder: subOrder,
        Afamily : Afamily,
        subFamily : subFamily,
        Agenus : Agenus,
        subGenus : subGenus,
        Aspecies : Aspecies,
        subSpecies : subSpecies,
        Acommon_Names : Acommon_Names,
        reftit : reftit,
        pgNumber : pgNumber,
        Aname_Notes : Aname_Notes,
        status : status,
        Adescription : Adescription,
        Aecology : Aecology,
        Ahabits : Ahabits,
        Adistrib_Notes : Adistrib_Notes,
        imgtag : Aimg_Tags,
        contributer_ID : contributer_ID,
        thecat :thecat 
		},
		success : function(data){
			$("#ajaxBox").html(data);
			$("#ajaxBox").show();
		}
	});
		
    }
    else if (catvalue == "Minerals"){
    	var Akingdom = 'Minerals';
   var Mname = $("#Name").val();
   var Mgroup = $("#Group").val();
		var crystSys = $("#Crystal_System").val();
		var Mhabit = $("#Habit").val();
		var Mchemical_Formula = $("#Chemical_Formula").val();
		var Mhardness = $("#Hardness").val();
		var Mdensity = $("#Density").val();
		var Mcleavage = $("#Cleavage").val();
		var Mfracture = $("#Fracture").val();
		var Mstreak = $("#Streak").val();
		var Mlustre = $("#Lustre").val();
		var Mfluorescence = $("#Fluorescence").val();
		var Mnotes = $("#Notes").val();
		var reftit = $("#refTit").val();
		var pgNumber = $("#pgnum").val();
		var Morigin = $("#Origin").val();
		var Mcharacteristics = $("#Characteristics").val();
		var Muses = $("#Uses").val();
		var Mdistrib = $("#Distribution").val();
		var distrib_Notes = $("#Distrib_Notes").val();
		var Mimg_Tags = $("#Image_Tags").val();
		var contributer_ID = $("#contrib_ID").val();
		var thecat = $("#thecatid").val();
		var Macclvl = $("#acclevel").val();
				$("#messD").hide();
	$.ajax({
		url : "../../cgi-bin/IBISnewMinerals.php3",
		method : "POST",
		data : {
		 	 Akingdom: Akingdom,
 				Mname : Mname,
        Mgroup: Mgroup,
        crystSys : crystSys,
        Mhabit : Mhabit,
        Mchemical_Formula : Mchemical_Formula,
        Mhardness: Mhardness,
        Mdensity : Mdensity,
        Mcleavage : Mcleavage,
        Mfracture : Mfracture,
        Mstreak : Mstreak,
        Mlustre : Mlustre,
        Mfluorescence : Mfluorescence,
        Mnotes : Mnotes,
        reftit : reftit,
        pgNumber : pgNumber,
        Morigin : Morigin,
        Mcharacteristics : Mcharacteristics,
        Muses : Muses,
        Mdistrib : Mdistrib,
        distrib_Notes : distrib_Notes,
        Mimg_Tags : Mimg_Tags,
        contributer_ID : contributer_ID,
        thecat :thecat,
        Macclvl : Macclvl 
		},
		success : function(data){
			$("#ajaxBox").html(data);
			$("#ajaxBox").show();
		}
	});
 }
}
        
function hidethis(){
	$('#messD').hide();
}

function doSubmit(){
	var apicValue = checkPics();
	if (apicValue == ""){
	var messgDiv = "<div id=\"messD\" class=\"dialogC\"><p>Entries without an attached image are saved to the Lost And Found</br>and will not be available through the Data Index.</p><input type=\"button\" class=\"buttonclass\" value=\"Don't worry about it.\" onclick=\"reallySubmit()\"/><br /><input type=\"button\" class=\"buttonclass\" value=\"Oops.\" onclick=\"hidethis()\"/></div>";
		$('#messageDiv').html(messgDiv);
	  }else{
	   	sendit();
	  }
}

 function showSrcBlock(){
        $('#SrcBlock').slideDown();
        }
        
function shortRefCode() {
var contrib = $('#contrib_ID').val();
var titList = "";
        	$.ajax({
        		url : "../../cgi-bin/getRefs.php3",        		type : "POST",        		data : {name1 : contrib},
        		success : function(response){
        			var Rlist = response.split(":@");
        			for (j = 0; j < Rlist.length; j++){
        				if (Rlist[j] == ""){
        					continue;
        				}
        				var refSet = Rlist[j].split(":*");
        				titList += "<option value=\""+refSet[0]+"\">"+refSet[1]+"</option>";
        			}
        			selctList = "<select id=\"refSelect\">"+titList+"</select>";
        			$('#refContainer').html(selctList);
        		}
        	})
}

function closeThis() {
        	$('#SrcBlock').fadeOut();
        }

function srcSubmit(){
	var Type = $('#type').val();
	var Title = $('#Title').val();
	var Publisher = $('#Publisher').val();
	var pubD = $('#pubD').val();
	var pubAddrs = $('#pubAddrs').val();
	var isbn = $('#isbn').val();
	var auth = $('#auth').val();
	var ed = $('#ed').val();
	var urlA = $('#urlA').val();
	var contrib = $('#contrib').val();
	var meth = $('#meth').val();
	var srcID = $('#refid').val();

	$.ajax({
		url : "../../cgi-bin/IBISsrc.php3",		type : "POST",		data : {type:Type, title : Title, publshr :Publisher, publDate : pubD, publAddr : pubAddrs, ISBN : isbn, author : auth, editor : ed, url: urlA, contributer: contrib, Meth:meth, SrcID : srcID },
		success : function(data){
			alert(data);
		}
	});
	$('#SrcBlock').fadeOut();
}

function updateForm(){
	shortRefCode();
	$('#Ocontainer').show();
	$('#dataF').hide();

}
function updF(){
	var recID = $('#refSelect').val();
	$.ajax({
		url : "../../cgi-bin/IBISupdSrc.php3",		type : "POST",		data : {name1:recID},
		success : function(data){
		var SrcList = data.split(":@");
		$('#type').val(SrcList[0]);
		$('#Title').val(SrcList[1]);
		$('#Publisher').val(SrcList[2]);
		$('#pubD').val(SrcList[4]);
		$('#pubAddrs').val(SrcList[3]);
		$('#isbn').val(SrcList[5]);
		$('#auth').val(SrcList[6]);
		$('#ed').val(SrcList[7]);
		$('#urlA').val(SrcList[8]);
		$('#contrib').val(SrcList[9]);
		$('#refid').val(SrcList[10]);
		}
	});
	$('#subButton').hide();
	$('#updButton').show();
	$('#meth').val('update');
	$('#dataF').show();
	$('#Ocontainer').hide();
	
}
