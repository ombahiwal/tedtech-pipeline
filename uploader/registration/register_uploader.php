<?php

if(isset($_POST)){
 include('../../connections/db_connection_root.php');

    // check phone
    try{
        if( strlen((string)$_POST['phone']) ==10 && is_numeric((int)$_POST['phone'])){
            echo 'Its Numeric';        }else{
            header("location:index.php?no=1"); 
        }
    }catch(Exception $e){
        header("location:index.php?no=1"); 
    }
    

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = "TEDTECHENCRYPTIONKEYCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR";
    $secret_iv = '"TEDTECHENCRYPTIONIVCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR"';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
$password = encrypt_decrypt('encrypt', $_POST['password']);




// Check if already exists
 $email_verify =$_POST['email'];
    $sql_verify_email = "SELECT * FROM user_info_uploader WHERE user_email='{$email_verify}'";
    $sql_query = pg_query( $sql_verify_email);
    if(pg_num_rows($sql_query)){
        header("location:index.php?exists=1");   
    }



$data_array = array();

array_push($data_array, $_POST['fname']);

array_push($data_array, $_POST['lname']);

array_push($data_array, $_POST['email']);


array_push($data_array, $_POST['organisation']);
    
array_push($data_array, $password);

array_push($data_array, $_POST['jobtitle']);


array_push($data_array, $_POST['linkedinlink']);
    
    
    
    array_push($data_array, $_POST['phone']);
    
$register_query = pg_prepare($dbconn, "register", "INSERT INTO user_info_uploader(first_name, last_name,user_email, organisation, password,job_title, linkedin, phone, verified) VALUES($1,$2,$3,$4,$5,$6,$7,$8,0)");
    
$result = pg_execute($dbconn, "register", $data_array);

    
    
    
if($result){
    
    
    	$to=$data_array[2];
	$subject="TedTech Account Verification";
	$body= "<center><h3>Thank you for Registration.</h3><br><p>Click <A href=\"http://tedtech.in/verify.php?code={$data_array[4]}&u=0\">here</a> to verify your account.</p></center>";

    
    
include '../../Mailer/classes/class.phpmailer.php';
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
    
echo "<center><h2>Registration Successful, 
<br>Redirecting...</h2></center><script>
setTimeout(function(){
            window.location.href = '../panel/login.php';
         }, 5000);
         </script>
";
}else{
    echo "Some Problem Occurred<br>Redirecting...<script>
setTimeout(function(){
            window.location.href = '../../index.php';
         }, 5000);
         </script>";
}
//print_r($data_array);
}
   
   
?>