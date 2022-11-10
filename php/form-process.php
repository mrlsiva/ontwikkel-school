<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
use PHPMailer\PHPMailer\SMTP; 

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer(true);

if( isset($_POST['name']) && isset($_POST['academic-year']) && isset($_POST['dob']) && isset($_POST['inquery-message']) && isset($_POST['address']) && isset($_POST['parent-name']) && isset($_POST['relationship']) && isset($_POST['contact-number']) && isset($_POST['email']) && isset($_POST['source-of-info']) ) {

	try{
		$name 				= $_POST['name'];
		$academic_year 		= $_POST['academic-year'];
		$dob 				= $_POST['dob'];
		$inquery_message 	= $_POST['inquery-message'];
		$address 			= $_POST['address'];
		$parent_name 		= $_POST['parent-name'];
		$relationship 		= $_POST['relationship']; 
		$contact_number	 	= $_POST['contact-number'];
		$email 				= $_POST['email'];
		$source_of_info 	= $_POST['source-of-info'];
		
		
		$emailTo = "pmrlsivas@gmail.com";
		$emailToName = "St.Josephs Garden School";
		$subject = "School test msg";
		
		$senderName = $name;
		$senderEmail = $email;
		$senderMessage = $inquery_message;	
		
		/* *************** LOCAL SMTP START *************** */
		// $developmentMode = true;
		// $mail->isSMTP();
		// if ($developmentMode) {
		// 	$mail->SMTPOptions = [
		// 		'ssl'=> [
		// 		'verify_peer' => false,
		// 		'verify_peer_name' => false,
		// 		'allow_self_signed' => true
		// 		]
		// 	];
		// }
		// $mail->Host = 'mail.slinggroups.in';
		// $mail->SMTPAuth = TRUE;
		// $mail->SMTPSecure = 'ssl';
		// $mail->Username = 'praveenkumar@slinggroups.in';
		// $mail->Password = '+H@bR]jLQPHH';
		// $mail->Port = 465;	 			
		// $mail->isHTML(true);
		// $mail->SMTPDebug = 2;		
		/* *************** LOCAL SMTP END *************** */
		
		$mail->SetFrom( $senderEmail, $senderName );
		$mail->AddReplyTo( $senderEmail, $senderName );
		$mail->AddAddress( $emailTo, $emailToName );
		$mail->Subject = $subject;	
		
		$template = file_get_contents("email-template.html");
		$template = str_replace('###NAME###', $senderName, $template);
		$template = str_replace('###ACADEMIC-YEAR###', $academic_year, $template);
		$template = str_replace('###DOB###', $dob, $template);
		$template = str_replace('###INQUERY-MESSAGE###', $inquery_message, $template);
		$template = str_replace('###ADDRESS###', $address, $template);
		$template = str_replace('###PARENT-NAME###', $parent_name, $template);
		$template = str_replace('###RELATIONSHIP###', $relationship, $template);
		$template = str_replace('###CONTACT-NUMBER###', $contact_number, $template);
		$template = str_replace('###EMAIL###', $senderEmail, $template);
		$template = str_replace('###SOURCE-OF-INFO###', $source_of_info, $template);
	
		
		$mail->MsgHTML( $template );
		
		$mail->Body = $template; 
		
		if( $mail->Send() ){	
			$result = array( 'success' => true, 'message' => 'Mail send successfully!!!' );
		}else{
			$result = array( 'success' => false, 'message' => 'Mail not send. Please try again.' );
		}
	}	
	catch (phpmailerException $e) {	  
		$result = array( 'success' => false, 'message' => $e->errorMessage() );
	} catch (Exception $e) {	  
		$result = array( 'success' => false, 'message' => $e->getMessage() );
	}
	
	echo json_encode($result);
	exit;
}
?>