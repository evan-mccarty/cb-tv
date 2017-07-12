<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="../style.css" rel="stylesheet" media="screen">-->
    <style>
h1{
    position: fixed;
    margin-top: 10vh;
    padding-top: 8vh;
    width: 100vw;
    text-align: center;
    background: #043a91;
    color: white;
    font-family: arial;
    font-size: 20pt;
    left: 0;
}

h2{
    position: fixed;
    margin-top: 25vh;
    width: 100vw;
    text-align: center;
    color: #043a91;
    font-family: arial;
    font-size: 15pt;
    left: 0;
}

img{
    position: fixed;
    padding-top: 32vh;
    padding-left: 38vw;    
}

form{
    position: fixed;
    padding-top: 30vh;
    padding-left: 46vw;
    font-family: arial;
}

pre{
    margin-top: 60vh;
    margin-left: 25vw;
    background-color: #b52727;
    position: fixed;
}
</style>
</head>

<body>
    <h1>Restrictions Display Control Panel</h1>
    <h2>Login:</h2>
    <img src="../images/logo1.png" />
    <div class="container">

        <form class="form-signin" name="form1" method="post" action="checklogin.php">
            <p><input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus></p>
            <p><input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password"></p>
            <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: auto;">Sign in</button>
            <div id="message"></div>
        </form>
<pre>
            
            
    NOTE: This is a development environment version and does not control the TV.                
            
            
        </pre>
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>
    
</body>
</html>