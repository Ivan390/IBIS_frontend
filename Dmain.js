/* Dmain.js*/

function checkStorage(){
	  if (sessionStorage.userRef) {
	    $("#editThis").css("display", "inline");

	  }else {
        $("#editThis").css("display", "none");

	  }
	}

function initForm() {
  document.getElementById("dateBlock").innerHTML = (new Date()).shortFormat();
  starttime();
  checkStorage();
}
