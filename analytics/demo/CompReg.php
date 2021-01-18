<?php
session_start();
	include 'dbConn2.php';
	$sql = "UPDATE Users SET Status=1 WHERE ID=".$_GET['ID']." AND Username='".$_GET['Email']."'";
	mysql_query($sql) or die(mysql_error());

	header("Location: thankyouReg.html");
?>