<?php
// Relational Database Service Root user credentials.

$dbname = "tedtechdb";
$username = "ombahiwal1";
$password = "tedtechdb123";
$dbhost_endpoint = "tedtechdb-server.csqcw200ryz3.us-east-2.rds.amazonaws.com";
$dbcon_pdo = 0;


try{
    // Database connection in PDO
//    $dbcon_pdo  = new PDO("pgsql:host={$dbhost_endpoint};dbname={$dbname}", "{$username}", "{$password}");
   
//    echo "Connected Successfully ";
 
    $dbconn = pg_connect("host={$dbhost_endpoint} dbname=tedtechdb user={$username} password={$password}");

}catch(PDOException $e){
    echo $e->getMessage();
}

//var_dump($dbcon_pdo)



    // fetch Data from table simple
    
//     $query = "SELECT * FROM skill_table";
//    $result = pg_query($query);
//    if (!$result) {
//        echo "Problem with query " . $query . "<br/>";
//        echo pg_last_error();
//        exit();
//    }
//    while($row = pg_fetch_assoc($result)){
//        var_dump($row);
//    }    
    

    // Insert data into table using prepared statement simple
    // Prepare a query for execution
 
//    $prepare = pg_prepare($dbconn, "query", 'SELECT * FROM skill_table WHERE skill_id = $1');
//
//    $result = pg_execute($dbconn, "query", array(2));
//    var_dump(pg_fetch_all($result));
//    
//    
//    $result = pg_execute($dbconn, "query", array(1));
//    var_dump(pg_fetch_all($result));
//    
    
    
    
    // Decrypt Passwords
    
  /*
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = "TEDTECHENCRYPTIONKEYCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLY";
    $secret_iv = '"TEDTECHENCRYPTIONIVCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLY"';
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
    
    */
?>

