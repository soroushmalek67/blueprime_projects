<?php
	session_start();
	include 'dbConn.php';
	$q = $_GET['q'];
//	echo $q;
	echo "<select class='form-control' name='SelBuildState'>\n";
	$result = mysqli_query($con,"SELECT State FROM InsideviewStates WHERE State<>'' AND Country='". $q ."' ORDER BY State");
	echo "<option><-- All States --></option>\n";
	while($row = mysqli_fetch_array($result))
	{
	 if ($_SESSION['SelBuildState']==$row['State'])
	echo "<option selected>" . $row['State'] . "</option>\n";
	 else
	echo "<option>" . $row['State'] . "</option>\n";
	}
	echo "</select>\n";
?>