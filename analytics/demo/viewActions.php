<?php
session_start();

if(isset($_POST['btnSearch']))
{
	if ($_POST['SelProjectCountry']=="<-- All Countries -->")
		$_SESSION['SelProjectCountry'] = "";
	else
		$_SESSION['SelProjectCountry'] = $_POST['SelProjectCountry'];
	if ($_POST['SelProjectState']=="<-- All States -->")
		$_SESSION['SelProjectState'] = "";
	else
		$_SESSION['SelProjectState'] = $_POST['SelProjectState'];
	if ($_POST['SelProjectIndustry']=="<-- All Industries -->")
		$_SESSION['SelProjectIndustry'] = "";
	else
		$_SESSION['SelProjectIndustry'] = $_POST['SelProjectIndustry'];
	if ($_POST['SelProjectSubIndustry']=="<-- All SubIndustries -->")
		$_SESSION['SelProjectSubIndustry'] = "";
	else
		$_SESSION['SelProjectSubIndustry'] = $_POST['SelProjectSubIndustry'];
	$_SESSION['ProjectKeyword'] = $_POST['Keyword'];
	header("Location: view.php?ShowData=1");
}
if(isset($_POST['btnDelSelected']))
{
	echo "btnDelSelected<br/>";
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
	            $sql = "DELETE FROM ProjectCompanies WHERE ID=". $companies[$i];
//	            echo $sql."<br/>";
	            $ret = mysql_query($sql) or die(mysql_error());
	    }
	  }	
	header("Location: view.php?page=".$_POST["pageno"]);
}
if(isset($_POST['btnDelThese']))
{
	echo "btnDelThese<br/>";
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
	            $sql = "DELETE FROM ProjectCompanies WHERE ID=". $companies[$i];
//	            echo $sql."<br/>";
	            $ret = mysql_query($sql) or die(mysql_error());
	    }
	  }	
	header("Location: view.php?page=".$_POST["pageno"]);	 
}
if(isset($_POST['btnDelAllSearched']))
{
	echo "btnDelAllSearched<br/>";
	if (isset($_SESSION['SelProjectCountry']))
		$SelProjectCountry = $_SESSION['SelProjectCountry'];
	else
		$SelProjectCountry = "";
	if (isset($_SESSION['SelProjectState']))
		$SelProjectState = $_SESSION['SelProjectState'];
	else
		$SelProjectState = "";
	if (isset($_SESSION['SelProjectIndustry']))
		$SelProjectIndustry = $_SESSION['SelProjectIndustry'];
	else
		$SelProjectIndustry = "";
	if (isset($_SESSION['SelProjectSubIndustry']))
		$SelProjectSubIndustry = $_SESSION['SelProjectSubIndustry'];
	else
		$SelProjectSubIndustry = "";
	$Keyword = $_SESSION['ProjectKeyword'];
	include 'dbConn2.php';
           $sql = "DELETE FROM ProjectCompanies WHERE ProjectID =". $_SESSION['ProjectID']." AND (Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (Industry='". $SelProjectIndustry . "' OR '". $SelProjectIndustry . "' = '') AND (SubIndustry='". $SelProjectSubIndustry . "' OR '". $SelProjectSubIndustry . "' = '') AND (Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')";
    //        echo $sql."<br/>";
	$ret = mysql_query($sql) or die(mysql_error());
	header("Location: view.php");	 
}
if(isset($_POST['btnDelAll']))
{
	echo "btnDelAll<br/>";
	include 'dbConn2.php';
            $sql = "DELETE FROM ProjectCompanies WHERE ProjectID =". $_SESSION['ProjectID']; 
//            echo $sql."<br/>";
	$ret = mysql_query($sql) or die(mysql_error());
	header("Location: view.php");	 
}

?>