function initthisForm(){
var something = "thisthing";
$.ajax({
	url : '../../cgi-bin/lnf.php3',
	type : 'post',
	data : {name1:something},
	success : function(data){
	var listA = data.split("::");
	var ImagesList = listA[0];
	var NamesList = listA[1];
	
	$('#LostBlock').append(ImagesList);
	$('#FoundBlock').append(NamesList);
	}
	
})
}
