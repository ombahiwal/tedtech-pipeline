<?php
session_start();
if(isset($_SESSION["uploader_id"])){
    unset($_SESSION["uploader_id"]);
    session_destroy();
    echo "<center><h2>Bye.<br>Logged Out</h2><br>Redirecting...</center><script>
setTimeout(function(){
            window.location.href = '../../index.php';
         }, 2000);
         </script>";
    
    
}else{
     echo "<h2>You never loggedIn</h2><br>Redirecting...<script>
setTimeout(function(){
            window.location.href = '../../index.php';
         }, 2000);
         </script>";
}

?>