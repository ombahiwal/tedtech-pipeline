<?php 
if(!isset($_SESSION['uploader_id'])){
//  GO to home page
//    header('location:../../index.html');
}else{
    header('location:index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
       <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <title> TedTech.in | Uploader Login</title>
    <meta name="description" content="Register as a Developer to Tedtech.in"/>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="../../favi/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../../favi/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../favi/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../../favi/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../favi/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../../favi/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../../favi/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../../favi/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../favi/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../../favi/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../favi/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../../favi/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../favi/favicon-16x16.png">
<link rel="manifest" href="../../favi/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../../favi/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
     <style>
        html,body{
    height: 100%
        }
    </style>
<body>

    <link rel="stylesheet" href="../../styles/style_temp.css" type="text/css">
<div class="container">
    
  <form id="contact" action="./create-session.php" method="post" enctype="multipart/form-data">
      <center><img height="120vmin" src="../../images/logos/logo2.png">
          <br>
    <h3>Uploader Login</h3>
    <h4></h4></center>
   <center><span class="error">
        
         <?php
         if(isset($_GET['incorrect'])){
        echo" Username or Password incorrect";
        }
         ?>
        </span></center> 
    <fieldset>
      <input placeholder="Your Email Address" type="email" name="email" value="" tabindex="3" required>
    </fieldset>

    
      
      <fieldset>
      <input placeholder="Enter Password" name="password" id="password" type="password" onkeyup='check();' data-toggle="tooltip" data-placement="right" title=" Password must contain at least one digit/lowercase/uppercase letter and be at least six characters long " pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required />
          <span class="error" id='message'></span> <span class="error" id="success"> </span>
      </fieldset>
     
      

      
     <fieldset style="color:white;">
         Not a member yet? <a href="../registration/index.php">Join Now</a>
      </fieldset>
      
    <fieldset>
      <button id="submit" name="send" type="submit" id="contact-submit" data-submit="...Sending">Login</button>
    </fieldset>
  </form>
</div>

    </body>
    <footer>
    &#9400; TedTech - 2019
    </footer>

</html>