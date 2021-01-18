<?php
session_start();
include 'dbConn2.php';
$username = $_POST['Email'];
$sql = "SELECT COUNT(*) cnt FROM Users WHERE Username='".$username."'";
$ret = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_row($ret);
if ($row[0]>0)
{
	$_SESSION['SignUpError']="YES";
	header("Location: signupIC.php");
}
else
{
//	$_SESSION['UserID'] = "6";
	$_SESSION['UserID'] = "17";
	$sql = "INSERT INTO Users (Username,Password,Organization,CreatedDate,Status,Name,ParentUserID) VALUES ('".$_POST['Email']."','".$_POST['Password']."','".$_POST['Organization']."',CURDATE(),1,'".$_POST['Name']."',". $_SESSION['UserID'] . ")";
	#echo $sql;
	mysql_query($sql) or die(mysql_error());
	$_SESSION['MainUserID'] =  mysql_insert_id();
	$_SESSION['Username'] = $_POST['Email'];
	$_SESSION['ProjectID'] = "64";
//	$_SESSION['ProjectID'] = "31";
	$_SESSION['ProjectType'] = "1";
	$_SESSION['ReadOnly'] = "YES";
	header("Location: view.php");
}
?>