<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Control Panel</title>
<style>
img{
    width: 5vw;
}
</style>
</head>

<body>
<form action="test.php" method="post">
<script src="https://portal2.community-boating.org/pls/apex/CBI_PROD.FLAG_JS" type="text/javascript"></script>
<script src="flags.js" type="text/javascript"></script>
<h3>Change Program</h3>
<input type="radio" name="program" value="ap">Adult Program</>
<input type="radio" name="program" value="jp">Junior Program</>

<h3>Red</h3>
<button type="button">Keelboats Reef</button>
<button type="button">Lagoon Restriction</button>
<button type="button">Two to a jib</button>
<button type="button">Two to a main</button>
<button type="button">Yellow Keel</button>
<button type="button">Yellow Crew</button>
<button type="button">Red Crew</button>
<button type="button">Red Keel</button>

<h3>Yellow</h3>
<button type="button">Green Keel</button>
<button type="button">Green Crew</button>

<h3>Special</h3>   
<button type="button">4th of July</button>
<button type="button">Head of The Charles</button>

<h3>Weather</h3>
<button type="button">Weather Warning</button>    
<button type="button">Half River</button>    
<button type="button">Wetsuits</button>
<button type="button">Sunscreen</button>
<button type="button">Water</button>
<button type="button">Algae</button>

<h3>Other</h3>
<input type="text" name="custom" />
<br />
<br />
<button type="clear">Clear</button>
<button type="submit">Submit</button>
</form>
</body>
</html>