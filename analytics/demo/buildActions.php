<?php
session_start();

if(isset($_POST['btnSearch']))
{
	if ($_POST['SelBuildCountry']=="<-- All Countries -->")
		$_SESSION['SelBuildCountry'] = "";
	else
		$_SESSION['SelBuildCountry'] = $_POST['SelBuildCountry'];
	if ($_POST['SelBuildState']=="<-- All States -->")
		$_SESSION['SelBuildState'] = "";
	else
		$_SESSION['SelBuildState'] = $_POST['SelBuildState'];
	if ($_POST['SelBuildIndustry']=="<-- All Industries -->")
		$_SESSION['SelBuildIndustry'] = "";
	else
		$_SESSION['SelBuildIndustry'] = $_POST['SelBuildIndustry'];
	if ($_POST['SelBuildSubIndustry']=="<-- All SubIndustries -->")
		$_SESSION['SelBuildSubIndustry'] = "";
	else
		$_SESSION['SelBuildSubIndustry'] = $_POST['SelBuildSubIndustry'];
	$_SESSION['BuildKeyword'] = $_POST['Keyword'];

	header("Location: build.php");
}
if(isset($_POST['btnAddSelected']))
{
	echo "btnAddSelected<br/>";
	  $companies = $_POST['cbCompany'];
	  if(empty($companies))
	  {
	    echo("You didn't select any companies.");
	  }
	  else
	  {
	    $N = count($companies);
	    echo("You selected $N companies: ");
	    for($i=0; $i < $N; $i++)
	    {
	      echo($companies[$i] . " ");
		include 'dbConn2.php';
	            $sql = "INSERT INTO ProjectCompanies (ProjectID,InsideviewID,Name,Description,Address,City,State,PostalCode,Country,Phone,Website,Industry,SubIndustry,NoEmployees,Revenue,NAICSCode) SELECT ".$_SESSION['ProjectID'].",ID,CompanyName,CompanyDescription,CompanyStreet,CompanyCity,CompanyState,CompanyZip,CompanyCountry,CompanyPhone,CompanyWebsite,Industry,SubIndustry,CompanyNoEmployees,CompanyRevenue,CompanyNAICSNo  FROM Insideview WHERE ID=". $companies[$i];
//	            echo $sql."<br/>";
	            $ret = mysql_query($sql) or die(mysql_error());
	    }
	  }	
	header("Location: build.php?page=".$_POST["pageno"]);
}
if(isset($_POST['btnAddThese']))
{
	echo "btnAddThese<br/>";
	  $companies = $_POST['hdCompany'];
	  if(empty($companies))
	  {
	    echo("You didn't select any companies.");
	  }
	  else
	  {
	    $N = count($companies);
	    echo("You selected $N companies: ");
	    for($i=0; $i < $N; $i++)
	    {
	      echo($companies[$i] . " ");
		include 'dbConn2.php';
	            $sql = "INSERT INTO ProjectCompanies (ProjectID,InsideviewID,Name,Description,Address,City,State,PostalCode,Country,Phone,Website,Industry,SubIndustry,NoEmployees,Revenue,NAICSCode) SELECT ".$_SESSION['ProjectID'].",ID,CompanyName,CompanyDescription,CompanyStreet,CompanyCity,CompanyState,CompanyZip,CompanyCountry,CompanyPhone,CompanyWebsite,Industry,SubIndustry,CompanyNoEmployees,CompanyRevenue,CompanyNAICSNo FROM Insideview WHERE ID=". $companies[$i];
//	            echo $sql."<br/>";
	            $ret = mysql_query($sql) or die(mysql_error());
	    }
	  }	
	header("Location: build.php?page=".$_POST["pageno"]);	 
}
if(isset($_POST['btnAddAll']))
{
	echo "btnAddAll<br/>";
	if (isset($_SESSION['SelBuildCountry']))
		$SelBuildCountry = $_SESSION['SelBuildCountry'];
	else
		$SelBuildCountry = "";
	if (isset($_SESSION['SelBuildState']))
		$SelBuildState = $_SESSION['SelBuildState'];
	else
		$SelBuildState = "";
	if (isset($_SESSION['SelBuildIndustry']))
		$SelBuildIndustry = $_SESSION['SelBuildIndustry'];
	else
		$SelBuildIndustry = "";
	if (isset($_SESSION['SelBuildSubIndustry']))
		$SelBuildSubIndustry = $_SESSION['SelBuildSubIndustry'];
	else
		$SelBuildSubIndustry = "";
	$Keyword = $_SESSION['BuildKeyword'];
	include 'dbConn2.php';
            $sql = "INSERT INTO ProjectCompanies (ProjectID,InsideviewID,Name,Description,Address,City,State,PostalCode,Country,Phone,Website,Industry,SubIndustry,NoEmployees,Revenue,NAICSCode) SELECT ".$_SESSION['ProjectID'].",ID,CompanyName,CompanyDescription,CompanyStreet,CompanyCity,CompanyState,CompanyZip,CompanyCountry,CompanyPhone,CompanyWebsite,Industry,SubIndustry,CompanyNoEmployees,CompanyRevenue,CompanyNAICSNo  FROM Insideview Where (CompanyCountry='". $SelBuildCountry . "' OR '". $SelBuildCountry . "' = '') AND (CompanyState='". $SelBuildState . "' OR '". $SelBuildState . "' = '') AND (Industry='". $SelBuildIndustry . "' OR '". $SelBuildIndustry . "' = '') AND (SubIndustry='". $SelBuildSubIndustry . "' OR '". $SelBuildSubIndustry . "' = '') AND (CompanyName like '%". $Keyword . "%' OR '". $Keyword . "' = '') AND NOT EXISTS (SELECT 1 FROM ProjectCompanies WHERE ProjectID=".$_SESSION['ProjectID']." AND InsideviewID=Insideview.ID)";
 //           echo $sql."<br/>";
	            $ret = mysql_query($sql) or die(mysql_error());
	header("Location: build.php?page=".$_POST["pageno"]);	 
}

?>