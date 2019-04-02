<?php
// Relational Database Service Root user credentials.
//$dbname = "tedtechdb";
//$username = "ombahiwal1";
//$password = "";
//$dbhosturl = "tedtechdb.csjpksikengp.us-east-2.rds.amazonaws.com";
//$dbcon_pdo = 0;

$dbname = "tedtechdb";
$username = "ombahiwal1";
$password = "tedtechdb123";
$dbhost_endpoint = "tedtechdb-server.csqcw200ryz3.us-east-2.rds.amazonaws.com";
$dbcon_pdo = 0;


try{
    // Database connection in PDO
    $dbcon_pdo  = new PDO("pgsql:host={$dbhost_endpoint};dbname={$dbname}", "{$username}", "{$password}");
//    echo "Connected Successfully ";
  
    
//    $result = pg_prepare($dbcon_pdo, "Open", "SELECT * FROM skill_table WHERE skill_name LIKE '$1%'");
//
//// Execute the prepared statement.print 'Example Run #3<br>';print '.. Prepared Statement - "Good Parameter"<br>"';
//$result = pg_execute($dbcon_pdo, "pst_product", array($param_good));
//$resultdta = pg_fetch_all($result);
//var_dump($resultdta);
//
//print '<br>';
//
//print 'Example Run #4<br>';
//print '.. Prepared Statement - SQL injection introduced<br>';
//$result = pg_execute($dbconn, "pst_product", array($param_inject));
//$resultdta = pg_fetch_all($result);
//var_dump($resultdta);
    
}catch(PDOException $e){
    echo $e->getMessage();
}

var_dump($dbcon_pdo)
?>

