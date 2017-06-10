<?php
  session_start();

  if (isset($_SESSION['username'])) {
      session_start();
      session_destroy();
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet" media="screen">
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
    padding-left: 30vw;    
}

form{
    position: fixed;
    padding-top: 35vh;
    padding-left: 38vw;
    font-family: arial;
}
</style>
  </head>

  <body>
      <h1>Restrictions Display Control Panel</h1>
      <h2>Register:</h2>
      <img src="../images/logo1.png" />
    <div class="container">

      <form class="form-signup" id="usersignup" name="usersignup" method="post" action="createuser.php">
        <input name="newuser" id="newuser" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="email" id="email" type="text" class="form-control" placeholder="Email">
<br />
        <input name="password1" id="password1" type="password" class="form-control" placeholder="Password">
        <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password">
<br />
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: auto;">Submit Registration</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script src="js/signup.js"></script>


    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>

$( "#usersignup" ).validate({
  rules: {
	email: {
		email: true,
		required: true
	},
    password1: {
      required: true,
      minlength: 4
	},
    password2: {
      equalTo: "#password1"
    }
  }
});
</script>

  </body>
</html>
