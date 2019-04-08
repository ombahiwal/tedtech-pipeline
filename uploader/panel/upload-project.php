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
        select{
            width: 100%;
            height: 50px;
        }
        
  
    </style>
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