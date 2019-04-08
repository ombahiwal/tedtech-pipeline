


<?php
include('../../connections/db_connection_root.php');
$project_id = $_POST['pid'];
$bid_id = $_POST['bid'];

// Update project status to Live 
$query = "UPDATE projects_table set status='LIVE' where project_id = '{$project_id}'";
$result = pg_query($dbconn, $query);

// delete Bid 
$query = "delete from bids where bid_id='{$bid_id}'";
$result = pg_query($dbconn, $query);

header('location:panel.php');
?>