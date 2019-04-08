<?php

session_start();


// Do this after Payment is Confirmed
if(isset($_SESSION['uploader_id'])){
$developer_id = $_POST['did'];
$bid_id = $_POST['bid_id'];
$project_id = $_POST['pid'];

include('../connections/db_connection_root.php');

    
    // Update Bid Clause status
$prepare = pg_prepare($dbconn, "query", 'UPDATE bids SET status=$1 where bid_id=$2');
    $result = pg_execute($dbconn, "query", array("PENDING", $bid_id));
    
    
    // UPDATE Project Status
    
    $prepare = pg_prepare($dbconn, "query2", 'UPDATE projects_table SET status=$1 where project_id=$2');
    $result = pg_execute($dbconn, "query2", array("PENDING", $_POST['pid']));
 
    
    
	$to=$_POST['email'];
	$subject="TEDTECH - Bid Accepted";
	$body= "<center><b>Congratulations!!</b><br>Your Bid Has been accepted<br>Login to Tedtech.in to Confirm it. Click<a href=\"http://tedtech.in/project.php?id={$project_id}\"> here</a> to view the project  </center>";

    
    
include '../Mailer/classes/class.phpmailer.php';
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
//   	  echo "<center><h1>Message has been sent Successfully!</center>";
   }
    
    echo "<center><h1>BID Accepted!!<br>Redirecting...</h1></center>
    <script> window.setTimeout(function(){
        window.location.href = \"../uploader/panel/project-page-uploader.php\";

    }, 3000);</script>";
}
?>