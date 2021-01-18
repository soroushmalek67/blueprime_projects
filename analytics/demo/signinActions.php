<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
include 'dbConn2.php';
$sql = "SELECT u1.ID,u1.Password,u1.ParentUserID,(SELECT COUNT(*) FROM Users u2 WHERE u2.ParentUserID=u1.ID) ViewerCount FROM Users u1 WHERE Username='".$username."' and Status=1 ORDER BY ID DESC LIMIT 1";
$ret = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_row($ret);
if ($row[1]==$password && $password!=="")
{
	$_SESSION['Username'] = $username;
	$sql = "INSERT INTO UserActions (UserID,ActionDate,Action) VALUES (".$row[0].",NOW(),'Sign In')";
	$ret = mysql_query($sql) or die(mysql_error());
	if ($row[2] == "" || $row[2] == "0")
	{
		$_SESSION['MainUserID'] = $row[0];
		$_SESSION['UserID'] = $row[0];
		$_SESSION['ReadOnly'] = "NO";
		$_SESSION['ViewerCount'] = $row[3];
		header("Location: projects.php");		
	}
	else
	{
		$_SESSION['MainUserID'] = $row[0];
		$_SESSION['UserID'] = $row[2];
		$_SESSION['ReadOnly'] = "YES";
		$_SESSION['ProjectID'] = "64";
//		$_SESSION['ProjectID'] = "31";
		$_SESSION['ProjectType'] = "1";
		$_SESSION['ViewerCount'] = $row[3];
		header("Location: list2.php");		
	}
}
else
{
	$_SESSION['SignInError']="YES";
	header("Location: signin.php");
}
	
?>