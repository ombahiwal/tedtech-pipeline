<?php
if(isset($_POST['update'])){
    include("../../connections/db_connection_root.php");
    session_start();
    $user_id = $_SESSION['developer_id'];
    $query = "SELECT * from bids where developer_id='{$user_id}' and status='ACCEPTED'";
    $res = pg_query($dbconn, $query);
    $row = pg_fetch_assoc($res);
    $uploader_id = $row['uploader_id'];
    $project_id = $row['project_id'];
    $start_date = $row['timestamp'];
    $amount = $row['amount'];
    $state = $_POST['optradio'];
    echo $state;
    $query = "UPDATE projects_table set state = '{$_POST['optradio']}' where project_id='{$project_id}'";
    $res = pg_query($dbconn, $query);
    
    header('location:project-panel.php?update=1');

}

?>