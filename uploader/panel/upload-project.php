<?php 
// Project Upload
include('../../connections/db_connection_root.php');
session_start();
if(!isset($_SESSION['uploader_id'])){
    header('location:i../../index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
       <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <title> TedTech.in | Project Upload.</title>
    <meta name="description" content="Register as a Developer to Tedtech.in"/>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../../styles/style_temp.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="../../favi/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../../favi/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../favi/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../../favi/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../favi/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../../favi/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../../favi/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../../favi/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../favi/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../../favi/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../favi/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../../favi/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../favi/favicon-16x16.png">
<link rel="manifest" href="../../favi/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../../favi/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link rel="stylesheet" href="../../styles/style_temp.css" type="text/css">
<div class="container">
    
  <form id="contact" action="./upload.php" method="post" enctype="multipart/form-data">
      <center><img height="120vmin" src="../../images/logos/logo2.png">
          <br>
    <h3>Project Upload</h3>
    <h4></h4></center>
    <fieldset>
      <input placeholder="Project Title" type="text" tabindex="1" name="title" value="" autofocus required>
      <span class="error"></span>
    </fieldset>
      
      <fieldset>
           <span class="error"><?php
        if(isset($_GET['desc'])){echo "The description must be of more than 60 words"; }
               ?></span>
          <textarea  placeholder="Project Abstract or Description...(min. 60 words)" tabindex="2" name="description" required></textarea>
     
    </fieldset>
 
        <fieldset>
              <span class="error"><?php
        if(isset($_GET['cat'])){echo "Select a valid Category"; }
               ?></span>
            
            <select required name="category">
                 <option value="" disabled selected>Select Category</option>      
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
            
            
    </fieldset>
<fieldset>
 <input type="text" placeholder="Tags - eg. AI, ML, DIP, etc." name="tags"  title="Enter The Key Points in your Project with comma seperated Tags eg.- AI, ML. It makes your project easier to search" required /> 
      </fieldset>
      
       <fieldset>
           <span class="error"><?php
        if(isset($_GET['budget'])){echo "The Budget should be greater than or equal to INR 500"; }
               ?></span>
           <table>
               <tr>
               <td><span style="color:white;">Budget : </span></td>
                   <td style="color:white">&#8377;  <input style="color:black" type="number" min="1000" placeholder="INR" name="budget"  title="Enter Your Project Budget in INR"  onkeyup='check();' required /> </td>
               </tr>
               <Tr>
               <td>-</td>
                   <td>-</td>
               </Tr>
               
 
</table>
      </fieldset>
 
      
     <fieldset style="color:white;">
     <label class="customcheck">I agree to the <a href="#">terms and conditions</a> and <a target="_blank" href="../../docs/privacy-policy.txt">privacy policy</a>
          <input name="agreement" id="agreement" type="checkbox" title="please accept the terms to proceed" required>
          <span class="checkmark"></span>
        </label>
      </fieldset>
     
    <fieldset>
      <button id="submit" name="send" type="submit" id="contact-submit" data-submit="...Sending">Post Project</button>
    </fieldset>
  </form>
</div>

    </body>
    <footer>
    &#9400; 2018 - TedTech.in
    </footer>
    <script>
        
  
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
    

        
    </script>

</html>