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
	if ($_POST['SelProjectIndustry']=="<-- All Industries -->")
		$_SESSION['SelProjectIndustry'] = "";
	else
		$_SESSION['SelProjectIndustry'] = $_POST['SelProjectIndustry'];
	if ($_POST['SelProjectSubIndustry']=="<-- All SubIndustries -->")
		$_SESSION['SelProjectSubIndustry'] = "";
	else
		$_SESSION['SelProjectSubIndustry'] = $_POST['SelProjectSubIndustry'];
	$_SESSION['ProjectKeyword'] = $_POST['Keyword'];
	header("Location: list.php");
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
	header("Location: list.php?page=".$_POST["pageno"]);
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
	header("Location: list.php?page=".$_POST["pageno"]);	 
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
	header("Location: list.php");	 
}
if(isset($_POST['btnDelAll']))
{
	echo "btnDelAll<br/>";
	include 'dbConn2.php';
            $sql = "DELETE FROM ProjectCompanies WHERE ProjectID =". $_SESSION['ProjectID']; 
//            echo $sql."<br/>";
	$ret = mysql_query($sql) or die(mysql_error());
	header("Location: list.php");	 
}
if(isset($_POST['btnExpAll']))
{
	include 'dbConn.php';
	if (mysqli_connect_errno($con))
	{
	  echo "<script>window.location = 'list.php'</script>";
	}
	else
	{
	  $result = mysqli_query($con,"SELECT * FROM ProjectCompanies pc Where ProjectID=". $_SESSION['ProjectID']);
	  if (!$result)
	      echo "<script>window.location = 'export.php'</script>";
	  else
	  {
	  while($row = mysqli_fetch_array($result))
	  {
	  	    $array[] = array(
	  	    	'Name'=>$row['Name'], 
	  	    	'Description'=>$row['Description'], 
	  	    	'Address'=>$row['Address'], 
	  	    	'City'=>$row['City'], 
	  	    	'State'=>$row['State'], 
	  	    	'PostalCode'=>$row['PostalCode'], 
	  	    	'Country'=>$row['Country'], 
	  	    	'Phone'=>$row['Phone'], 
	  	    	'Fax'=>$row['Fax'], 
	  	    	'Email'=>$row['Email'], 
	  	    	'Website'=>$row['Website'], 
	  	    	'NoEmployees'=>$row['NoEmployees'], 
	  	    	'LinkedIn'=>$row['LinkedInURL'], 
	  	    	'Facebook'=>$row['FacebookURL'], 
	  	    	'Twitter'=>$row['TwitterURL'], 
	  	    	'NAICSCode'=>$row['NAICSCode'], 
	  	    	'MantaURL'=>$row['MantaURL']
	  	    	);
	  }
	  mysqli_close($con);
	  }
	}
	download_send_headers("data_export_" . date("Y-m-d") . ".csv");
	echo array2csv($array);
	echo "<script>window.location = 'list.php'</script>";
	//header("Location: list.php");	 
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

?>