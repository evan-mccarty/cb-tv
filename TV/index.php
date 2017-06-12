<!DOCTYPE HTML>
<html>
<head>
    <!--<meta charset="utf-8" http-equiv="refresh" content="80">-->
    <title>Front Office Display</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type='text/javascript' src='restrictions.js'></script>
    <script type="text/javascript" src='slides.js'></script>
    <script src="flags.js" type="text/javascript"></script>
<script>
window.addEventListener("load", function(){
setInterval(function(){
getProgram();
}, 5000);
});
var getProgram = function(){
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    if(this.responseText == "ADULT"){
}else if(this.responseText == "JUNIOR"){
  window.location.href = "jpdisplay.html";
  }else{
console.log("Error in response" + this.responseText);
}
  }
};
xhttp.open("GET", "program.php", true);
xhttp.send();
}
</script>
    <style>

    /* Slideshow container
    .slideshow-container {
        width: 100vw;
        height: 100vh;
        position: relative;
        margin: auto;
    }

    .mySlides {
        display: none;
    }*/
    </style>
</head>

<body onload="startTime()">
    <div class="slideshow-container">
        <div class="mySlides fade" id="mainpanel" data-slide-time="26000" data-slide-index="0,2">
            <div class="content">
                <div class="header">
                    <h1>Welcome to Community Boating!</h1>
                </div>

                <div class="disp">
                    <div class="flag">
                        <img class="flag_img img_normal"></img>
                    </div>
    
                    <div class="times">
                        <script src="time.js"></script><div id="clock"></div>
                        <h2>Sunset: <script src="suncalc.js" type="text/javascript"></script><script src="sunset.js"></script><div id="sunset"></div></h2>
                    </div>
    
                    <div class="classes">
                        <iframe src="http://info.community-boating.org/ap-class-instances" style="border-width: 4; border-color: LightGrey; border-style: solid; -ms-zoom: 0.9; -moz-transform: scale(0.9); -moz-transform-origin: 0 0; -o-transform: scale(0.9); -o-transform-origin: 0 0; -webkit-transform: scale(0.9); -webkit-transform-origin: 0 0;" height="1000" width="900" ></iframe>
                    </div>

                    <div class="notes" style="text">
                        <script src="sunset.js"></script>
                        <div class="restrictions">
                            <div id="restrictions-state-settings" class="restrictions-show" data-restrictions-type="settings">
                                <div class="button-holder"><span>
                                    <button data-button-type="restriction" data-restriction-text="Keelboats must reef! Kayaks may only paddle in the lagoons!">Red Restrictions</button>
                                    <button data-button-type="restriction" data-restriction-text="All boats are restricted to half river!">Half River</button>
                                    <button data-button-type="restriction" data-restriction-text="Wetsuits are required for high performance boats and windsurfs.">Wetsuits</button>
                                    <button data-button-type="restriction" data-restriction-text="Minimum of two sailors to a mercury with jib.">2 To Jib</button>
                                    <button data-button-type="restriction" data-restriction-text="Two to a main, no fewer than two sailors to any mercury!">2 To Main</button>
                                    <button data-button-type="restriction" data-restriction-text="Chance of incliment weather: Stay alert and check the American flag frequently.">Weather Warning</button>
                                    <button data-button-type="restriction" data-restriction-text="Green rated sailors may crew only. No keels for green sailors.">Green Crew</button>
                                    <button data-button-type="restriction" data-restriction-text="Yellow rated sailors may crew only. No keels for yellow sailors.">Yellow Crew</button>
                                    <button data-button-type="restriction" data-restriction-text="Green rated sailors must use keel mercuries.">Green Keel</button>
                                    <button data-button-type="restriction" data-restriction-text="Yellow rated sailors must use keel mercuries.">Yellow Keel</button>
                                    <button data-button-type="restriction" data-restriction-text="Red rated sailors must use keel mercuries.">Red Keel</button>
                                    <button data-button-type="restriction" data-restriction-text="The lagoons are closed to paddling. All boats keep off fireworks barge at least 200ft.
                                    DO NOT ENTER THE RESTRICTED AREA.">4th of July</button>
                                </span></div>
                                <div class="button-holder"><span>
                                    <button data-button-type="submit">Submit</button>
                                    <button data-button-type="clear">Clear</button>
                                </span></div>
                            </div>
                            <div id="restrictions-state-display-1" class="restrictions-show" data-restrictions-type="display" data-restrictions-size="0" data-timeout-delay="4000">
                                <p>Mercuries are due back by <strong>sunset.</strong> All other boats are due back by: <strong id="callIn"></strong></p>
                                <p>Please Validate Your Parking Before Going On The Water</p>
                            </div>
                            <div id="restrictions-state-display-2" class="restrictions-show" data-restrictions-type="display" data-restrictions-size="2" data-timeout-delay="6000">
                            </div>
                            <div id="restrictions-state-display-3" class="restrictions-show" data-restrictions-type="display" data-restrictions-size="2" data-timeout-delay="6000">
                            </div>
                            <div id="restrictions-state-display-4" class="restrictions-show" data-restrictions-type="display" data-restrictions-size="2" data-timeout-delay="6000">
                            </div>
                            <div id="restrictions-state-display-5" class="restrictions-show" data-restrictions-type="display" data-restrictions-size="2" data-timeout-delay="6000">
                            </div>
                        </div>
                    </div>
                    <script src="restrictions.js" type="text/javascript"></script>
        
                    <div class="supporters" style="margin-left: 2vw; margin-top: 80vh;">
                        <img style="height: 10vw;" src="images/logo.png">
                        <img style="height: 10vw;" src="images/dcr.png">
                        <img style="height: 10vw; margin-left: 2vw;" src="images/csc.png">
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="mySlides fade" id="adpanel" data-slide-time="4000" data-slide-index="1">
            <img style="position: fixed; margin-left: 5% auto; margin-right: 5% auto; left: 0; right: 0; height: 100vh; overflow: hidden; top: 0;" src="https://docs.google.com/drawings/d/1ZypL9eMtICE_C5ePlK2ICgmfZuKs4VjYElmt-CFokcU/pub?w=2009&amp;h=1160">
        </div>-->
        
        <div class="mySlides fade" id="socialpanel" data-slide-time="6000" data-slide-index="1,3">
            <div class="container">
                <div class="infobar">
                    <!--<script src="https://portal2.community-boating.org/pls/apex/CBI_PROD.FLAG_JS" type="text/javascript"></script>-->
                    <script src="infobox.js" type="text/javascript"></script>
                    <img class="flag_img img_ib"></img>
                    <div id="ibtimehead">
                        <div style="position: fixed; top: 5vh; left: 40vw;">Time: <strong id="clockib"></strong></p>
                        <div style="position: fixed; top: 5vh; left: 60vw;">Sunset: <strong id="sunsetib"></strong></p>
                        <div style="position: fixed; top: 5vh; left: 80vw;">H.P./Keels: <strong id="callInib"></strong></div>
                    </div>    
                </div>
                <iframe src="http://info.community-boating.org/ap-class-instances" style="position: fixed; border-width: 4; border-color: LightGrey; border-style: solid;  -ms-zoom: 1.0; -moz-transform: scale(1.0); -moz-transform-origin: 0 0; -o-transform: scale(1.0); -o-transform-origin: 0 0; -webkit-transform: scale(1.0); -webkit-transform-origin: 0 0; margin-left: 3vw; margin-top: 6vh;" height="820" width="900" ></iframe>
                <div class="socialBar">
                    <div class="social" id="facebook">
                        <img src="images/facebook.png" alt="Facebook" style="width: 10vw;" /><p>@CommunityBoating</p>
                    </div>
                    <div class="social" id="twitter">
                        <img src="images/twitter.png" alt="Twitter" style="width: 10vw;"/><p>@SailCBI</p>
                    </div>
                    <div class="social" id="instagram">
                        <img src="images/instagram.png" alt="Instagram" style="width: 10vw;"/><p>@sailcbi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>