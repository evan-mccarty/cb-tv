/*switch (FLAG_COLOR) {
case "G":
document.write("<img src='images/green.png' id='greenib' alt='Green Flag'>");
break;
case "Y":
document.write("<img src='images/yellow.png' id='yellowib' alt='Yellow Flag'>");
break;
case "R":
document.write("<img src='images/red.png' id='redib' alt='Red Flag'>");
break;
default: // assume closed
document.write("<img src='images/black.png' id='closedib' alt='Closed'>");
}*/

window.addEventListener("load", function(){
	var times = SunCalc.getTimes(new Date(), 42.359810, -71.073056);
	var sunsetStr = times.sunset.getHours() - 12 + ':0' + times.sunset.getMinutes();
	document.getElementById('sunsetib').innerHTML = sunsetStr ;
});

window.addEventListener("load", function(){
	var times = SunCalc.getTimes(new Date(), 42.359810, -71.073056);
    var time = times.sunset.getTime();
    time -= Date.UTC(0, 0, 0, 0, 30, 0, 0);
    var callInTime = new Date(time);
	var callInStr = callInTime.getHours() - 12 + ':';
    if (callInTime.getMinutes() < 10) {
    callInStr += 0;
    }
    callInStr += callInTime.getMinutes();
	document.getElementById('callInib').innerHTML = callInStr;
});