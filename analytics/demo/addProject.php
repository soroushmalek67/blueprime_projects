<?php
session_start();
$name = $_POST['ProjectName'];
$type = $_POST['ProjectType'];
$userID = $_SESSION['UserID'];

include 'dbConn2.php';

$sql = "INSERT INTO UserProjects (UserID,Name,CreatedDate,Type,Status) VALUES (".$userID.",'".$name."',CURDATE(),'".$type."','New')";
$ret = mysql_query($sql) or die(mysql_error());
$projectID = mysql_insert_id();
$_SESSION['ProjectID']=$projectID;
header("Location: projects.php");
?>