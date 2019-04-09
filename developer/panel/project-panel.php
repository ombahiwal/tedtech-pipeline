<!DOCTYPE html>
<?php
session_start();
//echo "Session User ID : ".$_SESSION['uploader_id']; 

include('../../connections/db_connection_root.php');

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

            
                    
    $user_id = $_SESSION['developer_id'];
    $query = "SELECT * from bids where developer_id='{$user_id}' and status='ACCEPTED'";
    $res = pg_query($dbconn, $query);
    $row = pg_fetch_assoc($res);
    $uploader_id = $row['uploader_id'];
    $project_id = $row['project_id'];
    $start_date = $row['timestamp'];
    $amount = $row['amount'];
            
       ?>
            
  </ul>
     </div>
  </nav>

    
<body>
    <div class="container">

    <div class="row">

      
      <!-- /.col-lg-3 -->
<div class="col-lg-4">
        
     <div  class="card mt-4">
          <div class="card-body">
            <h2 class="card-title">Development Phases</h2>              
              
           
            <small class="text-muted">
               Started on : <?php echo $start_date;?></small>
              <br>
               <p style="color:lightgreen"class="card-text">
                   <?php
                   if(isset($_GET['update'])){
                       echo "Project Phase Updated!!";
                   }
                   ?>
               </p>
          </div>
        
    
        <form action="update-state.php" method="post">
    <div>
    <ul class="list-group">
  <li class="list-group-item">
        
        <div class="form-check">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="Simulation | Requirement Analysis" disabled>Simulation | Requirement Analysis
      </label>
    </div>
        
        </li>
  <li class="list-group-item">
        <div class="form-check">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="Design | Flow Chart" >Design | Flow Chart
      </label>
    </div>
        </li>
  <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio3">
        <input type="radio" class="form-check-input" id="radio3" name="optradio" value="Implementation" >Implementation
      </label>
    </div></li>
  <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio4">
        <input type="radio" class="form-check-input" id="radio4" name="optradio" value="Appraisal">Appraisal 
      </label>
    </div></li>
  <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio5">
        <input type="radio" class="form-check-input" id="radio5" name="optradio" value="Final Evaluation" >Final Evaluation
      </label>
    </div></li>
        
          <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio6">
        <input type="radio" class="form-check-input" id="radio6" name="optradio" value="Implementation and Monitoring" >Implementation and Monitoring
      </label>
    </div></li>
          <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio7">
        <input type="radio" class="form-check-input" id="radio7" name="optradio" value="Waiting for Approval" >Waiting for Approval
      </label>
    </div></li>
          <li class="list-group-item"><div class="form-check">
      <label class="form-check-label" for="radio8">
        <input type="radio" class="form-check-input" id="radio8" name="optradio" value="Ready to Dispatch" disabled>Ready to Dispatch
      </label>
    </div></li>
</ul>
    
    </div><br><br>
            <button class="form-control btn btn-danger" name="update" type="submit">Update Phase</button>
            </form><br><br>
    </div>
        
        </div>
        
        
      <div class="col-lg-8">
<?php
  
    $data = 0;
    $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM projects_table WHERE project_id = $1');

    $result = pg_execute($dbconn, "query", array($project_id));
    $data = pg_fetch_all($result);
    $data = $data[0];
    
    
    $user_id = $data['uploader_id'];
    $prepare2 = pg_prepare($dbconn, "query1", 'SELECT first_name, last_name, organisation, job_title FROM user_info_uploader WHERE uploader_id = $1');

    $result2 = pg_execute($dbconn, "query1", array($user_id));
    $data2 = pg_fetch_all($result2);
    $username = $data2[0]['first_name']." ".$data2[0]['last_name'] ;
//    print_r($data);
    
    // Fetch Category
    $cat_prepare = pg_prepare($dbconn, "cat", 'SELECT category_name FROM project_category WHERE category_id = $1');
    $cat_result = pg_execute($dbconn, "cat", array($data['category_id']));
    $category = pg_fetch_all($cat_result);
    $category = $category[0]["category_name"];
          
          ?>
        <div  class="card mt-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $data['project_title'];?></h2>
              <h5><?php echo $category;?></h5>
            <h5>Bid Amount : &#8377; <?php echo $amount;?></h5>
              <h4>Phase : <?php echo $data['state'];?></h4>
              
              
            <p class="card-text"><?php 
                echo $data['description'];
                ?></p>
              <small> Status : <?php echo $data['status'];?></small><br>
              
            <small class="text-muted">
               Posted by <a href="./uploader/panel/user-info.php?id=<?php echo $user_id; ?>">
                <?php echo $username;?>
                </a> on <?php echo $data['timestamp'];?></small>
          </div>
        </div>
        <!-- /.card -->

    
        <!-- /.card -->
         
      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->
    
    
    </body>
    <?php
    include('../../footer.php');
    ?>
    
    
    
</html>