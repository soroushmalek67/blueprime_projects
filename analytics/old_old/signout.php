<?php
session_start();
include 'dbConn2.php';
$sql = "INSERT INTO UserActions (UserID,ActionDate,Action) VALUES (".$_SESSION['MainUserID'].",NOW(),'Sign Out')";
$ret = mysql_query($sql) or die(mysql_error());
unset($_SESSION['MainUserID']);
unset($_SESSION['UserID']);
unset($_SESSION['ViewerCount']);
unset($_SESSION['ProjectID']);
unset($_SESSION['ProjectTypeID']);
unset($_SESSION['SelBuildCountry']);
unset($_SESSION['SelBuildState']);
unset($_SESSION['SelBuildIndustry']);
unset($_SESSION['SelBuildSubIndustry']);
unset($_SESSION['BuildKeyword']);
unset($_SESSION['SelProjectCountry']);
unset($_SESSION['SelProjectState']);
unset($_SESSION['SelProjectIndustry']);
unset($_SESSION['SelProjectSubIndustry']);
unset($_SESSION['ProjectKeyword']);
header("Location: index.html");
?>