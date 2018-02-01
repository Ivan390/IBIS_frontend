

function andThis(that){
	var theVal = that.value;
	var Elist = "";
	var Rlist = "";
	var listEntry = "";
	var setA = "" ;
	var recID = "";
	var gen = "";
	var fam = "";
	var spec = "";
	var comN = "";
	$.ajax({
		url : "../../cgi-bin/lnf.php3",
		type : "POST",
		data : {name1:theVal},
		success : function(data){
		var retListA = data.split(":@");
		for (i =0; i <= retListA.length ;i++){
			listEntry = retListA[i];
			if (!listEntry){
				continue;
			}
			setA = listEntry.split(":");
			recID = setA[0];
			gen = setA[1];
			spec = setA[2];
			comN = setA[3];
			Elist +="<li onclick=\"editThis(this)\"><span class=\"lc\"><span class=\"hiddentext\">"+recID+"</span>"+gen+":<span class=\"italic\" >"+spec+"</span>:</br>"+comN+"</span></li>";
		}
		Rlist = "<ul>"+Elist+"</ul>";
		$('#messDiv').html(Rlist);
		$('#catVal').val(theVal);
		}
	})
}
function moveUp(that){
	var item = that.id;
	if (item == "LostBlock"){
		$("#" + item).css('z-index','12');
		$('#FoundBlock').css('z-index','1');
	}
	if (item == "FoundBlock"){
		$("#" + item).css('z-index','12');
		$('#LostBlock').css('z-index','1');
	}
	
	
}

function editThis(that){
	var thetext = that.firstChild.innerHTML;
	var theID = that.firstChild.firstChild.innerHTML;
	var theItemA = thetext.split(":");
	$('#recID').val(theID);
	var thegenA = theItemA[0].split("</span>");
	var thegen = thegenA[1];
	$('#gen').val(thegen);
	$('#spec').val(theItemA[1]);
	$('#Cnames').val(theItemA[2]);
	document.lnfForm.submit();
}
