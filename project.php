<!DOCTYPE html>
<?php

session_start();
if(isset($_GET['id'])){
    
$project_id = $_GET['id'];
include('connections/db_connection_root.php');

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
    
}else{
    header("location:index.php");
}

?>



<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $data['project_title'];?> | Tedtech.in</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="styles/project-page.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
 <?php
    
//    include('../../header.php');
    
    ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      
      <!-- /.col-lg-3 -->
<div class="col-lg-2"></div>
      <div class="col-lg-8">

        <div  class="card mt-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $data['project_title'];?></h2>
              <h5><?php echo $category;?></h5>
            <h4>Budget : &#8377; <?php echo $data['budget'];?></h4>
              
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

          
        <div <?php if(isset($_SESSION['uploader_id']) && $data['status'] != 'LIVE'){   echo "style=\"display:none\"";} if(isset($_SESSION['ongoing'])){ if($_SESSION['ongoing'] == 'YES'){echo "style=\"display:none\"";}}?> class="card card-outline-secondary my-4">
          <div class="card-header">
            Propose a Bid
          </div>
          <div class="card-body">            
              <?php
 if(isset($_GET['already'])){
              echo '<p style="color:red">You have already bid on this project!</p>';}
              
               if(isset($_GET['ongoing'])){
              echo '<p style="color:red">You Currently have an Ongoing project..</p>';}
              ?>       
           <form method="post" action="<?php
            if(isset($_SESSION['developer_id'])){
                echo "orders/bid.php";   
            }else{
              echo "./developer/panel/index.php"; 
            }  ?>">
              <?php if(isset($_SESSION['developer_id'])){
                echo "<input type=\"hidden\" value=\"{$data['project_id']}\" name=\"pid\">";
                echo "<input type=\"hidden\" value=\"{$user_id}\" name=\"uid\">";
            }?>
             
            Amount : 
            <p><h5><input type="number"  class= "form-control" name="bid_amount" placeholder="&#8377; INR" min="500" max="<?php echo $data['budget']; ?>" required></h5>
              <br>
              Proposal :<br>
              <p>
              <textarea class="form-control" name="proposal_text" placeholder="Write your proposal here..." required>

              </textarea>
              </p>
            <br>
              <input class="form-control btn btn-success" type="submit" value="Propose a Bid">
            <hr>
               </form>
          </div>
        </div>
        <!-- /.card -->
         
      </div>
      <!-- /.col-lg-9 -->
<div class="col-lg-2">
<!--
        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item active">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div>
-->
      </div>
    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
    
    include('footer.php');
    ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
