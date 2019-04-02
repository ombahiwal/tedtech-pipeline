<?php
error_reporting(0);
if(isset($_POST['send']))
{
	$to="tedtech.in@gmail.com";
	$subject="Website Enquiry";
	$body= "Name : ".$_POST['name']."<br>Email : ".$_POST['email']."<br>Message : ".$_POST['Message']."<br>";

    
    
include 'classes/class.phpmailer.php';
   $mail= new PHPMailer();
// Un-Comment on localhost   
//$mail->isSMTP();
   $mail->SMTPDebug=0;
   $mail->SMTPAuth=true;
   $mail->SMTPSecure='ssl';
   $mail->Host="smtp.gmail.com";
   $mail->Port=465;
   $mail->isHTML(true);
   $mail->Username="tedtech.in@gmail.com";   // Add your Gmail Address.
   $mail->Password="nikunjsingh1289";           // Add your Gmail Password
   $mail->setFrom("tedtech.in@gmail.com");  // Add your Gmail Address.
   $mail->Subject=$subject;
   $mail->Body=$body;
   $mail->addAddress($to);
   if(!$mail->send())
   {
   	 echo "Mailer Error.".$mail->ErrorInfo;
   }
   else
   {
   	  echo "<center><h1>Message has been sent Successfully!<h1><br><h2>Redirecting to Home Page...</h2><center>";
   }
}

?>

<script>
setTimeout(function () {
       window.location.href = "../index.php"; //will redirect to your blog page (an ex: blog.html)
    }, 3000); 

</script>

