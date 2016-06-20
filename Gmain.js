/* Gmain.js*/

function initForm() {
  document.getElementById("dateBlock").innerHTML = (new Date()).shortFormat();
  starttime();
 var emptyStuffList = document.getElementsByName("FQNname");
 
 for (count=0; count < emptyStuffList.length; count++){
  if (emptyStuffList[count].innerHTML == ""){
    emptyStuffList[count].innerHTML = "noinfo";
    
  
  }
  //alert(emptyStuffList[count].innerHTML);
 }
 if (sessionStorage.userRef){
	$("#editDetails").css("display", "inline");
	}else {
	$("#editDetails").css("display", "none");
	}
 }
 function show_oDD(that){
 var theValue = that.parentNode.lastChild.innerHTML;
// alert(theValue);
$(".oDHClass").css("color","black");
if (document.getElementById("oDDOutput") === null){
  document.getElementById("oDDOutputMin").innerHTML = theValue;
}else{
document.getElementById("oDDOutput").innerHTML = theValue;
}
 

 that.style.color = "green";
  
 }
