<!DOCTYPE html>
<?php
session_start();
//echo "Session User ID : ".$_SESSION['uploader_id']; 

include('../connections/db_connection_root.php');

?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TedTech.in | Project Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

    
     <style>
         body{
             margin-top: 60px;
         }
         
        html,body{
    height: 100%
        }
    </style>
   
    
    
    
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    
      <a class="navbar-brand" href="https://tedtech.in">
          <img src="http://tedtech.in/images/logos/logo_nav.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      
      
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            
    

            <li class="nav-item"><form method="post" class="form-inline navbar-right" action="http://tedtech.in/projects/index.php">
    <input class="form-control mr-sm-2 mb-2" type="text" placeholder="Search projects..." name="query">
    <button class="btn btn-danger mr-sm-2 mb-2" type="submit">Search</button>
  </form></li>
            
            <?php if(isset($_SESSION['uploader_id'])){
            echo '<li class="nav-item">
      <a class="nav-link" href="http://tedtech.in/uploader/panel/logout.php">Logout</a>
    </li>';
        }
            if(isset($_SESSION['developer_id'])){
            echo '<li class="nav-item">
      <a class="nav-link" href="http://tedtech.in/developer/panel/logout.php">Logout</a>
    </li>';
        }
    
            
     if(!isset($_SESSION['developer_id']) && !isset($_SESSION['uploader_id'])){       
    echo '<li class="nav-item dropdown" style="margin-right:10px">
      <a class="btn btn-default nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        LOGIN
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="http://tedtech.in/developer/panel/index.php">Developer</a>
        <a class="dropdown-item" href="http://tedtech.in/uploader/panel/login.php">Uploader</a>
      </div>
    </li>';}
       ?>
            
  </ul>
     </div>
  </nav>

    
<body>
    </body>
    
    
    
    
</html>