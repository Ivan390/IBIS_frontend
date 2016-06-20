/* main.js*/
Date.prototype.shortFormat = function() {
  var myDate = Date();
  var dateString = myDate.split(" ");
  var theDay = dateString[0];
  var theMonth = dateString[1];
  var theDate = dateString[2];
  var theYear = dateString[3];
  var formDate = theDay + " " + theMonth + " " + theDate + " " + theYear;
  return(formDate);
}

function starttime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m=checkTime(m);
  s=checkTime(s);
  document.getElementById("timeBlock").innerHTML = h + ":" + m + ":" + s;
  t=setTimeout(function(){starttime()}, 500);
}

function checkTime(i) {
  if ( i < 10) {
    i = "0" + i;
  }
return i;
}