/* Gmain.js*/

function initForm() {
  $('#dateBlock').html(new Date().shortFormat());
  starttime();
	var emptyStuffList = $(".FQNname");
	for (count=0; count < emptyStuffList.length; count++){
		if ($(emptyStuffList[count]).html()==""){
		  $(emptyStuffList[count]).html('noinfo');
		}
	}
 	if (sessionStorage.userRef){
		$("#editDetails").css("display", "inline");
	}else {
		$("#editDetails").css("display", "none");
	}
}
 function show_oDD(that){
 	var theValue = that.parentNode.lastChild.innerHTML;
  $(".oDHClass").css("color","black");
  $("#oDDOutput").html(theValue);
  that.style.color = "green";
}
