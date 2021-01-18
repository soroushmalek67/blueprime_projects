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
	if ($_POST['SelProjectCapability']=="<-- All Capabilities -->")
		$_SESSION['SelProjectCapability'] = "";
	else
		$_SESSION['SelProjectCapability'] = $_POST['SelProjectCapability'];
	$_SESSION['ProjectKeyword'] = $_POST['Keyword'];
	header("Location: list2.php");
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
	header("Location: list2.php?page=".$_POST["pageno"]);
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
	header("Location: list2.php?page=".$_POST["pageno"]);	 
}
if(isset($_POST['btnDelAll']))
{
	echo "btnDelAll<br/>";
	include 'dbConn2.php';
            $sql = "DELETE FROM ProjectCompanies WHERE ProjectID =". $_SESSION['ProjectID']; 
//            echo $sql."<br/>";
	$ret = mysql_query($sql) or die(mysql_error());
	header("Location: list2.php");	 
}

?>