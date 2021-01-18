<?php
session_start();
if(isset($_POST['Activate']))
{
	include 'dbConn2.php';
	$_SESSION['SelUserID'] = $_POST['UserID'];
	$sql = "UPDATE Users SET Status=1,ParentUserID=111 WHERE ID=".$_SESSION['SelUserID'];
	mysql_query($sql) or die(mysql_error());
	header("Location: admin.php");
}
elseif(isset($_POST['Deactivate']))
{
	include 'dbConn2.php';
	$_SESSION['SelUserID'] = $_POST['UserID'];
	$sql = "UPDATE Users SET Status=0 WHERE ID=".$_SESSION['SelUserID'];
	mysql_query($sql) or die(mysql_error());
	header("Location: admin.php");
}
elseif(isset($_POST['CreateUser']))
{
	include 'dbConn2.php';
	$sql = "INSERT INTO Users (Username,Password,Organization,CreatedDate,Status) VALUES ('".$_POST['Email']."','".$_POST['Password']."','".$_POST['Organization']."',CURDATE(),1)";
	#echo $sql;
	mysql_query($sql) or die(mysql_error());
	header("Location: admin.php");
}	
else
	echo "None";
?>