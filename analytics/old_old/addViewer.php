<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$userID = $_SESSION['UserID'];

include 'dbConn2.php';

$sql = "INSERT INTO Users (ParentUserID,Username,CreatedDate,Password,Status,Name) VALUES (".$userID.",'".$email."',CURDATE(),'".$password."',1,'".$name."')";
$ret = mysql_query($sql) or die(mysql_error());
header("Location: viewers.php");
?>