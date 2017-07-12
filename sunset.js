window.addEventListener("load", function(){
	var times = SunCalc.getTimes(new Date(), 42.359810, -71.073056);
	var sunsetStr = times.sunset.getHours() - 12 + ':0' + times.sunset.getMinutes(); //check js Date object info to see if this is the correct method to get hte minutes. Perhaps tolocalestring
	document.getElementById('sunset').innerHTML = sunsetStr ;
});

//Call In time is half an hour before sunset.
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
	document.getElementById('callIn').innerHTML = callInStr;
});