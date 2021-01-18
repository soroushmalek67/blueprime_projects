<?php
session_start();
$ProjectID = $_GET['ProjectID'];
include 'dbConn.php';
if (mysqli_connect_errno($con))
{
  echo "<script>window.location = 'index.html'</script>";
  exit();
}
else
{
  $result = mysqli_query($con,"select IFNULL(c.Region,c.City) City,MAX(c.lat) lat,MAX(c.lon) lon,COUNT(*) cnt from ProjectCompanies pc inner join Cities c On c.City = trim(pc.City) inner join States s ON s.Code=c.State and (s.Code=trim(pc.State) or s.Name=trim(pc.State)) Where ProjectID=$ProjectID group by IFNULL(c.Region,c.City) having MAX(c.lat) is not null");
  if (!$result)
  {
    echo "<script>window.location = 'index.html'</script>";
    exit();
  }
   $i = 0;
  echo "locations:{";
  while ($row = mysqli_fetch_array($result))
  {
  	  echo $i . ": {name: '". $row["City"] ."', lat:  ". $row["lat"] .", lng:  -". $row["lon"] .",color: 'default', description: '";
  	  $City = $row["City"];
        if ($row["cnt"] >1)
  	     echo $row["cnt"] ." Companies";
         else
         echo $row["cnt"] ." Company";
        if ($row["cnt"] >5)
          echo '<br/><br/><table class="table table-bordered" cellpadding="5px"><tr><td class="danger">Top 5 Companies </td><td class="success"> Revenue </td><td class="success"> No Employees </td></tr>';
        else
          echo '<br/><br/><table class="table table-bordered" cellpadding="5px"><tr><td class="danger">All Companies </td><td class="success"> Revenue </td><td class="success"> No Employees </td></tr>';
	  $result2 = mysqli_query($con,"select pc.Name,concat('$',format(pc.Revenue,1),'M') Revenue,format(pc.NoEmployees,0) NoEmployees from ProjectCompanies pc inner join Cities c ON c.City = trim(pc.City) inner join States s ON s.Code=c.State and (s.Code=trim(pc.State) or s.Name=trim(pc.State)) where ProjectID=$ProjectID and IFNULL(c.Region,c.City)='$City' ORDER BY CAST(pc.NoEmployees AS UNSIGNED)  Desc LIMIT 5");
        if (!$result2)
        {
          echo "<script>window.location = 'index.html'</script>";
          exit();
        }
	  while ($row2 = mysqli_fetch_array($result2))
	  {
	  	echo '<tr><td class="success">' .$row2["Name"] . '</td><td>'  .$row2["Revenue"] . '</td><td>'  .$row2["NoEmployees"] . '</td></tr>';
	  }
	  echo "</table>";
	  echo "'}";
        mysqli_free_result($result2);
	  $i=$i+1;
	  if ($i<mysqli_num_rows($result))
	    echo ",";
  }
  echo " }";
  mysqli_free_result($result);
  mysqli_close($con);
}

?>
