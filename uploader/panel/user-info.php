<!DOCTYPE html>
<?php

if(isset($_GET['id'])){
include('../../connections/db_connection_root.php');
    $user_id = $_GET['id'];
    $prepare2 = pg_prepare($dbconn, "query1", 'SELECT first_name, last_name, organisation, job_title FROM user_info_uploader WHERE uploader_id = $1');

    $result2 = pg_execute($dbconn, "query1", array($user_id));
    $data = pg_fetch_all($result2);
    $data = $data[0];
    
    
    $prepare = pg_prepare($dbconn, "query", 'SELECT project_title, project_id FROM projects_table WHERE uploader_id = $1');

    $result = pg_execute($dbconn, "query", array($user_id));
    $data2 = pg_fetch_all($result);
    $data2 = $data2[0];
    
    
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

  <title><?php echo $data['first_name']." ".$data['last_name']; ?> - Tedtech.in</title>
 
  <!-- Bootstrap core CSS -->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="../../styles/uploader-panel.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
<!--        <h1 class="my-4">Omkar Bahiwal</h1>--><br>
                 <div class="card" >
    
      <div class="card-body">
        <h2 class="card-title"><?php echo $data['first_name']." ".$data['last_name']; ?></h2>
        <p class="card-text"><?php
            echo $data['job_title']."<br>".$data['organisation'];
            ?></p>
        
      </div>
    </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
          <h3>Projects Posted</h3>
          </div>
          <div class="card-body">
            <?php
              if(pg_num_rows($result) != 0){
                  
                  while($row = pg_fetch_assoc($result)){
              echo "<h4><a href=\"../../project.php?id={$row['project_id']}\">{$row['project_title']}</a></h4>\n<hr>";
              }}else{
                  echo "No Projects Posted yet";
              }
              ?>
<!--            <a href="#" class="btn btn-success">Leave a Review</a>-->
          </div>
        </div>
          
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->
<div class="card mt-4">
          
        </div>
    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
