<?php
session_start();
$id = $_POST['ProjectID'];
if(isset($_POST['btnDelProject']))
{
	if ($id)
	{
		include 'dbConn2.php';
		$sql = "UPDATE UserProjects SET Status='Deleted' WHERE ID=".$id;
		$ret = mysql_query($sql) or die(mysql_error());
	}
	header("Location: projects.php");
}
elseif(isset($_POST['btnDupProject']))
{
//	echo "dup";
	include 'dbConn2.php';

	$sql = "INSERT INTO UserProjects (UserID,Name,CreatedDate,Type,Status) SELECT UserID,CONCAT(Name,'-Copy'),CURDATE(),Type,'New' FROM UserProjects WHERE ID=" . $id;
	$ret = mysql_query($sql) or die(mysql_error());
	$projectID = mysql_insert_id();
	$_SESSION['ProjectID']=$projectID;
	$sql = "INSERT INTO ProjectCompanies (ProjectID,Name,Description,Address,City,State,PostalCode,Country,Phone,Fax,Email,Website,NoEmployees,Revenue,Industry,SubIndustry,InsideviewID,LinkedInURL,FacebookURL,TwitterURL,NewsReleaseURL,OtherURL,ContactName,ContactTitle,ContactEmail,NAICSCode,MantaURL) SELECT " . $projectID . ",Name,Description,Address,City,State,PostalCode,Country,Phone,Fax,Email,Website,NoEmployees,Revenue,Industry,SubIndustry,InsideviewID,LinkedInURL,FacebookURL,TwitterURL,NewsReleaseURL,OtherURL,ContactName,ContactTitle,ContactEmail,NAICSCode,MantaURL FROM ProjectCompanies WHERE ProjectID=" . $id;
	//echo $sql;
	$ret = mysql_query($sql) or die(mysql_error());
	header("Location: projects.php");
}
elseif(isset($_POST['btnNextStep']))
{
	$_SESSION['ProjectID']=$id;
	include 'dbConn.php';
	$result = mysqli_query($con,"SELECT COUNT(*) cnt FROM ProjectCompanies Where ProjectID=".$id);
	$row = mysqli_fetch_array($result);
	$_SESSION['CompanyCount'] = $row["cnt"];
  	mysqli_free_result($result);
	$result = mysqli_query($con,"SELECT Type FROM UserProjects Where ID=".$id);
	$row = mysqli_fetch_array($result);
	$_SESSION['ProjectType'] = $row["Type"];
  	mysqli_free_result($result);
        	mysqli_close($con);
	if ($_SESSION['CompanyCount']==0) {
		if  ($_SESSION['ProjectType']==1)
			header("Location: import.php");
		else if  ($_SESSION['ProjectType']==3)
			header("Location: importNew.php");
		else
			header("Location: build.php");
	}
	else
		header("Location: view.php");
}
else
	echo "none";
?>