/*
 need to make sure input values are valid for their type and
 restricted in length
 
*/
function submitRegistration(){
  var fName = document.getElementById("fName").value;
  var secA = document.getElementById("secA").value;
  
  if (fName.length > 10 || secA.length > 20){
    alert("please keep your name less than 10 characters and your security answer to less than 20" );
    exit();
  }else{
    document.registerForm.submit();
  }
}
