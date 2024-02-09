<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
//require_once "vendor/autoload.php"; //PHPMailer Object 

function sendMail($to, $subj, $body) {
	$mail = new PHPMailer; //From email address and name 

	//$mail->SMTPDebug = 3;                           
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();        
	//Set SMTP host name                      
	$mail->Host = "smtp.maildomain.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                      
	//Provide username and password
	$mail->Username = ""; //Email id             
	$mail->Password = ""; //App specific password
	$mail->SMTPSecure = "tls";                       
	//Set TCP port to connect to
	$mail->Port = 587;
	$mail->From = "demo@example.com"; 
	$mail->FromName = "demo@example.com"; //To address and name 
	$mail->addAddress($to);//Recipient name is optional
	//$mail->addAddress("recepient1@example.com"); //Address to which recipient will reply 
	//$mail->addReplyTo("reply@yourdomain.com", "Reply"); //CC and BCC 
	//$mail->addCC("cc@example.com"); 
	//$mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email 
	$mail->isHTML(true); 
	$mail->Subject = $subj; 
	$mail->Body = $body;
	$mail->AltBody = "This is the plain text version of the email content"; 

	if(!$mail->send()) 
	{
		//echo "Mailer Error: " . $mail->ErrorInfo; 
	} 
	else { 
		//echo "Message has been sent successfully"; 
	}
}
?>