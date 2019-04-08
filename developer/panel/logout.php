<?php
session_start();
if(isset($_SESSION["developer_id"])){
    unset($_SESSION["developer_id"]);
    session_destroy();
    echo "<center><h2>Bye.<br>Logged Out</h2><br>Redirecting...</center><script>
setTimeout(function(){
            window.location.href = '../../index.php';
         }, 3000);
         </script>";
    
    
}else{
     echo "<h2>You never loggedIn</h2><br>Redirecting...<script>
setTimeout(function(){
            window.location.href = '../../index.php';
         }, 3000);
         </script>";
}

?>