<?php
session_start();
$ProjectID = $_SESSION['ProjectID'];
$Max = 16;
                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                else
                {
                  $result = mysqli_query($con,"select case when (select count(distinct SUBSTRING(NAICSCode,1,6)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 6 when (select count(distinct SUBSTRING(NAICSCode,1,5)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 5 when (select count(distinct SUBSTRING(NAICSCode,1,4)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 4 when (select count(distinct SUBSTRING(NAICSCode,1,3)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 3 when (select count(distinct SUBSTRING(NAICSCode,1,2)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 2 else 0 end As Level");
                  $row = mysqli_fetch_array($result);
                  $level = $row['Level'];
                  $result = mysqli_query($con,"SELECT pc.Name CompanyName,n.Code,n.Name FROM ProjectCompanies pc INNER JOIN NAICS n on SUBSTRING(pc.NAICSCode,1,$level) = n.Code WHERE pc.ID=". $_SESSION['SelFirmoCompanyID']);
                  $row = mysqli_fetch_array($result);
                  echo '{"name": " '. $row['CompanyName'] . ' "';
                  echo ',"children": [';
	                  echo '{"name": " '. $row['Name'] . ' "';
	                  echo ',"children": [';
                        $result2 = mysqli_query($con,"SELECT pc.ID CompanyID,pc.Name CompanyName FROM ProjectCompanies pc WHERE SUBSTRING(pc.NAICSCode,1,$level) = '". $row['Code'] ."' AND ProjectID=". $ProjectID);
	                  $j=0;
	                  while($row2 = mysqli_fetch_array($result2))
	                  {
	                  	  $j=$j+1;
		              echo '{"id": '. $row2['CompanyID'] ;
		              echo ',"name": " '. $row2['CompanyName'] . ' "';
		              if ($j<mysqli_num_rows($result2))
		              	echo "},";
		              else
		              	echo "}";
	                  }
	                  echo "]";
	                  echo "}";
                  echo "]";
                  echo "}";
                  mysqli_close($con);
                }

?>