<?php
	session_start();
	include 'dbConn.php';
	$q = $_GET['q'];
	$q = str_replace("@@@","&",$q);
//	echo $q;
	echo "<select class='form-control' name='SelBuildSubIndustry'>\n";
	$result = mysqli_query($con,"SELECT SubIndustry FROM InsideviewIndustries WHERE SubIndustry<>'' AND Industry='". $q ."' ORDER BY SubIndustry");
	echo "<option><-- All SubIndustries --></option>\n";
	while($row = mysqli_fetch_array($result))
	{
	 if ($_SESSION['SelBuildSubIndustry']==$row['SubIndustry'])
	echo "<option selected>" . $row['SubIndustry'] . "</option>\n";
	 else
	echo "<option>" . $row['SubIndustry'] . "</option>\n";
	}
	echo "</select>\n";
?>