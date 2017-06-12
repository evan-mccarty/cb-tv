function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    h = formatTime(h);
    m = checkTime(m);
    document.getElementById('clock').innerHTML = h + ":" + m;
    document.getElementById('clockib').innerHTML = h + ":" + m;
    var t = setInterval(startTime, 500);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};   //add zero in front of numbers < 10
    return i;
}

function formatTime(i) {
    if (i > 12) {i = i - 12};
    if (i == 0) {i = 12};
    return i;
}