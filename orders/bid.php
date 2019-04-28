<?php
session_start();
include('../connections/db_connection_root.php');
$dev_id = $_SESSION['developer_id'];
$pid = $_POST['pid'];
$uploader_id = $_POST['uid'];

if($_SESSION['ongoing'] == 'YES'){
    header("location:../project.php?id={$pid}&ongoing=1");
    
}
$query = "SELECT * FROM bids where project_id='{$pid}' and developer_id='{$dev_id}'";
    $result = pg_query($dbconn, $query);
if(pg_num_rows($result) != 0){
    header("location:../project.php?id={$pid}&already=1");
}else{

    
$prepare = pg_prepare($dbconn, "query", "INSERT INTO bids(developer_id, uploader_id, project_id, amount, description, status) VALUES($1, $2, $3, $4, $5, 'LIVE')");

$result = pg_execute($dbconn, "query", array($dev_id, $uploader_id, $pid,$_POST['bid_amount'],$_POST['proposal_text']));
    
echo "<center><h1>Bid Successful!!</h1></center><script>window.setTimeout(function(){window.location.href = \"../developer/panel/panel.php\";}, 3000);
</script>";

}


?>
// Omkar Bahiwal
<!-- Omkar Bahiwal -->
