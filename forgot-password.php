<?php
include_once 'header.php';
include_once 'classes/account.php';
include_once 'config/connection.php';

include('db.php');

date_default_timezone_set('Asia/Manila');

if(isset($_POST["email"]) && (!empty($_POST["email"]))){

$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `accounts` WHERE email='".$email."'";
   $results = mysqli_query($con,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "No user is registered with this email address!";
   }
  }
   if($error!=""){
   echo "<script type='text/javascript'>alert('".$error."');</script>";
   }else{
   date_default_timezone_set('Asia/Manila');
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+(int)$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");
 
$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="127.0.0.1/apts/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
https://www.sihtm-apts.com/forgot-password/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>APTS Team</p>';
$body = $output; 
$subject = "Password Recovery";
 
$email_to = $email;
date_default_timezone_set('Asia/Manila');
require 'phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "SIHTM.APTS@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "papasakami123";
//Set who the message is to be sent from
$mail->setFrom('SIHTM.APTS@gmail.com');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email_to);
//Set the subject line
$mail->Subject = 'APTS Password Recovery';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
#$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
$mail->Body = $body;
//Attach an image file
#$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "<script type='text/javascript'>alert('Successfully Sent! Please check your email.'); location='login.php';</script>";
}
   }
}
?>

<body>


   <br><br>
   <div class="container col-md-7" style="margin: auto;">
      <h1>Forgot Password</h1>
       <div class="card border-secondary ">
         <div class="card-body text-dark">
         <form method="post" action="" name="reset">
            <div class="form-row">
               <div class="form-row col-md-3"></div>
               <div class="form-group col-md-6">
                  <label>Enter Your Email Address:</label>
                  <input class="form-control" type="email" name="email" placeholder="user@email.com" />
               </div>
            </div>
            <div class="form-row">
               <div class="form-row col-md-3"></div>
               <div class="form-row col-md-6">
                  <div class="text-right" style="width: 100%">
                     <input class="btn btn-danger" type="submit" value="Reset Password">
                  </div>
               </div>
            </div>
         </form>
         </div>
      </div>
   </div>
</body>


