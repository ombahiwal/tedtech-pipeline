<?php

if(isset($_POST)){
 include('../../connections/db_connection_root.php');


function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = "TEDTECHENCRYPTIONKEYCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR";
    $secret_iv = '"TEDTECHENCRYPTIONIVCREATEDBYOMKARPASSWORDSWILLBEDECRYPTEDWITHTHISKEYONLYMANALITAWAR"';
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
$password = encrypt_decrypt('encrypt', $_POST['password']);

    // check phone
    try{
        if( strlen((string)$_POST['phone']) == 10 && is_numeric((int)$_POST['phone'])){
            echo 'Its Numeric';        }else{
            header("location:index.php?no=1"); 
        }
    }catch(Exception $e){
        header("location:index.php?no=1"); 
    }
    
    
    
// Check if already exists
 $email_verify =$_POST['email'];
    $sql_verify_email = "SELECT * FROM user_info_developer WHERE user_email='{$email_verify}'";
    $sql_query = pg_query( $sql_verify_email);
    if(pg_num_rows($sql_query)){
        header("location:index.php?exists=1");   
    }

$skills = implode(",",$_POST['skills']);


// upload resume code  
$newfilename = "none";
    $target_dir = "resumes/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0){
    echo "Your file was not uploaded.";
// if everything is ok, try to upload file
    }else{
   
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
    if( move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.''.$newfilename)){
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    }
}

$data_array = array();

array_push($data_array, $_POST['fname']);

array_push($data_array, $_POST['lname']);

array_push($data_array, $_POST['email']);

array_push($data_array, $_POST['status']);

array_push($data_array, $password);

// Skill ids implode string
array_push($data_array, $skills);

// Resume path can also be null
array_push($data_array, $newfilename);
    
array_push($data_array, $_POST['linkedinlink']);
    
array_push($data_array, $_POST['githublink']);

// Check according to User status
if(isset($_POST['institution']) || isset($_POST['qualification']) && $_POST['institution'] != "" && $_POST['qualification'] != ""){
    array_push($data_array, $_POST['institution']);
    array_push($data_array, $_POST['qualification']);
}else{
    array_push($data_array, "none");
    array_push($data_array, "none");
}
    array_push($data_array, $_POST['phone']);
$register_query = pg_prepare($dbconn, "register", "INSERT INTO user_info_developer(first_name, last_name,user_email, status, password, skill_ids, resume_path, github, linkedin, institute, qualification,  phone, verified) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,0)");
    
$result = pg_execute($dbconn, "register", $data_array);


	$to=$data_array[2];
	$subject="TedTech Account Verification";
	$body= "<center><h3>Thank you for Registration.</h3><br><p>Click <A href=\"http://tedtech.in/verify.php?code={$data_array[4]}&u=1\">here</a> to verify your account.</p></center>";

    
    
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

if($result){
echo "<center><h2>Registration Successful, 
<br>Redirecting...</h2></center><script>
setTimeout(function(){
            window.location.href = '../panel/index.php';
         }, 5000);
         </script>
";
}else{
    echo "Some Problem Occurred<br>Redirecting...<script>
setTimeout(function(){
            window.location.href = '../panel/index.php';
         }, 5000);
         </script>";
}
    
//print_r($data_array);
   
}
   
   
?>