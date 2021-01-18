<?php
session_start();
	if (($_POST['email']!=""))
	{
		include 'dbConn2.php';
		$sql = "INSERT INTO Users (Username,Name,Organization,CreatedDate,Status,ParentUserID) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['organization']."',CURDATE(),0,111)";
		mysql_query($sql) or die(mysql_error());
		$UserID = mysql_insert_id();
	//	echo $sql;
	//	$_SESSION['UserID'] = mysql_insert_id();
	//	$_SESSION['MainUserID'] =  $_SESSION['UserID'];
	//	$_SESSION['Username'] = $_POST['email'];
		$_SESSION['SignUpMsg']="YES";
		include_once('class/class.phpmailer.php');
		require_once('class/class.smtp.php');
		

		$mail = new PHPMailer();
		$mail->setFrom('info@firmogram.com', 'Firmogram');
		$mail->addAddress('info@firmogram.com', '');
		$mail->addCC('info@blueprime.ca', '');
		$mail->addCC('info@blueprime.com', '');
		$mail->addBCC('h.goldani@blueprime.ca', '');
		$mail->addBCC('goldani@gmail.com', '');
		$mail->Subject = 'New Signup for Firmogram';
		$mail->msgHTML("Username: <i>" . $_POST['email'] . "</i><br/>Name: <i>" . $_POST['name'] . "</i><br/>Organization: <i>" . $_POST['organization'] . "</i>");
		$mail->send();
/*
		$mail = new PHPMailer();
		$mail->setFrom('info@firmogram.com', 'Firmogram');
		$mail->addAddress($_POST['email'], '');
		$mail->addCC('info@firmogram.com', '');
		$mail->addBCC('info@blueprime.ca', '');
		$mail->addBCC('h.goldani@blueprime.ca', '');
		$mail->Subject = 'Your Registration with Firmogram.com';
		$mail->msgHTML("Dear " . $_POST['email'] . "<br/><br/>Thank you for registering with Firmogram.com.<br/><br/>To complete your registration process please click on the link below:<br/><br/>http://www.firmogram.com/CompReg.php?ID=" . $UserID . "&Email=" . $_POST['email'] . "<br/><br/>Best Regards,<br/>-The Firmogram Team");
		$mail->send();
*/
		header("Location: thankyou.html");
	}
	else
		header("Location: signupNew.php");
?>