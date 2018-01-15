/*
 need to make sure input values are valid for their type and
 restricted in length
 
*/
function submitRegistration(){
  var fName = $("#fName").val();
  var secA = $("#secA").val();
  
  if (fName.length > 10){
  alert("please keep your name less than 10 characters" );
    exit();
  }if( secA.length > 20){
    alert("please keep your security answer to less than 20 characters" );
    exit();
  }else{
    document.registerForm.submit();
  }
}
////-> submit registration to server and receive results into floating dialog
function handleSubmition(){

} 
