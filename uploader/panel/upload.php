<?php
session_start();
if(isset($_POST['send']) && isset($_SESSION['uploader_id'])){
    include('../../connections/db_connection_root.php');
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $budget = $_POST['budget'];
    
    //Set Word Limit
    
    $words = 60;
        // Set Budget Limit
    $budget_limit = 500.0;
        
    // Check if words greater than 60
    if(count(explode(" ", $desc)) < $words){
        header("location:upload-project.php?desc=invalid");
    }
    
    if($budget < $budget_limit){
        header("location:upload-project.php?budget=invalid");
    }
    
    
      $prepare = pg_prepare($dbconn, "query", 'Insert INTO projects_table(project_title,description, category_id, budget, tags, status, uploader_id) VALUES($1,$2,$3,$4,$5,$6, $7)');

    $result = pg_execute($dbconn, "query", array($title, $desc, $category, $budget, $tags, 'LIVE', $_SESSION['uploader_id']));

   echo "<center><h1>Project Uploaded Successfully...</h1><br>Redirecting to Panel...</center>";
    sleep(4);
    header("location:index.php");
    
}else{
 echo "Something is wrong...";
//     sleep(4);
    header("location:index.php");
}

?>