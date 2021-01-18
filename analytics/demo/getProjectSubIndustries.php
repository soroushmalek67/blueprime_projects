<?php
	session_start();
	include 'dbConn.php';
	$q = $_GET['q'];
	$q = str_replace("@@@","&",$q);
	$p = $_GET['p'];
//	echo $q;
	echo "<select class='form-control' name='SelProjectSubIndustry'>\n";
            $result = mysqli_query($con,"SELECT DISTINCT SubIndustry FROM ProjectCompanies WHERE ProjectID=". $p ." and SubIndustry<>''  and Industry='". $q ."'  ORDER BY SubIndustry ");
	echo "<option><-- All SubIndustries --></option>\n";
	while($row = mysqli_fetch_array($result))
	{
	 if ($_SESSION['SelProjectSubIndustry']==$row['SubIndustry'])
	echo "<option selected>" . $row['SubIndustry'] . "</option>\n";
	 else
	echo "<option>" . $row['SubIndustry'] . "</option>\n";
	}
	echo "</select>\n";
?>