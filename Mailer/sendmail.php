<?php
error_reporting(0);

	$to="ombahiwal@gmail.com";
	$subject="Website Enquiry";
	$body= "Hello test message";

    
    
include 'classes/class.phpmailer.php';
   $mail= new PHPMailer();
// Un-Comment on localhost   
$mail->isSMTP();
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


?>


