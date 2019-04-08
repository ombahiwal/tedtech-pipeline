<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['developer_id'])){
//echo "Session User ID : ".$_SESSION['uploader_id']; 

include('../../connections/db_connection_root.php');
    $user_id = $_SESSION['developer_id'];
    $prepare = pg_prepare($dbconn, "query", 'SELECT * from user_info_developer WHERE developer_id = $1');

    $result = pg_execute($dbconn, "query", array($user_id));
    $data = pg_fetch_all($result);
    $data = $data[0];
//    print_r($data);
    
    $query = 
        "SELECT * FROM bids WHERE developer_id ={$user_id}";

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

  <title>TedTech.in | Developer Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
  <!-- Custom styles for this template -->
  <link href="../../styles/uploader-panel.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
      crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
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

    
    
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <center> <b>Are you sure ?</b><br>(Once you confirm, you cannot cancel the project nor you can bid on another projects unless you complete this project.)</center><br>
            
      </div>
      <div class="modal-footer"> 
        <button type="button" onclick="submit_form()"  class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
  <!-- Page Content -->
  <div class="container">

    <div  class="row">
      <div class="col-lg-3">

        <h1 class="my-4">Hi, <?php
            echo $data["first_name"];
            ?></h1>
          
        <div class="list-group">
          <a href="developer.php?id=<?php echo $_SESSION['developer_id'];?>" class="list-group-item">Account Info</a>
            <?php if($_SESSION['ongoing']=='YES'){
            echo '<a href="project-panel.php" class="list-group-item">Ongoing Project</a>';
            }else{
            echo '<a href="../../projects/index.php" class="list-group-item">Find Projects</a>';
                }
                ?>
             <a href="./logout.php" class="list-group-item">Logout</a>
            
<!--          <a href="#" class="list-group-item">View Accepted Projects</a>-->
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
          
<?php
          if(pg_num_rows($result) !=0){
          echo "<h3>Bids Proposed</h3>";
          }
?><br>
          <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Project Bids
          </div>
          <div class="card-body">
       
        <?php
            
            $query = "SELECT * FROM bids where developer_id='{$user_id}'";
            $result = pg_query($query);
             
            if(pg_num_rows($result)){
                $count = 0;
                $pre = 0;
            while($row = pg_fetch_assoc($result)){
                
            
                if($pre != $row['uploader_id']){    
                   $count =1;
                }else{
                 $count++;    
                }
                
                 $name_query = "select project_title, project_id from projects_table where uploader_id='{$row['uploader_id']}'"; 
                $res = pg_query($dbconn, $name_query);
                for($i=0; $i<$count; $i++){
                    $name = pg_fetch_assoc($res);
                }
                
                    echo "<p>
                <h3><a href=\"../../project.php?id={$name['project_id']}\">{$name['project_title']}</a></h3>
                    <h5>&#8377; {$row['amount']}</h5>
              {$row['description']}</p>
            <small class=\"text-muted\">
                Proposed on {$row['timestamp']}</small><br>";
                
                if($row['status'] == 'PENDING' && $_SESSION['ongoing'] !='YES'){
                echo "<br><form id=\"{$row['bid_id']}\" action=\"confirm-project.php\" method=\"POST\">
                 <button type=\"button\" onclick=\"update_values({$row['bid_id']})\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\">
                Confirm
            </button>
              <input type=\"hidden\" value=\"{$row['bid_id']}\" name=\"bid\">
              <input type=\"hidden\" value=\"{$name['project_id']}\" name=\"pid\">
            
              </form><br>
              
              <form action=\"cancel-bid.php\" method=\"POST\">
                 <button type=\"submit\" class=\"btn btn-danger\" data-toggle=\"modal\">
                Cancel
            </button>
              <input type=\"hidden\" value=\"{$row['bid_id']}\" name=\"bid\">
              <input type=\"hidden\" value=\"{$name['project_id']}\" name=\"pid\">
            
              </form>
              <hr>";
                    
            }$pre = $row['uploader_id'];
            }
            // end of loop
                echo "<hr>\n";
            
            }else{
                
               echo "<h5>No Bids Yet..</h5>"; 
                
            }
            ?> 
         
         
        </div>
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
<script>
    var value = 0;
    var submit_form_id = 0;
    function update_values(form_id){
        submit_form_id = form_id;   
    }
    function submit_form(){
        document.getElementById(submit_form_id.toString()).submit();  
    }
    </script>
</body>
<?php
    include('../../footer.php');
    ?>
</html>
