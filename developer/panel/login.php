<?php



function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = "TEDTECHENCRYPTIONKEYCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR";
    $secret_iv = '"TEDTECHENCRYPTIONIVCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR"';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}




if(isset($_POST['send'])){

    include('../../connections/db_connection_root.php');    
    $email  = $_POST['email'];
    $prepare = pg_prepare($dbconn, "query", "SELECT * FROM user_info_developer WHERE user_email = $1"); 
    $result = pg_execute($dbconn, "query",array($email));
    $row = pg_fetch_all($result);
    var_dump($row);
    if(sizeof($row)){
        
       $password = encrypt_decrypt('decrypt', $row[0]['password']); 
        if($password === $_POST['password']){
            // Code when Credentials correct
            session_start();
            $_SESSION['developer_id'] = $row[0]['developer_id'];
            $_SESSION['ongoing'] = $row[0]['ongoing'];
             // Go to the Developer Panel page
            header("location:panel.php");
            
            
            
        }else{
            echo "Incorrect Credentials";
            header("location:index.php?incorrect=yes");
        }
        
    }else{
        
        echo "Incorrect";
    
     header("location:index.php?incorrect=yes");
    }
    
    
}




?>