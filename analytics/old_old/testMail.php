<?php
		include_once('class/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->setFrom('info@firmogram.com', 'Firmogram');
		$mail->addAddress('goldani@gmail.com');
		$mail->Subject = 'Test Signup for Firmogram 7';
		$mail->msgHTML("Username: <i>Test</i><br/>Organization: <i>Org</i>");
if(!$mail->Send()) {
  echo "<script>alert('Mailer Error: " . $mail->ErrorInfo."')</script>";
} else {
	header("Location: thankyou.html");
}	
?>