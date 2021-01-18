<?php
session_start();

                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                else
                {
                  $result = mysqli_query($con,"SELECT Name FROM ProjectCompanies WHERE ID=". $_SESSION['SelFirmoCompanyID']);
                  $row = mysqli_fetch_array($result);
                  echo '{"name": " '. $row['Name'] . ' "';
                  echo ',"children": [';
                  $result = mysqli_query($con,"select CapabilityID,Title from CompanyCapabilities cc inner join ProjectCapabilities pc on pc.ID = cc.CapabilityID where CompanyID=".$_SESSION['SelFirmoCompanyID']);
                  $i=0;
                  while($row = mysqli_fetch_array($result))
                  {
                  	$i=$i+1;
	                  echo '{"name": " '. $row['Title'] . ' "';
	                  echo ',"children": [';
	                  $result2 = mysqli_query($con,"select CompanyID,Name from CompanyCapabilities cc inner join ProjectCompanies pc on pc.ID = cc.CompanyID where CapabilityID=".$row['CapabilityID'] . " and CompanyID<>".$_SESSION['SelFirmoCompanyID']);
	                  $j=0;
	                  while($row2 = mysqli_fetch_array($result2))
	                  {
	                  	  $j=$j+1;
		              echo '{"id": '. $row2['CompanyID'] ;
		              echo ',"name": " '. $row2['Name'] . ' "';
		              if ($j<mysqli_num_rows($result2))
		              	echo "},";
		              else
		              	echo "}";
	                  }
	                  echo "]";

	                  if ($i<mysqli_num_rows($result))
	                  	echo "},";
	                  else
	                  	echo "}";
                  }
                  echo "]";
                  echo "}";
                  mysqli_close($con);
                }

?>