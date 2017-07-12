//setTimeout(flagColor, 5000);
//var flagColor = function() {
//Console.log("derp");

window.addEventListener("load", function(){
	setFlagUpdateInterval();
});

var setFlagUpdateInterval = function(){
	setInterval(function(){
		updateFlagColor();
	}, 5000);
	updateFlagColor();
}

var updateFlagColor = function(){
	console.log("tried");
	//var img = document.getElementById("flag-img");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     //document.getElementById("demo").innerHTML = this.responseText;
     evaluateFlagChange(this);
    }
  };
  xhttp.open("GET", "flagcolor.php", true);
  xhttp.send();
}

var evaluateFlagChange = function(darth){
	var FLAG_COLOR = null;
	eval(darth.responseText);
	console.log(darth.responseText);
	if(FLAG_COLOR == null){
		console.log("flag value was not gotten ok!!!!");
	}else{
		var flagelemitertrons = document.getElementsByClassName("flag_img");
		for(var i = 0; i < flagelemitertrons.length; i++){
			var flagelem = flagelemitertrons[i];
			switch (FLAG_COLOR) {
				case "G":
				flagelem.src = "images/green.png";
				flagelem.id="green";
				flagelem.alt="Green Flag";
				//document.write("<img src='images/green.png' id='green' alt='Green Flag'>");
				break;
				case "Y":
				flagelem.src = "images/yellow.png";
				flagelem.id="yellow";
				flagelem.alt="Yellow Flag";
				//document.write("<img src='images/yellow.png' id='yellow' alt='Yellow Flag'>");
				break;
				case "R":
				flagelem.src = "images/red.png";
				flagelem.id="red";
				flagelem.alt="Red Flag";
				//document.write("<img src='images/red.png' id='red' alt='Red Flag'>");
				break;
				default: // assume closed
				flagelem.src = "images/black.png";
				flagelem.id="closed";
				flagelem.alt="Closed";
				//document.write("<img src='images/black.png' id='closed' alt='Closed'>");
				}
			}
	}
}
//}