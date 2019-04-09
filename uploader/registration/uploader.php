<!DOCTYPE html>
<?php
error_reporting(0);
include('../../connections/db_connection_root.php');

    $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM user_info_uploader WHERE uploader_id = $1');
    $result = pg_execute($dbconn, "query", array($_GET['id']));
    $data = pg_fetch_all($result);
    $data = $data[0];
//    print_r($data);
    $data = array_filter($data);

?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Tedtech.in Get the Best">
  <meta name="author" content="Omkar Bahiwal">

  <title><?php echo $data['first_name']." ".$data['last_name']?> - Tedtech.in</title>
 
  <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Custom styles for this template -->

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
            font-size: 1.5rem;
        }
    </style>

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

  <!-- Navigation -->
  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
<!--        <h1 class="my-4">Omkar Bahiwal</h1>--><br>
             
    <!--
        <div class="list-group">
          <a href="#" class="list-group-item active">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div>
-->
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-6">

        
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
           Uploader Profile Description
          </div>
          <div class="card-body">
              <h1><?php echo $data['first_name']." ".$data['last_name'];?></h1>
              <hr>
              <h3>Designation</h3>
                <p><?php echo $data['job_title'];?></p>
              <hr>
        
              <h3>Organisation</h3>
                <p><?php echo $data['organisation'];?></p>
              <hr>
              <?php if(isset($data['linkedin'])){
            echo "<h3><a href=". $data['linkedin']." target=\"_blank\">LinkedIn</a></h3>";}?>
            <hr>
              
               <h3>User since</h3>
                <p><?php echo $data['timestamp'];?></p>
              <hr>

            
<!--            <a href="#" class="btn btn-success">Leave a Review</a>-->
          </div>
        </div>
          
        <!-- /.card -->

      </div>
        <div class="col-lg-3">
      <!-- /.col-lg-9 -->
<div class="card mt-4">
          
        </div>
    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->

      
      
      

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
