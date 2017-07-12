<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Restrictions Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="form-signin">
            <script src="https://portal2.community-boating.org/pls/apex/CBI_PROD.FLAG_JS" type="text/javascript"></script>
            <script src="flags.js" type="text/javascript"></script>
            <form action="test.php" method="post">
                <div id="header">
                    <h1>Restrictions Control Panel</h1>
                </div>
                <div id="program">
                    <h3>Change Program</h3>
                    <input type="radio" name="program" value="ap" /> Adult Program
                    <input type="radio" name="program" value="jp" /> Junior Program
                </div>
                <div id="redrs">
                    <h3>Red Restrictions</h3>
                    <button type="button">Keelboats Reef</button>
                    <button type="button">Lagoon Restriction</button>
                    <button type="button">Two to a jib</button>
                    <button type="button">Two to a main</button>
                    <button type="button">Yellow Keel</button>
                    <button type="button">Yellow Crew</button>
                    <button type="button">Red Crew</button>
                    <button type="button">Red Keel</button>
                </div>
                <div id="yellowrs">
                    <h3>Yellow Restrictions</h3>
                    <button type="button">Green Keel</button>
                    <button type="button">Green Crew</button>
                </div>
                <div id="otherrs">
                    <h3>Other Restrictions</h3>   
                    <button type="button">Use Blue Sails</button>
                    <button type="button">Use Pink Sails</button>
                    <button type="button">Barges</button>
                    <button type="button">4th of July</button>
                    <button type="button">Head of The Charles</button>
                </div>
                <div id="weatherrs">
                    <h3>Weather Restrictions</h3>
                    <button type="button">Weather Warning</button>    
                    <button type="button">1/2 River</button>
                    <button type="button">1/4 River</button>
                    <button type="button">3/4 River</button>    
                    <button type="button">Wetsuits</button>
                    <button type="button">Sunscreen</button>
                    <button type="button">Drink Water</button>
                    <button type="button">Algae Bloom</button>
                </div>
                <div id="customrs">
                    <h3>Custom Restriction</h3>
                    <input type="text" name="custom" style="width: 25vw;"/>
                </div>
                <div id="controls">
                    <br />
                    <br />
                    <button type="clear" style="width: 7vw; margin-left: 8vw;">Clear</button>
                    <button type="submit" style="width: 7vw;">Submit</button>
                </div>
            </form>
            <div id="logout">
                <a href="login/logout.php"><button style="width: 5vw;">Logout</button></a>
            </div>
        </div>
    </div> <!-- /container -->
</body>
</html>