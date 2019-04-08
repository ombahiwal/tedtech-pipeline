<?php
include('../../connections/db_connection_root.php');
$project_id = $_POST['pid'];
$bid_id = $_POST['bid'];
// change project Status to ACCEPTED
 $query = "UPDATE projects_table set status='ACCEPTED' where project_id = '{$project_id}'";
$result = pg_query($dbconn, $query);

// project state to Simulation | Requirement Analysis
$query = "UPDATE projects_table set state='Simulation | Requirement Analysis' where project_id = '{$project_id}'";
$result = pg_query($dbconn, $query);

// Change bid status to accepted
$query = "UPDATE bids set status='ACCEPTED' where bid_id='{$bid_id}'";
$result = pg_query($dbconn, $query);

// change developer ongoing to yes

$query = "UPDATE user_info_developer set ongoing='YES' where bid_id='{$bid_id}'";
$result = pg_query($dbconn, $query);

$query = "SELECT * from projects_table where project_id='{$project_id}'";
$result = pg_query($dbconn, $query);
$row = pg_fetch_assoc($result);
$uploader_id = $row['uploader_id'];
$developer_id = $row['developer_id'];

$query = "SELECT * from user_info_uploader where uploader_id='{$uploader_id}'";
$result = pg_query($dbconn, $query);
$row = pg_fetch_assoc($result);
$uploader_email = $row['user_email'];

$query = "SELECT * from user_info_developer where developer_id='{$developer_id}'";
$result = pg_query($dbconn, $query);
$row = pg_fetch_assoc($result);
$d_email = $row['user_email'];
$d_phone = $row['phone'];

	$to=$uploader_email;
	$subject="TedTech - Project Confirmed.";
	$body= "<center><b>Congratulations!!</b><br>The developer has confirmed your project<br><br>The Contact Details - <br>Email : {$d_email}<br>Phone : {$d_phone}</center>";

    
    
include 'classes/class.phpmailer.php';
   $mail= new PHPMailer();
// Un-Comment on localhost   
//$mail->isSMTP();
   $mail->SMTPDebug=2;
   $mail->SMTPAuth=true;
   $mail->SMTPSecure='ssl';
   $mail->Host="smtpout.asia.secureserver.net";
   $mail->Port=465;
   $mail->isHTML(true);
   $mail->Username="support@tedtech.in";   // Add your Gmail Address.
   $mail->Password="TedTech@123";           // Add your Gmail Password
   $mail->setFrom("support@tedtech.in");  // Add your Gmail Address.
   $mail->Subject=$subject;
   $mail->Body=$body;
   $mail->addAddress($to);
   if(!$mail->send())
   {
   	 echo "Mailer Error.".$mail->ErrorInfo;
   }
   else
   {
   	  echo "<center><h1>Message has been sent Successfully!</center>";
   }





header('location:project-panel.php');


?>