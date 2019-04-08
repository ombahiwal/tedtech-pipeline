<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['uploader_id'])){
//echo "Session User ID : ".$_SESSION['uploader_id']; 

include('../../connections/db_connection_root.php');
    $user_id = $_SESSION['uploader_id'];
    $prepare = pg_prepare($dbconn, "query", 'SELECT first_name, last_name, organisation, job_title FROM user_info_uploader WHERE uploader_id = $1');

    $result = pg_execute($dbconn, "query", array($user_id));
    $data = pg_fetch_all($result);
    $data = $data[0];
//    print_r($data);
    
    $query = 
        "SELECT * FROM projects_table WHERE uploader_id ={$user_id}";

    $result = pg_query($query);
    
    
    
    
    
        
}else{
     header("location:../../index.php");
}
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TedTech.in | Uploader Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap core CSS -->

    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="../../styles/uploader-panel.css" rel="stylesheet">

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
      <div class="col-lg-3">

        <h1 class="my-4">Hi, <?php
            echo $data["first_name"];
            ?></h1>
        <p class="my-4"><b><?php echo $data['job_title']."<br>".$data["organisation"];?></b></p>
          
        <div class="list-group">
          <a href="../registration/uploader.php?id=<?php echo $_SESSION['uploader_id'];?>" class="list-group-item">Account Info</a>
          <a href="upload-project.php" class="list-group-item">Upload a New Project</a>
          <a href="./logout.php" class="list-group-item">Logout</a>
            
<!--          <a href="#" class="list-group-item">View Accepted Projects</a>-->
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
          
<?php
          if(pg_num_rows($result) !=0){
          echo "<h3>Your Projects</h3>";
          }
?><br>
        <div  class="row">
        <?php
            if(pg_num_rows($result)==0){
                echo "<h3>No Projects Yet..</h3>";
            }else{
            
        while($row = pg_fetch_assoc($result)){
            echo "<div class=\"col-lg-4 col-md-6 mb-4\">
            <div class=\"card h-100\">
              <div class=\"card-body\">
                <h4 class=\"card-title\">
                  <a href=\"project-page-uploader.php?id={$row['project_id']}\">{$row['project_title']}</a>
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
 

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
<?php
    include('../../footer.php');
    ?>
</html>
