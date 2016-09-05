var lastNum = 0;
function showGuests(){
	var guestList = $('#hiddencatPicsList').html();
	var guestArray = guestList.split("::");
	var guestCount = guestArray.length - 1;
	var dispLimit = 8;
	var shortList ="";
	var theList = "";
	for (c = 0; c <= guestCount; c++){
		guestEntry = guestArray[c].split(":");
		if (guestEntry[0] == ""){
			continue;
		}
		imgsrc = guestEntry[0];
		imgtitle  = guestEntry[1];
		theList += '<img class="thumbpic" src="'+imgsrc+'" title="'+imgtitle +'" />:';
	}
	var listArray = theList.split(":");
	
	for (l=0; l<=dispLimit; l++){
	shortListEntry = listArray[l+lastNum];
	if (l+lastNum >= guestCount){
	break;
	}
	 shortList += listArray[l+lastNum];
	}
	lastNum = lastNum+dispLimit+1;
	if (lastNum >= guestCount){
		lastNum = 0;
		$('#showguests').val("<Show Guests>");
	}else {
		$('#showguests').val("<Show More>");
	}
	$('#catPicsList').html(shortList);
}
