<?php

if(isset($_GET['code'])){
    include('connections/db_connection_root.php');
    if($_GET['u'] == 1){
        // Developer
        $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM user_info_developer WHERE password = $1');
        
        $result = pg_execute($dbconn, "query", array($_GET['code']));
    
    if(pg_num_rows($result) != 0){
       
        $prepare = pg_prepare($dbconn, "query2", 'UPDATE  user_info_developer SET verified = $1 WHERE password = $2');
        
        $result = pg_execute($dbconn, "query2", array(1, $_GET['code']));
        
        echo "<h1>Account Verified!!</h1>";
    }else{
        echo "Could not verify account.";
    }
    }
    if($_GET['u'] == 0){
        // Developer
        $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM user_info_uploader WHERE password = $1');
        
        $result = pg_execute($dbconn, "query", array($_GET['code']));
    
    if(pg_num_rows($result) != 0){
       
        $prepare = pg_prepare($dbconn, "query2", 'UPDATE  user_info_uploader SET verified =$1 WHERE password = $2');
        
       $result = pg_execute($dbconn, "query2", array(1, $_GET['code']));
        
        echo "<h1>Account Verified!!</h1>";
    }else{
        echo "Could not verify account.";
    }
    }
    
    
}



?>