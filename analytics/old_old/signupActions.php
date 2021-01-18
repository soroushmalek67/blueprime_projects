<?php
session_start();
	include 'dbConn2.php';
	$sql = "INSERT INTO Users (Username,Password,Organization,CreatedDate,Status) VALUES ('".$_POST['Email']."','".$_POST['Password']."','".$_POST['Organization']."',CURDATE(),1)";
	#echo $sql;
	mysql_query($sql) or die(mysql_error());
	$_SESSION['UserID'] = mysql_insert_id();
	$_SESSION['Username'] = $_POST['Email'];
	header("Location: projects.php");
?>