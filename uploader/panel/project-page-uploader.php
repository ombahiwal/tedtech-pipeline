<!DOCTYPE html>
<?php

session_start();
if(isset($_SESSION['uploader_id']) && $_GET['id']){
$project_id = $_GET['id'];
include('../../connections/db_connection_root.php');
    $user_id = $_SESSION['uploader_id'];
    $prepare2 = pg_prepare($dbconn, "query1", 'SELECT first_name, last_name, organisation, job_title FROM user_info_uploader WHERE uploader_id = $1');

    $result2 = pg_execute($dbconn, "query1", array($user_id));
    $data = pg_fetch_all($result2);
    $username = $data[0]['first_name']." ".$data[0]['last_name'] ;
    $data = 0;
    $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM projects_table WHERE project_id = $1');

    $result = pg_execute($dbconn, "query", array($project_id));
    $data = pg_fetch_all($result);
    $data = $data[0];
    if($data['uploader_id'] != $_SESSION['uploader_id']){
        header("location:index.php");
    }
//    print_r($data);
    
    
    // Fetch Category
    $cat_prepare = pg_prepare($dbconn, "cat", 'SELECT category_name FROM project_category WHERE category_id = $1');
    $cat_result = pg_execute($dbconn, "cat", array($data['category_id']));
    $category = pg_fetch_all($cat_result);
    $category = $category[0]["category_name"];
     
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
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo $data['project_title'];?> | Tedtech.in</title>

  <!-- Bootstrap core CSS -->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/project-page.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
      crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <!-- Bootstrap core CSS -->

    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<script
    src="https://www.paypal.com/sdk/js?client-id=AYxnUkb8nrWavfE-mSnBhLkmHeao882OQbnQfICRe8JI0hwBDe5LpwncVkd4D2CSzD9G0MyWepr3LXCf&currency=INR">
  </script>
   
     <style>
         body{
             margin-top: 60px;
         }
         
        html,body{
    height: 100%
        }
    </style>
    
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    
      <a class="navbar-brand" href="#">
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

        <div class="card mt-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $data['project_title'];?></h2>
              <h5><?php echo $category;?></h5>
            <h4>Budget : &#8377; <?php echo $data['budget'];?></h4>
              
            <p class="card-text"><?php 
                echo $data['description'];
                ?></p>
            <small class="text-muted">
                Posted by <a href="./user-info.php?id=<?php echo $user_id; ?>">
                <?php echo $username;?>
                </a> on <?php echo $data['timestamp'];?></small>
          </div>
        </div>
        <!-- /.card -->

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <center> Click to proceed securely</center><br><br>
        <div id="paypal-button-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
        
          
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Project Bids
          </div>
          <div class="card-body">

              <?php
            
            $query = "SELECT * FROM bids where project_id='{$project_id}'";
            $result = pg_query($query);
            
            if(pg_num_rows($result)){
            while($row = pg_fetch_assoc($result)){
             if($row['status'] =='LIVE'){ 
                $name_query = "select first_name, last_name from user_info_uploader where uploader_id='{$row['uploader_id']}'";    
                $res = pg_query($dbconn, $name_query);
                $name = pg_fetch_assoc($res);
                
                $dev_ongoing_query = "select first_name, last_name, ongoing, user_email from user_info_developer where developer_id='{$row['developer_id']}'";    
                $res2 = pg_query($dbconn, $dev_ongoing_query);
                $ongoing = pg_fetch_assoc($res2);
//                var_dump($ongoing);
                    echo "<p><h5>&#8377; {$row['amount']}</h5>
              {$row['description']}
              </p>
            <small class=\"text-muted\">
                Proposed by <a href=\"../../developer/panel/developer.php?id={$row['developer_id']}\">{$ongoing['first_name']} {$ongoing['last_name']}</a> on {$row['timestamp']}</small><br>";
              if($ongoing['ongoing'] != 'YES'){  
            echo "<form id=\"{$row['bid_id']}\"action=\"../../orders/accept-bid.php\" method=\"POST\">
             <button type=\"button\" onclick=\"updateValue({$row['bid_id']},{$row['amount']})\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\">
                Accept
            </button>
              <input style=\"display:none\" type=\"submit\" name=\"accept\"class=\"btn btn-success\" value=\"Accept\">
              <input type=\"hidden\" value=\"{$row['bid_id']}\" name=\"bid_id\">
              <input type=\"hidden\" value=\"{$row['developer_id']}\" name=\"did\">
               <input type=\"hidden\" value=\"{$project_id}\" name=\"pid\">
               <input type=\"hidden\" value=\"{$ongoing['user_email']}\" name=\"email\">
              </form>
            ";}
                else{
                    echo "<p>Developer is Currently Completing Another Project<p>";
                }
                echo "<hr>\n";
                } else{
                 
                 // Status when ongoing or pending
                 $dev_ongoing_query = "select first_name, last_name, ongoing, user_email from user_info_developer where developer_id='{$row['developer_id']}'";    
                $res2 = pg_query($dbconn, $dev_ongoing_query);
                $ongoing = pg_fetch_assoc($res2);
                 
                 $name_query = "select state from projects_table where project_id='{$project_id}'"; 
                $res = pg_query($dbconn, $name_query);
                 $arr = pg_fetch_assoc($res);
//                var_dump($ongoing);
                echo "BID Status : {$row['status']}<br>Amount : PAID<br>Developement Status : {$arr['state']}<br><br>";
                echo "<small class=\"text-muted\">
                Proposed by <a href=\"../../developer/panel/developer.php?id={$row['developer_id']}\">{$ongoing['first_name']} {$ongoing['last_name']}</a> on {$row['timestamp']}</small><br>";
            }
            } //end loop
                
//                 echo "Developement Status : {$row['state']}";
            }
            else{
               echo "<h5>No Bids Yet..</h5>"; 
            }
            ?>
          
          
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
    
    include('../../footer.php');
    ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        var value = 0;
        var bid_form_id = 0;
        function updateValue(bid_id,val){
            value = val;
            bid_form_id = bid_id;
//            console.log(value);
             
        }
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: value.toString()
          }
            
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
        
        // Call your server to save the transaction
          document.getElementById(bid_form_id.toString()).submit();  
          
        return fetch('/paypal-transaction-complete', {
          method: 'post',
          headers: {
            'content-type': 'application/json'
          },
          body: JSON.stringify({
            orderID: data.orderID
          })
        });
     
      });
        
      
    }
  }).render('#paypal-button-container');
</script>
</body>

</html>
