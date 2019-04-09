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

  <title>TedTech.in | Find Projects</title>

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
<?php include('../favicon.php');?>    
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

  <!-- Page Content -->
   
  <div class="container">
    <div  class="row">
      <div class="col-lg-1">
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9"><br>
           <h3>Find Projects</h3><br>
          <form class="form-inline" method="post" action="./index.php">
  <div style="width:52%" class="form-group">
    <label for="query"></label>
    <input style="width:98%"  type="text" class="form-control" name="query" id="query" placeholder="Search Projects...">
  </div>
              
               <select  class="form-control" name="category">
                 <option value="" disabled selected>All</option>      
               <?php 
                try{
                $query = "SELECT * FROM project_category";
    $result = pg_query($query);
    if (!$result) {
        echo "Problem with query " . $query . "<br/>";
        echo pg_last_error();
        exit();
    }
    while($row = pg_fetch_assoc($result)){
        echo "<option value=\"{$row['category_id']}\">{$row['category_name']}</option>
        ";
    }    
}catch(PDOException $e){
    echo $e->getMessage();
}
                ?>    
                
</select>
            
              
  <button style="margin-left:5px" type="submit" class="form-control btn btn-primary">Search</button>
</form>
<?php
          
             if(isset($_POST['query'])){
                 $query_string = $_POST['query'];
             if(!isset($_POST['category'])){
    $query = 
        "SELECT * FROM projects_table WHERE LOWER(project_title) LIKE LOWER('{$query_string}%')  or LOWER(tags) LIKE LOWER('{$query_string}%')";
             }else{
                 $query = 
        "SELECT * FROM projects_table WHERE LOWER(project_title) LIKE LOWER('{$query_string}%') and category_id='{$_POST['category']}'";
             }
    }else{
                 $query = "SELECT * FROM projects_table LIMIT 30";
             }
    $result = pg_query($dbconn ,$query);    
?><br>
        <div  class="row">
        <?php
            if(pg_num_rows($result)==0){
                echo "<h3>No Projects Found...</h3>";
            }else{
                
                
            
        while($row = pg_fetch_assoc($result)){
            echo "<div class=\"col-lg-4 col-md-6 mb-4\">
            <div class=\"card h-100\">
              <div class=\"card-body\">
                <h4 class=\"card-title\">
                  <a href=\"../project.php?id={$row['project_id']}\">{$row['project_title']}</a>
                </h4>
                <h5>Budget : &#8377;{$row['budget']}</h5>
              </div>
              <div class=\"card-footer\">
              </div>
            </div>
          </div>\n";

            } } 
                 
                 
             
          ?>  
         

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
    <br>
 <?php include('../footer.php');?>    

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
<?php
//    include('../footer.php');
    ?>
</html>
