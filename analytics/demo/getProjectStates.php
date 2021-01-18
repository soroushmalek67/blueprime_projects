<?php
	session_start();
	include 'dbConn.php';
	$q = $_GET['q'];
	$p = $_GET['p'];
//	echo $q;
	echo "<select class='form-control' name='SelProjectState'>\n";
            $result = mysqli_query($con,"SELECT DISTINCT State FROM ProjectCompanies WHERE ProjectID=". $p ." and State<>''  and Country='". $q ."'  ORDER BY State ");
	echo "<option><-- All States --></option>\n";
	while($row = mysqli_fetch_array($result))
	{
	 if ($_SESSION['SelProjectState']==$row['State'])
	echo "<option selected>" . $row['State'] . "</option>\n";
	 else
	echo "<option>" . $row['State'] . "</option>\n";
	}
	echo "</select>\n";
?>