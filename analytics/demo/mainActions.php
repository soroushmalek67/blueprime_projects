<?php
session_start();

if(isset($_POST['btnSearch']))
{
	if ($_POST['SelProvince']=="<-- All Provinces -->")
		$_SESSION['SelProvince'] = "";
	else
		$_SESSION['SelProvince'] = $_POST['SelProvince'];
	if ($_POST['SelSector']=="<-- All Sectors -->")
		$_SESSION['SelSector'] = "";
	else
		$_SESSION['SelSector'] = $_POST['SelSector'];
	$_SESSION['Keyword'] = $_POST['Keyword'];
}

header("Location: main.php");

?>