<!DOCTYPE html>
<?php
session_start();
//echo "Session User ID : ".$_SESSION['uploader_id']; 

include('../connections/db_connection_root.php');

//    print_r($data);
    
    $query = 
        "SELECT * FROM projects_table";

    $result = pg_query($dbconn ,$query);
    

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

  <!-- Custom styles for this template -->

</head>
<Style>
    body{margin-top: 50px;}
    </Style>
    
<body>

  <!-- Page Content -->
  <div class="container">
    <div  class="row">
      <div class="col-lg-1">
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
          
<?php
          if(pg_num_rows($result) !=0){
          echo "<h3>Find Projects</h3>";
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
 

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
<?php
//    include('../footer.php');
    ?>
</html>
