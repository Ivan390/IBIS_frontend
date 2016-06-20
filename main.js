/* main.js*/

function checkStorage(){
	  if (sessionStorage.userRef) {
	    $("#loginhead").css("display", "none");
	    $("#logouthead").css("display", "block");
	     $("#registerBlock").addClass("locked");
	    $("#registerBlock a").removeAttr("href")  ;
	  }else {
        $("#loginhead").css("display", "block");
	    $("#logouthead").css("display", "none");
	     $("#registerBlock").removeClass("locked ").addClass("adminC");

	  }
	}
	

function initForm() {
  document.getElementById("dateBlock").innerHTML = (new Date()).shortFormat();
  starttime();
  picswaps();
  checkStorage();
}

